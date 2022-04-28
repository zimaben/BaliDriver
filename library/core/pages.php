<?php
namespace <!PLUGINPATH->\core;

use \<!PLUGINPATH->\<!PLUGINNAME-> as Plugin;
/*
 * The PluginPage class extends the base class
 * and is run at instantiation. This provides a quick syntax
 * for page operations that are common when setting up a theme
 * or plugin:
 *  
 * add a page:
 * $page = new PluginPage('example', 'My Example Page);
 * $page->set_template('example.php');
 * $page->set_content('<p>I am the very model of a modern major general.</p>');
 * $page->set_title('Yes Yes I am a Major General');
 * 
 * # Sets the page as home;
 * $page->set_to_home_page();
 * 
 */ 

class PluginPage extends Plugin{
    public function __construct(  $slug = null, $name = null, $posttype = 'page', $forcenew = false ){
        $this->id = $this->add_plugin_page($slug, $name, $posttype, $forcenew);
    }
    
    public function add_plugin_page( $slug, $name, $posttype, $forcenew ){
        $new_page_id = false;
        $title = self::nicename($name);
        $content = '';
        if($slug) $slug = \sanitize_title( $name );
        //check if page currently exists wp_delete_post( int $postid, bool $force_delete = false )
        $page_check = \get_page_by_path($slug, OBJECT, $posttype);
        $page = array(
                'post_type' => $posttype,
                'post_title' => $title,
                'post_content' => $content,
                'post_status' => 'publish',
                'post_name' => $slug
        );
        //if not, add it
        if( !isset($page_check->ID) ){
            $new_page_id = \wp_insert_post($page);
            return $new_page_id;
        } else {
            return $page_check->ID;
        }        
    }
    public function set_author( $authid ){
        if($this->id){
            $arg = array('ID'=> $this->id, 'post_author' => $authid);
            return \wp_update_post($arg);
        } else {
            return false;
        }
    }
    public function set_content( $content ){
        if($this->id){
            $arg = array('ID'=> $this->id, 'post_content' => $content);
            return \wp_update_post($arg);
        } else {
            return false;
        }
    }
    public function set_title( $title ){
        if($this->id){
            $arg = array('ID'=> $this->id, 'post_title' => $title);
            return \wp_update_post($arg);
        } else {
            return false;
        }
    }
    public function set_status( $status ){
        if($this->id){
            $arg = array('ID'=> $this->id, 'post_status' => $status);
            return \wp_update_post($arg);
        } else {
            return false;
        }
    }
    public function set_taxonomy( $taxonomy, $array_of_ids, $overwrite = false ){
        if($this->id){
            if(is_array($array_of_ids)){
                if($overwrite){
                    $ids = $array_of_ids;
                } else {
                    $current_terms = \get_the_terms( $this->id, $taxonomy );
                    $current_ids = array();
                    foreach($current_terms as $term) array_push($current_ids, $term->term_id );

                    if($current_ids && is_array($current_ids)){
                        $ids = array_unique(array_merge($array_of_ids, $current_ids));
                    } else {
                        $ids = $array_of_ids;
                    } 
                }
                #the "append" param in set_post_terms is opposite of overwrite. If overwrite is false, append is true

                #but we will keep "overwrite" to remain consistent with other functions

                $append = $overwrite ? false : true;
                return \wp_set_post_terms($this->id, $array_of_ids, $taxonomy, $append);
              
            } else {
                if(self::$mode !== "production") error_log("PluginPage->set_taxonomy function requires an array as first parameter");
                return false;
            }
        } else {
            if(self::$mode !== "production") error_log("PluginPage->set_taxonomycalled on non-page");
            return false;
        }
    }
    public function set_categories( $array_of_ids, $overwrite = false ){
        if($this->id){
            if(is_array($array_of_ids)){
                if($overwrite){
                    $ids = $array_of_ids;
                } else {
                    $current_ids = \wp_get_post_categories( $this->id, array('fields'=>'ids') );
                    if($current_ids && is_array($current_ids)){
                        $ids = array_unique(array_merge($array_of_ids, $current_ids));
                    } else {
                        $ids = $array_of_ids;
                    } 
                }
                return \wp_update_post(array('ID'=>$this->id, 'post_categories'=> $ids));
            } else {
                if(self::$mode !== "production") error_log("PluginPage->set_categories function requires an array as first parameter");
                return false;
            }
        } else {
            if(self::$mode !== "production") error_log("PluginPage->set_categories called on non-page");
            return false;
        }
    }
    /*
     * Set Featured Image takes a $filepath variable and optional $relative
     * If relative is set false, the absolute path of the file is tried
     * If defaulted to true, the filepath is relative to the PLUGIN ROOT
     */
    public function set_featured_image( $filepath, $relative = true, $overwrite = false ){
        // Add Featured Image to Post
        $existing = \get_the_post_thumbnail( $this->id);
        if(!$existing || $overwrite){
            if($relative){
                $image_path  = self::get_plugin_path($filepath); // Define the image path
            } else {
                $image_path = $filepath;
            }
            
            $image_array = explode('/', $filepath);
           # $image_name = $image_array[end(array_keys($image_array))];
            $image_name = $image_array[ count($image_array) - 1 ];
    
            $upload_dir        = \wp_upload_dir(); // Set upload folder
            $image_data        = file_get_contents($image_path); // Get image data
    
            if($image_data){
                $unique_file_name = \wp_unique_filename( $upload_dir['path'], $image_name ); // Generate unique name
                $filename = basename( $unique_file_name ); // Create image file name
    
                // Check folder permission and define file location
                if( \wp_mkdir_p( $upload_dir['path'] ) ) {
                    $file = $upload_dir['path'] . '/' . $filename;
                } else {
                    $file = $upload_dir['basedir'] . '/' . $filename;
                }
                // Create the image  file on the server
                file_put_contents( $file, $image_data );
    
                // Check image file type
                $wp_filetype = \wp_check_filetype( $filename, null );
    
                // Set attachment data
                $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title'     => \sanitize_file_name( $filename ),
                    'post_content'   => '',
                    'post_status'    => 'inherit'
                );
    
                // Create the attachment
                $attach_id = \wp_insert_attachment( $attachment, $file, $this->id );
    
                // Include image.php
                require_once(ABSPATH . 'wp-admin/includes/image.php');
    
                // Define attachment metadata
                $attach_data = \wp_generate_attachment_metadata( $attach_id, $file );
    
                // Assign metadata to attachment
                \wp_update_attachment_metadata( $attach_id, $attach_data );
    
                // And finally assign featured image to post
                return \set_post_thumbnail( $this->id, $attach_id );
    
            }
        }
        
