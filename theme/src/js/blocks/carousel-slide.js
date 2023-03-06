import theme_icons from './icons.js';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { MediaUpload, MediaUploadCheck, InspectorControls, InnerBlocks, RichText } = wp.blockEditor; 
const { ColorPicker, PanelBody, Button, SelectControl, TextControl } = wp.components;

registerBlockType('rbt/carousel-slide', { 
 
	title: 'Animated Slide for Robot Slider', 
	icon: theme_icons.friendlyrobot,
    category: 'friendlyrobot', 
    //attributes
    attributes: {
        image:{
            type: 'object',
            default: {}
        },
        title:{
            type: 'string',
            default: ''
        },
        text: {
            type: 'string',
            default: ''
        },
        price: {
            type: 'string',
            default: ''
        }

    },   

	edit({attributes, setAttributes}){
		const { title, text, image, price } = attributes;

        function onTextChange(newtext){
        	setAttributes({ text: newtext });
        }
        function setStyle(newstyle){
        	setAttributes({ style: newstyle });
        }
        function onTitleChange(newtitle){
            setAttributes({title:newtitle});
        }
        function onSelectMedia(media){
            setAttributes({ image: media});
        }
        function onPriceChange(newprice){
            setAttributes({ price: newprice});
        }

		return ([
            <InspectorControls style={{marginBottom: '20px' }}>
                <PanelBody title="Image">
                    <p><strong>Image:</strong></p>
                    <MediaUploadCheck>
                        <p><strong>Upload Image</strong></p>
                        <MediaUpload
                            label="Image"
                            onSelect={ (media) => onSelectMedia(media) }
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
                </PanelBody>,            
            </InspectorControls>,

            <div className="rbt-carousel-slide">
                <div className={"rbt-slide-container"}>
                    <RichText 
                        tagName="h2"
                        className="carousel-title"
                        value={title}
                        onChange={onTitleChange}
                        placeholder={ 'Accordion Title' }
                    />
                    <RichText 
                        tagName="h4"
                        className="carousel-tagline"
                        value = {text}
                        onChange={onTextChange}
                        placeholder={ 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'} 
                    />   
                    <TextControl
                        value={price}
                        onChange={onPriceChange}
                        placeholder={ 'Price in IDR' }
                    /> 
                </div>
            </div>

        ]);
	},
	save({attributes}) {
		const { title, text, image, price } = attributes;

		return (
            <div className="rbt-carousel-slide" data-process="doSlide">
                <div className={"rbt-slide-container"} >
                    
                    <img 
                        className="foregroundImage"
                        src={image.url} 
                    />
                    <section class="header">
                        <div class="title-wrapper">
                           
                            <RichText.Content
                                tagName="h1"
                                className="mod-title"
                                value={title}
                            />
                 
                        </div>
                    </section>

                    <RichText.Content
                        tagName="h4"
                        className="carousel-tagline"
                        value = {text}
                    />  

                    <div className="price-pop showprice idr" data-currency="IDR" data-default-price={price}>{price}</div>
                </div>   
            </div>
		)
	}
});