
import theme_icons from './icons.js';

const { registerBlockType }= wp.blocks;
const { InspectorControls, RichText, InnerBlocks  } = wp.blockEditor;
const {PanelBody, SelectControl } = wp.components
const ALLOWED = ['core/buttons', 'core/button', 'core/paragraph', 'core/heading'];
registerBlockType( '<!PLUGINPATH->/simple-cta', {
    apiVersion: 2,
	title: '<!HUMANREADABLE> Simple CTA',  
	icon: theme_icons.kitelytech,
    category: 'kitelytech', 
    //attributes
    attributes: {
        style: {
            type: "string",
            default: null
        },

        title: {
            type: "string",
            default: null
        }, 
        buttonstyle: {
            type: "string",
            default: null
        }

    },
 
    edit({attributes, setAttributes}){
        const {style, title, buttonstyle} = attributes;
        function onTitleChange(newTitle){
            setAttributes({title: newTitle});
        }
        function onSelectStyle(newstyle){
            setAttributes({style: newstyle})
        }
        function onSelectButtonStyle(newstyle){
            setAttributes({buttonstyle: newstyle})
        }
        return ([
			<InspectorControls style={{marginBottom: '20px' }}>
				<PanelBody title="Choose Style">
					<p><strong>Style</strong></p>
                    <SelectControl
                        label="Choose Style"
                        value={style}
                        options={[
                            {label: "Default", value: null},
                            {label: "StyleOne", value: 'styleone'}
                        ]}
                        onChange={onSelectStyle}
                    />

                    <p><strong>Buttons</strong></p>
                    <SelectControl
                        label="Button Options"
                        value={buttonstyle}
                        options={[
                            {label: "Horizontal Row", value: 'horizontal'},
                            {label: "Vertical Row", value: 'vertical'}
                        ]}
                        onChange={onSelectButtonStyle}
                    />
                    
                </PanelBody>
			</InspectorControls>,

            <div className={style ? "simple-cta-wrap " + style : "simple-cta-wrap"}>
                <RichText 
                    tagName="H2"
                    value={title}
                    onChange={onTitleChange}
                    placeholder="Call To Action Title"
                />

                <div className={buttonstyle ? "blockswrap " + buttonstyle : "blockswrap"}>
                    <InnerBlocks allowedBlocks={ALLOWED} />
                </div>
            </div>
        ]);
    },
    save({attributes}){ 
        const {style, title, buttonstyle} = attributes;
        return (
        <div className={style ? "simple-cta-wrap " + style : "simple-cta-wrap"}>
        <RichText.Content
            tagName="H2"
            value={title}
        />
        <div className={buttonstyle ? "blockswrap " + buttonstyle : "blockswrap"}>
            <InnerBlocks.Content />
        </div>
    </div>
    )}
} );