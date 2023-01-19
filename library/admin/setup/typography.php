<?php 
namespace rbt\setup;
use \rbt\Config as Config;

class ColorPalette {
    #this is the structure for our default color palette
    public $err = false;
    public $warning = '';

    private static $defaults = array(
        'UI' => array('good'=>'#5B8C5A', 'bad'=>'#E3655B', 'warning'=>'#F2ED6F'),
        'Primary' => '#7D8CC4',
        'Accent' => '#A0D2DB',
        'Dark' => array('color'=>'#2B363B', 'neutral'=>'#718C98', 'half'=>'#9CAFB7'),
        'Light' => array('color'=>'#FFFFFF', 'neutral'=>'#CCCCCC', 'half'=>'#D1D1D1'),
    );

    public function __construct( $input = array() ){
        $this->input = (!empty($input)) ? array_change_key_case($input, CASE_LOWER) : array();
        $this->UI = $this->getUIColors( $this->input );
        $this->Primary = $this->getPrimaryColor( $this->input );
        $this->Accent = $this->getAccentColor( $this->input );
        $this->Dark = $this->getDarkColors( $this->input );
        $this->Light = $this->getLightColors( $this->input );
        $this->Extra = $this->getExtraColors( $this->input );
    }
    public static function adjustBrightness($hex, $steps) {
        // Steps should be between -255 and 255. Negative = darker, positive = lighter
        $steps = max(-255, min(255, $steps));
    
        // Normalize into a six character long hex string
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
        }
    
        // Split into three parts: R, G and B
        $color_parts = str_split($hex, 2);
        $return = '#';
    
        foreach ($color_parts as $color) {
            $color   = hexdec($color); // Convert to decimal
            $color   = max(0,min(255,$color + $steps)); // Adjust color
            $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
        }
    
