<?php
namespace <!PLUGINPATH->\admin\setup;
use \<!PLUGINPATH->\<!PLUGINNAME-> as Theme;
use \<!PLUGINPATH->\admin\setup\PostTypes as PostTypes;
use \<!PLUGINPATH->\admin\setup\Page as Page;
use \<!PLUGINPATH->\admin\setup\Taxonomy as Taxonomy;
use \<!PLUGINPATH->\Config as Config;

/**
 * https://gist.github.com/joshuadavidnelson/164a0a0744f0693d5746
 * 
 * // Example Usage
 * // Add an unattached image to the media library
 * $image_url_or_resource = 'http://someimageurl';
 * $create_image = new Create_Media_File( $image_url_or_resource );
 * $image_id = $create_image->attachment_id;

 * // Add image and attach to a post
 * $post_id = '3'; // the id of the post
 * $create_image = new Create_Media_File( $image_url, $post_id );
 * $image_id = $create_image->attachment_id;
 * 
 * @package RBT
 * @subpackage <!PLUGINNAME->
 */
class MediaImage {
	
    public $err = false;
	var $post_id;
	var $image_url;
	var $wp_upload_url;
	var $attachment_id;
	var $resource;
	/**
	 * You can construct this object with an image url or an image resource and filename.
     * $image_url_or_resource = takes url path OR image resource (if $new_filename is set to true)
     * $new_filename = file name of new resource
     * 
     * Example: Adding a featured image to a post (will work with internal or external url)
     *      $image_url = 'https://example.com/wp-uploads/12/my-image.jpg;
     *      $post_id = 10;
     *      $Image = new MediaImage($image_url);
     *      $attachment_id = $Image->upload_to_media( $post_id );
     * Example: Add Image Resource to Media 
     *      $resource = file_get_contents( $resource_path );
     *      $Image = new MediaImage($resource, "newimage.jpg");
     *      $attachment_id = $Image->upload_to_media();
     * Example: Set Theme Logo
     *      $resource = file_get_contents( $resource_path );
     *      $Image = new MediaImage($resource, "logo.svg");
     *      $attachment_id = $Image->set_logo();
	 */
	public function __construct( $image_url_or_resource, $new_filename = false ) {
		
		// Setup class variables
		$this->image_url = $new_filename ? esc_url( $image_url_or_resource ) : false;
        $this->resource = $new_filename ? $image_url_or_resource : \file_get_contents( $image_url_or_resource );
		$this->resource_name = $new_filename ? $new_filename : basename( $this->image_url ); 
		$this->wp_upload_url = $this->get_wp_upload_url();
        $this->attachment_id = $this->get_attachment_id();
	}
	
	/**
	 * Set the upload directory
	 */
	private function get_wp_upload_url() {
		$wp_upload_dir = \wp_upload_dir();
		return isset( $wp_upload_dir['url'] ) ? $wp_upload_dir['url'] : false;
	}
    public function get_attachment_id(){
        //if we have a url, check if it's already an attachment
        if( !$this->image_url ) return false;
        return \attachment_url_to_postid( $this->image_url );
    }
    public function set_logo(){
        $this->err = false;
        if( !$this->attachment_id ) {
            $this->upload_to_media();
        }
        if(!$this->attachment_id) {
            $this->err = 'Could not upload that file';
            return false;
        }
        \set_theme_mod( 'custom_logo', $this->attachment_id );
        return $this->attachment_id;
    }
	
	/**
	 * Create the image and return the new media upload id.
     * Accepts an optional $PostID of the parent page to attach the new media upload
     * to. If $PostID is zero or not provided, the new media upload will not be 
     * attached to a page.
	 *
	 * @see https://gist.github.com/hissy/7352933
	 *
	 * @see http://codex.wordpress.org/Function_Reference/wp_insert_attachment#Example
	 */
	public function upload_to_media( $PostID = 0 ) {
		$this->err = false;
		if( $this->attachment_id ) {
            #attachment already exists
            if($PostID){
                require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
                \set_post_thumbnail( $PostID, $this->attachment_id );
            }
            return $this->attachment_id;
        }
        if( !$this->wp_upload_url ) {
            $this->err = 'Could not find upload directory';
            return false;
        }
		if( !$this->image_url && !$this->resource ){
            $this->err = 'Could not find image or resource';
            return false;
        } 
		if( !$this->resource_name ){ 
            $this->err = 'No filename specified';
            return false;
        }
		
		$upload_file = \wp_upload_bits( $this->resource_name, null, $this->resource );
		
		if ( ! $upload_file['error'] ) {
			$wp_filetype = \wp_check_filetype($this->resource_name, null );
			$attachment = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_title' => preg_replace('/\.[^.]+$/', '', $this->resource_name),
				'post_content' => '',
				'post_status' => 'inherit'
			);
            
            if($PostID) $attachment['post_parent'] = $PostID;

			$attachment_id = \wp_insert_attachment( $attachment, $upload_file['file'], $this->post_id );
			
			if( ! is_wp_error( $attachment_id ) ) {
				
				require_once( ABSPATH . "wp-admin" . '/includes/image.php' );
				require_once( ABSPATH . 'wp-admin/includes/media.php' );
				
				$attachment_data = \wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
				\wp_update_attachment_metadata( $attachment_id,  $attachment_data );
				
				$this->attachment_id = $attachment_id;

                if($PostID){
                    \set_post_thumbnail( $PostID, $attachment_id);
                }
				
				return $attachment_id;
			}
		} else { $this->err = $upload_file['error']; }
		
		return false;
		
	} // end function get_image_id
}