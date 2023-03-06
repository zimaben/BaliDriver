import theme_icons from './icons.js';


const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { MediaUpload, MediaUploadCheck, InspectorControls, RichText } = wp.blockEditor; 
const { PanelBody, Button, TextControl } = wp.components;

registerBlockType('rbt/testimonial-card', { 
 
	title: 'Testimonial Card', 
	icon: theme_icons.friendlyrobot,
    category: 'friendlyrobot', 
    //attributes
    attributes: {
        image: {
            type: 'object',
            default:{},
        },
        name:{
            type: 'string',
            default: ''
        },
        quote: {
            type: 'string',
            default: ''
        },
        trip: {
            type: 'string',
            default:'',
        }, 
        tripurl: {
            type: 'string',
            default: '',
        }

    },   

	edit({attributes, setAttributes}){
		const { image, name, quote, trip, tripurl} = attributes;

        function onSelectMedia(media){
            setAttributes({ image: media});
        }
        function onTextChange(newtext){
        	setAttributes({ quote: newtext });
        }
        function onNameChange(newtext){
            setAttributes({name:newtext});
        }
        function onTripChange(newtrip){
            setAttributes({trip:newtrip});
        }
        function onTripUrlChange(newurl){
            setAttributes({tripurl:newurl});
        }
        function renderAvatarImage(array, img){
            const rows = [];
            Object.keys(img.sizes).forEach(function(key, idx){
                if(array.includes(key) ){
                    rows.push (img.sizes[key].url + ' ' + img.sizes[key].width + 'w' )
                }
            });
            return rows;
        }

		return ([
            <InspectorControls>
                <PanelBody title="Author Image">
                    <MediaUploadCheck>
                        <p><strong>Upload Avatar(small)</strong></p>
                        <MediaUpload
                            label="Image"
                            onSelect={ (media) => onSelectMedia(media) }
                            allowedTypes={ ['image'] }
                            accept={["image/*", "image/svg"]}
                            value={ image.id }
                            render={ ({open}) => {
                                return (
                                    <>
                                        <Button
                                            isPrimary={ true }
                                            onClick={ (event) => {
                                                event.stopPropagation();
                                                open();
                                            } }
                                        >
                                            { image.id > 0 ? 'Edit Image': 'Upload Image'}
                                        </Button>
                                    </>
                                );
                            } }
                        />
                        <p><strong>Upload Trip Image</strong></p>
                    </MediaUploadCheck>
                </PanelBody>, 
            </InspectorControls>,
            <div className="rbt-testimonial-card">
                <div className="rbt-avatar-wrap">
                    {image.id ?
                        <img 
                            className="rbt-avatar" 
                            key={image.id}
                            loading="lazy"
                            src={image.sizes.hasOwnProperty("thumbnail") ? image.sizes.thumbnail.url : image.src }
                            srcset={renderAvatarImage(['thumbnail', 'medium'],image)} 
                            alt={ name ? name + ' image' : 'avatar image'}
                        />
                        :
                        <img
                            className="rbt-avatar"
                            src={theme_admin.theme_root ? theme_admin.theme_root + "/theme/assets/icons/user-solid.svg" : false }
                        />
                    }
                </div>
                <div className="rbt-testimonial-text">
                    <RichText 
                        tagName="div"
                        className="rbt-testimonial"
                        value = {quote}
                        onChange={onTextChange}
                        placeholder={ 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'} 
                    />   
                    <RichText 
                        tagName="h5"
                        className="rbt-author"
                        value={name}
                        onChange={onNameChange}
                        placeholder={ 'Testimonial Author' }
                    />
                    <TextControl 
                        tagName="span"
                        label="Trip Name"
                        className="rbt-trip"
                        value={trip}
                        onChange={onTripChange}
                        placeholder="Trip Name (optional)"
                    />
                    <TextControl 
                        label="Trip Slug"
                        tagName="span"
                        className="rbt-trip-slug"
                        value={tripurl}
                        onChange={onTripUrlChange}
                        placeholder="trip-slug"
                    />
                </div>
            </div>

        ])
	},
	save({attributes}) {
		const { image, name, quote, trip, tripurl } = attributes;

        function renderTrip(){
            if(trip && trip.length && tripurl && tripurl.length){
                //we have everything
                let base_url = theme_admin.siteurl ? theme_admin.siteurl : false;
                if(!base_url) return (<span className="rbt-trip">{trip}</span>);

                return (<a href={base_url + "/trips/" + tripurl} target="_blank">{trip}</a> );
            }
            return trip ? (<span className="rbt-trip">{trip}</span>) : '';
        }
        function renderAvatarImage(array, img){
            const rows = [];
            Object.keys(img.sizes).forEach(function(key, idx){
                if(array.includes(key) ){
                    rows.push (img.sizes[key].url + ' ' + img.sizes[key].width + 'w' )
                }
            });
            return rows;
        }

		return (
            <div className="rbt-testimonial-card">
                <div className="rbt-avatar-wrap">
                    {image.id ?
                        <img 
                            className="rbt-avatar" 
                            key={image.id}
                            loading="lazy"
                            src={image.sizes.hasOwnProperty("thumbnail") ? image.sizes.thumbnail.url : image.src }
                            srcset={renderAvatarImage(['thumbnail', 'medium'],image)} 
                            alt={ name ? name + ' image' : 'avatar image'}
                        />
                        :
                        <img
                            className="rbt-avatar"
                            src={theme_admin.theme_root ? theme_admin.theme_root + "/theme/assets/icons/user-solid.svg" : false }
                        />
                    }
                </div>
                <div className="rbt-testimonial-text">
                    <RichText.Content 
                        tagName="p"
                        className="rbt-testimonial"
                        value = {quote}
                    />   
                    <RichText.Content
                        tagName="h5"
                        className="rbt-author"
                        value={name}
                    />
                    { renderTrip() }
                </div>

            </div>
		)
	}
});