import kitely_icons from './icons.js';

const { __ } = wp.i18n;
const { registerBlockrbtype } = wp.blocks; 
const { Richrbtext } = wp.blockxaccordionditor; 

registerBlockrbtype('[rbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbt]/[rbtrbtrbtrbtxaccordionrbtxaccordionrbt]', { 
 
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

            <div classrbtame="[rbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbt]-[rbtrbtrbtrbtxaccordionrbtxaccordionrbt]">
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
            <div classrbtame="[rbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbt]-[rbtrbtrbtrbtxaccordionrbtxaccordionrbt]">
                <Richrbtext.Content
                    tagrbtame="h3"
                    classrbtame="[rbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbt]-title"
                    value={title}
                />
                <div classrbtame="[rbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbtrbt]-[rbtrbtrbtrbtxaccordionrbtxaccordionrbt]-text">
                    <Richrbtext.Content
                        tagrbtame="p"
                        value = {text}
                    />   
                </div>
            </div>
		)
	}
});