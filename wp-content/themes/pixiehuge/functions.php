<?php
/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/
// Customization options 
require get_template_directory() . "/inc/customization.php";
require get_template_directory() . "/inc/menu.php";
/*------------------------------------*\
	Theme Support
\*------------------------------------*/
// Content width set
if ( ! isset($content_width) )
{
    $content_width = 1170;
}
// Theme support
if (function_exists('add_theme_support'))
{
    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('pixiehuge-large', 800, 450, true);
    add_image_size('pixiehuge-large-thumbnail', 600, 360, true);
    add_image_size('pixiehuge-small-thumbnail', 400, 226, true);
    add_image_size('pixiehuge-widget-thumbnail', 95, 54, true);

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');
}
// WooCommerce
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'woocommerce_support' );

/*------------------------------------*\
    Plugin
\*------------------------------------*/
require_once get_template_directory() . '/lib/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'pixiehuge_register_required_plugins' );
if(!function_exists('pixiehuge_register_required_plugins')) {
    function pixiehuge_register_required_plugins()
    {
        /*
         * Array of plugin arrays. Required keys are name and slug.
         */
        $plugins = array(

            array(
                'name' => 'PixiePanel', // The plugin name.
                'slug' => 'pixiehugepanel', // The plugin slug (typically the folder name).
                'source' => get_template_directory_uri() . '/lib/tgm/plugins/pixiehugepanel.zip', // The plugin source.
                'required' => false, // If false, the plugin is only 'recommended' instead of required.
                'version' => '1.0.2.', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
                'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
                'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
                'external_url' => false, // If set, overrides default API URL and points to an external URL.
                'is_callable' => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
            ),
        );
        /*
         * Array of configuration settings. Amend each line as needed.
         * Only uncomment the strings in the config array if you want to customize the strings.
         */
        $config = array(
            'id' => 'pixiehuge',             // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu' => 'tgmpa-install-plugins', // Menu slug.
            'has_notices' => true,                    // Show admin notices or not.
            'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg' => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message' => '',                      // Message to output right before the plugins table.

        );

        tgmpa($plugins, $config);
    }
}

/*------------------------------------*\
    Functions
\*------------------------------------*/
$tables = array(
    'sponsors'          => 'pixiehuge_sponsor',
    'teams'             => 'pixiehuge_team',
    'players'           => 'pixiehuge_player',
    'streams'           => 'pixiehuge_stream',
    'matches'           => 'pixiehuge_match',
    'boardmembers'      => 'pixiehuge_boardmember',
    'achievements'      => 'pixiehuge_achievement',
    'maps'              => 'pixiehuge_maps',
    'sections'          => 'pixiehuge_section',
);

// Rewrite
function pixiehge_listen_rewrite_action() {
    add_rewrite_tag('%teamname%','([^/]*)');

    // Team page
    add_rewrite_rule(
        '^team/([^/]+)$',
        'index.php?pagename=team&teamname=$matches[1]',
        'top');
    add_rewrite_rule(
        '^team/([^/]+)/page/([^/]+)$',
        'index.php?pagename=team&teamname=$matches[1]&paged=$matches[2]',
        'top');

    // Player page
    add_rewrite_tag('%playername%','([^/]*)');
    add_rewrite_rule(
        '^player/([^/]+)$',
        'index.php?pagename=player&playername=$matches[1]',
        'top');
    add_rewrite_rule(
        '^player/([^/]+)/page/([^/]+)$',
        'index.php?pagename=player&playername=$matches[1]&paged=$matches[2]',
        'top');

    // Match page
    add_rewrite_tag('%matchid%','([^/]*)');
    add_rewrite_rule(
        '^match/([^/]+)$',
        'index.php?pagename=match&matchid=$matches[1]',
        'top');
    add_rewrite_rule(
        '^match/([^/]+)/page/([^/]+)$',
        'index.php?pagename=match&matchid=$matches[1]&paged=$matches[2]',
        'top');

    flush_rewrite_rules();
}
add_action( 'init', 'pixiehge_listen_rewrite_action' );

