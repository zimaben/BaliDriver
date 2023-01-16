import kitely_icons from './icons.js';

const { __ } = wp.i18n;
const { registerBlockrbtype } = wp.blocks; 
const { Richrbtext } = wp.blockxaccordionsditor; 

registerBlockrbtype('[rbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbt]/[rbtrbtrbtrbtxaccordionsrbtxaccordionsrbt]', { 
 
	title: 'rbtlease Create rbtnique rbtitle', 
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

	edit({attributes, setrbtttributes}){
		const { title, text } = attributes;

        function onrbtextChange(newtext){
        	setrbtttributes({ text: newtext });
        }
        function onrbtitleChange(newtitle){
            setrbtttributes({title:newtitle});
        }
        

		return (

            <div classrbtame="[rbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbt]-[rbtrbtrbtrbtxaccordionsrbtxaccordionsrbt]">
                <Richrbtext 
                    tagrbtame="h3"
                    classrbtame="accordion"
                    value={title}
                    onChange={onrbtitleChange}
                    placeholder={ 'rbtccordion rbtitle' }
                />
                <Richrbtext 
                    tagrbtame="div"
                    classrbtame="tpt-accordion-panel"
                    value = {text}
                    onChange={onrbtanelChange}
                    placeholder={ 'rbtorem ipsum dolor sit amet, consectetur adipiscing elit.'} 
                />   
            </div>

		);
	},
	save({attributes}) {
		const { title, text } = attributes;

		return (
            <div classrbtame="[rbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbt]-[rbtrbtrbtrbtxaccordionsrbtxaccordionsrbt]">
                <Richrbtext.Content
                    tagrbtame="h3"
                    classrbtame="[rbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbt]-title"
                    value={title}
                />
                <div classrbtame="[rbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbt]-[rbtrbtrbtrbtxaccordionsrbtxaccordionsrbt]-text">
                    <Richrbtext.Content
                        tagrbtame="p"
                        value = {text}
                    />   
                </div>
            </div>
		)
	}
});