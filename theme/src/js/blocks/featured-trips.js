import theme_icons from './icons.js';

const { useSelect } = wp.data;
const { decodeEntities } = wp.htmlEntities;
const { useState } = wp.element;
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { RichText, InspectorControls, MediaUploadCheck, MediaUpload } = wp.blockEditor; 
const { SearchControl, PanelBody, Spinner, Button, ToggleControl, SelectControl, RangeControl, TextControl, ColorPicker  } = wp.components;

registerBlockType('rbt/featured-trips', { 
 
	title: 'Featured Trips Section', 
	icon: theme_icons.friendlyrobot,
    category: 'friendlyrobot', 
    supports: {
        //align: ['alignwide', 'aligncenter', 'alignfull', 'alignleft', 'alignright']
        align: true
    },
    //attributes
    attributes: {
        title:{
            type: 'string',
            default: ''
        },
        text: {
            type: 'string',
            default: ''
        },
        image: {
            type: 'object',
            default:{}
        },
        /* Default stuff */ 
        scrollLink:{
            type: 'string',
            default: null
        },
        reversed: {
            type: 'boolean',
            default: false,
        },
        leftColWidth:{
            type: 'number',
            default: 60
        },
        gap: {
            type: 'number',
            default: 30
        },
        /* Selected Data */
        selectedTrips: {
            type: 'array',
            default: []
        },
        /* Background */
        bgType: {
            type: 'string',
            default: 'None'
        },
        isLinearGradient: { 
            type: 'boolean',
            default:true,
        },
        gradientArg: {
            type: 'string',
            default: 'to left'
        },
        bgColor: { 
            type: 'string',
            default: null
        },
        bgColorTwo: {
            type: 'string',
            default: null
        },
        expandAdder: { 
            type: 'boolean',
            default: false
        },
        componentIdentifier: {
            type: 'number',
            default: 0
        }
    },   

	edit({attributes, setAttributes}){
		const { title, text, image, scrollLink, reversed, selectedTrips, bgType, bgColor, bgColorTwo, expandAdder, leftColWidth, isLinearGradient, gradientArg, gap, componentIdentifier } = attributes;
        {componentIdentifier === 0 ? setAttributes({componentIdentifier: Math.floor(Math.random()*90000) + 10000}) : null }
        const breakpoint = 991; //set breakpoints here or import from JSON
        const mediakey = '@media (max-width: '+ breakpoint + 'px)';
        function inlineStyleWithMediaQuery(){
            return (
                <style dangerouslySetInnerHTML={ {__html: `
                    .rbt-featured-trips .layout._${ componentIdentifier} .leftcol{
                        width: Calc( ${ leftColWidth }% - ${ Math.floor(gap / 2) }px);
                    }
                    .rbt-featured-trips .layout._${ componentIdentifier} .rightcol{
                        width: Calc( ${ 100 - leftColWidth }% - ${ Math.floor(gap / 2) }px );
                    }
                    @media (max-width: ${ breakpoint }px){
                        .rbt-featured-trips .layout._${ componentIdentifier} .leftcol{width:100%;}
                        .rbt-featured-trips .layout._${ componentIdentifier} .rightcol{width:100%;}
                    }
                `}} />
            )
        }

        function onTextChange(newtext){
        	setAttributes({ text: newtext });
        }
        function onTitleChange(newtitle){
            setAttributes({ title: newtitle });
        }
        function setColorOne(newcolor){
            setAttributes({bgColor:newcolor});
        }
        function setColorTwo(newcolor){
            setAttributes({bgColorTwo:newcolor});
        }
        function onSelectMedia(media) {
            setAttributes({ image: media });
          }
        function onUpdateScrollLink(newtext){
            setAttributes({scrollLink:newtext}); 
        }
        function RemovePostButtonClick(post_id){
            const updatedTrips = selectedTrips.filter( trip => { return trip.id !== post_id } );
            setAttributes({selectedTrips: updatedTrips, expandAdder: false });
        }

        function AddPostButtonClick(pageobject){
            console.log(pageobject)
            if(typeof pageobject._embedded === "undefined"){
                setAttributes({
                    selectedTrips: [...selectedTrips, { id: pageobject.id, title: pageobject.title, excerpt: pageobject.excerpt, slug: pageobject.slug, featuredImage: 0 }], 
                    expandAdder: !expandAdder
                });
            } else {
                const sizes = pageobject._embedded.hasOwnProperty('wp:featuredmedia') ? pageobject._embedded['wp:featuredmedia'][0].media_details.sizes : false;
                if(sizes){
                    setAttributes({
                        selectedTrips: [...selectedTrips, { id: pageobject.id, title: pageobject.title, excerpt: pageobject.excerpt, slug: pageobject.slug, featuredImage: sizes }], 
                        expandAdder: !expandAdder
                    });
                } else {
                    setAttributes({
                        selectedTrips: [...selectedTrips, { id: pageobject.id, title: pageobject.title, excerpt: pageobject.excerpt, slug: pageobject.slug, featuredImage: 0 }], 
                        expandAdder: !expandAdder
                    });
                }
            }
        }
        function SelectPage(){
            const [searchTerm, setSearchTerm] = useState( '' );
            const {pages, hasResolved } = useSelect(
                select => {
                    const query = {};
                    if(searchTerm){
                        query.search = searchTerm;
                        query._embed = true;
                    }
                    return {
                        pages: select('core').getEntityRecords( 'postType', 'trips', query),
                        hasResolved: select('core').hasFinishedResolution( 'getEntityRecords', ['postType', 'trips', query] ),
                    }
                    
                },[searchTerm]);
            return (
                <div>
                    <SearchControl
                        onChange={ setSearchTerm }
                        value={ searchTerm }
                    />
                    <PagesList hasResolved={ hasResolved } pages={pages} />
                </div>
            );

        }
        function stripTheTags( htmlstring ){
            return (<div className="editorRenderTags" dangerouslySetInnerHTML={{ __html: htmlstring  }}>
            
            </div>);
        }
        function PagesList( { hasResolved, pages } ) {
            if ( !hasResolved ) {
                return <Spinner/>
            }
            if ( !pages?.length ) {
                return <div>No results</div>
            }
            const selectedIds = selectedTrips.map(trip => { return trip.id })
            return (
                <table className="wp-list-table widefat fixed striped table-view-list">
                    <thead>
                        <tr>
                            <th>Trip Title</th><th>Feature</th>
                        </tr>
                    </thead>
                    <tbody>
                        { pages?.map( page => {
                            if(!selectedIds.includes( page.id)){ 
                                return ( 
                                    <tr key={ page.id }>
                                        <td>{ decodeEntities(page.title.rendered) }</td>
                                        <td>
                                            {selectedTrips.length < 4 &&
                                                <Button variant="primary" onClick={ ()=> {
                                                     AddPostButtonClick(page)
                                                } }> 
                                                 
                                                   Add
                                                </Button>
                                            
                                            }

                                        </td>
                                    </tr>
                                )   
                            }
                        } 
                        )}
                    </tbody>
                </table>
            )
        }
        function TripCard( selectedTrips ){
            return(
                <div className="featured-trips">
                    {
                        selectedTrips.map( trip => (
                            
                            <div className="trip-card">{ /*console.log(trip) */}
                                <div className="trip-img">
                                    {(trip.featuredImage !== 0) &&
                                        <img className="trip-img-tag" src={trip.featuredImage.medium.source_url} />
                                    }
                                    {

                                    }
                                </div>
                                <div className="trip-details">
                                    <h3 className="trip-title">{ decodeEntities(trip.title.rendered) }</h3>
                                    <div className="trip-excerpt">{ stripTheTags( decodeEntities(trip.excerpt.rendered)) }</div>
                                    <span className="rbt-cta">Details!</span>
                                    <Button variant="secondary" className="rbt-editor-remove" onClick={ ()=> { RemovePostButtonClick(trip.id); } } >Remove Post</Button>
                                </div>
                            </div>
                        ))
                    }
                </div>
            )

        }
        function RenderBackgroundDetails( { type } ){
                switch(type){
                case "Image": return(
                    <MediaUploadCheck>
                        <p><strong>Upload Image:</strong></p>
                        <MediaUpload
                            label="Image"
                            onSelect={ (media) => { onSelectMedia(media) } }
                            allowedTypes={ ['image'] }
                            accept={["image/*", "image/svg"]}
                            value={ image.id }

                            render={ ({open}) => {
                                return (
                                    <>
                                        <Button
                                            isPrimary={ true }
                                            onClick={ (event) => {
                                                event.stopPropagation();
                                                open();
                                            } }
                                        >
                                            { image.id > 0 ? 'Edit Image': 'Upload Image'}
                                        </Button>
                                    </>
                                );
                            } }
                        />
                    </MediaUploadCheck>
                ); break;
                case "Color": return(
                <>
                    <p><strong>Background Color:</strong></p>
                    <ColorPicker
                        color={bgColor}
                        onChange= { ( color ) => setColorOne( color )}
                        enableAlpha
                    />
                </>
                ); break;
                case "Gradient": return(
                <>
                    <p><strong>Gradient Start Color:</strong></p>
                    <ColorPicker
                        color={bgColor}
                        onChange= { ( color ) => setColorOne( color )}
                        enableAlpha
                    />
                    <p><strong>Gradient End Color:</strong></p>
                    <ColorPicker
                        color={bgColorTwo}
                        onChange = { ( color ) => setColorTwo( color )}
                        enableAlpha
                    />
                    <p><strong>Gradient Style</strong></p>
                    <ToggleControl 
                        help={ isLinearGradient ? 'Linear' : 'Radial' }
                        checked={isLinearGradient}
                        onChange={() => {setAttributes({isLinearGradient: !isLinearGradient}); }}
                    />
                    { isLinearGradient ? 
                    <TextControl
                        label="(optional) First Linear Gradient Argument (Ex: 'to top, 45deg, etc.')"
                        placeholder="to left"
                        value={gradientArg}
                        onChange={ (text) => { setAttributes({gradientArg: text})} }
                    /> : null }
                </>
                ); break;
            }
        }
        function renderStyle(){
            switch( bgType ){
                case "None": return null; break;
                case "Image": return({backgroundImage: 'url(' + image.url + ')'});break;
                case "Color": return({backgroundColor: bgColor});break;
                case "Gradient": 
                    if( isLinearGradient ){
                        const argOne = gradientArg ? gradientArg : 'to left';
                        return ({backgroundImage: 'linear-gradient(' + argOne + ', ' + bgColor + ', ' + bgColorTwo + ')'})
                    } else {
                        const argOne = gradientArg ? gradientArg : 'to left';
                        return ({backgroundImage: 'radial-gradient(' + bgColor + ', ' + bgColorTwo + ')'})
                    }
                break;
            }
        }
		return ([
            <InspectorControls style={{marginBottom: '20px' }}>
                <PanelBody title="Layout">
                    <p><strong>Switch Direction?</strong></p>
                    <ToggleControl
                        label="Switch Direction?"
                        help={ reversed ? 'Text Left' : 'Text Right' }
                        checked={reversed}
                        onChange={() => setAttributes({reversed: !reversed})}
                    />
                    <p><strong>Column Width</strong></p>
                    <RangeControl
                        label="Left / Right"
                        value={ columns }
                        onChange={ ( val ) => setAttributes({leftColWidth: val }) }
                        min={ 10 }
                        max={ 90 }
                    />
                    <p><strong>Add a Scroll Link?</strong></p>
                    <p>(No # character please)</p>
                    <TextControl 
                        label="Scroll Link"
                        value={scrollLink}
                        onChange={onUpdateScrollLink}
                        placeholder="scroll-here"
                    />
                    
                </PanelBody>
                <PanelBody title="Background">
                    <p><strong>Background Settings:</strong></p>
                    {console.log("bgType", bgType)}
                        <SelectControl 
                            label="Background Type"
                            value={bgType}
                            onChange={ (selected)=> { setAttributes({ bgType: selected})} }
                            options={[
                                {label:'None', value:'None'}, 
                                {label:'Image', value: "Image"},
                                {label:'Color', value:'Color'},
                                {label: 'Gradient', value: 'Gradient'},
                            ]}
                        />
                    { bgType === 'None' ? '' : <p><strong>Details</strong></p> }
                    { bgType === 'None' ? '' : <RenderBackgroundDetails type={ bgType } /> }

                </PanelBody>
            </InspectorControls>,
            <>{ inlineStyleWithMediaQuery() }
            
                <div className="rbt-featured-trips">
                    <div className="underlay" style={ renderStyle() }></div>
                    <div className="filters"></div>
                    <div className={ reversed ? "layout reversed _" + componentIdentifier : "layout _" + componentIdentifier}>
                        <div className="leftcol">
                            { selectedTrips && selectedTrips.length ? TripCard( selectedTrips ) : null }
                            { selectedTrips.length < 4 ?
                                (expandAdder ? SelectPage() : <Button variant="primary" onClick={ () => { setAttributes({expandAdder: !expandAdder})} }>Add Trip to Section</Button>) : null
                            }
                            
                            
                        </div>
                        <div className="rightcol">
                            <RichText 
                                tagName="h2"
                                className="modtitle"
                                value={title}
                                onChange={onTitleChange}
                                placeholder={ 'Section Title' }
                            />
                            <RichText 
                                tagName="div"
                                className="rbt-accordion-panel"
                                value = {text}
                                onChange={onTextChange}
                                placeholder={ 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'} 
                            />  
                        </div>
    
                    </div>
                </div>
            </>

        ]);
	},
	save({attributes}) {
		const { title, text, image, scrollLink, reversed, selectedTrips, bgType, bgColor, bgColorTwo, expandAdder, leftColWidth, isLinearGradient, gradientArg, gap, componentIdentifier } = attributes;
        function TripCard( selectedTrips ){
            return(
                <div className="featured-trips">
                    {
                        selectedTrips.map( trip => (
                            
                            <div className="trip-card">{console.log(trip)}
                                <div className="trip-img">
                                    {(trip.featuredImage !== 0) &&
                                        <img className="trip-img-tag" src={trip.featuredImage.medium.source_url} />
                                    }
                                </div>
                                <div className="trip-details">
                                    <h3 className="trip-title">{ trip.title.rendered }</h3>
                                    <div className="trip-excerpt">{ stripTheTags( decodeEntities(trip.excerpt.rendered)) }</div>
                                    <span className="rbt-cta">Details!</span>
                                </div>
                            </div>
                        ))
                    }
                </div>
            )

        }
        function renderStyle(){
            switch( bgType ){
                case "None": return null; break;    
                case "Image": return({backgroundImage: 'url(' + image.url + ')'});break;
                case "Color": return({backgroundColor: bgColor});break;
                case "Gradient": 
                    if( isLinearGradient ){
                        const argOne = gradientArg ? gradientArg : 'to left';
                        return ({backgroundImage: 'linear-gradient(' + argOne + ', ' + bgColor + ', ' + bgColorTwo + ')'})
                    } else {
                        const argOne = gradientArg ? gradientArg : 'to left';
                        return ({backgroundImage: 'radial-gradient(' + bgColor + ', ' + bgColorTwo + ')'})
                    }
                break;
            }
        }
        function stripTheTags( htmlstring ){
            return (<div className="editorRenderTags" dangerouslySetInnerHTML={{ __html: htmlstring  }}>
            
            </div>);
        }
		return (
            <div className="rbt-featured-trips">
                <div className="underlay"
                    style={ renderStyle() }
                ></div>
                <div className="filters"></div>
                <div className={ reversed ? "layout reversed" : "layout"}>
                    <div className="leftcol">
                        {TripCard( selectedTrips )}
                    </div>
                    <div className="rightcol">
                        <RichText.Content
                            tagName="h3"
                            className="rbt-title"
                            value={title}
                        />
                        <div className="rbt-featured-trips-text">
                            <RichText.Content
                                tagName="p"
                                value = {text}
                            />  
                        </div>
                    </div> 
                </div>
            </div>
		)
	}
});