// Load Pixie styles
if(!function_exists('pixiehuge_styles')) {
    function pixiehuge_styles() {
        wp_enqueue_style('pixiehuge', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all');
        wp_enqueue_style('fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '1.0', 'all');
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '1.0.0', 'all');
        wp_enqueue_style('flagicon', get_template_directory_uri() . '/assets/css/flag-icon.min.css', array(), '1.0.0', 'all');
        wp_enqueue_style('owlcarousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), '1.0.0', 'all');
        wp_enqueue_style('chosen', get_template_directory_uri() . '/assets/css/chosen.min.css', array(), '1.0.0', 'all');
        wp_enqueue_style('pixiehuge_main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.2', 'all');

        // Custom fonts
         wp_enqueue_style('google-fonts', pixiehuge_fonts_url(), array(), '1.0.0' );

        $customCss = pixiehuge_inline_css();
        wp_add_inline_style('pixiehuge_main', $customCss);
    }
}
add_action('wp_enqueue_scripts', 'pixiehuge_styles'); // Add Theme Stylesheet

if(!function_exists('pixiehuge_inline_css')) {
    function pixiehuge_inline_css() {

        // get primary color
        $primaryColor = get_theme_mod('pixiehuge_primary_color');
        if (empty($primaryColor)) {
            $primaryColor = "#39bffd";
        }

        // Background
        $css = '
        /* BBPress */
        div.bbp-submit-wrapper button,
        #bbpress-forums #bbp-search-form #bbp_search_submit,

        /* WooCommerce */
        body.woocommerce-page .woocommerce .return-to-shop a,
        body.woocommerce-page .woocommerce .form-row.place-order input.button.alt,
        body.woocommerce-page .woocommerce .wc-proceed-to-checkout a,
        .woocommerce span.onsale,
        .woocommerce button.button.alt,
        .woocommerce #review_form #respond .form-submit input,
        .woocommerce div.product a.button a:hover,
        .woocommerce #respond input#submit:hover, 
        .woocommerce a.button:hover, 
        .woocommerce button.button:hover, 
        .woocommerce input.button:hover,
        .woocommerce a.remove:hover,

        /* About page */
        section#aboutInfo,
        section#aboutStaff .container.bg ul.header li:after,

        /* Player page */
        section#player-details .content div.equip ul li a:hover,

        /* Match page */
        section#matchRoster .content .roster > li .overlay,

        /* Sidebar */
        aside article #searchform .formSearch button#searchsubmit,

        /* Team section */
        section#teams .boxes .box,
        section#teams .boxes .box .overlay,

        /* Single page */
        section#single-page article.comments form input#submit,
        section#single-page article.comments form button,
        section#single-page article.header div.top-line a.category,
        .search-page .formSearch button#searchsubmit,

        /* Match page */
        section#matches div.container > div.content li.matchBox > a.cta-btn,
        section#matches.match-page li.matchBox:after,

        /* News page */
        section#news .content .news-box a.category,
        section#single-page article.content p input[type="submit"],
        
        /* Btn */
        section#streams div.container div.content div.list article.streamBox:not(.large) .details.on-hover > a.cta-btn,
        .btn.btn-blue {
            background-color: ' . esc_attr($primaryColor) . ' !important;
        }

        /* Chosen */
        .chosen-container .chosen-results li.highlighted {
            background: ' . esc_attr($primaryColor) . ' !important
        }
        ';

        // Border-color
        $css .= '
        /* About page */
        section#aboutStory .bg article.footer div.right ul li:hover,

        /* Sidebar */
        aside article #searchform .formSearch input,

        /* Section header */
        .section-header article.bottombar ul li.active a, 
        .section-header article.bottombar ul li:hover a,

        /* Match page */
        .btn.btn-transparent,
        
        /* Single page */
        .search-page .formSearch input,
        section#single-page article.content blockquote,

        /* WooCommerce */
        .woocommerce-info,
        body.woocommerce-page .woocommerce .woocommerce-info,
        .woocommerce form.checkout_coupon,

        /* Footer */
        footer .container.top article.box.aboutUs a {
            border-color: ' . esc_attr($primaryColor) . ' !important;
        }
        ';

        // Border-bottom
        $css .= '
        /* Player page */
        section#player-profile .player-info .right-panel ul.info-section li:hover {
            border-bottom: 1px solid ' . esc_attr($primaryColor) . ' !important;
        }
        ';

        // Color
        $css .= '

        /* BBPress*/
        #bbpress-forums div.bbp-breadcrumb p a,
        #bbpress-forums li a,
        #bbpress-forums p.bbp-topic-meta span a,
        #bbpress-forums li.bbp-body .bbp-topic-title a,

        /* NAV */
        .nav-previous a,
        .nav-next a,
        .mo-modal .mo-menu-box .modal-body ul li a,

        /* Header */
        header > nav > .container > ul > li > a > span.title:hover,
        header > nav > .container > ul > li:hover span.title,
        header div.topbar a:hover,
        #cancel-comment-reply-link,

        /* About Page*/
        section#aboutStaff .container.bg ul.tab span.role,
        section#aboutStaff .container.bg ul.header li.active a,
        section#aboutStaff .container.bg ul.header li a:hover,
        section#aboutStory .bg article.footer div.right ul li span.email,
        section#aboutStory .bg article.head > h4,

        /* Sponsors Page*/
        section#sponsor-page .container ul li .content .head a:hover,
        section#cta-sponsor article.content h4,
        section#sponsor-page .container ul li .content a.cta-link,

        /* Team Page*/
        section#team-profile ul.achievements li span.title,
        section#team-profile article.stats ul.left li span.title,
        section#team-profile .team-info .profile-details div.name span,

        /* Match section */
        section#matches div.container > div.content li.matchBox > div.rightBox > div.match-info > span.league,
        section#matches div.container > div.content li.matchBox > div.rightBox > div.stream > a,
        section#match-details .container.bg article.middle .details h5,
        .btn.btn-transparent,

        /* Player Page*/
        section#player-details .content div.equip ul li .details span.name,
        section#player-details .content .stats ul li div.info span.title,
        section#player-profile .player-info .right-panel ul.info-section li:hover span.title,
        section#player-profile .player-info .right-panel ul.profile-details li.social a:not(.stream):hover,
        section#player-profile .player-info .right-panel ul.profile-details li div.name span,

        /* Maps */
        section#mapsPlayed ul li .details span.won,
        section#matchRoster .content .roster > li .details span,

        /* Sidebar */
        aside article #wp-calendar a,
        aside ul li a,
        aside .tagcloud a,

        /* Single page */
        section#single-page article.header span.date,
        section#single-page article.comments ul li article.author div.details h5,
        section#single-page article.comments p:not(.form-submit) a,
        section#single-page article.comments ul li article.author div.details h5 a,
        section#single-page article.content code,
        section#single-page article.content a,
        section#single-page article.content h2:first-child,

        /* Hero section */
        section#hero article.content h4,

        /* Section header */
        .section-header article.bottombar ul li.active a, 
        .section-header article.bottombar ul li:hover a,

        /* Stream section */
        section#streams div.container div.content div.list article.streamBox .details > h6,

        /* Twitter section */
        section#twitter div.tw-bg > article.left > h4,

        /* News section */
        section#news .content .news-box > .details > span,
        .wp-caption-text,

        /* WooCommerce */
        body.woocommerce-page .woocommerce .woocommerce-info a.showcoupon,
        body.woocommerce-page .woocommerce .woocommerce-info a,
        body.woocommerce-page .woocommerce .woocommerce-info:before,
        section#boardmembers ul li.dropdown.active button,
        section#boardmembers ul li.dropdown.active .dropdown-menu li.active a,
        .woocommerce div.product a,
        .woocommerce div.product p.price,
        .woocommerce ul.products li.product .price,
        .woocommerce .woocommerce-product-rating a,
        .woocommerce table.shop_table td.product-name a,
        .woocommerce form .lost_password a,
        .woocommerce-info:before,
        .woocommerce a.remove,
        .woocommerce a.added_to_cart,
        .woocommerce-loop-product__title,

        /* Footer */
        footer .bottom .container > article.left a:hover,
        footer .bottom .container > article.left h5,
        footer .container.top article.box ul li > span.date,
        footer .container.top article.box ul li > a > span.email,
        footer .container.top article.box.aboutUs a {
            color: ' . esc_attr($primaryColor) . ' !important;
        }
        ';

        // Background gradient
        $css .= '
        /* Match section */
        section#matches div.container > div.content li.matchBox {
            background: rgba(34, 34, 46, 0.08);
            background: -moz-linear-gradient(left, rgba(34, 34, 46, 0.08) 0%, ' . esc_attr(pixiehuge_hex2rgba($primaryColor, '.08')) . ' 100%);
            background: -webkit-gradient(left top, right top, color-stop(0%, rgba(34, 34, 46, 0.08)), color-stop(100%, ' . esc_attr(pixiehuge_hex2rgba($primaryColor, '.008')) . '));
            background: -webkit-linear-gradient(left, rgba(34, 34, 46, 0.08) 0%, ' . esc_attr(pixiehuge_hex2rgba($primaryColor, '.08')) . ' 100%);
            background: -o-linear-gradient(left, rgba(34, 34, 46, 0.08) 0%, ' . esc_attr(pixiehuge_hex2rgba($primaryColor, '.08')) . ' 100%);
            background: -ms-linear-gradient(left, rgba(34, 34, 46, 0.08) 0%, ' . esc_attr(pixiehuge_hex2rgba($primaryColor, '.08')) . ' 100%);
            background: linear-gradient(to right, rgba(34, 34, 46, 0.08) 0%, ' . esc_attr(pixiehuge_hex2rgba($primaryColor, '.08')) . ' 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#22222e\', endColorstr=\''. esc_attr($primaryColor) . '\', GradientType=1 );
        }        ';
        // Fill
        $css .= '
        /* Top bar */
        #icon-discord:hover path,

        /* Match */
        section#matches.match-page .navigation .left:hover svg path,
        section#matches.match-page .navigation .right:hover svg path,

        /* Header */
        section#sponsors span.rightArrow svg:hover path,
        section#sponsors span.leftArrow svg:hover path,
        
        /* Sponsor page */
        section#sponsor-page .container ul li .content a.cta-link svg path,

        /* Team page */
        section#team-profile article.stats ul.left li svg path,

        /* Footer */
        footer .container.top article.box h4 svg path,

        /* Section header */
        .section-header article.topbar h3 svg path {
            fill: ' . esc_attr($primaryColor) . ' !important;
        }
        ';

        // Menu shadow
        $css .= '
        /* Header */
        header > nav > .container > ul > li > a > span.title {
            text-shadow: 5px 0px 6px ' . esc_attr(pixiehuge_hex2rgba($primaryColor, '.35')) . ';
        }

        /* About page */
        section#aboutStaff .container.bg ul.header li a {
            text-shadow: 1px 0px 1px ' . esc_attr(pixiehuge_hex2rgba($primaryColor, '.35')) . ';
        }
        ';

        return $css;
    }
}

