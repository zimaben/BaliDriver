import theme_icons from './icons.js';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { InnerBlocks, InspectorControls, RichText } = wp.blockEditor; 
const { ColorPicker, PanelBody, ToggleControl } = wp.components;

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
        isGradient: {
            type: 'Boolean',
            default: true,
        }, 
        backgroundColor:{
            type: 'string',
            default: ''
        },
        innerBlockLength:{
            type: 'number',
            default: 0,
        }

    },   

	edit({clientId, attributes, setAttributes}){
		const { title, text, direction, isGradient, backgroundColor, innerBlockLength } = attributes;
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
        function onChangeDirection(){
            setAttributes({direction: !direction});
        }
        


		return (
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

        );
	},
	save({attributes}) {
		const { title, text, direction, isGradient, backgroundColor, innerBlockLength } = attributes;

		return (
            <div className="rbt-testimonials" data-process="doTestimonials">
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