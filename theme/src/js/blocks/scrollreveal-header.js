import theme_icons from './icons.js';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { RichText, InnerBlocks, InspectorControls, MediaUploadCheck, MediaUpload } = wp.blockEditor; 
const {PanelBody, SelectControl, Button} = wp.components;
const ALLOWED = ['core/button'];
registerBlockType('rbt/scrollreveal-header', { 
 
	title: 'Header With Scroll Reveal', 
	icon: theme_icons.friendlyrobot,
    category: 'friendlyrobot', 
    //attributes
    attributes: {
        title:{
            type: 'string',
            default: ''
        },
        htag: {
            type: 'string',
            default: 'H2'
        },
        text: {
            type: 'string',
            default: ''
        },
        textimage: {
            type: 'object',
            default: {}
        }, 
        animatedSVG: {
            type: 'object',
            default: {}
        }


    },   

	edit({attributes, setAttributes}){
		const { htag, title, text, textimage, animatedSVG} = attributes;

        function onTextChange(newtext){
        	setAttributes({ text: newtext });
        }
        function onTitleChange(newtitle){
            setAttributes({title:newtitle});
        }
        function onSelectMedia(media) {
            setAttributes({ textimage: media });
          }
        

		return ([
            <InspectorControls>
                <PanelBody title="Scroll Reveal Header Settings">
                    <SelectControl
                        label="Tag"
                        value={htag}
                        options={[
                            {label: "H1", value: "H1"},
                            {label: "H2", value: "H2"},
                            {label: "H3", value: "H3"},
                            {label: "H4", value: "H4"},
                            {label: "H5", value: "H5"},
                            {label: "H6", value: "H6"},
                        ]}
                        onChange={ (val) => { setAttributes({htag: val})} }
                    />
                    <MediaUploadCheck>
                        <p><strong>Upload Image:</strong></p>
                        <MediaUpload
                            label="Image"
                            onSelect={ (media) => { onSelectMedia(media) } }
                            allowedTypes={ ['image'] }
                            accept={["image/*", "image/svg"]}
                            value={ textimage.id }

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
                                            { textimage.id > 0 ? 'Edit Image': 'Upload Image'}
                                        </Button>
                                    </>
                                );
                            } }
                        />
                    </MediaUploadCheck>
                </PanelBody>
            </InspectorControls>,
            <div className="rbt-scrollreveal-header">
                <RichText 
                    tagName={htag}
                    className="accordion"
                    value={title}
                    onChange={onTitleChange}
                    placeholder={ 'Section Title' }
                    style={{backgroundImage: 'url(' + textimage.url + ')'}}
                />
                <RichText 
                    tagName="div"
                    className="rbt-accordion-panel"
                    value = {text}
                    onChange={onTextChange}
                    placeholder={ 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'} 
                />  
                <InnerBlocks allowedBlocks={ALLOWED} />
            </div>

        ]);
	},
	save({attributes}) {
		const { htag, title, text, textimage, animatedSVG} = attributes;

		return (
            <div className="rbt-scrollreveal-wrap">
                <RichText.Content
                    tagName={htag}
                    className="rbt-title"
                    value={title}
                    data-process="doScrollReveal"
                    style={{backgroundImage: 'url(' + textimage.url + ')'}}
                />
                <div className="rbt-scrollreveal-header-text">
                    <RichText.Content
                        tagName="p"
                        value = {text}
                    /> 
                    <InnerBlocks.Content />  
                </div>
            </div>
		)
	}
});