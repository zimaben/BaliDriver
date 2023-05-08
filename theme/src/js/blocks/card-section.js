import theme_icons from './icons.js';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { RichText, InnerBlocks, InspectorControls  } = wp.blockEditor; 
const { SelectControl, PanelBody } = wp.components;

const ALLOWED = ['rbt/card-section-card'];

registerBlockType('rbt/card-section', { 
 
	title: 'Cards with Scroll Animation', 
	icon: theme_icons.friendlyrobot,
    category: 'friendlyrobot', 
    //attributes
    // Having the SVG into the attributes this way puts it into the data properties without exposing
    // any UI. I think this is a good happy medium for reuse.
    attributes: {
        cards:{
            type: 'array',
            default: [],
        },
        svgMarkup:{
            type: 'string',
           // default: '<svg viewBox="0 0 1657 297" fill="none"><path id="svg-map-dashes" d="M47.9999 137.5C105.333 201.667 277.9 321.8 509.5 289C799 248 426 -80 741.5 20.5C1057 121 1120.5 348.5 1293 184.5C1465.5 20.5 1410 127 1488 147.5C1550.4 163.9 1626.33 179 1656.5 184.5" stroke="#FF1A1B" stroke-width="4" stroke-dasharray="22 40"/><g clip-path="url(#clip0_19_9)"><path d="M72.5144 42.7592C65.5223 40.8857 58.0724 41.8665 51.8034 45.4859C45.5345 49.1052 40.9601 55.0667 39.0866 62.0588C33.5581 82.6914 47.0328 112.913 50.6728 120.426C50.869 120.826 51.2157 121.132 51.6372 121.278C52.0587 121.423 52.5206 121.395 52.9218 121.201L53.1259 121.083C59.9706 116.354 86.2835 96.8191 91.8126 76.1845C93.6854 69.193 92.7044 61.7439 89.0854 55.4755C85.4663 49.2072 79.5057 44.6331 72.5144 42.7592ZM63.5334 76.2768C61.7651 75.803 60.177 74.8155 58.9699 73.4391C57.7628 72.0626 56.991 70.3592 56.752 68.5442C56.5131 66.7291 56.8177 64.884 57.6274 63.242C58.4371 61.6001 59.7155 60.2352 61.301 59.3198C62.8864 58.4045 64.7077 57.9798 66.5345 58.0996C68.3613 58.2193 70.1116 58.878 71.564 59.9925C73.0164 61.107 74.1057 62.6271 74.6941 64.3607C75.2826 66.0942 75.3438 67.9633 74.87 69.7317L74.864 69.7538C74.2238 72.1197 72.6714 74.135 70.5473 75.3579C68.4232 76.5807 65.9008 76.9112 63.5334 76.2768Z" fill="#FF1A1B" stroke="black" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></g><defs><clipPath id="clip0_19_9"><rect width="100" height="100" fill="white" transform="translate(26.6446 20.7627) rotate(15)"/></clipPath></defs></svg>',
            default: `<?xml version="1.0" encoding="utf-8"?>
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                 viewBox="0 0 1657 297" width="1657" height="297" style="enable-background:new 0 0 1657 297;" xml:space="preserve">
            <style type="text/css">
                .st0{clip-path:url(#SVGID_00000065779224380356357740000015508457661078391990_);}
                .st1{fill:#663333;stroke:#000000;stroke-width:4;stroke-linecap:round;stroke-linejoin:round;}
                .st2{fill:none;stroke:#871818;stroke-width:4;}
            </style>
            <g>
                <defs>
                    
                        <rect id="SVGID_1_" x="12" y="32" transform="matrix(0.2588 -0.9659 0.9659 0.2588 -33.2527 120.6641)" width="100" height="100"/>
                </defs>
                <clipPath id="SVGID_00000158711709548526291700000015334821501289289629_">
                    <use xlink:href="#SVGID_1_"  style="overflow:visible;"/>
                </clipPath>
                <g style="clip-path:url(#SVGID_00000158711709548526291700000015334821501289289629_);">
                    <path class="st1" d="M72.5,42.8c-7-1.9-14.4-0.9-20.7,2.7c-6.3,3.6-10.8,9.6-12.7,16.6c-5.5,20.6,7.9,50.9,11.6,58.4
                        c0.2,0.4,0.5,0.7,1,0.9c0.4,0.1,0.9,0.1,1.3-0.1l0.2-0.1c6.8-4.7,33.2-24.3,38.7-44.9c1.9-7,0.9-14.4-2.7-20.7
                        C85.5,49.2,79.5,44.6,72.5,42.8z M63.5,76.3c-1.8-0.5-3.4-1.5-4.6-2.8c-1.2-1.4-2-3.1-2.2-4.9c-0.2-1.8,0.1-3.7,0.9-5.3
                        c0.8-1.6,2.1-3,3.7-3.9c1.6-0.9,3.4-1.3,5.2-1.2c1.8,0.1,3.6,0.8,5,1.9c1.5,1.1,2.5,2.6,3.1,4.4c0.6,1.7,0.6,3.6,0.2,5.4l0,0
                        c-0.6,2.4-2.2,4.4-4.3,5.6C68.4,76.6,65.9,76.9,63.5,76.3z"/>
                </g>
            </g>
            
            <path id="svg-map-line" class="st2" d="M48.4,133.9 358.6,252.3 444.7,175.1 625.7,109.6 1014.2,281.2 1334.1,148.5 1382.5,231.3 
                1630.6,229.7 "/>
            </svg>`
        },
        scrollTriggerFunction: {
            type: 'string',
            default: null
        },
        title: {
            type: 'string',
            default: ''
        },

    },   

	edit({attributes, setAttributes}){
		const { title, cards, svgMarkup, scrollTriggerFunction } = attributes;

        function onTitleChange(newtitle){
            setAttributes({title:newtitle});
        }
        

		return ([
            <InspectorControls>
                <PanelBody title="RBT Card Section">
                    <SelectControl
                        label="ScrollTrigger"
                        value={scrollTriggerFunction}
                        options={[
                            {label: "none", value: null},
                            {label: "Scroll Reveal SVG", value: "scrollSVG"}
                        ]}
                        onChange={(val) =>{ setAttributes({scrollTriggerFunction: val}) } }
                    />
                </PanelBody>
            </InspectorControls>,
            <div className="rbt-card-section">
                { svgMarkup.length &&
                    <div
                        className="underlay"
                        data-process={ scrollTriggerFunction ? "scrollTrigger" : ""}
                        dangerouslySetInnerHTML={{__html: svgMarkup}}
                        data-scroll-function={ scrollTriggerFunction ? scrollTriggerFunction : ""}
                    />
                }

                <RichText 
                    tagName="h2"
                    className="section-title"
                    value={title}
                    onChange={onTitleChange}
                    placeholder={ 'Section Title' }
                />
                <div className="rbt-cardwrap">
                    <InnerBlocks allowedBlocks = { ALLOWED } />
                </div>

            </div>

        ]);
	},
	save({attributes}) {
		const { title, cards, svgMarkup, scrollTriggerFunction } = attributes;

		return (
            <div className="rbt-card-section">
                { svgMarkup.length &&
                    <div
                        className="underlay"
                        data-process={ scrollTriggerFunction ? "scrollTrigger" : ""}
                        dangerouslySetInnerHTML={{__html: svgMarkup}}
                        data-scroll-function={ scrollTriggerFunction ? scrollTriggerFunction : ""}
                    />
                }
                <RichText.Content
                    tagName="h2"
                    className="rbt-title"
                    value={title}
                />
                <div className="rbt-cardwrap">
                    <InnerBlocks.Content />
                </div>
            </div>
		)
	}
});