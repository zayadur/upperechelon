<?php

namespace PixieHuge;

class Controller
{

    protected $view = false;

    public function view($view, $data = [], $notification = false) {

        // Enqueue style
        $this->view = $view;
        $this->enqueue();

    
        // Notification
        if($notification) {
            $data['notification'] = $data;
        }

        // Set Data
        set_query_var('pixiehuge_data', $data);

        if(!isset($data['menu'])) {
            $data['menu'] = [];
        }
        set_query_var('pixiehuge_admin_menu', $data['menu']);

        // Require header
        require_once PIXIEHUGE_LOC_DIR . 'includes/header.php';

        // Content
        require_once PIXIEHUGE_LOC_DIR . 'pages/' . $view . '.php';

        // Require footer
        require_once PIXIEHUGE_LOC_DIR . 'includes/footer.php';

    }

    public function query($q) {
        global $wpdb;

        $result = $wpdb->get_results($q, ARRAY_A);

        return $result;
    }

    public function redirect($url, $status = 'success', $notification = true, $slug = false) {
        
        $redirectUrl = menu_page_url($url, false);
        if($slug) {
            $redirectUrl .= $slug;
        }
        $this->view('error/index', ['status' => $status, 'message' => $notification, 'redirectUrl' => $redirectUrl], $notification);
    }
    
