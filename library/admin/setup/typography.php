<?php 
namespace rbtddb\setup;
use \rbtddb\Config as Config;
use \rbtddb\setup\ColorPalette as ColorPalette;

class FigmaTypography {
    #structureless object to build your default css for typography purposes. It could be used to build any CSS I suppose.
    #Class functions accept Figma text node properties, typically the ['style'] property from a Text Node object.
    #Prints to the global variables file and the base _typography.scss file
    public $err = false;
    public $warning = '';
    public $styles = array();
    public $mobilestyles = array();
    public static $styleTranslationTable = array(
        'fontFamily' => 'font-family',
        'fontWeight' => 'font-weight',
        'textCase' => 'text-transform',
        'fontSize' => 'font-size',
        'letterSpacing' => 'letter-spacing',
        'lineHeightPx'  => 'line-height'
    );
    public static $settable = array(
        "a",
        "big",
        "blockquote",
        "body",
        "button",
        "canvas",
        "caption",
        "col",
        "colgroup",
        "content",
        "data",
        "figcaption",
        "figure",
        "footer",
        "form",
        "frame",
        "frameset",
        "h1",
        "h2",
        "h3",
        "h4",
        "h5",
        "h6",
        "header",
        "hgroup",
        "hr",
        "img",
        "input",
        "label",
        "legend",
        "li",
        "link",
        "main",
        "map",
        "menu",
        "menuitem",
        "nav",
        "ol",
        "optgroup",
        "option",
        "p",
        "pre",
        "section",
        "select",
        "small",
        "spacer",
        "span",
        "strong",
        "sub",
        "sup",
        "table",
        "tbody",
        "td",
        "textarea",
        "tfoot",
        "th",
        "thead",
        "tr",
        "track",
        "ul",
        "video"
    );

    private static $defaults = array(
        'H1' => array( 'Desktop' => 36, 'Mobile' => 24),
        'H6' => array( 'Desktop' => 18, 'Mobile' => 16),
    );

