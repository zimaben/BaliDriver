<?php
namespace rbt\admin;
use rbt\Config as Config;
use \rbt\admin\setup\Create_Media_File as Create_Media_File;
use rbt\setup\ColorPalette as ColorPalette;

/* 
    Set up admin ajax request - this just bounces method requests between the WP admin ajax and
    our FigmaRequest class. Admin Ajax can figure out Auth & Nonce.
*/

#Run function must be called to get Ajax requests on server request handle
\rbt\admin\FigmaAdmin::run();

class FigmaAdmin {
    public static function run(){
        \add_action( 'wp_ajax_test_figma', array(get_class(), 'test_figma' ));
        \add_action( 'wp_ajax_test_figma_item', array(get_class(), 'test_figma_item'));
        \add_action( 'wp_ajax_get_figma_item', array(get_class(), 'get_figma_item'));
        \add_action( 'wp_ajax_get_logo', array(get_class(), 'get_logo'));
        \add_action( 'wp_ajax_get_colors', array(get_class(), 'get_colors'));
        \add_action( 'wp_ajax_get_typography', array(get_class(), 'get_typography'));
        \add_action( 'wp_ajax_run_setup', array(get_class(), 'run_setup'));

        require_once( get_template_directory() . '/library/admin/setup/colorpalette.php' );
    }
    private static function color_rectangle_to_hex( $node ){
        error_log("Fills:");
        error_log(print_r($node['fills'][0],true));
        $fill = isset($node['fills'][0]->color) ? $node['fills'][0]->color : false;
        $color = $fill ? (Array) $fill : false;
        error_log("Color");
        error_log(print_r($color,true));
        $hex = $color ? ColorPalette::FigmaRGBArrayToHex( $color ) : false;
        error_log("Hex: " . $hex);
        return $hex;
    }
    private static function get_color_palette(){

        $document = new FigmaRequest( 'get_document' );
        if($document->err){
            self::return_false($request->err);
        }
        if(!$document->response){
            self::return_false('No Server Response');
        }
        #to get the actual document node, you need to actually look at <response->
        $document = json_decode($document->response);
        $document = $document->document;
        # error_log(print_r(\json_decode($document->response), true));
        $PageNode = self::get_node('Page 1', 'CANVAS', $document);
        $Colors = $PageNode ? self::get_node('Colors', 'FRAME', $PageNode) : false;
        if($Colors){         
            $Palette = new ColorPalette();
            #Get Primary and Accent Colors
            $primaryNode = self::get_node('primary color', 'ELLIPSE', $Colors);
            if($primaryNode ){
                error_log("Found Primary Node");
            } else {
                error_log("No Primary Node found");
            }
            $primaryHex = self::color_rectangle_to_hex( $primaryNode );
            if($primaryHex) {
                error_log("Found Primary Hex: " . $primaryHex );
            
                $Palette->setPrimary($primaryHex);
                if(Config::MODE == "development" && $Palette->warning) error_log($Palette->warning);
            }
            $accentNode = self::get_node('accent color', 'ELLIPSE', $Colors);
            $accentHex = self::color_rectangle_to_hex( $accentNode );
            if($accentHex) {
                error_log("Found Accent Hex: " . $accentHex );
                $Palette->setAccent($accentHex);
                if(Config::MODE == "development" && $Palette->warning) error_log($Palette->warning);
            }
            #Set UI Colors
            $UI = self::get_node('User Experience', 'GROUP', $Colors);
            $UI_badHex = false;
            $UI_goodHex = false;
            $UI_warning = false;
            $UI_badNode = $UI ? self::get_node('bad', 'ELLIPSE', $UI) : false;
            $UI_goodNode = $UI ? self::get_node('good', 'ELLIPSE', $UI) : false;
            $UI_warningNode = $UI ? self::get_node('warning', 'ELLIPSE', $UI) : false;
            if($UI_badNode && $UI_goodNode && $UI_warningNode){
                $UI_badHex = self::color_rectangle_to_hex( $UI_badNode );
                $UI_goodHex = self::color_rectangle_to_hex( $UI_goodNode );
                $UI_warningHex = self::color_rectangle_to_hex( $UI_warningNode );
                if($UI_badHex && $UI_goodHex && $UI_warningHex){
                    $Palette->setUI( array('good' => $UI_goodHex, 'bad' => $UI_badHex, 'warning' => $UI_warningHex));
                    if(Config::MODE == "development" && $Palette->warning) error_log($Palette->warning);
                }
            }
            #Set Light Colors
            $Light = self::get_node('Light', 'GROUP', $Colors);
            $LightColor = false;
            $LightHalf= false;
            $LightNeutral = false;
            $LightColorNode = $Light ? self::get_node('color', 'RECTANGLE', $Light) : false;
            $LightHalfNode = $Light ? self::get_node('half', 'RECTANGLE', $Light) : false;
            $LightNeutralNode = $Light ? self::get_node('neutral', 'RECTANGLE', $Light) : false;
            if($LightColorNode && $LightHalfNode && $LightNeutralNode){
                $LightColorHex = self::color_rectangle_to_hex( $LightColorNode );
                $LightHalfHex = self::color_rectangle_to_hex( $LightHalfNode );
                $LightNeutralHex = self::color_rectangle_to_hex( $LightNeutralNode );
                if($LightColorHex && $LightHalfHex && $LightNeutralHex){
                    $Palette->setLight( array('color' => $LightColorHex, 'half' => $LightHalfHex, 'neutral' => $LightNeutralHex));
                    if(Config::MODE == "development" && $Palette->warning) error_log($Palette->warning);
                } else if($LightColorHex){
                    #if 3 tones aren't available you can set Light tones with a single color instead of an array
                    $Palette->setLight( $LightColorHex );
                    if(Config::MODE == "development" && $Palette->warning) error_log($Palette->warning);
                }
            } else if($LightColorNode){
                $LightColorHex = self::color_rectangle_to_hex( $LightColorNode );
                if($LightColorHex)$Palette->setLight( $LightColorHex );
                if(Config::MODE == "development" && $Palette->warning) error_log($Palette->warning);
            }
            #Set Dark Colors
            $Dark = self::get_node('Dark', 'GROUP', $Colors);
            $DarkColor = false;
            $DarkHalf= false;
            $DarkNeutral = false;
            $DarkColorNode = $Dark ? self::get_node('color', 'RECTANGLE', $Dark) : false;
            $DarkHalfNode = $Dark ? self::get_node('half', 'RECTANGLE', $Dark) : false;
            $DarkNeutralNode = $Dark ? self::get_node('neutral', 'RECTANGLE', $Dark) : false;
            if($DarkColorNode && $DarkHalfNode && $DarkNeutralNode){
                $DarkColorHex = self::color_rectangle_to_hex( $DarkColorNode );
                $DarkHalfHex = self::color_rectangle_to_hex( $DarkHalfNode );
                $DarkNeutralHex = self::color_rectangle_to_hex( $DarkNeutralNode );
                if($DarkColorHex && $DarkHalfHex && $DarkNeutralHex){
                    $Palette->setDark( array('color' => $DarkColorHex, 'half' => $DarkHalfHex, 'neutral' => $DarkNeutralHex));
                    if(Config::MODE == "development" && $Palette->warning) error_log($Palette->warning);
                } else if($DarkColorHex){
                    #if 3 tones aren't available you can set Dark tones with a single color instead of an array
                    $Palette->setDark( $DarkColorHex );
                    if(Config::MODE == "development" && $Palette->warning) error_log($Palette->warning);
                }
            } else if($DarkColorNode){
                $DarkColorHex = self::color_rectangle_to_hex( $DarkColorNode );
                if($DarkColorHex)$Palette->setDark( $DarkColorHex );
                if(Config::MODE == "development" && $Palette->warning) error_log($Palette->warning);
            }
            #Set theme.json colors
            $Palette->printToThemeJSON();
            echo json_encode(array('status'=>200, 'message'=>'Setting theme.json colors'));
            die();
        }
        #Else no Colors
        echo json_encode(array('status'=>404, 'message'=>'Could not find Colors in Figma File'));
        die();

    }
    public static function get_figma_item(){
        if( ! self::gatekeep_post() ) self::return_false('Missing or Invalid Nonce');
        $item = isset($_POST['item']) ? $_POST['item'] : false;

        switch ($item){
            #$item = color
            case("Colors") : 
                self::get_color_palette();
            break;
            default: 
                echo json_encode(array('status'=>404, 'message'=>'Could not find Item in Figma File'));
                die();
            break;
        }
    }
    public static function test_figma_item(){
        if( ! self::gatekeep_post() ) self::return_false('Missing or Invalid Nonce');
        $item = isset($_POST['item']) ? $_POST['item'] : false;

        switch ($item){
            #$item = color
            case("Colors") : 
                #yeah
                $document = new FigmaRequest( 'get_document' );
                if($document->err){
                    self::return_false($request->err);
                }
                if(!$document->response){
                    self::return_false('No Server Response');
                }
                #to get the actual document node, you need to actually look at <response->
                $document = json_decode($document->response);
                $document = $document->document;
               # error_log(print_r(\json_decode($document->response), true));
                $PageNode = self::get_node('Page 1', 'CANVAS', $document);

                $Colors = self::get_node('Colors', 'FRAME', $PageNode);
                error_log(print_r($Colors, true));
               # error_log(print_r($PageNode, true));
                if(!$PageNode){ self::return_false('Could Not Parse Figma Page'); }
                
                break;
            default: 
            break;

        }
        echo json_encode(array('status'=>200, 'message'=>'Hi'));
        die();

    }
    public static function test_figma(){
        if( ! self::gatekeep_post() ) self::return_false('Missing or Invalid Nonce');
        
        $request = new FigmaRequest( 'test_figma' );
        if($request->err){
            self::return_false($request->err);
        }
        if(!$request->response){
            self::return_false('No Server Response');
        }

        echo json_encode(array('status'=>200, 'message'=>$request->response));
        die();
    }

