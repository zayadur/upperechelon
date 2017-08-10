<?php /* Template Name: About Page */ ?>

<?php get_header(); ?>
    <?php
        $coverBg = get_option('pixiehuge-about-background');
    ?>
    <section id="aboutStory">
        <div class="container bg" style="background-image: url('<?php echo (!empty($coverBg)) ? esc_url($coverBg) : get_stylesheet_directory_uri() . '/images/about-bg.jpg' ?>');">
            <article class="head">
                <?php
                    $aboutHeader = [
                        'title'                 => get_option('pixiehuge-about-title'),
                        'subtitle'              => get_option('pixiehuge-about-subtitle'),
                        'description'           => get_option('pixiehuge-about-description'),
                    ];
                ?>
                <?php if(!empty($aboutHeader['title'])): // if not empty ?>
                <h4><?php echo esc_attr($aboutHeader['title']) ?></h4>
                <?php endif; ?>

                <?php if(!empty($aboutHeader['subtitle'])): // if not empty ?>
                <h3><?php echo esc_attr($aboutHeader['subtitle']) ?></h3>
                <?php endif; ?>

                <?php if(!empty($aboutHeader['description'])): // if not empty ?>
                <p>
                    <?php echo htmlspecialchars_decode($aboutHeader['description']) ?>
                </p>
                <?php endif; ?>
            </article>
            <!-- /HEAD -->

            <article class="footer">
                <div class="left">
                    <?php
                        $aboutFooter = [
                            'title'                 => get_option('pixiehuge-about-foot-title'),
                            'subtitle'              => get_option('pixiehuge-about-foot-subtitle'),
                        ];
                    ?>

                    <?php if(!empty($aboutFooter['title'])): // if not empty ?>
                    <h4>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19" height="16" viewBox="0 0 19 16"><image id="Vector_Smart_Object_copy_3" data-name="Vector Smart Object copy 3" width="19" height="16" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAABMAAAAQCAMAAADDGrRQAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAzFBMVEUAAADX19fX19fX19fX19fX19fX19fX19fX19fX19f////////////////X19fX19fX19fX19fX19fX19f////////////////X19fX19fX19fX19fX19f////////////f39/////X19fX19fX19fX19fX19fd3d3////////////X19fX19fX19fX19f////////////////////X19fX19fX19fX19f////////////X19fX19fX19fX19fX19fX19fX19fX19cAAADc6kKKAAAAQnRSTlMAjf3KQ/ve8LYtYHpABaAUkfqdGoBBcHMjq/aDDRgEO8YgOMTpaQS8flgTUtrYTxZcfUgJbOrDKiRqbQ6E9+Vq3fyJdHXPAAAAAWJLR0QAiAUdSAAAAAlwSFlzAAALEgAACxIB0t1+/AAAAI1JREFUGNNjYAACRiZmFgY0wMrG7sTBieBzcfPwOvHxCwgyCQnDxERExcSd+BgYJCSdpKRloGKycvJOCopAlpKyk4qqGkSMgcFJXUNTC8jW1nHS1YOJ8ekbGBoZMzComZg6mZlDxRgYLCytQNqsbWzt8Ihh0YthB7Jb7NVwuRmb38Bh4IAaBuCwckQJKwBiRhd0mcnE2AAAAABJRU5ErkJggg=="/></svg>
                        <?php echo esc_attr($aboutFooter['title']) ?>
                    </h4>
                    <?php endif; ?>

                    <?php if(!empty($aboutFooter['subtitle'])): // if not empty ?>
                    <p>
                        <?php echo esc_attr($aboutFooter['subtitle']) ?>
                    </p>
                    <?php endif; ?>
                </div>
                <!-- /LEFT -->

                <div class="right">
                    <ul>
                        <?php
                        $contact = [
                            1 => [
                                'text'  => get_option('pixiehuge-about-mail-one-text'),
                                'link'  => get_option('pixiehuge-about-mail-one-link'),
                                'icon'  => get_option('pixiehuge-about-mail-one-icon'),
                            ],
                            2 => [
                                'text'  => get_option('pixiehuge-about-mail-two-text'),
                                'link'  => get_option('pixiehuge-about-mail-two-link'),
                                'icon'  => get_option('pixiehuge-about-mail-two-icon'),
                            ],
                            3 => [
                                'text'  => get_option('pixiehuge-about-mail-three-text'),
                                'link'  => get_option('pixiehuge-about-mail-three-link'),
                                'icon'  => get_option('pixiehuge-about-mail-three-icon'),
                            ],
                        ];
                        ?>

                        <?php for($x=1;$x<4;$x++): ?>
                            <?php
                                if(empty($contact[$x]['text'])) {
                                    continue;
                                } // Skip if empty
                            ?>
                        <li>
                            <a href="<?php echo esc_url($contact[$x]['link']) ?>">
								<span class="info">
									<i class="icon" style="background-image: url('<?php echo esc_url($contact[$x]['icon']) ?>');"></i> <?php echo esc_attr($contact[$x]['text']) ?>
								</span>
                                <span class="email">
									<?php echo esc_attr($contact[$x]['link']) ?>
								</span>
                            </a>
                        </li>
                        <?php endfor; // End for ?>
                    </ul>
                </div>
                <!-- /RIGHT -->

            </article>
        </div>

    </section>
    <!-- /ABOUT-STORY -->

    <?php
    $staffBg = get_option('about-pixiehuge-footer-background');

    $categories = get_option('pixiehuge-about-category');
    $members = pixiehuge_members();

    if(!empty($categories) && !empty($members)):
    ?>
    <section id="aboutStaff">

        <div class="container bg" style="background-image: url('<?php echo (!empty($staffBg)) ? esc_url($staffBg) : get_stylesheet_directory_uri() . '/images/staff-bg.jpg' ?>');">
            <ul class="header">


                <?php
                    $i = 0;
                    foreach($categories as $category):
                        $i ++;
	                    if(empty($category) || empty(pixiehuge_members($category))) {
		                    continue; // Skip if empty
	                    }
                ?>
                <li<?php echo ($i == 1) ? ' class="active"' : '' ?>>
                    <a href="#<?php echo esc_attr(strtolower($category)) ?>" data-toggle="tab"><?php echo esc_attr($category) ?></a>
                </li>
                <?php endforeach; ?>

            </ul>

            <div class="tab-content">
                <?php
                    $i = 0;
                    foreach($categories as $category):
                        $i ++;
                        if(empty($category) || empty(pixiehuge_members($category))) {
                            continue; // Skip if empty
                        }
                ?>
                <ul id="<?php echo esc_attr(strtolower($category)) ?>" class="tab<?php echo ($i == 1) ? ' active' : '' ?>">
                    <?php
                    foreach(pixiehuge_members($category) as $item):
	                    $social = json_decode($item['social']);
                    ?>
                    <li>
                        <?php if(!empty($item['avatar'])): ?>
                        <img src="<?php echo esc_url($item['avatar']) ?>" alt="<?php echo esc_attr($item['fullname']) ?>">
                        <?php endif; // If not empty ?>
                        <span class="role"><?php echo esc_attr($item['role']) ?></span>
                        <span class="name"><?php echo esc_attr($item['fullname']) ?></span>


                        <?php
                        if(!empty($social)):
                            foreach($social as $id => $link):
                                if(empty($link)) {
                                    continue; // Skip if empty
                                }
                        ?>
                        <a href="<?php echo esc_url($link) ?>" target="_blank">
                            <i class="fa fa-<?php echo esc_attr(strtolower($id)) ?>"></i>
                        </a>
                        <?php
                            endforeach; // Get list of social networks
                        endif; // If not empty
                        ?>
                    </li>
                    <?php endforeach; // List of members by category ?>

                </ul>
                <!-- /TAB -->
                <?php endforeach; // List of categories ?>

            </div>
        </div>

    </section>
    <!-- /ABOUT-STAFF -->
    <?php endif; // end if ?>

    <?php
        $title = get_option('pixiehuge-about-footer-title', '');
        $subtitle = get_option('pixiehuge-about-footer-subtitle', '');
        $btntext = get_option('pixiehuge-about-footer-btn-text', '');
        $btnlink = get_option('pixiehuge-about-footer-btn-file', '');
    ?>

    <?php if(!empty($title) || !empty($subtitle) || !empty($btntext)): ?>
    <section id="aboutInfo" class="container">

        <div class="left">
            <?php if(!empty($title)): // If not empty ?>
            <h3><?php echo esc_attr($title) ?></h3>
            <?php endif;?>

            <?php if(!empty($subtitle)): // If not empty ?>
            <h4><?php echo esc_attr($subtitle) ?></h4>
            <?php endif; ?>

        </div>
        <!-- /LEFT -->

        <?php if(!empty($btnlink)): ?>
        <div class="right">
            <a href="<?php echo esc_url($btnlink) ?>" class="btn btn-transparent">
                <?php echo esc_attr($btntext) ?>
            </a>
        </div>
        <!-- /LEFT -->
        <?php endif; ?>

    </section>
    <!-- /ABOUTINFO -->
    <?php endif; ?>

<?php get_footer(); ?>