if(!function_exists('pixiehuge_body_classes')) {
    function pixiehuge_body_classes($classes) {
        return $classes;
    }
}
add_filter('body_class', 'pixiehuge_body_classes');

if(!function_exists('pixiehuge_fonts_url')) {
    function pixiehuge_fonts_url() {
        $font_url = '';

        /*
        Translators: If there are characters in your language that are not supported
        by chosen font(s), translate this to 'off'. Do not translate into your own language.
         */
        if ('off' !== _x('on', 'Google font: on or off', 'pixiehuge')) {
            $font_url = add_query_arg('family', urlencode('Baloo Bhai|Source Sans Pro:400,700|Ubuntu:400,500,700&amp;subset=latin-ext'), "//fonts.googleapis.com/css");
        }
        return $font_url;
    }
}

if(!function_exists('pixiehuge_inline_js')) {
    function pixiehuge_inline_js() {

        $customJs = '
        jQuery(\'section#sponsors .owl-carousel\').owlCarousel({
            margin:10,
            loop:true,
            autoWidth:false,
            nav: false,
            responsive : {
                0 : {
                    items: 1,
                    margin:0,
                },
                360 : {
                    items: 2,
                    margin:50,
                },
                480 : {
                    items: 3,
                    margin:50,
                },
                768 : {
                    items: 3,
                    margin:50,
                },
                992 : {
                    items: 4,
                    margin:100,
                },
                1200 : {
                    items: 5,
                    margin:100,
                }
            }
        });
        ';

        return $customJs;
    }
}
if(!function_exists('pixiehuge_scripts')) {
    function pixiehuge_scripts() {
        if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
            wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('owlcarousel', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('chosen', get_template_directory_uri() . '/assets/js/chosen.jquery.min.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('pixiehuge_mainscript', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
            wp_enqueue_script('twitter', 'http://platform.twitter.com/widgets.js', array('jquery'), '1.0.0', true);

            $customJs = pixiehuge_inline_js();
            wp_add_inline_script( 'pixiehuge_mainscript', $customJs );
        }

        // Comments
        if (is_singular() && comments_open() && (get_option('thread_comments') == 1)) {
            // Load comment-reply.js (into footer)
            wp_register_script('comment-reply', 'wp-includes/js/comment-reply', array('jquery'), false, true);
            wp_enqueue_script('comment-reply');
        }
    }
}
add_action('wp_enqueue_scripts','pixiehuge_scripts');
if(!function_exists('pixiehuge_add_menu')) {
    function pixiehuge_add_menu() {
        register_nav_menu('header_menu', esc_html__('Header Menu', 'pixiehuge'));
        register_nav_menu('footer_menu', esc_html__('Useful Links', 'pixiehuge'));

        // Localisation Support
        load_theme_textdomain('pixiehuge.pot', get_template_directory() . '/languages');
    }
}
add_action( 'after_setup_theme', 'pixiehuge_add_menu' );

// hex to rgba
if(!function_exists('pixiehuge_hex2rgba')) {
    function pixiehuge_hex2rgba($color, $opacity = false) {

        $default = 'rgb(0,0,0)';

        //Return default if no color provided
        if (empty($color))
            return $default;

        //Sanitize $color if "#" is provided
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        } elseif (strlen($color) == 3) {
            $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        } else {
            return $default;
        }

        //Convert hexadec to rgb
        $rgb = array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if ($opacity) {
            if (abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
        } else {
            $output = 'rgb(' . implode(",", $rgb) . ')';
        }

        //Return rgb(a) color string
        return esc_attr($output);
    }
}

if(!function_exists('pixiehuge_query')) {
    function pixiehuge_query($q) {
        global $wpdb;
        $prefix = $wpdb->prefix;

        // Check if plugin exists
        if (!function_exists('run_pixiehugepanel')) {
            return false;
        }
        $result = $wpdb->get_results($q, ARRAY_A);

        return $result;
    }
}

if(!function_exists('pixiehuge_select_all')) {
    function pixiehuge_select_all($table, $where = null, $order = null, $limit = null, $andwhere = null, $noteq = false, $or = false) {
        global $wpdb;

        $table = $wpdb->prefix . $table;
        $q = "SELECT * FROM `{$table}`";
        $signWhere = ($or) ? 'OR' : 'AND';
        // Select where
        if(empty($noteq)) {
            if(!empty($where)) {
                $q .= " WHERE `" .  esc_sql($where[0]) . "`='" .  esc_sql($where[1]) . "'";
            }
            if(!empty($where) && !empty($andwhere)) {
                $q .= " " . esc_sql($signWhere) . " `" .  esc_sql($where[0]) . "`='" .  esc_sql($where[1]) . "'";
            }
        } else {
            if(!empty($where)) {
                $q .= " WHERE `" .  esc_sql($where[0]) . "`!='" .  esc_sql($where[1]) . "'";
            }
            if(!empty($where) && !empty($andwhere)) {
                $q .= " " . esc_sql($signWhere) . " `" .  esc_sql($where[0]) . "`!='" .  esc_sql($where[1]) . "'";
            }
        }
        if(!empty($order)) {
            $q .= " ORDER BY `" .  esc_sql($order[0]) . "` " .  esc_sql($order[1]);
        }
        if(!empty($limit)) {
            $q .= " LIMIT 0, {$limit}";
        }
        // Check if plugin exists
        if(!function_exists('run_pixiehugepanel')) {
            return false;
        }
        $result = $wpdb->get_results($q, ARRAY_A);

        return $result;
    }
}

// Unlimited functions
/**
 * @return bool
 */
if(!function_exists('pixiehuge_sponsors')) {
    function pixiehuge_sponsors() {
        global $tables;

        // Get Sponsors
        $sponsors = pixiehuge_select_all($tables['sponsors']);
        return $sponsors;
    }
}
if(!function_exists('pixiehuge_teams')) {
    function pixiehuge_teams($tname = false, $id = false) {
        global $tables;

        // Get Teams
        if($tname) {
            $teams = pixiehuge_select_all( $tables['teams'], ['slug', esc_sql($tname)] );
        } elseif($id) {
            $teams = pixiehuge_select_all($tables['teams'], ['id', esc_sql($id)]);
        } else {
            $teams = pixiehuge_select_all($tables['teams']);
        }
        return $teams;
    }
}
if(!function_exists('pixiehuge_org_teams')) {
    function pixiehuge_org_teams($tname = false, $id = false) {
        global $tables;

        // Get Teams
        $teams = pixiehuge_select_all($tables['teams'], ['my_team', 1]);
        return $teams;
    }
}
if(!function_exists('pixiehuge_team')) {
    function pixiehuge_team($tid = false) {
        global $tables;

        // Get Teams
        if(!$tid) {
            return false;
        }
        $team = pixiehuge_select_all($tables['teams'], ['id', esc_sql($tid)]);

        return $team;
    }
}
if(!function_exists('pixiehuge_players')) {
    function pixiehuge_players($tid) {
        global $tables;

        // Get Players
        if(!$tid) {
           return false;
        }
        $players = pixiehuge_select_all($tables['players'], ['team_id', esc_sql($tid)], ['orderNum', 'ASC']);

        return $players;
    }
}
if(!function_exists('pixiehuge_player')) {
    function pixiehuge_player($playerName) {
        global $tables;

        // Get Player
        if(!$playerName) {
           return false;
        }
        $player = pixiehuge_select_all($tables['players'], ['slug', esc_sql($playerName)]);

        return $player;
    }
}
if(!function_exists('pixiehuge_achievements')) {
    function pixiehuge_achievements($tid) {
        global $tables;

        // Get Achievements
        if(!$tid) {
           return false;
        }
        $achievements = pixiehuge_select_all($tables['achievements'], ['team_id', esc_sql($tid)]);

        return $achievements;
    }
}
if(!function_exists('pixiehuge_maps')) {
    function pixiehuge_maps() {
        global $tables;

        // Get Maps
        $maps = pixiehuge_select_all($tables['maps']);

        return $maps;
    }
}
if(!function_exists('pixiehuge_members')) {
    function pixiehuge_members($cat = false) {
        global $tables;

        // Get members
        if($cat) {
	        $members = pixiehuge_select_all($tables['boardmembers'], ['category', esc_sql($cat)]);

	        return $members;
        }
	    $members = pixiehuge_select_all($tables['boardmembers']);

        return $members;
    }
}
if(!function_exists('pixiehuge_streams')) {
	function pixiehuge_streams($id = false, $streamCat = false) {
		global $tables;

		// Get Stream(s)
		if($id) {
			$streams = pixiehuge_select_all($tables['streams'], ['id', esc_sql($id)]);
		} elseif($streamCat) {
			$streams = pixiehuge_select_all($tables['streams'], ['category', esc_sql($streamCat)]);
		} else {
			$streams = pixiehuge_select_all( $tables['streams'] );
		}

		return $streams;
	}
}
if(!function_exists('pixiehuge_matches')) {
	function pixiehuge_matches($tid = false, $limit = false, $matchType = false) {
		global $tables;
        global $wpdb;

		// Get Matches
		if($tid) {
			return $matches = pixiehuge_select_all($tables['matches'], ['id', esc_sql($tid)]);
		}
		if($limit) {
            $table = $wpdb->prefix . $tables['matches'];
            if($matchType == 1) {
                $q = "SELECT * FROM `{$table}` WHERE `score_a`='0' AND `score_b`='0' LIMIT 0,5";

                return $matches = pixiehuge_query($q);
            } elseif($matchType == 2) {
                $q = "SELECT * FROM `{$table}` WHERE `score_a`!='0' OR `score_b`!='0' LIMIT 0,5";

                return $matches = pixiehuge_query($q);
            } else {
                return $matches = pixiehuge_select_all($tables['matches'], null, null, $limit);
            }
		}
		$matches = pixiehuge_select_all($tables['matches']);

		return $matches;
	}
}
if(!function_exists('pixiehuge_matches_byTeamID')) {
	function pixiehuge_matches_byTeamID($tid = false, $limit = false, $matchId) {
		global $tables;
        global $wpdb;

		$table = $wpdb->prefix . $tables['matches'];
		$q = "SELECT * FROM `{$table}` WHERE `team_a_id`='{$tid}' AND `id`!='{$matchId}' OR `team_b_id`='{$tid}' AND `id`!='{$matchId}' LIMIT 0,5";

        $matches = pixiehuge_query($q);
		return $matches;
	}
}

if(!function_exists('pixiehuge_sections')) {
	function pixiehuge_sections() {
		global $tables;

		// Get sections
		$sections = pixiehuge_select_all($tables['sections'], null, ['orderNum', 'ASC']);

		return $sections;
	}
}

// Shorten the title
if(!function_exists('pixiehuge_short_title')) {
    function pixiehuge_short_title($numLimit = 35, $title) {
        $numChars = strlen($title);
        $title = $title . " ";
        $title = substr($title, 0, $numLimit);
        $title = substr($title, 0, strrpos($title, ' '));

        if ($numChars > $numLimit) {
            $title = $title . "...";
        } // Ellipsis
        return $title;
    }
}

// Shorten the excerpt
if(!function_exists('pixiehuge_short_excerpt')) {
    function pixiehuge_short_excerpt($trim){
        $shortexcerpt = wp_trim_words($trim, $num_words = 20, $more = '&#44;&#44;&#44; ');
        echo esc_html($shortexcerpt);
    }
}

// Post share links
if(!function_exists('pixiehuge_share_links')) {
    function pixiehuge_share_links($social, $link, $title) {

        switch ($social) {
            case 'twitter':
                return 'https://twitter.com/share?url=' . esc_url($link) . '&text=' . esc_attr($title);
            case 'pinterest':
                return 'http://pinterest.com/pin/create/link/?url=' . esc_url($link);
            case 'facebook':
                return 'http://www.facebook.com/sharer.php?s=100&p[title]=' . esc_attr($title) . '&p[url]=' . esc_url($link) . '';
        }

        return;
    }
}

// Add sidebar
if(!function_exists('pixiehuge_add_sidebar')) {
    function pixiehuge_add_sidebar() {

        // If Dynamic Sidebar Exists
        if (function_exists('register_sidebar')) {
            // Define Sidebar Widget Area 1
            register_sidebar(array(
                'name' => esc_html__('Side Area', 'pixiehuge'),
                'description' => esc_html__('The widgets on side area go here. Just drag the ones you want here.', 'pixiehuge'),
                'id' => 'pixiehuge-aside-1',
                'before_widget' => '<article id="%1$s" class="%2$s">',
                'after_widget' => '</article>',
                'before_title' => '<div class="section-header"><article class="topbar"><h3><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="7px" height="8px"><path fill-rule="evenodd"  fill="rgb(57, 191, 253)" d="M-0.000,0.435 C-0.000,0.805 -0.000,7.292 -0.000,7.546 C-0.000,7.877 0.338,8.123 0.672,7.930 C0.940,7.775 6.293,4.649 6.750,4.381 C7.050,4.205 7.045,3.786 6.750,3.611 C6.421,3.415 1.048,0.272 0.658,0.054 C0.373,-0.106 -0.000,0.071 -0.000,0.435 Z"/></svg>',
                'after_title' => '</h3></article></div>'
            ));

        }
    }

    add_action('widgets_init', 'pixiehuge_add_sidebar');
}

//Title
if(!function_exists('pixiehuge_filter_wp_title')) {
    function pixiehuge_filter_wp_title($title, $sep) {
        global $paged, $page;

        if (is_feed())
            return $title;

        // Add the site name.
        $sub = $title;
        $title = get_bloginfo('name') . esc_attr($sub);

        // Add the site description for the home/front page.
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page()))
            $title = "$title $sep $site_description";

        // Add a page number if necessary.
        if ($paged >= 2 || $page >= 2)
            $title = "$title $sep " . sprintf(esc_html__('Page %s', 'pixiehuge'), max($paged, $page));

        return $title;
    }
}
add_theme_support( 'title-tag' );
add_filter( 'wp_title', 'pixiehuge_filter_wp_title', 10, 2 );

