<?php get_header(); ?>
<?php
    $heroBG = get_option('pixiehuge-header-background');

    $topLine = get_option('pixiehuge-header-top-line');
    $middleLine = get_option('pixiehuge-header-middle-line');
    $bottomLine = get_option('pixiehuge-header-bottom-line');
    $ctaLink = [
        'text'  => get_option('pixiehuge-header-cta-red-text'),
        'link'  => get_option('pixiehuge-header-cta-red-link'),
    ];
?>
<?php if(!empty($topLine) || !empty($middleLine) || !empty($bottomLine) || !empty($ctaLink['text'])): ?>
<section id="hero" style="background-image: url('<?php echo (!empty($heroBG)) ? $heroBG : get_stylesheet_directory_uri() . '/images/hero-bg.jpg' ?>')">

    <div class="container">

        <article class="content">

            <?php if(!empty($topLine)): // If top text exists ?>
                <h4><?php echo esc_attr($topLine) ?></h4>
            <?php endif; ?>

            <?php if(!empty($middleLine)): // If middle text exists ?>
                <h3><?php echo esc_attr($middleLine) ?></h3>
            <?php endif; ?>

            <?php if(!empty($bottomLine)): // If bottom text exists ?>
                <h5><?php echo esc_attr($bottomLine) ?></h5>
            <?php endif; ?>

            <?php if(!empty($ctaLink['link'])): // If link exists ?>
                <a href="<?php echo !empty($ctaLink['link']) ? esc_url($ctaLink['link']) : '#' ?>" class="btn btn-blue"><?php echo esc_attr($ctaLink['text']) ?></a>
            <?php endif; ?>

        </article>

    </div>
</section>
<!-- /HERO -->
<?php endif; ?>

<?php
    $sponsors = pixiehuge_sponsors();
    $sponsorEnabled = get_option('pixiehuge-sponsor-home-enable');
?>
<?php if($sponsorEnabled && !empty($sponsors)): ?>
<section id="sponsors">

    <div class="container">
        <span class="leftArrow">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8px" height="12px">
            <path fill-rule="evenodd"  opacity="0.2" fill="rgb(256, 256, 256)" d="M0.006,5.995 C0.006,6.252 0.103,6.508 0.299,6.704 L5.313,11.713 C5.704,12.104 6.339,12.104 6.731,11.713 C7.122,11.322 7.122,10.687 6.731,10.296 L2.426,5.995 L6.731,1.694 C7.122,1.303 7.122,0.669 6.731,0.277 C6.339,-0.114 5.704,-0.114 5.313,0.277 L0.299,5.287 C0.103,5.483 0.006,5.739 0.006,5.995 Z"/>
            </svg>
        </span>
        <div class="owl-carousel">
            <?php foreach($sponsors as $sponsor): ?>
            <a href="<?php echo ($sponsor['url'] != 'no') ? esc_url($sponsor['url']) : '#' ?>" target="_blank">
                <img src="<?php echo esc_url($sponsor['logo']) ?>" alt="Image">
            </a>
            <?php endforeach; ?>
        </div>
        <span class="rightArrow">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="8px" height="12px">
            <path fill-rule="evenodd"  opacity="0.2" fill="rgb(256, 256, 256)" d="M0.006,5.995 C0.006,6.252 0.103,6.508 0.299,6.704 L5.313,11.713 C5.704,12.104 6.339,12.104 6.731,11.713 C7.122,11.322 7.122,10.687 6.731,10.296 L2.426,5.995 L6.731,1.694 C7.122,1.303 7.122,0.669 6.731,0.277 C6.339,-0.114 5.704,-0.114 5.313,0.277 L0.299,5.287 C0.103,5.483 0.006,5.739 0.006,5.995 Z"/>
            </svg>
        </span>
    </div>

</section>
<!-- /SPONSORS -->
<?php endif; ?>

<?php

$sections = pixiehuge_sections();

if(!empty($sections)) {
	$sectionNum = 0;
    foreach($sections as $section) {
	    $sectionNum ++;
	    get_template_part('inc/' . strtolower($section['name']) . '-section');
    }
}

?>



<?php get_footer(); ?>