    public static function get_logo(){
        if( ! self::gatekeep_post() ) self::return_false('Missing or Invalid Nonce');

        $document = new FigmaRequest( 'get_document' );
        if($document->err){
            self::return_false($request->err);
        }
        if(!$document->response){
            self::return_false('No Server Response');
        }

        #Get Document to Parse in associative array, if return node is specified set Document to return node
        $parse_document = json_decode($document->response, true );
        if($document->return_node && isset($document->return_node) && isset($parse_document[$document->return_node]) ) $parse_document = $parse_document[$document->return_node];

        $logo_node_id = false;
        
        #Get Page
        $PageNode = self::get_node('Page 1', 'CANVAS', $parse_document);
        if(!$PageNode){ self::return_false('Could Not Parse Figma Page'); }

        #Now find our target nodes
        $LogoNode = self::get_node('Logo', 'FRAME', $PageNode);
        if(!$LogoNode){ self::return_false('Could Not Find Figma Logo'); }

        $logo_node_id = $LogoNode['id'];
        #Now we have everything we need to get the image
        $image = new FigmaRequest('images/' . $document->connection->file . '?ids=' . $logo_node_id . '&format=svg', 'GET' );
        #https://api.figma.com/v1/images/N5EdgAhAjPuSaygdRG2KFD?ids=4:4'
        
        #CHECK
        $imgresponse = json_decode($image->response, true);
        if(isset($imgresponse['images'][$logo_node_id])){
            
            $url = $imgresponse['images'][$logo_node_id];
            $file_name = 'theme-logo.svg';
                
            // Use file_get_contents() function to get the file
            // from url and use file_put_contents() function to
            // save the file 
            if (\file_put_contents( \get_template_directory() . '/theme/assets/' . $file_name, file_get_contents($url)))
            {
                echo json_encode( array('status'=>200, 'message'=>'Successfully Saved Logo to ' . \get_template_directory_uri() . '/theme/assets/' . $file_name ) );
                die();
            }
            else
            {
                self::return_false('Could not save Logo.');
            }  
        }
        self::return_false('Could Not Find Image for that Node.');


        echo json_encode(array('status'=>200, 'message'=>'Could not find what you were looking for'));
        die();
        
    }

