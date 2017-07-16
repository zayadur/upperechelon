<?php /* Template Name: Sponsors Page */ ?>

<?php get_header(); ?>

<?php
$coverbg = get_option('pixiehuge-sponsor-cover');
?>
<div class="cover-bg player" style="background-image: url('<?php echo !empty($coverbg) ? esc_url($coverbg) : get_stylesheet_directory_uri() . '/images/sponsor-page-bg.jpg'; ?>');"></div>
<section id="sponsor-page">

    <div class="container">
        <?php

        // Get sponsors
        $sponsors = pixiehuge_sponsors();

        if(!empty($sponsors)):
        ?>
        <ul>
            <?php foreach($sponsors as $sponsor): ?>
            <li>
                <figure>
                    <img src="<?php echo esc_url($sponsor['logo']) ?>" alt="<?php echo esc_attr($sponsor['name']) ?>">
                </figure>

                <div class="content">

                    <div class="head">
                        <?php if(!empty($sponsor['sponsor_category'])): ?>
                        <span class="label <?php echo ($sponsor['sponsor_type'] == 1) ? 'gray' : (($sponsor['sponsor_type'] == 2) ? 'blue' : 'red' ); ?>"><?php echo esc_attr($sponsor['sponsor_category']) ?></span>
                        <?php endif; // check if exists ?>

                        <?php
                            // Get social networks
                            $social = json_decode($sponsor['social'], 1);
                            if(!empty($social)):
                                foreach($social as $id => $link):
                                    if(empty($link))
                                        continue; // Skip if empty
                        ?>
                        <a href="<?php echo esc_url($link) ?>" target="_blank">
                            <i class="fa fa-<?php echo esc_attr(strtolower($id)) ?>"></i>
                        </a>
                        <?php
                                endforeach;
                            endif;
                        ?>
                    </div>

                    <p>
                        <?php echo esc_attr($sponsor['about']) ?>
                    </p>

                    <a href="<?php echo ($sponsor['url'] != 'no') ? esc_url($sponsor['url']) : '#' ?>" class="cta-link" target="_blank"><?php esc_html_e('VIEW WEBSITE', 'pixiehuge') ?> <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px"><path fill-rule="evenodd" d="M4.699,0.191 C4.448,0.452 4.448,0.874 4.699,1.134 L6.816,3.331 L0.653,3.331 C0.298,3.331 0.010,3.630 0.010,3.998 C0.010,4.366 0.298,4.665 0.653,4.665 L6.816,4.665 L4.699,6.862 C4.448,7.123 4.448,7.545 4.699,7.805 C4.950,8.066 5.357,8.066 5.608,7.805 L8.823,4.470 C8.939,4.349 9.011,4.182 9.011,3.998 C9.011,3.814 8.939,3.647 8.823,3.526 L5.608,0.191 C5.357,-0.069 4.950,-0.069 4.699,0.191 Z"/></svg></a>
                </div>
            </li>
            <!-- /SPONSOR -->
            <?php endforeach; ?>
        </ul>
        <?php endif; // If sponsors exists ?>
    </div>
    <!-- /CONTAINER -->
</section>
<!-- /SPONSORS -->

<section id="cta-sponsor">
    <?php

    // Get options
    $bg = get_option('pixiehuge-sponsor-custom-background');


    $customOptions = [
        'heading'       => get_option('pixiehuge-sponsor-custom-heading', ''),
        'subtitle'      => get_option('pixiehuge-sponsor-custom-subtitle', ''),
        'text'          => get_option('pixiehuge-sponsor-custom-text', ''),
        'ctalefttext'   => get_option('pixiehuge-sponsor-cta-left-text', ''),
        'ctaleftlink'   => get_option('pixiehuge-sponsor-cta-left-link', ''),
        'ctarighttext'  => get_option('pixiehuge-sponsor-cta-right-text', ''),
        'ctarightlink'  => get_option('pixiehuge-sponsor-cta-right-link', ''),
    ];
    ?>
    <div class="container bg" style="background-image: url('<?php echo !empty($bg) ? esc_url($bg) : get_stylesheet_directory_uri() . '/images/sponsor-cta-bg.jpg'; ?>');">
        <article class="content">

            <?php if(!empty($customOptions['heading'])): ?>
                <h3><?php echo esc_attr($customOptions['heading']); ?></h3>
            <?php endif; ?>

            <?php if(!empty($customOptions['subtitle'])): ?>
                <h4><?php echo esc_attr($customOptions['subtitle']); ?></h4>
            <?php endif; ?>

            <?php if(!empty($customOptions['text'])): ?>
                <p><?php echo esc_attr($customOptions['text']); ?></p>
            <?php endif; ?>

            <?php if(!empty($customOptions['ctalefttext'])): ?>
                <a href="<?php echo (!empty($customOptions['ctaleftlink'])) ? esc_url($customOptions['ctaleftlink']) : '#' ?>" class="btn btn-blue"><?php echo esc_attr($customOptions['ctalefttext']); ?></a>
            <?php endif; ?>

            <?php if(!empty($customOptions['ctarighttext'])): ?>
                <a href="<?php echo (!empty($customOptions['ctarightlink'])) ? esc_url($customOptions['ctarightlink']) : '#' ?>" class="btn btn-transparent"><?php echo esc_attr($customOptions['ctarighttext']); ?></a>
            <?php endif; ?>
        </article>
    </div>
</section>

<?php
    // Get ad space options
    $bg = get_option('pixiehuge-sponsor-adspace', '');
    $url = get_option('pixiehuge-sponsor-adspace-url', '');
?>

<?php if(!empty($bg)):?>
<section id="adSpace">
    <div class="container" style="background-image: url('<?php echo esc_url($bg) ?>');" onclick="window.location.href = '<?php echo (!empty($url)) ? esc_url($url) : '#'; ?>';"></div>
</section>
<?php endif; // check if exists ?>

<?php get_footer(); ?>