    return false;
   }

    
    public function protect_slug(){
        if($this->id){
            $post = \get_post($this->id); 
            $slug = $post->post_name;
            $slugarray = \get_option(self::textdomain . '_protected_slugs');
            if($slugarray){
                if(is_array($slugarray)){
                    array_push($slugarray, $slug);
                } else {
                    $slugarray = array( $slug );
                }
            } else {
                $slugarray = array( $slug );
            }
          
            return \update_option(self::textdomain . '_protected_slugs', $slugarray);
             
        } else {
            return false;
        }
    }
    public function set_to_home_page(){
        if($this->id){
            //have we already made this assignment once?
            $assigned = \get_option(self::textdomain . '_home_page_assigned');
            if($assigned) {
                return false;
            }
            //is there already a static home page?
            if('page' == \get_option('show_on_front')){
                return false;
            } else {
                //if our home page is the current one
                if($this->id == \get_option( 'page_on_front' )){
                    return false;
                } else {
                    \update_option( 'page_on_front', $this->id);
                    \update_option( 'show_on_front', 'page' );
                    \update_option(self::textdomain . '_home_page_assigned', 1);
                    return true;
                }
            }
        }
    }
    public function set_body_class( $class ){
        $post = \get_post($this->id); 
        if($post){
            $all_classes = get_option(self::textdomain . '_body_classes');
            $all_classes = $all_classes ? $all_classes : array();
            $all_classes[$post->post_name] = $class;
            return \update_option( self::textdomain . '_body_classes', $all_classes );
        } else {
            if(self::$mode !== 'production') error_log('PluginPage->set_body_class called on non-page');
        }
        #store in slug=>filename key value pair;
        return \add_option( self::textdomain . '_body_classes', array($post->post_name => $class));
    }
    public function set_template( $file ){
        #filename of the file contained in /theme/pagetemplates
        $post = \get_post($this->id); 
        if($post){
            #do this way to avoid any checks or loops
            $all_templates = \get_option(self::textdomain . '_set_templates' );
            $all_templates = $all_templates ? $all_templates : array();
            #this overwrites, appends, and adds new
            $all_templates[$post->post_name ] = $file;
            return \update_option(self::textdomain . '_set_templates', $all_templates);
        } else {
            if(self::$mode !== 'production') error_log('PluginPage->set_template called on non-page');
        }
    }
    public static function nicename( $name ){
        $conjunctions = array(
            'for','and','or','nor','but','yet', 'so'
        );
        $prepositions = array(
            'above', 'across', 'against', 'along', 'among', 'around', 
            'at', 'before', 'behind', 'below', 'beneath', 'beside', 
            'between', 'by', 'down', 'from', 'in', 'into', 'near', 'of', 
            'off', 'on', 'to', 'toward', 'under', 'upon', 'with', 'within'
        );
        $return_name = '';
        $name = str_replace('_', ' ', $name);
        $name = str_replace('-', ' ', $name);
        $wordarray = explode(' ', $name);
        
        foreach($wordarray as $word){
            if(!in_array($word, $conjunctions, true) && !in_array($word, $prepositions, true ) ){
                $word = ucfirst($word);
            } 
            $return_name.=$word . ' ';
        }
        $return_name = trim($return_name);
        return $return_name;
    }
}