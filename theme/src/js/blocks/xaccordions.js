import theme_icons from './icons.js';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { InnerBlocks, InspectorControls } = wp.blockEditor; 
const {PanelBody, TextControl } = wp.components;

const ALLOWED = [ 'rbt/ktaccordion' ];

registerBlockType('rbt/xaccordions', { 
 
	title: 'Accordions List', 
	icon: theme_icons.kitelytech,
    category: 'friendlyrobot', 
    
    //attributes
    attributes: {
        scrollLink: {
            type: 'string',
            default:null
        }
    },   
	edit({attributes, setAttributes}){
		const { scrollLink  } = attributes;
        function onUpdateScrollLink(newtext){
            setAttributes({scrollLink:newtext});
        }

		return ([
            <InspectorControls>
                <PanelBody>
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
            <div className="rbt-accordionslist"> 
                <InnerBlocks allowedBlocks={ALLOWED} templateLock={false}  />
            </div>

        ]);
	},
	save({attributes}) {
		const { scrollLink } = attributes;

		return (
            <div className="rbt-accordionslist">
                {scrollLink && <a id={scrollLink}></a> }
                <InnerBlocks.Content  />
            </div>
		)
	}
});