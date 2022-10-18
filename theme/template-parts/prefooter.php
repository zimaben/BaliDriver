<?php 
/* Global Prefooter */
/* Get Contact Form */
$prefooter_contactform = \carbon_get_post_meta( \get_the_ID(), 'prefooter_contactform');
/* More Options */
if(!$prefooter_contactform){
    /* sometimes CB fields are not populated at the time of call - try normal post meta */
    \get_post_meta( \get_the_ID(), '_prefooter_contactform', true);
}
if(!$prefooter_contactform){
    /* No contact form for the page, get the global */
    $prefooter_contactform = \get_theme_mod( 'footer_default_contact_shortcode', true);
}
if( $prefooter_contactform ) : 
    $html = \do_shortcode($prefooter_contactform);
    if($html !== $prefooter_contactform){ # if the shortcode produced markup, show it
        ?>
            <div class="prefooter">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col col-12">
                            <?php echo $html ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
endif;