    /**
    *   Admin panel including styles and scripts
    **/
    public function enqueue() {

        // Page hook
        $hook = $this->view;

        // Styles
        add_action( 'admin_enqueue_scripts', array($this, $this->pixiehuge_admin_assets($hook)));
        add_action( 'customize_preview_init', array($this, 'pixiehuge_add_customization_script'));
    }

    
    // adding styles for admin page
    function pixiehuge_admin_assets($hook){
        // pages that are including scripts and styles

        $pages = [
            'home',
            'error/index',
            'team/index',
            'team/edit',
            'team/editplayer',
            'team/achievement',
            'sponsor/index',
            'sponsor/edit',
            'stream/index',
            'stream/edit',
            'match/index',
            'match/edit',
            'match/editmap',
            'about/index',
            'about/edit',
            'gallery/index',
            'gallery/edit',
        ];
        if( !in_array($hook, $pages) ) { 
            return;
        } // escape if it's not pixie page

        /* Styles */
        wp_enqueue_style('pixiehuge_admin_style', plugin_dir_url( __FILE__ ) . '../../assets/admin/css/style.admin.css', array(), '1.0.1', 'all');
        wp_enqueue_style('font-awesome', plugin_dir_url( __FILE__ ) . '../../assets/css/font-awesome.min.css', array(), '1.0.0', 'all');
        wp_enqueue_style('jquery-ui-structure', plugin_dir_url( __FILE__ ) . '../../assets/admin/css/jquery-ui.structure.min.css', array(), '1.12.0', 'all');
        wp_enqueue_style('jquery-ui-theme', plugin_dir_url( __FILE__ ) . '../../assets/admin/css/jquery-ui.theme.min.css', array(), '1.12.0', 'all');
        wp_enqueue_style('jquery-ui', plugin_dir_url( __FILE__ ) . '../../assets/admin/css/jquery-ui.min.css', array(), '1.12.1', 'all');
        wp_enqueue_style('datatables', plugin_dir_url( __FILE__ ) . '../../assets/admin/css/datatables.min.css', array(), '1.10.12', 'all');
        wp_enqueue_style('tipsy', plugin_dir_url( __FILE__ ) . '../../assets/admin/css/tipsy.css', array(), '1.0.0', 'all');
        wp_enqueue_style('jquery_datetimepicker', plugin_dir_url( __FILE__ ) . '../../assets/admin/css/jquery.datetimepicker.min.css', array(), '1.0.0', 'all');

        /* Scripts */
        wp_enqueue_media();

        wp_enqueue_script( 'datatablesjs', plugin_dir_url( __FILE__ ) . '../../assets/admin/js/datatables.min.js', array('jquery'), '1.10.12', true );
        wp_enqueue_script( 'jquery_tipsy', plugin_dir_url( __FILE__ ) . '../../assets/admin/js/jquery.tipsy.js', array('jquery'), '1.0.0', true );

        $customJS = $this->pixiehuge_inline_datatables(); // Load inline js
        wp_add_inline_script( 'datatablesjs', $customJS );
        wp_enqueue_script( 'jquery_datetimepicker_fulljs', plugin_dir_url( __FILE__ ) . '../../assets/admin/js/jquery.datetimepicker.full.min.js', array('jquery'), '1.0.0', true);
        
        $datePickerJS = $this->pixiehuge_inline_datetimepicker();
        wp_add_inline_script('jquery_datetimepicker_fulljs', $datePickerJS);

        $jqueryTipsy = $this->pixiehuge_inline_tipsy();
        wp_add_inline_script('jquery_tipsy', $jqueryTipsy);

        wp_enqueue_script( 'jquery_uijs', plugin_dir_url( __FILE__ ) . '../../assets/admin/js/jquery-ui.min.js', array('jquery'), '1.12.1', true );
        $customSortable = $this->pixiehuge_inline_sortable(); // Load inline js
        wp_add_inline_script('jquery_uijs', $customSortable);

        wp_enqueue_script( 'pixiehuge_admin_script', plugin_dir_url( __FILE__ ) . '../../assets/admin/js/script.admin.js', array('jquery'), '1.0.0', true );

        wp_localize_script( 'pixiehuge_admin_script', 'ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'pixiehugepanel_value' => false ) );
        
    }

    private function pixiehuge_inline_tipsy() {

        $txt = "
            jQuery(function() {
                jQuery('[rel=tipsy]').tipsy({fade: true, gravity: 's'});
            });
        ";

        return $txt;
    }

    private function pixiehuge_inline_sortable() {

        $txt = "
            jQuery(document).ready(function() {
                jQuery('.sectionTable').sortable({
                    placeholder: \"ui-state-highlight\",
                    update: function() {
                        var items = jQuery('.sectionTable').sortable(\"toArray\", {key:'item[]'});

                        var data = {
                            'action': 'pixiehugepanel_save_section_order',
                            'items': items,
                            'pixiehugepanel_value': ajax_object.pixiehugepanel_value
                        };
                        // We can also pass the url value separately from ajaxurl for front end AJAX implementations
                        jQuery.post(ajax_object.ajax_url, data, function(response) {
                            console.log('Saved');
                        });
                    }
                });
                jQuery('.playersTable > tbody').sortable({
                    placeholder: \"ui-state-highlight\",
                    update: function() {
                        var items = jQuery('.playersTable > tbody').sortable(\"toArray\", {key:'item[]'});

                        var data = {
                            'action': 'pixiehugepanel_save_player_order',
                            'items': items,
                            'pixiehugepanel_value': ajax_object.pixiehugepanel_value
                        };
                        // We can also pass the url value separately from ajaxurl for front end AJAX implementations
                        jQuery.post(ajax_object.ajax_url, data, function(response) {
                            console.log('Saved');
                        });
                    }
                });
                jQuery('.playersTable > tbody').disableSelection();
            });
        ";

        return $txt;
    }

    private function pixiehuge_inline_datatables() {

        $txt = "
            jQuery(document).ready(function() {
                jQuery('#datatable').DataTable({});
                jQuery('#mapDatatable').DataTable({});
                jQuery('.playersTable').DataTable({\"bSort\" : false});
                jQuery('.noSortTable').DataTable({\"bSort\" : false});
            });
        ";

        return $txt;
    }

    private function pixiehuge_inline_datetimepicker() {

            $js = "
            jQuery(document).ready(function() {
                jQuery('.dateFrom').datetimepicker({
                    minDate: 0,
                    onShow:function( ct ){
                        this.setOptions({
                            maxDate:jQuery('.dateTo').val()?jQuery('.dateTo').val():false
                        })
                    }
                });
                jQuery('.dateTo').datetimepicker({
                    onShow:function( ct ){
                        this.setOptions({
                            minDate:jQuery('.dateFrom').val()?jQuery('.dateFrom').val():0
                        })
                    }
                });
            });
            ";

            return $js;
        }

    // adding scripts for customization options
    function pixiehuge_add_customization_script(){
        wp_register_script( 'pixiehuge_custom_script', plugin_dir_url( __FILE__ ) . '../../assets/admin/js/customization.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'pixiehuge_custom_script' );
    }
}