    public static function get_colors(){
        if( ! self::gatekeep_post() ) self::return_false('Missing or Invalid Nonce');
        
    }
    public static function get_typography(){
        if( ! self::gatekeep_post() ) self::return_false('Missing or Invalid Nonce');

        $document = new FigmaRequest( 'get_document' );
        if($document->err){
            self::return_false($request->err);
        }
        if(!$document->response){
            self::return_false('No Server Response');
        }

        #Get Document to Parse in associative array, if return node is specified set Document to return node
        $parse_document = json_decode($document->response, true );
        if($document->return_node && isset($document->return_node) && isset($parse_document[$document->return_node]) ) $parse_document = $parse_document[$document->return_node];
        
        #Get Page
        $PageNode = self::get_node('Page 1', 'CANVAS', $parse_document);
        if(!$PageNode){ self::return_false('Could Not Parse Figma Page'); }

        $TypographyGroup = self::get_node('Typography', 'GROUP', $PageNode);
        if(!$TypographyGroup){ self::return_false('Could not find Typography');}

       # error_log(print_r($TypographyGroup, true));

        $filtered_typography_nodes = self::get_nodes( array('style'=> '*'), array('name', 'style'), $TypographyGroup);

        error_log("FILTERED");
        error_log(print_r( $filtered_typography_nodes, true));
        #this kicks Ass

        die();

    }
    public static function run_setup(){

        if( ! self::gatekeep_post() ) self::return_false('Missing or Invalid Nonce');

        $document = new FigmaRequest( 'get_document' );
        if($document->err){
            self::return_false($request->err);
        }
        if(!$document->response){
            self::return_false('No Server Response');
        }

        #Get Document to Parse in associative array, if return node is specified set Document to return node
        $parse_document = json_decode($document->response, true );
        if($document->return_node && isset($document->return_node) && isset($parse_document[$document->return_node]) ) $parse_document = $parse_document[$document->return_node];
        
        #Get Page
        $PageNode = self::get_node('Page 1', 'CANVAS', $parse_document);
        if(!$PageNode){ self::return_false('Could Not Parse Figma Page'); }

        #From PageNode we can do everything we need;
        #Logo
        $added_theme_logo = self::setup_logo( $PageNode );
        
        #Typography


        
    }

