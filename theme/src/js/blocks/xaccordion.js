import theme_icons from './icons.js';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { RichText } = wp.blockEditor; 

registerBlockType('rbt/xaccordion', { 
 
	title: 'Accordion', 
	icon: theme_icons.friendlyrobot,
    category: 'friendlyrobot', 
    parent: [ 'rbt/xaccordions' ], 
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

    },   

	edit({attributes, setAttributes}){
		const { title, text } = attributes;

        function onPanelChange(newtext){
        	setAttributes({ text: newtext });
        }
        function onTitleChange(newtitle){
            setAttributes({title:newtitle});
        }
        
		return (

            <div className="rbt-accordion">
                <RichText 
                    tagName="h4"
                    className="accordion"
                    value={title}
                    onChange={onTitleChange}
                    placeholder={ 'Accordion Title' }
                />
                <RichText 
                    tagName="div"
                    className="rbt-accordion-panel"
                    value = {text}
                    onChange={onPanelChange}
                    placeholder={ 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'} 
                />   
            </div>

		);
	},
	save({attributes}) {
		const { title, text } = attributes;

		return (
            <div className="rbt-accordion">
                <RichText.Content
                    tagName="h4"
                    className="accordion"
                    value={title}
                />
                <div className="rbt-accordion-panel">
                    <RichText.Content
                        tagName="p"
                        value = {text}
                    />   
                </div>
            </div>
		)
	}
});