if(!function_exists('pixiehuge_pagebreak_button')) {
    function pixiehuge_pagebreak_button($buttons, $id) {

        if ('content' != $id)
            return $buttons;

        array_splice($buttons, 13, 0, 'wp_page');

        return $buttons;
    }

    add_filter('mce_buttons', 'pixiehuge_pagebreak_button', 1, 2); // 1st row
}

if(!function_exists('pixiehuge_custom_header_menu_wrap')) {
    function pixiehuge_custom_header_menu_wrap() {

        // open the nav
        $wrap = '<ul id="%1$s" class="%2$s">';

        // get nav items
        $wrap .= '%3$s';

        $wrap .= '</ul>';

        // return the result
        return $wrap;
    }
}

if(!function_exists('pixiehuge_custom_form')) {
    function pixiehuge_custom_form( $form ) {
        $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
            <div class="formSearch">
                <input type="text" value="' . get_search_query() . '" name="s" id="s" />
                <button type="submit" id="searchsubmit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>';

        return $form;
    }
}
add_filter( 'get_search_form', 'pixiehuge_custom_form', 100 );

function pixiehuge_custom_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <article class="author" id="comment-<?php comment_ID(); ?>">
            <figure>
                <?php echo get_avatar($comment,$size='75'); ?>
            </figure>

            <div class="details">
                <h5><?php printf(esc_html__('%s', 'pixiehuge'), get_comment_author_link()) ?></h5>
                <p>
                    <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                    <a href="#"><?php printf(esc_html__('%1$s at %2$s', 'pixiehuge'), get_comment_date(), get_comment_time()) ?></a></a>
                    <?php edit_comment_link(esc_html__('(Edit)', 'pixiehuge'),'  ','') ?>
                </p>
            </div>

            <div class="reply">
                <?php 
                $replyIcon = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="9px" height="8px">
                    <path fill-rule="evenodd"  fill="rgb(0, 0, 0)" d="M7.863,5.807 L5.802,7.799 C5.536,8.056 5.111,8.051 4.850,7.788 C4.590,7.525 4.595,7.103 4.862,6.846 L5.747,5.990 L3.353,5.990 C1.512,5.990 0.000,4.508 0.000,2.686 L0.000,0.660 C0.000,0.292 0.301,-0.006 0.673,-0.006 C1.046,-0.006 1.347,0.292 1.347,0.660 L1.347,2.686 C1.347,3.773 2.254,4.658 3.353,4.658 L5.764,4.658 L4.896,3.796 C4.633,3.535 4.635,3.113 4.898,2.853 C5.029,2.724 5.201,2.659 5.373,2.659 C5.546,2.659 5.718,2.724 5.850,2.855 L7.870,4.860 C7.997,4.986 8.068,5.157 8.067,5.335 C8.065,5.513 7.992,5.683 7.863,5.807 Z"/>
                </svg>';
                ?>
                <?php comment_reply_link(array_merge( $args, array('before' => $replyIcon,'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            </div>
            <!-- /DETAILS -->
        </article>
        <!-- /AUTHOR -->
        <div class="comment">
            <?php comment_text() ?>
        </div>
        <!-- /COMMENT-CONTENT -->
    </li>
    <!-- /COMMENT -->

    <?php
}

if(!function_exists('pixiehuge_custom_footer_menu_wrap')) {
    function pixiehuge_custom_footer_menu_wrap() {

        // open the nav
        $wrap = '<ul id="%1$s" class="%2$s">';

        // get nav items
        $wrap .= '%3$s';

        $wrap .= '</ul>';

        // return the result
        return $wrap;
    }
}
function pixiehuge_is_bbpress() {
    if( function_exists ( "is_bbpress" ) && is_bbpress()){
        return true;
    }
    return false;
}
// WooCommerece
function pixiehuge_is_woocommerce_page () {
    if( function_exists ( "is_woocommerce" ) && is_woocommerce()){
        return true;
    }
    $woocommerce_keys = array(
        "woocommerce_shop_page_id",
        "woocommerce_terms_page_id",
        "woocommerce_cart_page_id",
        "woocommerce_checkout_page_id",
        "woocommerce_pay_page_id",
        "woocommerce_thanks_page_id",
        "woocommerce_myaccount_page_id",
        "woocommerce_edit_address_page_id",
        "woocommerce_view_order_page_id",
        "woocommerce_change_password_page_id",
        "woocommerce_logout_page_id",
        "woocommerce_lost_password_page_id");
    foreach ( $woocommerce_keys as $wc_page_id ) {
        if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
            return true ;
        }
    }
    return false;
}
add_action('woocommerce_before_cart', 'pixiehuge_woocommerce_before_cart', 1);
function pixiehuge_woocommerce_before_cart() {
    echo '
    <div class="section-header">
        <article class="topbar">
            <h3>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="7px" height="8px"><path fill-rule="evenodd"  fill="rgb(57, 191, 253)" d="M-0.000,0.435 C-0.000,0.805 -0.000,7.292 -0.000,7.546 C-0.000,7.877 0.338,8.123 0.672,7.930 C0.940,7.775 6.293,4.649 6.750,4.381 C7.050,4.205 7.045,3.786 6.750,3.611 C6.421,3.415 1.048,0.272 0.658,0.054 C0.373,-0.106 -0.000,0.071 -0.000,0.435 Z"/></svg>
               ' . esc_html__('Cart', 'pixiehuge') . '
            </h3>
        </article>
        <!-- /TOP-BAR -->
    </div>
    <!-- /SECTION-HEADER -->
    <div class="cart">
    ';
}
add_action('woocommerce_after_cart', 'pixiehuge_woocommerce_after_cart', 1);
function pixiehuge_woocommerce_after_cart() {
    echo '</div>';
}

// WooCommerece
add_action('woocommerce_before_checkout_form', 'pixiehuge_woocommerce_before_checkout_form', 1);
function pixiehuge_woocommerce_before_checkout_form() {
    echo '
    <div class="section-header">
        <article class="topbar">
            <h3>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="7px" height="8px"><path fill-rule="evenodd"  fill="rgb(57, 191, 253)" d="M-0.000,0.435 C-0.000,0.805 -0.000,7.292 -0.000,7.546 C-0.000,7.877 0.338,8.123 0.672,7.930 C0.940,7.775 6.293,4.649 6.750,4.381 C7.050,4.205 7.045,3.786 6.750,3.611 C6.421,3.415 1.048,0.272 0.658,0.054 C0.373,-0.106 -0.000,0.071 -0.000,0.435 Z"/></svg>
               ' . esc_html__('Checkout', 'pixiehuge') . '
            </h3>
        </article>
        <!-- /TOP-BAR -->
    </div>
    <!-- /SECTION-HEADER -->
    <div class="cart">
    ';
}
add_action('woocommerce_after_checkout_form', 'pixiehuge_woocommerce_after_checkout_form', 1);
function pixiehuge_woocommerce_after_checkout_form() {
    echo '</div>';
}