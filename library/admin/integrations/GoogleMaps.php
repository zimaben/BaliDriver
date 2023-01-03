<?php
namespace rbt\admin;
use rbt\Config as Config;

/*/ 
 * The parent and child Classes for deferred loading of Google Maps. We'll load after the page 
 * has loaded instead of using the standard enqueue method.
/*/
class GoogleMaps {
    private const theme_json_setting = "locations";
    private const upatemap = array(

    );
    public static function run(){
        if( \is_admin() ){
            \add_action('wp_ajax_create_deferred_maps', array(get_class(), 'create_deferred_maps'));
            \add_action('wp_ajax_nopriv_create_deferred_maps', array(get_class(), 'create_deferred_maps'));
            \add_action('wp_ajax_sync_map_data', array(get_class(), 'sync_map_data'));
            
        } else {
            \add_action( 'wp_footer', array(get_class(), 'defer_google_maps'));
        }

    }

    private static function get_term_names( $terms ){
        $returnarray = array();
        if(is_array($terms)){
            foreach($terms as $term) array_push($returnarray, $term->name);
        }
        return count($returnarray) ? $returnarray : false;
    }

    private static function twentywords($string){
        $arr = explode(' ', $string);
        if(count($arr) < 20 ){
            return $string;
        } else {
            $arr = array_slice($arr, 0, 20);
            $cut = implode(' ', $arr);
            if(substr($cut, -1) !== '.') $cut = trim($cut) . '...';
            return $cut;
        }
    }
    public static function sync_map_data(){
        /* This will rewrite the theme.json file to sync JSON data to database-specific
        values like image urls and site links. These will be different in each install, but
        in order to keep the javascript snappy the data should be loaded into an area of the
        Wordpress theme.json manifest file under Settings instead of query the DB every click.
        */
        if(!isset($_POST['nonce']) || \wp_verify_nonce($_POST['nonce'], 'theme-admin') === false) {
            if(Config::MODE === "development") error_log('NONCE FAILED: Google Maps theme.json sync');
            echo json_encode(array('status'=>400, 'message'=>'Bad Request'));
            die();
        }

        #Now get an array from the DB
        $args = array();
        $args['post_type'] = 'locations';
        $args['post_status'] = 'publish';
        $args['nopaging'] = true; #same as posts_per_page=-1

        $q = new \WP_Query( $args ); 

        if(! $q->have_posts() ){ return false; }

        $locationsarray = array();
        while($q->have_posts() ) : $q->the_post();

            #Get info
            $title = \get_the_title();
            $id = \get_the_id();
            $link = \get_post_permalink( $id );
            $thumb = \get_the_post_thumbnail_url( $id, 'thumb-landscape' );
            $services = self::get_term_names( \get_the_terms( $id, 'Services') );
            $addr = \carbon_get_post_meta($id, 'locations_address');
            $city = \carbon_get_post_meta($id, 'locations_city');
            $state = \carbon_get_post_meta($id, 'locations_state');
            $zip = \carbon_get_post_meta($id, 'locations_zip');
            $phone = \carbon_get_post_meta($id, 'locations_phone');
            $email = \carbon_get_post_meta($id, 'locations_email');
            $lat = floatval( \carbon_get_post_meta($id, 'locations_latitude') );
            $lng = floatval( \carbon_get_post_meta($id, 'locations_longitude') );
            $description = self::twentywords( \get_the_excerpt() );

            array_push($locationsarray, array(
                $title => array(
                    'id'=> $id,
                    'link'=> $link,
                    'thumb'=> $thumb,
                    'description'=> $description,
                    'services'=> $services,
                    'address'=> $addr,
                    'city'=>$city,
                    'state'=>$state,
                    'zip'=>$zip,
                    'phone'=> $phone,
                    'email'=> $email,
                    'lat'=> $lat,
                    'lng'=> $lng,
                )
            ));

        endwhile;
        \wp_reset_postdata();
        
        #get JSON Part
        $filestring = file_get_contents(\get_template_directory() . '/theme.json' );
        $theme_json = json_decode( $filestring, true);

        $new_json = $theme_json;
        $new_json['settings']['locations'] = $locationsarray;

        file_put_contents( \get_template_directory() . '/theme.json', json_encode($new_json));
        echo json_encode(array('status'=>200, 'message'=>'Success. theme.json locations synced to Database values'));
        die();

    }

    public static function defer_google_maps(){
        $key = \carbon_get_theme_option( 'gmap_api_key' );
        if(!$key) $key = \get_option('_gmap_api_key');
        if($key){
            ?>
                <script
                src="https://maps.googleapis.com/maps/api/js?key=<?php echo $key ?>&callback=initMap&v=quarterly"
                async defer
            ></script>

            <?php
        } else {
            error_log("Couldn't get MAPS key");
        }


    }
}
GoogleMaps::run();

class GoogleMap {
    public $ready = false;
    public $error = false;
    public function __construct($args){
        $this->apiKey = $this->getAPIKey();
        $this->args = $this->checkArgs($args);
        $this->buildCallScript = $this->ready ? $this->buildCallScript( $this->apiKey, $this->args ) : false;
        
    }
    private function getAPIKey(){
        if( \carbon_get_theme_option( 'tpt_google_maps_api_key' )) return trim(\carbon_get_theme_option( 'tpt_google_maps_api_key' ));
        
        return \get_option('_tpt_google_maps_api_key') ? \get_option('_tpt_google_maps_api_key') : false ;
    }
    private function checkArgs($args){
        #figure out what we need here
        $error = '';
        if(!$this->apiKey) $error .= ' - Missing or invalid Google Maps API Key';
       # if(!isset($args['somethingneeded'])) $error .= ' - Missing something needed';
        
       if(strlen($error) > 0){
           $this->error = $error;
           return false;
       } else {
            return $args;
       }
    }

    public function buildCallScript($apikey){
        $init_script = '<script async defer src="https://maps.googleapis.com/maps/api/js?key=';
        $init_script .= $apikey . '&callback=initMap"></script>';
    }
}