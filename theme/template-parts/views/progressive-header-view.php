<div class="aspectRatioPlaceholder <?php echo \is_front_page($this->post->ID) ? 'home' : $this->post->post_type; ?> is-locked hero-holder texture" alt="<?php the_title() ?> banner" data-process="doProgressiveHeader">
    <?php $filtertext = '';
    if(is_array($this->filters)) {foreach($this->filters as $f) $filtertext.= $f;} else {$filtertext.= $this->filters;} ?>
    <span class="filters <?php echo $filtertext ?>"></span>
        <canvas id="placeholder-<?php echo $this->featured_img_id ?>"  
            data-img-sm-mobile="<?php echo $this->sm_mobile ?>" 
            data-img-lg-mobile="<?php echo $this->lg_mobile ?>" 
            data-img-sm-desktop="<?php echo $this->sm_landscape ?>"
            data-img-md-desktop="<?php echo $this->md_landscape ?>"
            data-img-lg-desktop="<?php echo $this->lg_landscape ?>"
            data-img-full="<?php echo $this->full ?>"
            data-aspect-width="<?php echo $this->w ?>" 
            data-aspect-height="<?php echo $this->h ?>"
            data-min-height="<?php echo $this->min_height ?>">
        </canvas> 

    <?php 

        $headertext = \carbon_get_post_meta( $this->post->ID, 'crb_header_text' );
        $video_url = \carbon_get_post_meta( $this->post->ID, 'crb_featured_video' );
        $mobile_video = \carbon_get_post_meta( $this->post->ID, 'crb_mobile_featured_video' );
        $button1_text = \carbon_get_post_meta( $this->post->ID, 'crb_button_text' );
        $button1_url = \carbon_get_post_meta( $this->post->ID, 'crb_button_url' );
        $cta_price = \carbon_get_post_meta( $this->post->ID, 'crb_button_price');

    ?>
    <div class="overlay-text">
    <!-- <h1><?php echo ($this->post->post_type === "page") ? \get_the_title($this->post->ID) : ''; ?></h1> -->
    <h1><?php echo \get_the_title( $post->ID )?></h1>
    <?php 
        if($headertext && $cta_price){ 
            echo '<h5 class="headertext">'. $headertext . '<span class="price idr showprice" data-currency="idr" data-default-price="'.$cta_price .'">'.$cta_price .'</span></h5>';
        } else if($headertext){
            echo '<h5 class="headertext">'. $headertext .'</h5>';
        }
        echo '<div class="buttons">';
        if($button1_text && $button1_url) {
            echo '<a class="wp-block-button__link" href="'.$button1_url.'">'.$button1_text.'</a>';
        }
        if($video_url || $mobile_video) {
            echo '<div class="header-video" data-modal-type="video" data-modal-link="'.$video_url.'">';
            echo '<span class="playvideo"></span>Play Video</div>';
        }
        echo '</div>';
    ?>
    </div>


    <span class="bottom-mask"></span>
    <span class="bottom-gradient"></span>
</div>