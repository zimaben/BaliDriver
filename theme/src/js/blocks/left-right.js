import theme_icons from './icons.js';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { MediaUpload, MediaUploadCheck, InspectorControls, InnerBlocks } = wp.blockEditor; 
const { ColorPicker, PanelBody, Button, ToggleControl, TextControl  } = wp.components;
const ALLOWED = ['core/paragraph', 'core/list', 'core/heading', 'core/buttons', 'core/button'];
registerBlockType('rbt/left-right', { 
 
	title: 'Image and Text', 
	icon: theme_icons.kitelytech,
    category: 'friendlyrobot', 
    //attributes
    attributes: {
        image:{
            type: 'object',
            default: {}
        },
        option:{
            type: 'boolean',
            default: false,
        },
        scrollLink: {
            type: 'string',
            default:null
        }, 
        bgColor: {
            type: 'boolean',
            default:false,
        }, 
        isGradient:{
            type: 'boolean',
            default:false,
        },
        bgColorOne: {
            type: 'string',
            default: '',
        },
        bgColorTwo: {
            type: 'string',
            default: '',
        }

    },   

	edit({attributes, setAttributes}){
		const { image, option, scrollLink, bgColor, isGradient, bgColorOne, bgColorTwo } = attributes;

        function onChangeOption(){
            setAttributes({ option: !option});
        }
        function onSelectMedia(media){
            setAttributes({ image: media
            });
        }
        function onUpdateScrollLink(newtext){
            setAttributes({scrollLink:newtext});
        }
        function setColorOne(newcolor){
            setAttributes({ bgColorOne: newcolor});
        }
        function setColorTwo(newcolor){
            setAttributes({ bgColorTwo: newcolor});
        }
        function renderBackground(){
            if(!bgColor) return "";
            if(bgColor && isGradient && bgColorOne && bgColorTwo){
                return "linear-gradient(to top, " + bgColorOne + "," + bgColorTwo + ");";
            }
            if(bgColor && bgColorOne){
                return bgColorOne;
            }
            return "";
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

		return (
            [
            <InspectorControls style={{marginBottom: '20px' }}>
                <PanelBody title="Image">
                    <p><strong>Upload Image </strong></p>
                    <MediaUploadCheck>
                        <p><strong>Image Settings</strong></p>
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

                        <p><strong>Switch Direction?</strong></p>
                        <ToggleControl
                            label="Switch Direction?"
                            help={ option ? 'Image Right' : 'Image Left' }
                            checked={option}
                            onChange={onChangeOption}
                        />
                    <p><strong>Add a Scroll Link?</strong></p>
                    <p>(No # character please)</p>
                    <TextControl 
                        label="Scroll Link"
                        value={scrollLink}
                        onChange={onUpdateScrollLink}
                        placeholder="scroll-here"
                    />
                    </MediaUploadCheck>
                </PanelBody>
                <PanelBody title="Background">
                    <p><strong>Colored Background?</strong></p>
                        <ToggleControl
                            label="Background Color"
                            help={ option ? 'Color' : 'Transparent' }
                            checked={bgColor}
                            onChange={ () => setAttributes({bgColor: !bgColor}) }
                        />
                    { bgColor && 
                        <>
                            <p><strong>Background Gradient?</strong></p>
                            <ToggleControl
                                label="Switch Direction?"
                                help={ isGradient ? 'Gradient (to Top)' : 'Solid Background' }
                                checked={isGradient}
                                onChange={ () => setAttributes({isGradient: !isGradient}) }
                            />
                        </>
                    }
                    { bgColor && 
                        <>
                            <p><strong>Background Color:</strong></p>
                            <ColorPicker
                                color={bgColorOne}
                                onChange= { ( color ) => setColorOne( color )}
                            />
                        </>
                    }
                    {bgColor && isGradient && 
                        <>
                            <p><strong>Gradient Top Color:</strong></p>
                            <ColorPicker
                                color={bgColorTwo}
                                onChange = { ( color ) => setColorTwo( color )}
                            />
                        </>
                    }
                </PanelBody>
            </InspectorControls>,
            <div 
                className={ option ? "left-right reversed" : "left-right"}
                style= {{background:renderBackground()}}
            >
                {scrollLink && <a id={scrollLink}></a> }
                <div className="layout">
                    <div className="leftcol">

                        <div class="image">
                            { image.id && 
                                
                                    <div className="imgwrap">
                                        <img className="bm-module-img"   
                                            key={ image.id }
                                            src={ image.url }
                                            srcset={renderSrcSet(image, ['medium', 'large', 'full'])}
                                            alt={ image.alt ? image.alt : image.caption }
                                        />
                                    </div>
                                
                                }
                        </div>
                    </div>
                    <div className="rightcol">
                        <InnerBlocks
                            allowedBlocks={ ALLOWED }       
                        />
                    </div>
                </div>
            </div>

        ]);
	},
	save({attributes}) {
		const { image, option, scrollLink, bgColor, isGradient, bgColorOne, bgColorTwo } = attributes;
        function renderBackground(){
            if(!bgColor) return "";
            if(bgColor && isGradient && bgColorOne && bgColorTwo){
                return "linear-gradient(to top, " + bgColorOne + "," + bgColorTwo + ");";
            }
            if(bgColor && bgColorOne){
                return bgColorOne;
            }
            return "";
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

		return (
    
            
            <div 
                className={ option ? "left-right reversed" : "left-right"}
                style= {{background:renderBackground()}}
            >
                {scrollLink && <a id={scrollLink}></a> }
                <div className="layout">
                    <div className="leftcol">
                        <div class="image">
                            { image.id && 
                                
                                    <div className="imgwrap">
                                        <img className="bm-module-img"   
                                            key={ image.id }
                                            src={ image.url }
                                            srcset={renderSrcSet(image, ['landscape-md', 'landscape-mobile', 'full'])}
                                            alt={ image.alt ? image.alt : image.caption }
                                        />
                                    </div>
                                
                                }
                        </div>
                    </div>
                    <div className="rightcol">
                        <InnerBlocks.Content />
                    </div>
                </div>
            </div>
		)
	}
});