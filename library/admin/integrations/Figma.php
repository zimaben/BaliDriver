<?php
namespace rbtddb\admin;
use rbtddb\Config as Config;
use rbtddb\admin\Setup as Setup;
use rbtddb\setup\ColorPalette as ColorPalette;
use rbtddb\setup\FigmaTypography as FigmaTypography;
use rbtddb\admin\setup\MediaImage as MediaImage;

/* 
    Set up admin ajax request - this just bounces method requests between the WP admin ajax and
    our FigmaRequest class. Admin Ajax can figure out Auth & Nonce.
*/

#Run function must be called to get Ajax requests on server request handle
\rbtddb\admin\FigmaAdmin::run();

class FigmaAdmin {
    public static function run(){
        \add_action( 'wp_ajax_test_figma', array(get_class(), 'test_figma' ));
        \add_action( 'wp_ajax_test_figma_item', array(get_class(), 'test_figma_item'));
        \add_action( 'wp_ajax_get_figma_item', array(get_class(), 'get_figma_item'));
        \add_action( 'wp_ajax_import_figma_styleguide', array(get_class(), 'import_figma_styleguide'));
        \add_action( 'wp_ajax_get_logo', array(get_class(), 'get_logo'));
        \add_action( 'wp_ajax_get_colors', array(get_class(), 'get_colors'));
        \add_action( 'wp_ajax_get_typography', array(get_class(), 'get_typography'));
        \add_action( 'wp_ajax_run_setup', array(get_class(), 'run_setup'));

        require_once( get_template_directory() . '/library/admin/setup/colorpalette.php' );
        require_once( get_template_directory() . '/library/admin/setup/typography.php' );
    }
    private static function color_rectangle_to_hex( $node ){
        $fill = isset($node['fills'][0]->color) ? $node['fills'][0]->color : false;
        $color = $fill ? (Array) $fill : false;
        $hex = $color ? ColorPalette::FigmaRGBArrayToHex( $color ) : false;
        return $hex;
    }
    private static function getPageNode( FigmaRequest $RootDocument ){
        
        if($RootDocument->err){
            self::return_false($request->err);
        }
        if(!$RootDocument->response){
            self::return_false('No Server Response');
        }
        #to get the actual document node, you need to actually look at <response->
        $document = json_decode($RootDocument->response);
        $document = $document->document;
        $PageNode = self::get_node($document, 'Page 1', 'CANVAS');
        return $PageNode ? $PageNode : false;
    }
    public static function import_figma_styleguide(){
        $document = new FigmaRequest( 'get_document' );
        $logo = self::get_logo( $document );
        $pageNode = self::getPageNode( $document );
        $typography = self::get_typography( $pageNode );
        $colors = self::get_color_palette( $pageNode );
        $message = '';
        $message.= $logo ? 'Imported Logo...' . PHP_EOL : '';
        $message.= $typography? 'Imported Typography...'. PHP_EOL : '';
        $message.= $colors? 'Imported Color Palette...'. PHP_EOL : '';
        # Set Home Page to Static Home Template
        $HomePageID = Setup::set_up_home_page(); 
        if($message === '') $message = 'Could not import Figma Styleguide';
        echo json_encode(array('status'=>200, 'message'=>$message));
        die();

    }
    private static function get_logo( FigmaRequest $RootDocument){

        require_once( get_template_directory() . '/library/admin/setup/images.php' );
        #to get the actual document node, you need to actually look at <response->
        $obj_document = json_decode($RootDocument->response);
        $array_document = $obj_document->document;
        $PageNode = self::get_node($array_document, 'Page 1', 'CANVAS');
        $LogoFrame = self::get_node($PageNode, 'Logo', 'FRAME');
        $LogoNode = self::get_node($LogoFrame, 'Logo', 'COMPONENT');
        if(!$LogoNode){ return false; }

        $logo_node_id = $LogoNode['id'];
        $format = 'svg';
        $image = new FigmaRequest('images/' . $RootDocument->connection->file . '?ids=' . $logo_node_id . '&format=' . $format, 'GET' );
        
        $response = json_decode($image->response);
        if($response->err ){
            self::return_false($response->err);
            die();
        }
        $imgresponse = (Array) $response->images;
        $imgurl = $imgresponse[ array_keys($imgresponse)[0] ];
        $resource = file_get_contents( $imgurl );
        $upload_image = new MediaImage($resource, 'site-logo-figma.' . $format);
        $upload_image->set_logo();
        #Set Screenshot.png to Branded Logo
        $format = 'png';
        $image = new FigmaRequest('images/' . $RootDocument->connection->file . '?ids=' . $logo_node_id . '&format=' . $format, 'GET' );
        $response = json_decode($image->response);
        $imgresponse = (Array) $response->images;
        $imgurl = $imgresponse[ array_keys($imgresponse)[0] ];
        //copy( \get_template_directory() . '/screenshot.png', $imgurl);
        $resource = file_get_contents( $imgurl );
        file_put_contents(\get_template_directory() . '/screenshot.png', $resource);
        return true;
 
    }
    private static function get_typography( $PageNode ){
       # $PageNode = self::getPageNode();
        $Typography = $PageNode ? self::get_node($PageNode, 'Typography', 'FRAME') : false;
        $TypographyGroup = $Typography ? self::get_node($Typography, 'Typography', 'GROUP') : false;
        if($TypographyGroup){
            $Header = self::get_node($TypographyGroup, 'Header', 'GROUP');
            $BaseTypography = new FigmaTypography();
            
            $H1 = self::get_node($Header, 'H1 Desktop', 'TEXT' );
            $H2 = self::get_node($Header, 'H2 Desktop', 'TEXT');
            $H3 = self::get_node($Header, 'H3 Desktop', 'TEXT');
            $H4 = self::get_node($Header, 'H4 Desktop', 'TEXT');
            $H5 = self::get_node($Header, 'H5 Desktop', 'TEXT' );
            $H6 = self::get_node($Header, 'H6 Desktop', 'TEXT');

            $BaseTypography->setStyle('H1', (Array) $H1['style']);
            $BaseTypography->setStyle('H2', (Array) $H2['style']);
            $BaseTypography->setStyle('H3', (Array) $H3['style']);
            $BaseTypography->setStyle('H4', (Array) $H4['style']);
            $BaseTypography->setStyle('H5', (Array) $H5['style']);
            $BaseTypography->setStyle('H6', (Array) $H6['style']);
            
            $H1Mobile = self::get_node($Header, 'H6 Mobile', 'TEXT');
            $H2Mobile = self::get_node($Header, 'H6 Mobile', 'TEXT');
            $H3Mobile = self::get_node($Header,'H6 Mobile', 'TEXT');
            $H4Mobile = self::get_node($Header,'H6 Mobile', 'TEXT');
            $H5Mobile = self::get_node($Header,'H6 Mobile', 'TEXT');
            $H6Mobile = self::get_node($Header,'H6 Mobile', 'TEXT');

            $BaseTypography->setMobileStyle('H1', (Array) $H1Mobile['style']);
            $BaseTypography->setMobileStyle('H2', (Array) $H2Mobile['style']);
            $BaseTypography->setMobileStyle('H3', (Array) $H3Mobile['style']);
            $BaseTypography->setMobileStyle('H4', (Array) $H4Mobile['style']);
            $BaseTypography->setMobileStyle('H5', (Array) $H5Mobile['style']);
            $BaseTypography->setMobileStyle('H6', (Array) $H6Mobile['style']);

            $BodyGroup = self::get_node($TypographyGroup, 'Body', 'GROUP');
            #Desktop Body & Mobile Body
            $Body = self::get_node($BodyGroup, 'Body Desktop', 'TEXT');
            $MobileBody = self::get_node($BodyGroup, 'Body Mobile', 'TEXT');
            $BaseTypography->setStyle('body', (Array) $Body['style']);
            $BaseTypography->setMobileStyle('body', (Array) $MobileBody['style']);
            $BaseTypography->printToGlobalCSS();
            #this kicks Ass
            return true;
        }
        #Else no Typography
        echo json_encode(array('status'=>404, 'message'=>'Could not find Typography in Figma File'));
        die();
    }
    private static function get_color_palette( $PageNode ){

        #$PageNode = self::getPageNode();
        $Colors = $PageNode ? self::get_node($PageNode, 'Colors', 'FRAME') : false;
        if($Colors){         
            $Palette = new ColorPalette();
            #Get Primary and Accent Colors
            $primaryNode = self::get_node($Colors, 'primary color', 'ELLIPSE');
            $primaryHex = self::color_rectangle_to_hex( $primaryNode );
            if($primaryHex) {
            
                $Palette->setPrimary($primaryHex);
                if(Config::MODE == "development" && $Palette->warning) error_log($Palette->warning);
            }
            $accentNode = self::get_node($Colors, 'accent color', 'ELLIPSE');
            $accentHex = self::color_rectangle_to_hex( $accentNode );
            if($accentHex) {
                $Palette->setAccent($accentHex);
                if(Config::MODE == "development" && $Palette->warning) error_log($Palette->warning);
            }
            #Set UI Colors
            $UI = self::get_node($Colors, 'User Experience', 'GROUP', );
            $UI_badHex = false;
            $UI_goodHex = false;
            $UI_warning = false;
            $UI_badNode = $UI ? self::get_node($UI, 'bad', 'ELLIPSE') : false;
            $UI_goodNode = $UI ? self::get_node($UI, 'good', 'ELLIPSE') : false;
            $UI_warningNode = $UI ? self::get_node($UI, 'warning', 'ELLIPSE') : false;
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
            $Light = self::get_node($Colors, 'Light', 'GROUP');
            $LightColor = false;
            $LightHalf= false;
            $LightNeutral = false;
            $LightColorNode = $Light ? self::get_node($Light, 'color', 'RECTANGLE') : false;
            $LightHalfNode = $Light ? self::get_node($Light, 'half', 'RECTANGLE') : false;
            $LightNeutralNode = $Light ? self::get_node($Light, 'neutral', 'RECTANGLE') : false;
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
            $Dark = self::get_node($Colors, 'Dark', 'GROUP');
            $DarkColor = false;
            $DarkHalf= false;
            $DarkNeutral = false;
            $DarkColorNode = $Dark ? self::get_node($Dark, 'color', 'RECTANGLE') : false;
            $DarkHalfNode = $Dark ? self::get_node($Dark, 'half', 'RECTANGLE') : false;
            $DarkNeutralNode = $Dark ? self::get_node($Dark, 'neutral', 'RECTANGLE') : false;
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
            $Palette->printToGlobalCSS();
            return true;
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
            case("Typography") : 
                self::get_typography();
                break;
            case("Logo") : 
                self::get_logo();
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
                $PageNode = self::get_node($document, 'Page 1', 'CANVAS');

                $Colors = self::get_node($PageNode, 'Colors', 'FRAME');
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



    public static function run_setup(){

        if( ! self::gatekeep_post() ) self::return_false('Missing or Invalid Nonce');

        $document = new FigmaRequest( 'get_document' );
        if($document->err){
            self::return_false($document->err);
        }
        if(!$document->response){
            self::return_false('No Server Response');
        }

        #Get Document to Parse in associative array, if return node is specified set Document to return node
        $parse_document = json_decode($document->response, true );
        if($document->return_node && isset($document->return_node) && isset($parse_document[$document->return_node]) ) $parse_document = $parse_document[$document->return_node];
        
        #Get Page
        $PageNode = self::get_node($parse_document, 'Page 1', 'CANVAS');
        if(!$PageNode){ self::return_false('Could Not Parse Figma Page'); }

        #From PageNode we can do everything we need;
        #Logo
        $added_theme_logo = self::setup_logo( $document );
        
        #Typography


        
    }

    #High Level Function Rips Logo from Figma file containing FRAME node named Logo and sets it as the Theme Logo
    private static function setup_logo( $document ){

        #Get Document to Parse in associative array, if return node is specified set Document to return node
        $parse_document = json_decode($document->response, true );
        if($document->return_node && isset($document->return_node) && isset($parse_document[$document->return_node]) ) $parse_document = $parse_document[$document->return_node];

        $PageNode = self::get_node($parse_document, 'Page 1', 'CANVAS');
        
        if(!$PageNode) return false;

        #We will add or overwrite theme-logo.svg under theme/assets.
        $logo_node_id = false;

        #Now find our target nodes
        $LogoNode = self::get_node($PageNode, 'Logo', 'FRAME');
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
            $media_image = new MediaImage( $logo_url );
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
    private static function get_node($root, $name, $type ){

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
                    $check = self::get_node($child, $name, $type);
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
    /* Were recursive function returns ALL matches on args in the structure of returnfields */
    private static function get_nodes($root, $args = null, $returnfields = null ){
        if(!$args) return false;

        $return_array = array();

        $this_node = self::check_node($root, $args);
        if($this_node){
            $built_array = array();
            foreach($returnfields as $field){
                if(isset($this_node[$field])) $built_array[$field] = $this_node[$field];
            }
            $return_array[] = $built_array;
        }
        if(isset($root['children'])){
            foreach($root['children'] as $idx => $child ){
                $check_child = self::get_nodes($child, $args, $returnfields);
                if($check_child) $return_array = array_merge($return_array, $check_child);
            }
        }
        return count($return_array) ? $return_array : false;

    }

    private static function check_node( $node, $args = null ){
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
            // error_log(print_r($this, true));
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