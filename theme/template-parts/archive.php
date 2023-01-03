<?php

// Load posts loop.
while ( have_posts() ) {
    the_post();

    ?>
    <article class="postwrap <?php echo get_post_type() ?>">
        <div class="layout">
            <div class="left"> 
                <?php $thumb = get_the_post_thumbnail_url();
                if($thumb) : ?>
                <a href="<?php the_permalink(); ?>" title="image for <?php the_title(); ?>">
                    <img src="<?php echo $thumb ?>" loading="lazy" data-modern-attribute="loading" alt="<?php the_title(); ?>" />
                </a>
                <?php endif; ?>
            </div>
            <div class="right">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><h2><?php the_title(); ?></h2></a>
                <div class="textwrap">
                    <?php the_excerpt(); ?>
                </div>
            </div>
    
    </article>
    <?php
}