    #High Level Function Rips Logo from Figma file containing FRAME node named Logo and sets it as the Theme Logo
    private static function setup_logo( $PageNode = null ){

        if(!$PageNode) return false;

        #We will add or overwrite theme-logo.svg under theme/assets.
        $logo_node_id = false;

        #Now find our target nodes
        $LogoNode = self::get_node('Logo', 'FRAME', $PageNode);
        if(!$LogoNode){ return false; }

        $logo_node_id = $LogoNode['id'];
        $image = new FigmaRequest('images/' . $document->connection->file . '?ids=' . $logo_node_id . '&format=svg', 'GET' );
        
        #CHECK
        $imgresponse = json_decode($image->response, true);
        if( ! isset($imgresponse['images'][$logo_node_id]) ) { return false; }
            
        $url = $imgresponse['images'][$logo_node_id];
        $file_name = 'theme-logo.svg';
            
        // Use file_get_contents() function to get the file
        // from url and use file_put_contents() function to
        // save the file 
        if (\file_put_contents( \get_template_directory() . '/theme/assets/' . $file_name, file_get_contents($url))) {
            #new file is in theme/assets/theme-logo
            require_once( get_template_directory() . '/library/admin/setup/images.php');

            $logo_url = \get_template_directory_uri() . '/theme/assets/' . $file_name;
            $media_image = new Create_Media_File( $logo_url );
            if($media_image->attachment_id){
                $ret_value = \set_theme_mod( 'custom_logo', $media_image->attachment_id);

                #Check if we have set screenshot.png yet
                $checkSSPNG = get_option( 'theme_set_screenshot');
                if(!$checkSSPNG){   
                    #do another image request for PNG - avoids library dependency
                    $image = new FigmaRequest('images/' . $document->connection->file . '?ids=' . $logo_node_id . '&format=png&scale=2', 'GET' );
                    $imgresponse = json_decode($image->response, true);
                    $url = $imgresponse['images'][$logo_node_id];

                    $rewriteSS = file_put_contents( \get_template_directory() . 'screenshot.png', file_get_contents($url));
                    if($rewriteSS) \update_option( 'theme_set_screenshot', 'set' );
                }

                return $ret_value;

            } else { return false; }
        } else { return false; }  

        #end of the road - impossible to get here
        return false;
    }
    /* 
    * High level function takes a filtered list of Typography nodes and writes a 
    * /theme/src/css/typography/typography.scss file

    */
    private static function create_typography_file( $nodes ){
        $importfonts = array();
        $headlines = array();
        foreach($nodes as $node){

        }
        $printstring = '';
        foreach($importfonts as $fontfamily){
            $fontfamily=str_replace(' ', '+', $fontfamily);
            $printstring.= '@import url(//fonts.googleapis.com/css?family='.$fontfamily.');' . PHP_EOL;
        };

       /*
            [name] => Body Mobile
            [style] => Array
                (
                    [fontFamily] => Merriweather Sans
                    [fontPostScriptName] => MerriweatherSans-Regular
                    [fontWeight] => 400
                    [fontSize] => 12
                    [textAlignHorizontal] => LEFT
                    [textAlignVertical] => TOP
                    [letterSpacing] => 0
                    [lineHeightPx] => 15.083999633789
                    [lineHeightPercent] => 100
                    [lineHeightUnit] => INTRINSIC_%
                )

                
       */
    }
    # UTILITY FUNCTIONS BELOW - These are less abstract walking/parsing helpers #
    /*
    Recursively brute force through document looking for FIRST node match on name & type 
    */
    private static function get_node( $name, $type, $root ){
        #error_log("MATCH CALLED ON " . $name . ' ' . $type);
        if( is_object($root) ){
            $root = (array) $root;
        } 
        if( isset( $root['name'] ) && isset( $root['type'] )){
            #check that node is matchable
            if($root['name'] === $name && $root['type'] === $type){
                return $root;
            }
            if(isset($root['children'])){
                foreach( $root['children'] as $idx => $child){
                    $check = self::get_node($name, $type, $child);
                    if($check){
                        return $check;
                    }
                }
                return false;
            }
        } else {
            return false;
        }
    }
    /* Were morbin up in here */
    /* Were morbiun here recursive function returns ALL matches on args in the structure of returnfields */
    private static function get_nodes( $args = null, $returnfields = null, $root){
        if(!$args) return false;

        $return_array = array();

        $this_node = self::check_node($args, $root);
        if($this_node){
            $built_array = array();
            foreach($returnfields as $field){
                if(isset($this_node[$field])) $built_array[$field] = $this_node[$field];
            }
            $return_array[] = $built_array;
        }
        if(isset($root['children'])){
            foreach($root['children'] as $idx => $child ){
                $check_child = self::get_nodes($args, $returnfields, $child);
                if($check_child) $return_array = array_merge($return_array, $check_child);
            }
        }
        return count($return_array) ? $return_array : false;

    }

