import theme_icons from './icons.js';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { useBlockProps, innerBlocksProps, useInnerBlocksProps } = wp.blockEditor; 
const ALLOWED = ['rbt/carousel-slide', 'rbt/carousel-slide-canvas'];

registerBlockType('rbt/carousel-slides', { 
 
	title: 'SLIDES', 
	icon: theme_icons.friendlyrobot,
    category: 'friendlyrobot', 
    //attributes
    // supports: {
    //     inserter: true,
    // },
    // parent: 
    //     ['rbt/carousel-slider']
    // ,
    attributes: {
        slides:{
            type: 'array',
            default: []
        },
    },   

	edit({attributes, setAttributes}){
		const { slides } = attributes;
        const blockProps = useBlockProps();
        const innerBlocksProps = useInnerBlocksProps();

        function onTextChange(newtext){
        	setAttributes({ text: newtext });
        }
        function onTitleChange(newtitle){
            setAttributes({title:newtitle});
        }
        function renderSlides(slides){
            console.log(slides);
        }
        function renderIndicators(slides){
            console.log(slides);
        }

		return (

            <div className={"slides-markup-wrap"} {...innerBlocksProps}>
                <div className="slides-control-left">
                    <span className="leftArrow"></span>
                </div>
                <div className="slides-indicators">
                    {renderSlides( slides )}
                </div>
                <div className="slides-indicators">
                    {renderIndicators( slides )}
                </div>
                <div className="slides-control-right">
                    <span className="rightArrow"></span>
                </div>
            </div>

		);
	},
	save({attributes}) {
		const { slides } = attributes;
        function renderSlides(slides){
            console.log(slides);
        }
        function renderIndicators(slides){
            console.log(slides);
        }
		return (
            <div className={"slides-markup-wrap"} {...innerBlocksProps}>
                <div className="slides-control-left">
                    <span className="leftArrow"></span>
                </div>
                <div className="slides-indicators">
                    {renderSlides( slides )}
                </div>
                <div className="slides-indicators">
                    {renderIndicators( slides )}
                </div>
                <div className="slides-control-right">
                    <span className="rightArrow"></span>
                </div>
            </div>
		)
	}
});