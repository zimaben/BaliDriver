import theme_icons from './icons.js';


const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { MediaUpload, MediaUploadCheck, InspectorControls, InnerBlocks, RichText } = wp.blockEditor; 
const { ColorPicker, PanelBody, Button, TextControl } = wp.components;
//const theme_json = require('../../../../theme.json');


registerBlockType('rbt/carousel-slide-canvas', { 
    /* 
        https://codepen.io/mireille1306/pen/BawdXzY
    */
	title: 'Canvas Slide for Robot Slider', 
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
        colorone: {
            type: 'string',
            default: '#000'
        },
        colortwo: {
            type: 'string',
            default: '#fff'
        },
        price: {
            type: 'number', 

        }

    },   

	edit({attributes, setAttributes}){
		const { title, text, image, colorone, colortwo, price } = attributes;

        function onTextChange(newtext){
        	setAttributes({ text: newtext });
        }
        function onPriceChange(newprice){
        	setAttributes({ price: Number(newprice) });
        }
        function onTitleChange(newtitle){
            setAttributes({title:newtitle});
        }
        function onSelectMedia(media){
            setAttributes({ image: media
            });
        }
        function setColorOne(newcolor){
            setAttributes({ colorone: newcolor
            });
        }
        function setColorTwo(newcolor){
            setAttributes({ colortwo: newcolor
            });
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
                </PanelBody>
                <PanelBody title="Background">
                    <p><strong>Color One:</strong></p>
                    <ColorPicker
                        color={colorone}
                        onChange= { ( color ) => setColorOne( color )}
                    />
                    <p><strong>Color Two:</strong></p>
                    <ColorPicker
                        color={colortwo}
                        onChange = { ( color ) => setColorTwo( color )}
                    />
                </PanelBody>
                
            </InspectorControls>,

            <div className="rbt-carousel-slide">
                <canvas class="rbt-carousel-animated"
                    data-foreground-image={image.url}
                    data-canvas-colorone={colorone}
                    data-canvas-colortwo={colortwo}
                />
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
                    label="Price (in default currency)"
                    value = {price}
                    onChange={onPriceChange}
                    placeholder={ 500 } 
                />   
            </div>

        ]);
	},
	save({attributes}) {
		const { title, text, image, colorone, colortwo, price } = attributes;
        function LightenDarkenColor(col, amt) {
            var R = parseInt(col.substring(1,3),16);
            var G = parseInt(col.substring(3,5),16);
            var B = parseInt(col.substring(5,7),16);
        
            R = parseInt(R * (100 + amt) / 100);
            G = parseInt(G * (100 + amt) / 100);
            B = parseInt(B * (100 + amt) / 100);
        
            R = (R<255)?R:255;  
            G = (G<255)?G:255;  
            B = (B<255)?B:255;  
        
            R = Math.round(R)
            G = Math.round(G)
            B = Math.round(B)
        
            var RR = ((R.toString(16).length==1)?"0"+R.toString(16):R.toString(16));
            var GG = ((G.toString(16).length==1)?"0"+G.toString(16):G.toString(16));
            var BB = ((B.toString(16).length==1)?"0"+B.toString(16):B.toString(16));
        
            return "#"+RR+GG+BB;
        }
        //let col1 = LightenDarkenColor(colorone, 90);
        let col1 = "#4af7ff";
        //let col2 = LightenDarkenColor(colortwo, 90);
        let col2 = "#165bfb";
		return (
            <div className="rbt-carousel-slide" data-process="doCanvasSlide">
                <canvas class="rbt-carousel-animated"
                    data-foreground-image={image.url}
                    data-canvas-colorone={colorone}
                    data-canvas-colortwo={colortwo}
                />

                <section class="header">
                    <div class="title-wrapper">
                        <h1 class="sweet-title" style={{textShadow: "3px 1px 1px " + col1 + ", 2px 2px 1px " + col2 + ", 4px 2px 1px " + col1 + ", 3px 3px 1px " + col2  + ", 5px 3px 1px " + col1 + ", 4px 4px 1px " + col2 + ", 6px 4px 1px " + col1 + ", 5px 5px 1px " + col2 + ", 7px 5px 1px " + col1 + ", 6px 6px 1px " + col2 + ", 8px 6px 1px " + col1 + ", 7px 7px 1px " + col2 + ", 9px 7px 1px " + col1 }}>
                            <RichText.Content
                                tagName="span"
                                className="mod-title"
                                value={title}
                            />
                        </h1>
                    </div>
                </section>
                <RichText.Content
                    tagName="h4"
                    className="carousel-tagline"
                    value={text}
                />   
                <div className="price-pop" data-currency="IDR">{price}</div>
            </div>
		)
	}
});