    private static function check_node( $args = null, $node ){
        if(!$args || !is_array($args)) return false;

        $return_node = true;
        foreach( $args as $k=>$v){
            if(!isset($node[$k])){ 
                $return_node = false;
                break;
            }
            if($v !== '*' ){
                # * value returns any node with the key set to something
                if($node[$k] !== $v){
                    $return_node = false;
                    break;
                }
            }

        }
        return $return_node ? $node : false;
    }
    private static function return_false( $error ){
        echo json_encode(array('status'=>400, 'message'=>$error));
        die();
    }
    private static function gatekeep_post(){
        if(!isset($_POST['nonce'])) return false;
        return \wp_verify_nonce( $_POST['nonce'], 'theme-admin');
    }
}

class FigmaRequest{
    /* This class sends a Request to a Figma document
     Accepted Parameters: $request == string, $method == string
     Use: The first parameter takes a supported request, or if the request 
     is not found appends the request as a URL string to the base API URL
     and attempts the request using the optional second method parameter.

     If the request isn't supported and the method isn't provided an error will 
     be thrown. If the request is supported the method parameter will be 
     ignored in favor of the supported method.
     */
    public $err = false;
    public $response = false;
    public $supported_requests = array(
        'test_figma' => array('string'=> 'me', 'method'=> 'GET'),
        'get_document' => array('string'=>'files', 'method'=>'GET', 'return_node'=>'document'),
        'get_node' => array('string'=>'files', 'method'=>'GET', 'return_node'=>'document'),
        
    );
    public $request = null;
    public $method = null;
    public $returnvalue = null;
    public $return_node = null;
    public function __construct($request, $method = null){
        $this->connection = new FigmaConnection();
        if($this->connection->err) $this->err = $this->connection->err;
        $this->request = $this->checkRequest( $request, $method );
        $this->response = $this->err ? false : $this->doRequest($request, $method);
        $this->returnvalue = $this->response ? $this->doReturnValue() : false;
        // error_log("FIGMAREQUEST CLASS");
        // error_log(print_r($this,true));
    }
    private function checkRequest($request, $method){
        if(isset($this->supported_requests[$request])){
            
            $this->method = $this->supported_requests[$request]['method'];
            $this->return_node = isset($this->supported_requests[$request]['return_node']) ? $this->supported_requests[$request]['return_node'] : null;
            return $request;
        }
    }
    private function doReturnValue(){
        if( isset($this->response) && 
            $this->response && 
            isset($this->return_node) && 
            $this->return_node ){
            
            return isset($this->response[$this->return_node]) ? $this->response[$this->return_node] : false;
        } else {
            return false;
        }
    }
    private function doRequest($request, $method){
        #if supported request
        if($this->request){
            $this->connection->setMethod( $this->supported_requests[$request]['method']);
            $this->connection->setRequest($this->supported_requests[$request]['string']);
            if($this->connection->err){
                $this->err = $this->connection->err;
                return false;
            }

            $sent = $this->connection->doRequest();
            if($sent) return $this->connection->response;
            #for some reason we didn't send and 
            #no error was caught
            // error_log(print_r($this, true));
            // $this->err = 'Something went wrong with the request';
            return false;
        } else {
            #unsupported request
            if(!$method) {
                $this->err = 'Unsupported requests require a method parameter';
                return false;
            }
            $this->connection->setMethod($method);
            if($this->connection->err){
                $this->err = $this->connection->err;
                return false;
            }
            $this->connection->setRequest($request);
            if($this->connection->err){
                $this->err = $this->connection->err;
                return false;
            }
            $sent = $this->connection->doRequest();
            if($sent) return $this->connection->response;
            #for some reason we didn't send and 
            #no error was caught
            error_log(print_r($this, true));
            $this->err = 'Something went wrong with the unsupported request';
            return false;
        }
    } 
}

