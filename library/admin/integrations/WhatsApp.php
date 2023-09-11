<?php

namespace rbtddb\admin;
use \rbtddb\Config as Config;

#\add_action( 'wp_enqueue_scripts', array( '\rbtddb\admin\WhatsAppIntegration', 'whatsapp_theme_enqueue'));

Class WhatsAppIntegration {

	public $err = false;

	public function __construct( ){
        $this->name = $this->getOption('name');
		$this->logo = $this->getOption('logo');
        $this->color = $this->getOption('color');
        $this->phone = $this->getOption('phone');
	}
    private function getOption( $option_name ) {
        $option = \carbon_get_theme_option( 'whatsapp_' . $option_name );
        return $option;
    }
	private function createProp($prop, $value){
        $this->{$prop} = $value;
    }

    public static function whatsapp_theme_enqueue(){
        $v =Config::MODE == "development" ? (string) bin2hex(random_bytes(2)) : Config::VERSION;
        \wp_enqueue_script ( 'whatsapp', \get_template_directory_uri() . '/vendor/whatsapp/dist/js/whatsapp-widget.min.js', array(), $v, false );
        \wp_enqueue_style ( 'whatsapp', \get_template_directory_uri() . '/vendor/whatsapp/dist/css/whatsapp-widget.min.css', array(), $v, 'all' );
    }

	public function embedCode( $message = null ){
        ?>
       <script>
        (function (w, d, s, u) {
        w.gbwawc = {
        url: u,
        options: {
                waId: "<?php echo $this->phone ?>",
                siteName: "<?php echo $this->name ?>",
                siteTag: "Within 5 minutes",
                siteLogo: "<?php echo $this->logo ?>",
                widgetPosition: "RIGHT",
                triggerMessage: "",
                welcomeMessage: "Hi! ",
                brandColor: "<?php echo $this->color?>",
                messageText: "How can we help you?",
                replyOptions: [''],
            },
        };
        var h = d.getElementsByTagName(s)[0],
        j = d.createElement(s);
        j.async = true;
        j.src = u + "/whatsapp-widget.min.js?_=" + Math.random();
        h.parentNode.insertBefore(j, h);
        })(window, document, "script", "https://waw.gallabox.com");
        </script> 
        <!-- <form id="whatsapp" class="wa-widget" action="<?php #echo $this->phone ?>" data-chat="general-support"></form>
        <script>
            // WhatsAppWidget(element, { configs }, [ inputs ])

            var chat = new WhatsAppWidget(document.getElementById('whatsapp'), {
                name: "<?php echo $this->name ?>",
                photo: "<?php echo $this->logo ?>",
                introduction: "How can we help you?"
            }, [
                // array of input object
            ]);
        </script> -->

        <?php
        
	}

	private function getLogo(){
		$logo = \carbon_get_theme_option( 'whatsapp_logo' );
        return true;
    }
}