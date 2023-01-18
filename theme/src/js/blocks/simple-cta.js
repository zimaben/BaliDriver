import kitely_icons from './icons.js';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { RichText } = wp.blockEditor; 

registerBlockType('rbt/simple-cta', { 
 
	title: 'Please Create Unique Title', 
	icon: kitely_icons.kitelytech,
    category: 'kitelytech', 
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

        function onTextChange(newtext){
        	setAttributes({ text: newtext });
        }
        function onTitleChange(newtitle){
            setAttributes({title:newtitle});
        }
        

		return (

            <div className="rbt-simple-cta">
                <RichText 
                    tagName="h3"
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
            <div className="rbt-simple-cta">
                <RichText.Content
                    tagName="h3"
                    className="rbt-title"
                    value={title}
                />
                <div className="rbt-simple-cta-text">
                    <RichText.Content
                        tagName="p"
                        value = {text}
                    />   
                </div>
            </div>
		)
	}
});