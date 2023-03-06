<?php

namespace rbtddb\admin;

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

	public function embedCode( $message = null ){
        ?>
        <script>
        (function (w, d, s, u) {
        w.gbwawc = {
        url: u,
        options: {
                waId: "+1 <?php echo $this->phone ?>",
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
        <?php
        
	}

	private function getLogo(){
		$logo = \carbon_get_theme_option( 'whatsapp_logo' );
        return true;
    }
}