import theme_icons from './icons.js';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const {RichText, InspectorControls, InnerBlocks } = wp.blockEditor; 
const { ColorPicker, ToggleControl } = wp.components;
const ALLOWED = ['rbt/carousel-slide'];



registerBlockType('rbt/carousel-slider', { 
 
	title: 'Form With Slides', 
	icon: theme_icons.friendlyrobot,
    category: 'friendlyrobot', 
    supports: {
        align: ['wide', 'full', 'center'],
        spacing: {
            margin: [ 'top', 'bottom' ],             // Enable margin for arbitrary sides.
            padding: true,                           // Enable padding for all sides.
            blockGap: [ 'horizontal', 'vertical' ],  // Enables axial (column/row) block spacing controls
        }
    },
    attributes: {
        title:{
            type: 'string',
            default: '',
        },
        text: {
            type: 'string',
            default: '',
        },
        isstripe: {
            type: 'boolean',
            default: false,
        },
        stripe: {
            type: 'string',
            default: 'none',
        },
        direction:{
            type: 'boolean',
            default: true,
        },
        innerBlockLength:{
            type: 'number',
            default: 0,
        }

    },   

	edit({clientId, attributes, setAttributes}){
		const { title, text, direction, innerBlockLength, isstripe, stripe } = attributes;

        const parentBlock = wp.data.select( 'core/editor' ).getBlocksByClientId( clientId )[ 0 ];
        const childBlocks = parentBlock.innerBlocks;

        // reference number of carousel blocks
        setAttributes( {innerBlockLength: childBlocks.length});

        function onChangeDirection(){
            setAttributes({direction: !direction});
        }
        function onTextChange(newtext){
        	setAttributes({ text: newtext });
        }
        function onTitleChange(newtitle){
            setAttributes({title:newtitle});
        }
        function renderIndicators(){
            let counter = innerBlockLength;
            let markup = '';
            while(counter){
                let active = (counter === innerBlockLength) ? ' active' : '';
                markup+= '<li class="rbt-indicator' + active + '"></li>';
                counter--;
            }
            return (<ul className="rbt-indicators" dangerouslySetInnerHTML={{__html: markup}} ></ul>)
        }
        

		return ([

            <InspectorControls>
                <p><strong>Switch Direction?</strong></p>
                <ToggleControl
                    label="Switch Direction?"
                    help={ direction ? 'Image Right' : 'Image Left' }
                    checked={direction}
                    onChange={onChangeDirection}
                />
            </InspectorControls>,
            <div className="rbt-carousel" data-process="CarouselControls">
                <div className={"rbt-carousel-background " + direction }>
                    <div className="rbt-carousel-control left">
                        <span className="control-left" >

                        </span>
                    </div>
                    <div className="rbt-carousel-left">
                        <RichText 
                            tagName="h2"
                            className="mod-title"
                            value={title}
                            onChange={onTitleChange}
                            placeholder={ 'Carousel Title' }
                        />
                        <RichText 
                            tagName="div"
                            className="mod-text"
                            value = {text}
                            onChange={onTextChange}
                            placeholder={ 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'} 
                        /> 
                        <form className="conditional-form" data-process="doBookingFormInit">
                            <div className="form-entry doconditions">
                                <h4>Where are you going?</h4>
                                <div className="switchgroup icons">
                                    <span class="iconswitch airplane" data-switch-value="true" data-switch="is_airport"></span>
                                   {/*<label for="is_airport" className="service-type" data-show-on="0">Day Trip</label> */}
                                    <label className="switch hidden">
                                        <input type="checkbox" name="is_airport" checked="checked"/>
                                        <span class="slider"></span>
                                    </label>
                                    <span class="iconswitch car" data-switch-value="false" data-switch="is_airport"></span>
                                   {/* <label for="is_airport" className="service-type active" data-show-on="1">Airport Pickup/Dropoff</label> */}
                                </div>
                            </div>
                            <div className="form-entry normal">
                                <label for="pickupdate">Pickup date:</label>
                                <input type="text" name="pickupdate" id="pickupdate" value="" tabindex="3" />
                                <label for="pickuptime">Pickup time (Local Time):</label>
                                <input type="text" name="pickuptime" id="pickuptime" value="" tabindex="4" />
                            </div>
                            <section className="form-section conditional" data-depends-on="service-type" data-show-on="airport">
                                <h4>Pick Me Up From:</h4>
                                <div className="form-entry conditional" data-controls="radio-to" data-depends-on="radio-to">
                                    <label for="radio-from">The Airport</label>
                                    <input type="radio" name="radio-from" id="radio-from-airport" tabindex="1" value="airport" data-select-on="address"/>

                                    <label for="radio-address">My Hotel or Address</label>
                                    <input type="radio" name="radio-from" id="radio-from-address" tabindex="2" value="address" data-select-on="airplane"/>

                                </div>
                                <div className="form-entry conditional" data-depends-on="radio-from" data-show-on="address">
                                    <label for="startaddress">Address:</label>
                                    <input type="text" name="startaddress" id="startaddress" value="" />
                                </div>
                                <div className="form-entry conditional" data-depends-on="radio-from" data-show-on="airport">
                                    <label for="from-flight">Flight Number:</label>
                                    <input type="text" name="from-flight" id="from-flight" value="" />
                                </div>
                                <h4>Take Me To:</h4>
                                <div className="form-entry conditional" data-depends-on="radio-from" data-controls="radio-from">
                                    <label for="radio-to">The Airport</label>
                                    <input type="radio" name="radio-to" id="radio-to-airport" value="airport" data-select-on="address" />

                                    <label for="radio-to">My Hotel or Address</label>
                                    <input type="radio" name="radio-to" id="radio-to-airport" value="address" data-select-on="airplane" />
                                </div>
                            </section>
                            <section className="form-section conditional" data-depends-on="service-type" data-show-on="daytrip">
                                <h4>Pick Me Up From:</h4>
                                <div className="form-entry conditional" data-depends-on="radio-from" data-show-on="address">
                                    <label for="startaddress">Address:</label>
                                    <input type="text" name="startaddress" id="startaddress" value="" />
                                </div>

                                <h4>How Long:</h4>
                                <label for="select-service">Select Dropdown Choice:</label>
                                <select name="select-choice" id="select-choice">
                                    <option value="single-ride">Quick Ride (under 2 hours)</option>
                                    <option value="half-day">Half Day (4 hours)</option>
                                    <option value="full-day">Full Day (4 - 8 hours)</option>
                                    <option value="all-day">All Day (8+ hours)</option>
                                </select>
                            </section>
                        </form>
                        <div className="control-indicators">
                            { renderIndicators() }
                        </div>
                    </div>
                    <div className="rbt-carousel-right">
                        <InnerBlocks allowedBlocks={ ALLOWED } />
                    </div>
                    <div className="rbt-carousel-control right">
                        <span className="control-right" >

                        </span>
                    </div>
                </div>
            </div>

        ]);
	},
	save({attributes}) {
		const { title, text, direction, innerBlockLength, isstripe, stripe } = attributes;
        function renderIndicators(){
            let counter = innerBlockLength;
            let markup = '';
            while(counter){
                let active = (counter === innerBlockLength) ? ' active' : '';
                markup+= '<li class="rbt-indicator' + active + '"></li>';
                counter--;
            }
            return (<ul className="rbt-indicators" dangerouslySetInnerHTML={{__html: markup}} ></ul>)
        }
		return (
            <div className="rbt-carousel" data-process="CarouselControls">
                <div className={"rbt-carousel-background " + direction }>
                    { isstripe && <span className="rbt-carousel-stripe" style={{backgroundColor:stripe}} ></span> }
                    <div className="rbt-carousel-control left">
                        <span className="control-left" >

                        </span>
                    </div>
                    <div className="rbt-carousel-left">
                        
                        <RichText.Content
                            tagName="h2"
                            className="mod-title"
                            value={title}
                        />
                        <RichText.Content
                            tagName="div"
                            className="mod-text"
                            value = {text}
                        /> 
                        <form className="conditional-form rbt-form" data-process="doBookingFormInit">
                            <div className="form-entry doconditions">
                            <h4>Your Trip:</h4>
                                <div className="switchgroup icons">
                                    <div class="icon-group">
                                        <span class="iconswitch airplane active" data-switch-value="true" data-switch="is_airport"></span>
                                        <span class="iconswitch-text">To/From Airport</span>
                                    </div>
                                    <label className="switch hidden">
                                        <input type="checkbox" name="is_airport" checked="checked"/>
                                        <span class="slider"></span>
                                    </label>
                                    <div class="icon-group">
                                        <span class="iconswitch car" data-switch-value="false" data-switch="is_airport"></span>
                                        <span class="iconswitch-text">Day Trip</span>
                                    </div>
                                </div>


                            </div>
                            <div className="form-entry normal">
                                <label for="name-airport">My Name:</label>
                                <input type="text" name="name-airport" id="name-airport" value="" data-required="true"/>
                                <label for="pickupdate">Pickup date:</label>
                                <input type="text" name="pickupdate" id="pickupdate" value="" tabindex="3" placeholder="Select Date.." data-input/>
                            </div>
                            <section className="form-section conditional active" data-show-on="1">
                            <h4>Service Type:</h4>
                                <div className="switchgroup">
                                    <label for="is_airport" className="service-type section" data-show-on="0">To Airport</label>
                                    <label className="switch">
                                        <input type="checkbox" name="from_to" checked="checked"/>
                                        <span class="slider"></span>
                                    </label>
                                    <label for="is_airport" className="service-type section active" data-show-on="1">From Airport</label>
                                </div>

                                <label for="radio-to">My Hotel or Address:</label>
                                <input type="text" name="airport-fromto" id="airport-address" value="" data-required="true"/>
                                <label for="radio-to">Flight Number:</label>
                                <input type="text" name="flightnumber" id="flightnumber" value="" placeholder="including your flight number helps us help you"/>
                            </section>
                            <section className="form-section conditional" data-depends-on="service-type" data-show-on="0">
                                <h4>Pick Me Up From:</h4>
                                <div className="form-entry" data-depends-on="radio-from" data-show-on="address">
                                    <label for="startaddress">My Hotel or Address:</label>
                                    <input type="text" name="daytrip-startaddress" id="daytrip-startaddress" value="" data-required="true"/>
                                </div>

                                <h4>How Long:</h4>
                                <label for="select-service">Select Dropdown Choice:</label>
                                <select name="select-choice" id="select-choice">
                                    <option value="single-ride">Quick Ride (under 2 hours)</option>
                                    <option selected="selected" value="half-day">Half Day (4 hours)</option>
                                    <option value="full-day">Full Day (4 - 8 hours)</option>
                                    <option value="all-day">All Day (8+ hours)</option>
                                </select>
                            </section>
                        </form>
                        <div className="control-indicators">
                            { renderIndicators() }
                        </div>
                    </div>
                    <div className="rbt-carousel-right">
                        <InnerBlocks.Content />
                    </div>
                    <div className="rbt-carousel-control right">
                        <span className="control-right" >

                        </span>
                    </div>
                </div>
            </div>
		)
	}
});