    public function __construct( $FigmaRoot = array() ){
        $this->grid = (defined('\rbtddb\Config::GRID') && Config::GRID > 0) ? Config::GRID : 1440;
    }
    public function setMobileStyle( String $tag, Array $style){
        if(!in_array( strtolower( $tag ), self::$settable )) return false;
        $css_style = self::translateFigmaStyle($style);
        if(!$css_style ) return false;

        $this->mobilestyles[$tag] = $css_style;
        return true;
    }
    public function setStyle( String $tag, Array $style ){
        if(!in_array( strtolower( $tag ), self::$settable )) return false;
        $css_style = self::translateFigmaStyle($style);
        if(!$css_style ) return false;

        $this->styles[$tag] = $css_style;
        return true;
    }
    public static function translateFigmaStyle( Array $style ) {
       
        $return_array = array();

        foreach($style as $key => $value){
            #first manipulate the values
            switch($key){
                case 'textCase' : 
                    if( $value == 'UPPER') $value = 'uppercase';
                    if( $value == 'LOWER') $value = 'lowercase';
                break;
                case 'lineHeightPx' :
                    $value = $value . 'px';
                break;
                case 'fontSize' :
                    $value = $value. 'px';
                break;
                
                default : 
                break;
            }
            $stylekey = ( array_key_exists($key, self::$styleTranslationTable) ) ? self::$styleTranslationTable[$key] : false;
            if($stylekey) $return_array[$stylekey] = $value;
        }
        return !empty($return_array) ? $return_array : false;

    }
    public function upClamp( $num, Float $percent = 1.5 ){
        $returnString = 'clamp(';
        if(strpos($num, 'px')) $num = str_replace( 'px', '', $num );
        if(strpos($num, ';')) $num = str_replace( ';', '', $num );
        $returnString.= $num . 'px, ' . round(($num / (integer) $this->grid) * 100, 2) . 'vw, ' . round(($num * $percent),2) . 'px)';
        return $returnString;
    }
    public function standardClamp( $num, Float $percent = .75 ){
        $returnString = 'clamp(';
        if(strpos($num, 'px')) $num = str_replace( 'px', '', $num );
        if(strpos($num, ';')) $num = str_replace( ';', '', $num );
        $returnString.= round($num * $percent) . 'px, ' . round(($num / (integer) $this->grid) * 100, 2) . 'vw, ' . $num . 'px)';
        return $returnString;
    }
    // public static function ColorPalette::rgbArrayToHex( $rgbArray = array() );
    private function getFontFamilyArray(){
        $returnArray = array();
        foreach($this->styles as $key => $value){
            if(isset($value['font-family'])) {
                if(!in_array($value['font-family'], $returnArray)) array_push($returnArray, $value['font-family']);
            }
        }
        return (Count($returnArray)) ? $returnArray : false;
    }
    private function returnImportStatements( Array $FontFamilyArray ){
        $returnString = '';
        foreach($FontFamilyArray as $FontFamily){
            $FontFamily = str_replace(' ', '+', $FontFamily);
            $returnString.= '@import url("https://fonts.googleapis.com/css2?family='. $FontFamily. '&display=swap");'. PHP_EOL;
        }
        return $returnString;
    }
    public function printToGlobalCSS(){
        $css_variables = file_get_contents( \get_template_directory() . '/theme/src/css/global/_variables.scss' );
        $split = explode("/*<! END TYPOGRAPHY !>*/", $css_variables);
        $typography = ( isset($split[0]) && isset($split[1]) )  ? $split[0] : false;
        $after = $typography ? $split[1] : false;
        $split = explode("/*<! START TYPOGRAPHY !>*/", $typography);
        $typography =  (isset($split[0]) && isset($split[1]) ) ? $split[1] : false;
        $before = $split[0];
        if($typography && $before && $after) {
            $new_filestring = '';
            $fonts = $this->getFontFamilyArray();
            $imports = $fonts ? $this->returnImportStatements( $fonts ) : '';
            $new_filestring.= $imports;
            foreach($this->styles as $key => $stylearray){
                $new_filestring.= $key . ' {' . PHP_EOL;
                foreach($stylearray as $stylekey => $style){
                    switch(strtolower($stylekey)) {
                        case 'font-size' : 
                            if(strtolower($key) === 'body'){
                                $style = $this->upClamp($style);
                            } else {
                                $style = $this->standardClamp($style);
                            }
                            
                            break;
                        case 'line-height' : 
                            if(strtolower($key) === 'body'){
                                $style = $this->upClamp($style);
                            } else {
                                $style = $this->standardClamp($style);
                            }
                            break;
                        case 'line-height' : 
                            $style = $this->standardClamp($style);
                            break;
                        case 'letter-spacing' : 
                            $style = round($style / 10, 2) . 'rem';
                    }
                    $new_filestring.= $stylekey . ':' . $style . ';'. PHP_EOL;
                }
                $new_filestring.= '}' . PHP_EOL;    
            }
            if(!empty($this->mobilestyles)) $new_filestring.= '@media screen and (max-width:991px) {'. PHP_EOL;
            foreach($this->mobilestyles as $key => $stylearray){
                $new_filestring.= $key . ' {' . PHP_EOL;
                foreach($stylearray as $stylekey => $style){
                    switch(strtolower($stylekey)) {
                        case 'letter-spacing' : 
                           // $style = round($style, 2) . 'rem';
                           $style = round($style / 10, 2) . 'rem';
                    }
                    $new_filestring.= $stylekey . ':' . $style . ';'. PHP_EOL;
                }
                $new_filestring.= '}' . PHP_EOL;  
            }
            if(!empty($this->mobilestyles)) $new_filestring.= '}' . PHP_EOL;    

            $new_file = $before . PHP_EOL . "/*<! START TYPOGRAPHY !>*/" . PHP_EOL . $new_filestring . PHP_EOL . "/*<! END TYPOGRAPHY !>*/" . PHP_EOL . $after;

            $new_variables = file_put_contents( \get_template_directory() . '/theme/src/css/global/_variables.scss', $new_file);
        }
    }
    public function printToThemeJSON(){
        $json = file_get_contents( \get_template_directory() . '/theme.json' );
        $themejson = json_decode($json, true);
        $colors = isset($themejson['settings']['color']['palette']) ? $themejson['settings']['color']['palette'] : false;
        $Primary = false;
        $UI = array(false, false, false);
        foreach($colors as $idx => $color){
            if( strtolower($color['name']) === 'primary' ){
                $colors[$idx]['color'] = $this->Primary;
                $Primary = true;
            }
        }
        if(!$UI[2]){
            array_unshift($colors, array('name'=>'Warning', 'slug'=>'warning', 'color'=>$this->UI['warning']));
        }


        #Now that we've mutated the array
        $themejson['settings']['color']['palette'] = $colors;
        $filestring = json_encode($themejson);
        file_put_contents( \get_template_directory() . '/theme.json', $filestring);

    }

}