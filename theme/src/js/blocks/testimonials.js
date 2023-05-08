import theme_icons from './icons.js';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { InnerBlocks, InspectorControls, RichText } = wp.blockEditor; 
const { ColorPicker, PanelBody, ToggleControl, SelectControl, Button, TextControl } = wp.components;

const ALLOWED = ['rbt/testimonial-card'];

registerBlockType('rbt/testimonials', { 
 
	title: 'Testimonials', 
	icon: theme_icons.friendlyrobot,
    category: 'friendlyrobot', 
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
            default: '#000000'
        },
        bgColorTwo: {
            type: 'string',
            default: 'transparent'
        },
        /* innerBlocks Helper */
        innerBlockLength:{
            type: 'number',
            default: 0,
        }

    },   

	edit({clientId, attributes, setAttributes}){
		const { title, text, isLinearGradient, gradientArg, bgType, bgColor, bgColorTwo, innerBlockLength } = attributes;
        const parentBlock = wp.data.select( 'core/editor' ).getBlocksByClientId( clientId )[ 0 ];
        const childBlocks = parentBlock.innerBlocks;

        // reference number of carousel blocks
        setAttributes( {innerBlockLength: childBlocks.length});
        function onTextChange(newtext){
        	setAttributes({ text: newtext });
        }
        function onTitleChange(newtitle){
            setAttributes({title:newtitle});
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
            <InspectorControls>
                <PanelBody title="Background">
                    <p><strong>Background Settings:</strong></p>

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
            <div className="rbt-testimonials">
                
                <RichText 
                    tagName="h2"
                    className="mod-title"
                    value={title}
                    onChange={onTitleChange}
                    placeholder={ 'Module Title' }
                />
                <RichText 
                    tagName="p"
                    className="mod-text"
                    value = {text}
                    onChange={onTextChange}
                    placeholder={ 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'} 
                />   
                <InnerBlocks allowedBlocks={ ALLOWED } /> 
            </div>

        ]);
	},
	save({attributes}) {
        const { title, text, isLinearGradient, gradientArg, bgType, bgColor, bgColorTwo, innerBlockLength } = attributes;
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
		return (
            <div className="rbt-testimonials" data-process="doTestimonials">
                <div className="underlay"
                    style={ renderStyle() }
                ></div>
                <div className={"layout"}>
                    <div className="top">
                        <RichText.Content tagName="h2" className="mod-title" value={title} />
                        <div className="mod-textwrap">
                            <RichText.Content tagName="p" className="mod-text" value={text} />
                        </div>
                    </div>
                    <div className="bottom">
                        {innerBlockLength && 
                            <div className="rbt-carousel-control left">
                                <span className="control-left" >
        
                                </span>
                            </div>
                        }
                        <InnerBlocks.Content  />
                        {innerBlockLength && 
                            <div className="rbt-carousel-control right">
                                <span className="control-right" >
        
                                </span>
                            </div>
                        }
                    </div>
                </div>
            </div>
        )
	}
});