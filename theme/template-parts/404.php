<?php
use ktdamd\DoctorAtMyDoor as Theme;
/*
 *  Template Name: 404
 *  404 Template
 * 
 */ 
?>
<section class="404">
    <header class="404-header">
        <img class="404-graphic" src="<?php Theme::Assets('404-image') ?>" alt="Not Found">
    <h1>Not Found</h1>
    </header>
    <div class="404-content">
        <p>The page you're looking for doesn't exist. Maybe it moved or you made a typo.</p>
        <p><a href="<?php echo home_url(); ?>">Go back to the homepage</a> or click the back button to take a look around.</p>
        <?php if(Theme::TemplatePart('featured-posts.php')) Theme::TemplatePart('featured-posts.php');?>
    </div>
</section>