class FigmaConnection {

    public $err = false;
    public $ready = false;
    private $base = 'https://api.figma.com/v1/';
    private $accepted_methods = array( 'GET', 'POST' );
    public $method = false;
    public $request = false;
    public $response = false;
    public function __construct(){
        $this->apikey = $this->getAPIKey();
        $this->file = $this->getFileID();
        $this->headers = $this->getHeaders();
    }

    public function setRequest( $request = null){
        if(!$request){
            $this->err = 'request: setRequest called without a valid request';
            $this->checkReady();
            return false;
        }
        if($this->err){
            if(substr($this->err, 0, 7) == 'request') $this->err = false;
        }
        $this->request = $request;
        $this->checkReady();
        return true;
    }
    public function setMethod( $method = null){
        if(!$method){
            $this->method = false;
            $this->err = 'method: setMethod called without valid method';
            $this->checkReady();
            return false;
        }
        if( ! in_array(strtoupper($method), $this->accepted_methods) ){
            $this->method = false;
            $this->err = 'method: the method ' . $method . ' is not supported';
            $this->checkReady();
            return false;
        }
        if($this->err){
            if(substr($this->err, 0, 6) == 'method') $this->err = false;
        }
        $this->method = strtoupper($method);
        $this->checkReady();
        return true;
    }

    public function doRequest(){

        if(!$this->ready) return false;

        $req = $this->request;
        if($req === 'files' ) $req .= '/' . $this->file;

        $url = $this->base . $req;
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->headers); 
        if($this->method === "POST") curl_setopt($curl, CURLOPT_POST, 1);
        $this->response = curl_exec($curl);
        curl_close($curl);
        return true;
    }

    private function checkReady(){
        $this->ready = (
            $this->err === false && 
            $this->method !== false &&
            $this->apikey &&
            $this->file &&
            $this->headers
        ) ? true : false;
    }
    private function getAPIKey(){
        $key = \carbon_get_theme_option( 'figma_api_key' );
        if($key) return $key;
        #carbon fields not loaded for some reason
        return \get_option( '_figma_api_key' );
    }
    private function getFileID(){
        if($this->err) return false;

        $file = \carbon_get_theme_option( 'figma_design_id' );
        if($file) return $file;
        #carbon fields not loaded for some reason
        $no_carbon_file = \get_option( '_figma_design_id' );
        if($no_carbon_file){
            return $no_carbon_file;
        } else {
            $this->err = 'api: Missing Figma filestring';
            return false;
        }
    }
    private function getHeaders(){
        if($this->apikey){
            return [ 'X-Figma-Token: '. $this->apikey, 'Accept: */*' ];
        } else {
            $this->err = 'api: Missing API key';
            return false;
        }

    }
}