        return $return;
    }
    public static function FigmaRGBArrayToHex( $rgbArray = array() ){
        #Use this function to convert Figma fills to hex 
        $rgbArray = array_change_key_case($rgbArray, CASE_LOWER);
        $returnString = false;
        if(empty($rgbArray)) return false;
        if( isset($rgbArray['r']) && 
            isset($rgbArray['g']) && 
            isset($rgbArray['b'] )){
            error_log("found Figma Fill Array");
            
            $returnString = sprintf("#%02x%02x%02x", round($rgbArray['r'] * 255),round($rgbArray['g'] * 255),round($rgbArray['b'] * 255) );

        }
        return $returnString;
    }
    public static function rgbArrayToHex( $rgbArray = array() ){
        #Use this function for converting RBG arrays in 0-255 range to Hex
        $rgbArray = array_change_key_case($rgbArray, CASE_LOWER);
        $returnString = false;
        if(empty($rgbArray)) return false;
        if( isset($rgbArray['r']) && 
            isset($rgbArray['g']) && 
            isset($rgbArray['b'] )){
            error_log("found valid associative rgb array");
            
            $returnString = sprintf("#%02x%02x%02x", $rgbArray['r'],$rgbArray['g'],$rgbArray['b']);

        } else if(isset($rgbArray[0]) && isset($rgbArray[1]) && isset($rgbArray[2]) ){

            $testString = sprintf("#%02x%02x%02x", $rgbArray[0], $rgbArray[1], $rgbArray[2]);
            if(self::isValidHex($testString)) $returnString = $testString;

        }
        return $returnString;
    }
    public function printToGlobalCSS(){
        $css_variables = file_get_contents( \get_template_directory() . '/theme/src/css/global/_variables.scss' );
        $split = explode("/*<! END COLORS !>*/", $css_variables);
        $colors = ( isset($split[0]) && isset($split[1]) )  ? $split[0] : false;
        $after = $colors ? $split[1] : false;
        if($colors && $after) {
            $split = explode("/*<! START COLORS !>*/", $css_variables);
            $header = (isset($split[0]) && isset($split[1]))? $split[0] : '';
            $colors_isolated = $header ? $split[1] : false;
            $new_colors = PHP_EOL . '$primary:' . $this->Primary .';'. PHP_EOL;
            $new_colors.= '$accent:' . $this->Accent .';'. PHP_EOL;
            $new_colors.= '$light:' . $this->Light['color'] .';'. PHP_EOL;
            $new_colors.= '$light-neutral:' . $this->Light['neutral'] .';'. PHP_EOL;
            $new_colors.= '$light-half:' . $this->Light['half'] .';'. PHP_EOL;
            $new_colors.= '$dark:' . $this->Dark['color'] .';'. PHP_EOL;
            $new_colors.= '$dark-neutral:' . $this->Dark['neutral'] .';'. PHP_EOL;
            $new_colors.= '$dark-half:' . $this->Dark['half'] .';'. PHP_EOL;
            $new_colors.= '$good:' . $this->UI['good'] .';'. PHP_EOL;
            $new_colors.= '$bad:' . $this->UI['bad'] .';'. PHP_EOL;
            $new_colors.= '$warning:' . $this->UI['warning'] .';'. PHP_EOL;

            $new_color_string = $header . PHP_EOL . "/*<! START COLORS !>*/" . PHP_EOL . $new_colors . PHP_EOL . "/*<! END COLORS !>*/" . PHP_EOL;

            $new_variables = file_put_contents( \get_template_directory() . '/theme/src/css/global/_variables.scss', $new_color_string . $after  );
        }
    }
    public function printToThemeJSON(){
        $json = file_get_contents( \get_template_directory() . '/theme.json' );
        $themejson = json_decode($json, true);
        $colors = isset($themejson['settings']['color']['palette']) ? $themejson['settings']['color']['palette'] : false;
        $Primary = false;
        $Accent = false;
        $Dark = array(false, false, false);
        $Light = array(false, false, false);
        $UI = array(false, false, false);
        foreach($colors as $idx => $color){
            if( strtolower($color['name']) === 'primary' ){
                $colors[$idx]['color'] = $this->Primary;
                $Primary = true;
            }
            if( strtolower($color['name']) === 'accent' ){
                $colors[$idx]['color'] = $this->Accent;
                $Accent = true;
            }
            if( strtolower($color['name']) === 'dark' ){
                $colors[$idx]['color'] = $this->Dark['color'];
                $Dark[0] = true;
            }
            if( strtolower($color['slug']) === 'dark-neutral' ){
                $colors[$idx]['color'] = $this->Dark['neutral'];
                $Dark[1] = true;
            }
            if( strtolower($color['slug']) === 'dark-half' ){
                $colors[$idx]['color'] = $this->Dark['half'];
                $Dark[2] = true;
            }
            if( strtolower($color['name']) === 'light' ){
                $colors[$idx]['color'] = $this->Light['color'];
                $Light[0] = true;
            }
            if( strtolower($color['slug']) === 'light-neutral' ){
                $colors[$idx]['color'] = $this->Light['neutral'];
                $Light[1] = true;
            }
            if( strtolower($color['slug']) === 'light-half' ){
                $colors[$idx]['color'] = $this->Light['half'];
                $Light[2] = true;
            }
            if( strtolower($color['slug']) === 'good' ){
                $colors[$idx]['color'] = $this->UI['good'];
                $UI[0] = true;
            }
            if( strtolower($color['slug']) === 'bad' ){
                $colors[$idx]['color'] = $this->UI['bad'];
                $UI[1] = true;
            }
            if( strtolower($color['slug']) === 'warning' ){
                $colors[$idx]['color'] = $this->UI['warning'];
                $UI[2] = true;
            }
        }
        if(!$UI[2]){
            array_unshift($colors, array('name'=>'Warning', 'slug'=>'warning', 'color'=>$this->UI['warning']));
        }
        if(!$UI[1]){
            array_unshift($colors, array('name'=>'Bad', 'slug'=>'bad', 'color'=>$this->UI['bad']));
        }
        if(!$UI[0]){
            array_unshift($colors, array('name'=>'Good', 'slug'=>'good', 'color'=>$this->UI['good']));
        }
        if(!$Dark[2]){
            array_unshift($colors, array('name'=>'Dark Half', 'slug'=>'dark-half', 'color'=>$this->Dark['half']));
        }
        if(!$Dark[1]){
            array_unshift($colors, array('name'=>'Dark Neutral', 'slug'=>'dark-neutral', 'color'=>$this->Dark['neutral']));
        }
        if(!$Dark[0]){
            array_unshift($colors, array('name'=>'Dark', 'slug'=>'dark', 'color'=>$this->Dark['color']));
        }
        if(!$Light[2]){
            array_unshift($colors, array('name'=>'Light Half', 'slug'=>'light-half', 'color'=>$this->Light['half']));
        }
        if(!$Light[1]){
            array_unshift($colors, array('name'=>'Light Neutral', 'slug'=>'light-neutral', 'color'=>$this->Light['neutral']));
        }
        if(!$Light[0]){
            array_unshift($colors, array('name'=>'Light', 'slug'=>'light', 'color'=>$this->Light['color']));
        }
        if(!$Primary){
            array_unshift($colors, array('name'=>'Primary','slug'=>'primary', 'color'=>$this->Primary));
        }
        if(!$Accent){
            array_unshift($colors, array('name'=>'Accent','slug'=>'accent', 'color'=>$this->Accent));
        }
        #Now that we've mutated the array
        $themejson['settings']['color']['palette'] = $colors;
        $filestring = json_encode($themejson);
        file_put_contents( \get_template_directory() . '/theme.json', $filestring);

    }
    private static function isValidHex( string $string = '' ){
        error_log("isValidHex called on: " . $string);
        if(!strlen($string)) return false;
        if(substr($string, 0, 1) !== '#') $string = '#' . $string;
        return preg_match('/^#([0-9A-F]{3}){1,2}$/i', $string);
    }
    private function getExtraColors( $input){
        $StandardKeys = array('primary', 'accent', 'ui', 'dark', 'light', 'good', 'bad', 'warning', 'dark-neutral', 'light-neutral', 'dark-half', 'light-half');
        $extraColors = array();
        foreach($input as $key => $value){
            if(!in_array($key, $StandardKeys)){
                $extraColors[$key] = $value;
            }
        }
        return  $extraColors;
    }
    private function getPrimaryColor( $input ){
        $override = false;
        if(!empty($input)){
            if(isset($input['primary'])) {
                if(self::isValidHex( $input['primary'] )){
                    $override = $input['primary'];
                    if(substr($override, 0, 1) !== '#') $override = '#' . $override;
                }
            }
        }
        if($override){
            return $override;
        } else {
            return $this::$defaults['Primary'];
        }
    }  
    private function getAccentColor( $input ){
        $override = false;
        if(!empty($input)){
            if(isset($input['accent'])) {
                if(self::isValidHex( $input['accent'] )){
                    $override = $input['accent'];
                    if(substr($override, 0, 1) !== '#') $override = '#' . $override;
                }
            }
        }
        if($override){
            return $override;
        } else {
            return $this::$defaults['Accent'];
        }
    }      
    private function getUIColors( $input ){
        $returnArray = array();
        if(!empty($input)){
            if(isset($input['UI']['good'])){
                if(self::isValidHex( $input['UI']['good'] )){
                    $returnArray['good'] = $input['UI']['good'];
                } else {
                    $returnArray['good'] = $this::$defaults['UI']['good'];
                }   
            } else {
                $returnArray['good'] = $this::$defaults['UI']['good'];
            }
            if(isset($input['UI']['bad'])) {
                if(self::isValidHex($input['UI']['bad'])){
                    $returnArray['bad'] = $input['UI']['bad'];
                } else {
                    $returnArray['bad'] = $this::$defaults['UI']['bad'];
                }
            } else {
                $returnArray['bad'] = $this::$defaults['UI']['bad'];
            }
            if(isset($input['UI']['warning'])) {
               if(self::isValidHex($input['UI']['warning'])){
                $returnArray['warning'] = $input['UI']['warning'];
               } else {
                $returnArray['warning'] = $this::$defaults['UI']['warning'];
               }
            } else {
                $returnArray['warning'] = $this::$defaults['UI']['warning'];
            }
            return $returnArray;

        }
        
        $returnArray['good'] = $this::$defaults['UI']['good'];
        $returnArray['bad'] = $this::$defaults['UI']['bad'];
        $returnArray['warning'] = $this::$defaults['UI']['warning'];
        return $returnArray;
    }
    private function getDarkColors( $input ){
        if(!empty($input)){
            if(isset($input['dark'])){
                if(is_array($input['dark'])){
                    if(isset($input['dark']['color']) &&
                        isset($input['dark']['neutral']) &&
                        isset($input['dark']['half'])){

                        if(self::isValidHex($input['dark']['color']) &&
                            self::isValidHex($input['dark']['neutral']) &&
                            self::isValidHex($input['dark']['half'])){

                            $returnArray = array();
                            $returnArray['color'] = $input['dark']['color'];
                            $returnArray['neutral'] = $input['dark']['neutral'];
                            $returnArray['half'] = $input['dark']['half'];
                            return $returnArray;
                        }
                    }
                } else if(self::isValidHex( $input['dark'] )){
                            $override = $input['dark'];
                            if(substr($override, 0, 1)!== '#') $override = '#'. $override;
                            $returnArray = array();
                            $returnArray['color'] = $override;
                            $returnArray['neutral'] = self::adjustBrightness($override, 62);
                            $returnArray['half'] = self::adjustBrightness($override, 125);
                            return $returnArray;
                } 
            }
        }
        $returnArray = array();
        $returnArray['color'] = $this::$defaults['Dark']['color'];
        $returnArray['neutral'] = $this::$defaults['Dark']['neutral'];
        $returnArray['half'] = $this::$defaults['Dark']['half'];
        return $returnArray;
    }
    private function getLightColors( $input ){
        if(!empty($input)){
            if(isset($input['light'])){
                if(is_array($input['light'])){
                    if(isset($input['light']['color']) &&
                        isset($input['light']['neutral']) &&
                        isset($input['light']['half'])){

                        if(self::isValidHex($input['light']['color']) &&
                            self::isValidHex($input['light']['neutral']) &&
                            self::isValidHex($input['light']['half'])){
                            
                            $returnArray = array();
                            $returnArray['color'] = $input['light']['color'];
                            $returnArray['neutral'] = $input['light']['neutral'];
                            $returnArray['half'] = $input['light']['half'];
                            return $returnArray;
                        }
                    }
                } else if(self::isValidHex( $input['light'] )){
                            $override = $input['light'];
                            if(substr($override, 0, 1)!== '#') $override = '#'. $override;
                            $returnArray = array();
                            $returnArray['color'] = $override;
                            $returnArray['neutral'] = self::adjustBrightness($override, 62);
                            $returnArray['half'] = self::adjustBrightness($override, 125);
                            return $returnArray;
                } 
            }
        }
        $returnArray = array();
        $returnArray['color'] = $this::$defaults['Light']['color'];
        $returnArray['neutral'] = $this::$defaults['Light']['neutral'];
        $returnArray['half'] = $this::$defaults['Light']['half'];
        return $returnArray;
    }
    public function setPrimary( $color ){
        $this->warning = '';
        if(substr($color, 0, 1) !== '#') $color = '#' . $color;
        if(self::isValidHex( $color )){
            $this->Primary = $color;
            return true;
        } else {
            $this->warning = 'Could not set primary color. Invalid color provided.';
            return false;
        }
    }
    public function setAccent( $color ){
        $this->warning = '';
        if(substr($color, 0, 1) !== '#') $color = '#' . $color;
        if(self::isValidHex( $color )){
            $this->Accent = $color;
            return true;
        } else {
            $this->warning = 'Could not set accent color. Invalid color provided.';
            return false;
        }
    }
    public function setDark( $color_or_array ){
        $this->warning = '';
        if(is_array($color_or_array)){
            if(isset($color_or_array['color']) && isset($color_or_array['neutral']) && isset($color_or_array['half']) ){
                $valid = false;
                if( self::isValidHex( $color_or_array['color']) &&
                    self::isValidHex( $color_or_array['neutral']) &&
                    self::isValidHex( $color_or_array['half'] ) ){
                        $this->Dark['color'] = $color_or_array['color'];
                        $this->Dark['neutral'] = $color_or_array['neutral'];
                        $this->Dark['half'] = $color_or_array['half'];
                        return true;
                    } else {
                        $this->warning = 'Could not set dark colors. One or more colors in the array was invalid.';
                        return false;
                    }  
            } else {
                $this->warning = 'Could not set dark colors. Invalid array provided.';
                return false;
            }

        } else {
            if(substr($color_or_array, 0, 1) !== '#') $color_or_array = '#' . $color_or_array;
            if(self::isValidHex( $color_or_array)){
                $this->Dark['color'] = $color_or_array;
                $this->Dark['neutral'] = self::adjustBrightness($color_or_array, 62);
                $this->Dark['half'] = self::adjustBrightness($color_or_array, 125);
                return true;
            } else {
                $this->warning = 'Could not set dark colors. Invalid color provided.';
                return false;
            }
        }
    }
    public function setLight( $color_or_array ){
        $this->warning = '';
        if(is_array($color_or_array)){
            if(isset($color_or_array['color']) && isset($color_or_array['neutral']) && isset($color_or_array['half']) ){
                $valid = false;
                if( self::isValidHex( $color_or_array['color']) &&
                    self::isValidHex( $color_or_array['neutral']) &&
                    self::isValidHex( $color_or_array['half'] ) ){
                        $this->Light['color'] = $color_or_array['color'];
                        $this->Light['neutral'] = $color_or_array['neutral'];
                        $this->Light['half'] = $color_or_array['half'];
                        return true;
                    } else {
                        $this->warning = 'Could not set light colors. One or more colors in the array was invalid.';
                        return false;
                    }  
            } else {
                $this->warning = 'Could not set light colors. Invalid array provided.';
                return false;
            }

        } else {
            if(substr($color_or_array, 0, 1) !== '#') $color_or_array = '#' . $color_or_array;
            if(self::isValidHex( $color_or_array)){
                $this->Light['color'] = $color_or_array;
                $this->Light['neutral'] = self::adjustBrightness($color_or_array, 62);
                $this->Light['half'] = self::adjustBrightness($color_or_array, 125);
                return true;
            } else {
                $this->warning = 'Could not set light colors. Invalid color provided.';
                return false;
            }
        }
    }
    public function setUI( $array = array() ){
        $this->warning = '';
        if(isset($array['good']) && isset($array['bad']) && isset($array['warning']) ){
            $valid = false;
            if( self::isValidHex( $array['good']) &&
                self::isValidHex( $array['bad']) &&
                self::isValidHex( $array['warning'] ) ){
                    $this->UI['good'] = $array['good'];
                    $this->UI['bad'] = $array['bad'];
                    $this->UI['warning'] = $array['warning'];
                    return true;
                } else {
                    $this->warning = 'Could not set UI colors. One or more colors in the array was invalid.';
                    return false;
                }  
        } else {
            $this->warning = 'Could not set UI colors. Invalid array provided.';
            return false;
        }
    }
}