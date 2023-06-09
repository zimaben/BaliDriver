import theme_icons from './icons.js';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { RichText, InspectorControls, MediaUploadCheck, MediaUpload } = wp.blockEditor; 
const { Button, PanelBody } = wp.components;

registerBlockType('rbt/card-section-card', { 
 
	title: 'Universal Card for Components', 
	icon: theme_icons.friendlyrobot,
    category: 'friendlyrobot', 
    //attributes
    attributes: {
        lightimage: {
            type: 'object',
            default: {},
        },
        darkimage: {
            type: 'object',
            default: {},
        },
        title:{
            type: 'string',
            default: ''
        },
        text: {
            type: 'string',
            default: ''
        },
        ctatype: {
            type: 'string',
            default: 'none'
        },
        ctatarget: {
            type: 'string',
            default: null
        },
        ctatext: {
            type: 'string',
            default: null
        }

    },   

	edit({attributes, setAttributes}){
		const { darkimage, lightimage, title, text, ctatype, ctatarget, ctatext } = attributes;

        function onTextChange(newtext){
        	setAttributes({ text: newtext });
        }
        function onTitleChange(newtitle){
            setAttributes({title:newtitle});
        }
        function onSelectDark(newimage){
            setAttributes({darkimage: newimage})
        }
        function onSelectLight(newimage){
            setAttributes({lightimage: newimage})
        }
        function renderSrcSet(img, array){
            const rows = [];
            Object.keys(img.sizes).forEach(function(key, idx){
                if(array.includes(key) ){
                    rows.push (img.sizes[key].url + ' ' + img.sizes[key].width + 'w' )
                }
            });
            return rows.length ? rows.join(',') : '';
        }
        

		return ([

            <InspectorControls>
                <PanelBody title="Card Image">
                    <MediaUploadCheck>
                        <p><strong>Dark/Light Images</strong></p>
                        <MediaUpload
                            label="Image"
                            onSelect={ (media) => onSelectDark(media) }
                            allowedTypes={ ['image'] }
                            value={ darkimage.id }

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
                                            { darkimage.id > 0 ? 'Edit Dark Image': 'Upload Dark Image'}
                                        </Button>
                                    </>
                                )
                            } }
                        />
                    </MediaUploadCheck>
                    <MediaUploadCheck>
                    <MediaUpload
                            label="Image"
                            onSelect={ (media) => onSelectLight(media) }
                            allowedTypes={ ['image'] }
                            value={ lightimage.id }

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
                                            { lightimage.id > 0 ? 'Edit Light Image': 'Upload Light Image'}
                                        </Button>
                                    </>
                                )
                            } }
                        />
                    </MediaUploadCheck>
                </PanelBody>
            </InspectorControls>,
            <div className="rbt-card-section-card">
                <div class="rbt-card-image">
                    { darkimage && darkimage.id && 
                        
                        <div className="imgwrap" 
                             style={{backgroundImage: "url(" + darkimage.url + ")"}}
                             data-image-light={lightimage.url}
                             data-image-dark={darkimage.url}
                        >
                            {/* <img className="bm-module-img"   
                                key={ image.id }
                                src={ image.url }
                                srcset={renderSrcSet(image, ['medium', 'large'])}
                                alt={ image.alt ? image.alt : image.caption }
                            /> */}
                        </div>
                        
                    }
                </div>
                <div class="card-text">
                    <RichText 
                        tagName="h3"
                        className="card-title"
                        value={title}
                        onChange={onTitleChange}
                        placeholder={ 'Card Title' }
                    />
                    <div class="card-text">
                        <RichText 
                            tagName="p"
                            multiline={true}
                            className="card-text"
                            value = {text}
                            onChange={onTextChange}
                            placeholder={ 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'} 
                        />   
                    </div>
                </div>
            </div>

        ]);
	},
	save({attributes}) {
		const { darkimage, lightimage, title, text, ctatype, ctatarget, ctatext } = attributes;
        function renderSrcSet(img, array){
            const rows = [];
            Object.keys(img.sizes).forEach(function(key, idx){
                if(array.includes(key) ){
                    rows.push (img.sizes[key].url + ' ' + img.sizes[key].width + 'w' )
                }
            });
            return rows.length ? rows.join(',') : '';
        }
		return (
            <div className="rbt-card-section-card">
                <div class="rbt-card-image">
                    { darkimage && darkimage.id && 
                        
                        <div className="imgwrap" 
                        style={{backgroundImage: "url(" + darkimage.url + ")"}}
                        data-image-light={lightimage.url}
                        data-image-dark={darkimage.url}
                        >
                            {/* <img className="bm-module-img"   
                                key={ image.id }
                                src={ image.url }
                                srcset={renderSrcSet(image, ['medium', 'large'])}
                                alt={ image.alt ? image.alt : image.caption }
                            /> */}
                        </div>
                        
                    }
                </div>
                <div className="rbt-card-info">
                    <RichText.Content
                        tagName="h3"
                        className="rbt-title"
                        value={title}
                    />
                    <div className="rbt-card-section-card-text">
                        <RichText.Content
                            tagName="p"
                            value = {text}
                        />   
                    </div>
                </div>
            </div>
		)
	}
});