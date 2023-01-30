<?php
namespace rbt;
use \<!PLUGINPATH->\template\View as View;

class ProgressiveHeader {
    public function __construct( $post, $w, $h, int $minHeight){
        $this->post = $post;
        $this->w = $w;
        $this->h = $h;
        $this->min_height = $minHeight;
        $this->featured_img_id = \get_post_thumbnail_id( $post->ID );
        $this->mobile_img_id = \carbon_get_post_meta($post->ID, 'crb_mobile_image');
        $this->full = $this->featured_img_id ? \wp_get_attachment_image_src( $this->featured_img_id, 'full', false )[0] : false;
        $this->sm_mobile = $this->mobile_img_id ? \wp_get_attachment_image_src( $this->mobile_img_id, 'thumbnail', false )[0] : false;
        $this->lg_mobile = $this->mobile_img_id ? \wp_get_attachment_image_src( $this->mobile_img_id, 'half', false )[0] : false;
        $this->sm_landscape = $this->featured_img_id ? \wp_get_attachment_image_src( $this->featured_img_id, 'ph-page-one', false )[0] : false;
        $this->md_landscape = $this->featured_img_id ? \wp_get_attachment_image_src( $this->featured_img_id, 'ph-page-two', false )[0] : false;
        $this->lg_landscape = $this->featured_img_id ? \wp_get_attachment_image_src( $this->featured_img_id, 'ph-page-full', false )[0] : false;
        // $this->desktop_video = \carbon_get_post_meta($post->ID, 'crb_featured_video');
        // $this->mobile_video = \carbon_get_post_meta($post->ID, 'crb_mobile_featured_video');
;
        $this->html = $this->getHTML();
        error_log(print_r($this, true));
    }
    private function getHTML(){
        $view = new View('progressive-header-view.php', $this);
        return $view->render();
    }
    public function render(){
        return $this->html;
    }
    
}