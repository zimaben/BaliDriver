import theme_icons from './icons.js';

const { registerBlockType }= wp.blocks; 
const { InspectorControls, RichText, InnerBlocks  } = wp.blockEditor;
const {PanelBody, SelectControl, TextControl } = wp.components
const ALLOWED = ['core/buttons', 'core/button', 'core/paragraph', 'core/heading', 'core/list', ];

registerBlockType('rbt/simple-cta', { 
 
	title: 'Simple CTA', 
	icon: theme_icons.friendlyrobot,
    category: 'friendlyrobot', 
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
        },
        scrollLink: {
            type: 'string',
            default:null
        }

    },
 
    edit({attributes, setAttributes}){
        const {style, title, buttonstyle, scrollLink} = attributes;
        function onTitleChange(newTitle){
            setAttributes({title: newTitle});
        }
        function onSelectStyle(newstyle){
            setAttributes({style: newstyle})
        }
        function onSelectButtonStyle(newstyle){
            setAttributes({buttonstyle: newstyle})
        }
        function onUpdateScrollLink(newtext){
            setAttributes({scrollLink:newtext});
        }
        return ([
			<InspectorControls style={{marginBottom: '20px' }}>
				<PanelBody title="Choose Style">
					<p><strong>Style</strong></p>
                    <SelectControl
                        label="Choose Header Tag"
                        value={style}
                        options={[
                            {label: "Default (H2)", value: "H2"},
                            {label: "H1 Tag", value: 'H1'},
                            {label: "H2 Tag", value: 'H2'},
                            {label: "H3 Tag", value: 'H3'},
                            {label: "H4 Tag", value: 'H4'},
                            {label: "H5 Tag", value: 'H5'},
                            {label: "H6 Tag", value: 'H6'},
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
                    <p><strong>Add a Scroll Link?</strong></p>
                    <p>(No # character please)</p>
                    <TextControl 
                        label="Scroll Link"
                        value={scrollLink}
                        onChange={onUpdateScrollLink}
                        placeholder="scroll-here"
                    />
                </PanelBody>
			</InspectorControls>,

            <div className={style ? "simple-cta-wrap " + style : "simple-cta-wrap"}>
                {scrollLink && <a id={scrollLink}></a> }
                <RichText 
                    tagName={style ? style : "H2"}
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
        const {style, title, buttonstyle, scrollLink} = attributes;
        return (
        <div className={style ? "simple-cta-wrap " + style : "simple-cta-wrap"}>
            {scrollLink && <a id={scrollLink}></a> }
        <RichText.Content
            tagName={style ? style : "H2"}
            value={title}
        />
        <div className={buttonstyle ? "blockswrap " + buttonstyle : "blockswrap"}>
            <InnerBlocks.Content />
        </div>
    </div>
    )}
} );