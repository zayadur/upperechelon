<?php

    // adding options
    function pixiehuge_add_options() {

        // Main Settings
        register_setting( 'main-settings', 'pixiehuge-social-option', 'pixiehuge_callback_array_url');
        register_setting( 'main-settings', 'pixiehuge-pixiehuge-twitch-clientid', 'esc_attr');
        register_setting( 'main-settings', 'pixiehuge-social-topbar-enable', 'esc_attr');
        register_setting( 'main-settings', 'pixiehuge-social-footer-enable', 'esc_attr');
        register_setting( 'main-settings', 'pixiehuge-news-social-share', 'esc_attr');

        add_settings_section( 'main-section', __('Social settings', 'pixiehugepanel') , 'pixiehuge_add_main_section', 'pixie-main-page');
        add_settings_field( 'soc-id', __('Setup social media', 'pixiehugepanel'), 'pixiehuge_add_social_links', 'pixie-main-page', 'main-section');

        // Twitch settings
        register_setting( 'socialstream-settings', 'pixiehuge-twitch-clientid', 'esc_attr');
        register_setting( 'socialstream-settings', 'pixiehuge-youtube-api-key', 'esc_attr');

        add_settings_section( 'socialstream-section', __('Stream integration', 'pixiehugepanel') , 'pixiehuge_add_streamsocial_section', 'pixiehuge-streamkey-page');
        add_settings_field( 'information-twitch-id', __('Note on how to find the Twitch Client ID', 'pixiehugepanel'), 'pixiehuge_socialstream_settings', 'pixiehuge-streamkey-page', 'socialstream-section');
        add_settings_field( 'information-youtube-id', __('Note on how to find the Youtube Key', 'pixiehugepanel'), 'pixiehuge_socialyoutube_settings', 'pixiehuge-streamkey-page', 'socialstream-section');

        // Stream settings
        register_setting( 'stream-settings', 'pixiehuge-stream-section-enable', 'esc_attr');
        register_setting( 'stream-settings', 'pixiehuge-stream-heading', 'esc_attr');

        add_settings_section( 'stream-section', __('General Settings', 'pixiehugepanel') , 'pixiehuge_add_stream_settings', 'pixiehuge-stream-page');
        add_settings_field( 'pixie-stream-id', __('Show section', 'pixiehugepanel'), 'pixiehuge_stream_settings', 'pixiehuge-stream-page', 'stream-section');
        add_settings_field( 'pixie-text-stream-id', __('Stream Section Settings', 'pixiehugepanel'), 'pixiehuge_stream_text_settings', 'pixiehuge-stream-page', 'stream-section');

        // Header settings 
        register_setting( 'header-settings', 'pixiehuge-header-top-line', 'esc_attr' );
        register_setting( 'header-settings', 'pixiehuge-header-middle-line', 'esc_attr' );
        register_setting( 'header-settings', 'pixiehuge-header-bottom-line', 'esc_attr' );
	    register_setting( 'header-settings', 'pixiehuge-header-cta-red-text', 'esc_attr' );
	    register_setting( 'header-settings', 'pixiehuge-header-cta-red-link', 'esc_url' );
	    register_setting( 'header-settings', 'pixiehuge-header-background', 'esc_url' );

	    add_settings_section( 'header-section', esc_html__('Header settings', 'pixiehugepanel') , 'pixiehuge_add_general_section', 'pixie-header-page');

	    add_settings_field( 'header-background-id', esc_html__('Header Background', 'pixiehugepanel'), 'pixiehuge_header_background', 'pixie-header-page', 'header-section');
	    add_settings_field( 'header-options-id', esc_html__('Header Content Settings', 'pixiehugepanel'), 'pixiehuge_header_options', 'pixie-header-page', 'header-section');

        // Twitter settings
        register_setting( 'twitter-settings', 'pixiehuge-twitter-enable', 'esc_attr' );
        register_setting( 'twitter-settings', 'pixiehuge-twitter-title', 'esc_attr' );
        register_setting( 'twitter-settings', 'pixiehuge-twitter-subtitle', 'esc_attr' );
        register_setting( 'twitter-settings', 'pixiehuge-twitter-text', 'esc_attr' );
	    register_setting( 'twitter-settings', 'pixiehuge-twitter-url', 'esc_url' );
	    register_setting( 'twitter-settings', 'pixiehuge-twitter-username', 'esc_attr' );
	    register_setting( 'twitter-settings', 'pixiehuge-twitter-background', 'esc_url' );

	    add_settings_section( 'twitter-section', esc_html__('Twitter settings', 'pixiehugepanel') , 'pixiehuge_add_stream_section', 'pixiehuge-twitter-page');

	    add_settings_field( 'twitter-show-section-id', esc_html__('Show section', 'pixiehugepanel'), 'pixiehuge_twitter_showsection', 'pixiehuge-twitter-page', 'twitter-section');
	    add_settings_field( 'twitter-background-id', esc_html__('Twitter Background', 'pixiehugepanel'), 'pixiehuge_twitter_background', 'pixiehuge-twitter-page', 'twitter-section');
	    add_settings_field( 'twitter-options-id', esc_html__('Twitter Content Settings', 'pixiehugepanel'), 'pixiehuge_twitter_options', 'pixiehuge-twitter-page', 'twitter-section');

	    // Footer settings
	    register_setting( 'footer-settings', 'pixiehuge-footer-background', 'esc_url' );
        register_setting( 'footer-settings', 'pixiehuge-footer-about-us-title', 'esc_attr' );
	    register_setting( 'footer-settings', 'pixiehuge-footer-about-us-text', 'esc_attr' );
	    register_setting( 'footer-settings', 'pixiehuge-footer-about-us-button-text', 'esc_attr' );
	    register_setting( 'footer-settings', 'pixiehuge-footer-copyright', 'htmlspecialchars_decode' );
        register_setting( 'footer-settings', 'pixiehuge-footer-about-us-link', 'esc_url' );

        add_settings_section( 'footer-section', esc_html__('Footer settings', 'pixiehugepanel') , 'pixiehuge_add_footer_section', 'pixie-footer-page');
        add_settings_field( 'footer-settings-id', esc_html__('Footer settings', 'pixiehugepanel'), 'pixiehuge_footer_settings', 'pixie-footer-page', 'footer-section');
        add_settings_field( 'footer-copyright-settings-id', esc_html__('Footer Copyright settings', 'pixiehugepanel'), 'pixiehuge_copyrightfooter_settings', 'pixie-footer-page', 'footer-section');
        add_settings_field( 'pixiehuge-footer-background-id', esc_html__('Footer Background', 'pixiehugepanel'), 'pixiehuge_footer_background', 'pixie-footer-page', 'footer-section');

        // Team settings 
        register_setting( 'team-settings', 'pixiehuge-team-heading', 'esc_attr' );
        register_setting( 'team-settings', 'pixiehuge-team-section-enable', 'esc_attr' );

        add_settings_section( 'team-section', esc_html__('Team settings', 'pixiehugepanel') , 'pixiehuge_add_team_section', 'pixiehuge-team-page');
	    add_settings_field( 'team-show-id', __('Show section', 'pixiehugepanel'), 'pixiehuge_team_settings', 'pixiehuge-team-page', 'team-section');
        add_settings_field( 'team-options-id', esc_html__('Team page header', 'pixiehugepanel'), 'pixiehuge_team_options', 'pixiehuge-team-page', 'team-section');

        // Match settings 
        register_setting( 'match-settings', 'pixiehuge-match-heading', 'esc_attr' );
        register_setting( 'match-settings', 'pixiehuge-match-section-enable', 'esc_attr' );

        add_settings_section( 'match-section', esc_html__('General Settings', 'pixiehugepanel') , 'pixiehuge_add_match_section', 'pixiehuge-match-page');

        add_settings_field( 'match-show-id', esc_html__('Show section', 'pixiehugepanel'), 'pixiehuge_match_settings', 'pixiehuge-match-page', 'match-section');
        add_settings_field( 'match-options-id', esc_html__('Match Content Settings', 'pixiehugepanel'), 'pixiehuge_match_options', 'pixiehuge-match-page', 'match-section');

        // About settings 
        register_setting( 'about-settings', 'pixiehuge-about-title', 'esc_attr' );
        register_setting( 'about-settings', 'pixiehuge-about-subtitle', 'esc_attr' );
        register_setting( 'about-settings', 'pixiehuge-about-description', 'esc_html' );
        register_setting( 'about-settings', 'pixiehuge-about-foot-title', 'esc_attr' );
        register_setting( 'about-settings', 'pixiehuge-about-foot-subtitle', 'esc_attr' );
        register_setting( 'about-settings', 'pixiehuge-about-background', 'esc_url' );
        register_setting( 'about-settings', 'pixiehuge-about-footer-title', 'esc_attr' );
        register_setting( 'about-settings', 'pixiehuge-about-footer-subtitle', 'esc_html' );
        register_setting( 'about-settings', 'pixiehuge-about-footer-btn-text', 'esc_attr' );
        register_setting( 'about-settings', 'pixiehuge-about-footer-btn-file', 'pixiehugepanel_handle_file_upload' );
        register_setting( 'about-settings', 'about-pixiehuge-footer-background', 'esc_url' );

        register_setting( 'about-settings', 'pixiehuge-about-category', 'pixiehuge_callback_array_attr');

        register_setting( 'about-settings', 'pixiehuge-about-mail-one-text', 'esc_attr' );
        register_setting( 'about-settings', 'pixiehuge-about-mail-one-link', 'esc_attr' );
        register_setting( 'about-settings', 'pixiehuge-about-mail-one-icon', 'esc_url' );
        register_setting( 'about-settings', 'pixiehuge-about-mail-two-text', 'esc_attr' );
        register_setting( 'about-settings', 'pixiehuge-about-mail-two-link', 'esc_attr' );
        register_setting( 'about-settings', 'pixiehuge-about-mail-two-icon', 'esc_url' );
        register_setting( 'about-settings', 'pixiehuge-about-mail-three-text', 'esc_attr' );
        register_setting( 'about-settings', 'pixiehuge-about-mail-three-link', 'esc_attr' );
        register_setting( 'about-settings', 'pixiehuge-about-mail-three-icon', 'esc_url' );

        add_settings_section( 'about-section', esc_html__('About settings', 'pixiehugepanel') , 'pixiehuge_add_about_section', 'pixie-about-page');

        add_settings_field( 'about-background-id', esc_html__('About Background', 'pixiehugepanel'), 'pixiehuge_about_background', 'pixie-about-page', 'about-section');
        add_settings_field( 'about-options-id', esc_html__('Top about us sections', 'pixiehugepanel'), 'pixiehuge_about_options', 'pixie-about-page', 'about-section');
        add_settings_field( 'pixiehuge-about-category-id', esc_html__('Board members Categories', 'pixiehugepanel'), 'pixiehuge_about_categories', 'pixie-about-page', 'about-section');
        add_settings_field( 'about-mails-id', esc_html__('About us & Footer contact info', 'pixiehugepanel'), 'pixiehuge_about_contact', 'pixie-about-page', 'about-section');
        add_settings_field( 'about-footer-options-id', esc_html__('Media kit', 'pixiehugepanel'), 'pixiehuge_about_footer_options', 'pixie-about-page', 'about-section');

        // Sponsor settings
        register_setting( 'sponsor-settings', 'pixiehuge-sponsor-home-enable', 'esc_attr' );
        register_setting( 'sponsor-settings', 'pixiehuge-sponsor-custom-heading', 'esc_attr' );
        register_setting( 'sponsor-settings', 'pixiehuge-sponsor-custom-subtitle', 'esc_attr' );
        register_setting( 'sponsor-settings', 'pixiehuge-sponsor-custom-text', 'esc_html' );
        register_setting( 'sponsor-settings', 'pixiehuge-sponsor-adspace', 'esc_url' );
        register_setting( 'sponsor-settings', 'pixiehuge-sponsor-adspace-url', 'esc_url' );
        register_setting( 'sponsor-settings', 'pixiehuge-sponsor-cover', 'esc_url' );
        register_setting( 'sponsor-settings', 'pixiehuge-sponsor-custom-background', 'esc_url' );
        register_setting( 'sponsor-settings', 'pixiehuge-sponsor-cta-left-text', 'esc_attr' );
        register_setting( 'sponsor-settings', 'pixiehuge-sponsor-cta-left-link', 'esc_url' );
        register_setting( 'sponsor-settings', 'pixiehuge-sponsor-cta-right-text', 'esc_attr' );
        register_setting( 'sponsor-settings', 'pixiehuge-sponsor-cta-right-link', 'esc_url' );

        add_settings_section( 'sponsor-section', esc_html__('Sponsor settings', 'pixiehugepanel') , 'pixiehuge_add_sponsor_section', 'pixiehuge-sponsor-page');

	    add_settings_field( 'sponsor-options-id', esc_html__('Header sponsor section', 'pixiehugepanel'), 'pixiehuge_sponsor_options', 'pixiehuge-sponsor-page', 'sponsor-section');
	    add_settings_field( 'sponsor-background-id', esc_html__('Sponsor Cover', 'pixiehugepanel'), 'pixiehuge_sponsor_cover', 'pixiehuge-sponsor-page', 'sponsor-section');
        add_settings_field( 'sponsor-footer-id', esc_html__('Custom Section', 'pixiehugepanel'), 'pixiehuge_sponsor_custom', 'pixiehuge-sponsor-page', 'sponsor-section');
        add_settings_field( 'sponsor-adspace-id', esc_html__('Ad Space', 'pixiehugepanel'), 'pixiehuge_adspace_option', 'pixiehuge-sponsor-page', 'sponsor-section');
    }

    function pixiehugepanel_handle_file_upload($option) {

        if(!empty($_FILES['pixiehuge-about-footer-btn-file']['tmp_name'])) {
            $file = $_FILES['pixiehuge-about-footer-btn-file'];

            $temp = explode('.', $file['name']);
            $extension = end($temp);

            if(in_array($extension, ['zip'])) {
                $urls = wp_handle_upload($file, array('test_form' => FALSE));
                $temp = $urls['url'];

                if(!empty($temp)) {
	                return $temp;
                }
            }
        }

        return !empty($option) ? $option : get_option('pixiehuge-about-footer-btn-file');
    }

    function pixiehuge_add_stream_settings(){
        echo '<p class="demolink"><span class="spliter">|</span> <a target="_blank" href="' . PIXIEHUGE_LOC_URL . 'assets/images/03_1_1.jpg">Click here></a>to see which element you are changing</p>';
    }

    function pixiehuge_add_main_section(){
        echo '<p class="demolink"><a href="' . PIXIEHUGE_LOC_URL . 'assets/images/ss_1_1.jpg" target="_blank">Click here</a> to see which element you are changing</p>';
    }

    function pixiehuge_add_streamsocial_section(){
        echo '<p class="demolink"></p>
        <p class="section-description"></p>';
    }

    function pixiehuge_add_youtube_section(){
        echo '<p class="demolink"></p>
        <p class="section-description">This section settings is important, if you want to add Twitch.tv as a streaming platform in the dropdown found in \'ADD STREAM\' in the sidebar to the left.</p>';
    }

    function pixiehuge_add_general_section(){
        echo '<p class="demolink"><span class="spliter">|</span><a target="_blank" href="' . PIXIEHUGE_LOC_URL . 'assets/images/ss_1_1.jpg">Click here></a> to see which element you are changing</p>';
    }
    
    function pixiehuge_add_stream_section(){
        echo '<p class="demolink"><span class="spliter">|</span><a target="_blank" href="' . PIXIEHUGE_LOC_URL . 'assets/images/ss_1_2.jpg">Click here></a> to see which element you are changing</p>';
    }

    function pixiehuge_add_footer_section(){

        echo '<p class="demolink"><span class="spliter">|</span><a target="_blank" href="' . PIXIEHUGE_LOC_URL . 'assets/images/ss_1_3.jpg">Click here></a> to see which element you are changing</p>';
    }

    function pixiehuge_add_about_section(){
        echo '<p class="demolink"><span class="spliter">|</span><a target="_blank" href="' . PIXIEHUGE_LOC_URL . 'assets/images/06_1_1.jpg">Click here</a> to see which element you are changing</p>';
    }
    function pixiehuge_add_team_section(){
        echo '<p class="demolink"></p>';
    }

    function pixiehuge_add_match_section(){
        echo '<p class="demolink"><span class="spliter">|</span><a target="_blank" href="' . PIXIEHUGE_LOC_URL . 'assets/images/04_1_1.jpg">Click here</a> to see which element you are changing</p>';
    }

    function pixiehuge_add_sponsor_section(){
        echo '<p class="demolink"><span class="spliter">|</span><a target="_blank" href="' . PIXIEHUGE_LOC_URL . 'assets/images/05_1_1.jpg">Click here</a> to see which element you are changing</p>';
    }

    function pixiehuge_callback_array_url( $input ){

        // get through every url
        foreach($input as $key => $value){
            $input[ $key ] = esc_url( $value ); // sanitize every url
        }

        return $input;
    }

    function pixiehuge_callback_array_attr( $input ){

        // get through every url
        foreach($input as $key => $value){
            $input[ $key ] = esc_attr( $value ); // sanitize every url
        }

        return $input;
    }

    function pixiehuge_callback_array_escape( $input ){

        // get through every url
        foreach($input as $key => $value){ 

            if($key == 'redbtnlink' || $key == 'background') {
                $input[ $key ] = esc_url( $value );
            } else {
                $input[ $key ] = esc_attr( $value );
            }
        }

        return $input;
    }

    function pixiehuge_add_social_links() {
        // short social media names
        $shorts = array('facebook', 'twitter', 'instagram', 'youtube', 'twitch', 'vimeo', 'steam', 'discord');

        // full names of social media
        $names = array('Facebook', 'Twitter', 'Instagram', 'YouTube', 'Twitch', 'Vimeo', 'Steam', 'Discord');
        $social_links = get_option('pixiehuge-social-option');
        $i = 0;

        // Enable/Disable
        $umtopbar = get_option('pixiehuge-social-topbar-enable', true);
        $umtopbar  = ( !empty($umtopbar) ? 'checked' : '' );

        $umfooter = get_option('pixiehuge-social-footer-enable', true);
        $umfooter  = ( !empty($umfooter) ? 'checked' : '' );

        $newsShare = get_option('pixiehuge-news-social-share');
        $newsShare  = ( !empty($newsShare) ? 'checked' : '' );


        echo '<table class="innerTable">';
        foreach($shorts as $short) { // for each social media
            if(empty($social_links[$short])) {
                $social_links[$short] = null;
            }
            echo '<tr><td><i class="fa fa-'. strtolower($short) .'" title="' . ucfirst($short) . '"></i>
                  <input type="text" class="social-option-field" name="pixiehuge-social-option[' .$short. ']" size="35" placeholder="' . ucfirst($short) . '" value="' . esc_url($social_links[$short]) . '"/>';
            echo '</div></td>';
            $i++;
        }
        echo '<tr><td>' . esc_html__('Show/Hide in TopBar', 'pixiehugepanel') . ': <input type="checkbox" id="pixiehuge-social-topbar-enable" name="pixiehuge-social-topbar-enable" value="1" ' . esc_attr($umtopbar) . '/>
                <div class="labelCheckbox '. esc_attr($umtopbar) .'"><span class="check on">show</span><span class="check off">hide</span></div></td></tr>';
        echo '<tr>
            <td>' . esc_html__('Show/Hide in Footer', 'pixiehugepanel') . ': <input type="checkbox" id="pixiehuge-social-footer-enable" name="pixiehuge-social-footer-enable" value="1" ' . esc_attr($umfooter) . '/>
            <div class="labelCheckbox '. esc_attr($umfooter) .'"><span class="check on">show</span><span class="check off">hide</span></div></td></tr>';

            echo '<tr>
            <td>' . esc_html__('Share buttons', 'pixiehugepanel') . ': <input type="checkbox" id="pixiehuge-news-social-share" name="pixiehuge-news-social-share" value="1" ' . esc_attr($newsShare) . '/>
            <div class="labelCheckbox '. esc_attr($newsShare) .'"><span class="check on">show</span><span class="check off">hide</span></div></td>
            </tr>';

        echo '</table>';
    }

    function pixiehuge_stream_settings() {
        
        $um = get_option('pixiehuge-stream-section-enable');
        $um  = ( !empty($um) ? 'checked' : '' );

        echo '<input type="checkbox" id="pixiehuge-stream-section-enable" name="pixiehuge-stream-section-enable" value="1" ' . esc_attr($um) . '/>
                <div class="labelCheckbox '. esc_attr($um) .'"><span class="check on">show</span><span class="check off">hide</span></div>';
        
        echo '<p class="description">' . esc_html__('Will the given section be displayed or not.', 'pixiehugepanel') . '</p>';
    }

    function pixiehuge_team_settings() {

        $um = get_option('pixiehuge-team-section-enable');
        $um  = ( !empty($um) ? 'checked' : '' );

        echo '<input type="checkbox" id="pixiehuge-team-section-enable" name="pixiehuge-team-section-enable" value="1" ' . esc_attr($um) . '/>
                <div class="labelCheckbox '. esc_attr($um) .'"><span class="check on">show</span><span class="check off">hide</span></div>';

        echo '<p class="description">' . esc_html__('Will the given section be displayed or not.', 'pixiehugepanel') . '</p>';
    }

    function pixiehuge_socialstream_settings() {
        $tw = get_option('pixiehuge-twitch-clientid');
        $clientid = (!empty($tw)) ? $tw : '';

        echo '<table>
            <tr><td><label for="pixiehuge-twitch-clientid">' . esc_html__('Twitch ClientID', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-twitch-clientid" id="pixiehuge-twitch-clientid" value="' . esc_attr($clientid) . '"></td></tr>
            </table>';

        echo '<p class="description">To get a client ID, register a developer application on the <a href="https://twitch.tv/settings/connections" target="_blank">connections</a> page of your Twitch account. Once you have your client ID just copy paste it in the field on the right.</p>';
    }

    function pixiehuge_socialyoutube_settings() {
        $yt = get_option('pixiehuge-youtube-api-key');

        echo '<table>
            <tr><td><label for="pixiehuge-youtube-api-key">' . esc_html__('Youtube Key', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-youtube-api-key" id="pixiehuge-youtube-api-key" value="' . esc_attr($yt) . '"></td></tr>
            </table>';

        echo '<p class="description">To get a YouTube key please check <a href="https://www.youtube.com/watch?v=_HYYJelTExE" target="_blank">this video</a> and copy paste it here in order to have the YouTube API working correctly.</p>';
    }

    function pixiehuge_stream_text_settings() {
        $field = get_option('pixiehuge-stream-heading', '');

        echo '<table>
            <tr><td colspan="2"><input type="text" size="50" name="pixiehuge-stream-heading" placeholder="' . esc_html__('Heading text', 'pixiehugepanel') . '" id="pixiehuge-stream-heading" value="' . esc_attr($field) . '"></td></tr>
            </table>';

        echo '<p class="description">In the fields on the right you need to enter the heading for the stream section which will be displayed on the home page.</p>';
    }

    function pixiehuge_header_background() {
        $bg = get_option('pixiehuge-header-background');

        $icon = (isset($bg)) ? $bg : '';

        echo '<table class="innerTable">
            <tr>
            <td>
                <div class="btn-holder"><input type="button" class="button button-secondary" value="Choose Background" id="uploadHeaderBG">
                <input type="hidden" name="pixiehuge-header-background" id="HeaderBG" value="' . esc_attr($icon) . '"/>';
    
        // remove button
        echo '<input type="button" class="button button-secondary" style="display: '. ( empty($icon) ? 'none' : 'inline-block' ) .' ;" value="Remove" id="resetHeaderBG"/></div>';
        
        // holder preview
        echo '<div class="image-preview-holder HeaderBG">';
        
        if( !empty($icon) ){ // if is set show picture
            echo '<img class="image-preview" src="' . esc_attr($icon) . '"/>';
        }
        echo '</div>';
        echo '</td></tr></table>';
        echo '<p class="description">' . esc_html__('An image that will be found in the main hero background, on the home page of the website. Recommended image size: 1920x590px', 'pixiehugepanel') . '.</p>';

    }

    function pixiehuge_twitter_background() {
        $bg = get_option('pixiehuge-twitter-background');

        $icon = (isset($bg)) ? $bg : '';

        echo '<table class="innerTable">
            <tr>
            <td>
                <div class="btn-holder"><input type="button" class="button button-secondary" value="Choose Background" id="uploadTwitterBG">
                <input type="hidden" name="pixiehuge-twitter-background" id="TwitterBG" value="' . esc_attr($icon) . '"/>';

        // remove button
        echo '<input type="button" class="button button-secondary" style="display: '. ( empty($icon) ? 'none' : 'inline-block' ) .' ;" value="Remove" id="resetTwitterBG"/></div>';

        // holder preview
        echo '<div class="image-preview-holder TwitterBG">';

        if( !empty($icon) ){ // if is set show picture
            echo '<img class="image-preview" src="' . esc_attr($icon) . '"/>';
        }
        echo '</div>';
        echo '</td></tr></table>';
        echo '<p class="description">' . esc_html__('Upload the background image which is found on the twitter section of the home page. Recommended image size: 1920x400px', 'pixiehugepanel') . '.</p>';

    }

    function pixiehuge_footer_settings() {

        $text = get_option('pixiehuge-footer-copyright', 'Copyright PixieHuge, crafted with love by PixieSquad 2017');
        $aboutustitle = get_option('pixiehuge-footer-about-us-title');
        $aboutustext = get_option('pixiehuge-footer-about-us-text');
        $btnText = get_option('pixiehuge-footer-about-us-button-text');
        $aboutus = get_option('pixiehuge-footer-about-us-link');

        $settings2 = array(
            'textarea_name' => 'pixiehuge-footer-copyright',
            'media_buttons' => false,
            'teeny' => true,
            'quicktags' => array(
                'buttons' => 'strong,em,del,ul,ol,li,close'
            )
        );

        echo '<table>
            <tr>
                <td colspan="2">
                <input type="text" value="' . esc_attr($aboutustitle) . '" type="text" size="50" name="pixiehuge-footer-about-us-title" id="pixiehuge-footer-about-us-title" placeholder="' . esc_html__('Section title', 'pixiehugepanel') . '">
                </td>
            </tr>
            <tr>
            	<td colspan="2"><textarea size="50" name="pixiehuge-footer-about-us-text" placeholder="' . esc_html__('Section Text', 'pixiehugepanel') . '" id="pixiehuge-footer-about-us-text">' . esc_attr($aboutustext) . '</textarea>
            	</td>
            </tr>
            <tr>
            	<td colspan="2"><input type="text" size="50" name="pixiehuge-footer-about-us-button-text" placeholder="' . esc_html__('Button Text', 'pixiehugepanel') . '" id="pixiehuge-footer-about-us-button-text" value="' . esc_attr($btnText) . '"></td>
            </tr>
            <tr>
            	<td colspan="2"><input type="text" size="50" name="pixiehuge-footer-about-us-link" placeholder="' . esc_html__('Button Link', 'pixiehugepanel') . '" id="pixiehuge-footer-about-us-link" value="' . esc_url($aboutus) . '"></td>
            </tr>
            </table>';

        echo '<p class="description">' . esc_html__('In the fields on the right you can insert your footer text, button text & link. Which will be found on each page of the website.', 'pixiehugepanel') . '.</p>';
    }
    function pixiehuge_copyrightfooter_settings() {

        $text = get_option('pixiehuge-footer-copyright', esc_html__('Copyright PixieHuge, crafted with love by PixieSquad 2017', 'pixiehugepanel'));

        $settings2 = array(
            'textarea_name' => 'pixiehuge-footer-copyright',
            'media_buttons' => false,
            'teeny' => true,
            'quicktags' => array(
                'buttons' => 'strong,em,del,ul,ol,li,close'
            )
        );

        echo wp_editor( $text , 'pixiehuge-footer-copyright', $settings2);


        echo '<p class="description">' . esc_html__('In the field on the right insert the copyright text that goes into your footer', 'pixiehugepanel') . '.</p>';
    }
    function pixiehuge_footer_background() {
        $bg = get_option('pixiehuge-footer-background');

        $icon = (isset($bg)) ? $bg : '';

        echo '<table class="innerTable">
            <tr>
            <td>
                <div class="btn-holder"><input type="button" class="button button-secondary" value="Choose Background" id="uploadFooterBG">
                <input type="hidden" name="pixiehuge-footer-background" id="FooterBG" value="' . esc_attr($icon) . '"/>';
    
        // remove button
        echo '<input type="button" class="button button-secondary" style="display: '. ( empty($icon) ? 'none' : 'inline-block' ) .' ;" value="Remove" id="resetFooterBG"/></div>';
        
        // holder preview
        echo '<div class="image-preview-holder FooterBG">';
        
        if( !empty($icon) ) { // if is set show picture
            echo '<img class="image-preview" src="' . esc_attr($icon) . '"/>';
        }
        echo '</div>';
        echo '</td></tr></table>';
        echo '<p class="description">' . esc_html__('Upload the background image that will be found on the footer, on each page. Recommended image size: 1920x440px', 'pixiehugepanel') . '</p>';

    }

	function pixiehuge_twitter_showsection() {

		$um = get_option('pixiehuge-twitter-enable');
		$um  = ( !empty($um) ? 'checked' : '' );

		echo '<input type="checkbox" id="pixiehuge-twitter-enable" name="pixiehuge-twitter-enable" value="1" ' . esc_attr($um) . '/>
	                <div class="labelCheckbox '. esc_attr($um) .'"><span class="check on">show</span><span class="check off">hide</span></div>';

		echo '<p class="description">' . esc_html__('Will the given section be displayed or not.', 'pixiehugepanel') . '</p>';
	}

    function pixiehuge_twitter_options() {

        $title = get_option('pixiehuge-twitter-title');
        $subtitle = get_option('pixiehuge-twitter-subtitle');
        $text = get_option('pixiehuge-twitter-text');
        $url = get_option('pixiehuge-twitter-url');
        $username = get_option('pixiehuge-twitter-username');

        echo '<table>
            <tr><td><label for="pixiehuge-twitter-title">' . esc_html__('Title', 'pixiehugepanel') . ':</label></td><td><input type="text" size="35" name="pixiehuge-twitter-title" id="pixiehuge-twitter-title" value="' . esc_attr($title) . '"/></td></tr>
            <tr><td><label for="pixiehuge-twitter-subtitle">' . esc_html__('Subtitle', 'pixiehugepanel') . ':</label></td><td><input type="text" size="35" name="pixiehuge-twitter-subtitle" id="pixiehuge-twitter-subtitle" value="' . esc_attr($subtitle) . '"/></td></tr>
            <tr><td><label for="pixiehuge-twitter-text">' . esc_html__('Text', 'pixiehugepanel') . ':</label></td><td><input type="text" size="35" name="pixiehuge-twitter-text" id="pixiehuge-twitter-text" value="' . esc_attr($text) . '"/></td></tr>
            <tr><td><label for="pixiehuge-twitter-url">' . esc_html__('Twitter URL', 'pixiehugepanel') . ':</label></td><td><input type="text" size="35" name="pixiehuge-twitter-url" id="pixiehuge-twitter-url" value="' . esc_attr($url) . '"/></td></tr>
            <tr><td><label for="pixiehuge-twitter-username">' . esc_html__('Twitter username', 'pixiehugepanel') . ':</label></td><td><input type="text" size="35" name="pixiehuge-twitter-username" id="pixiehuge-twitter-username" value="' . esc_attr($username) . '"/></td></tr>
            </table>';

        echo '<p class="description">' . esc_html__('In the fields on the right you can insert the title, text, link & your twitter profile. It will be displayed over the twitter background image, on the home page.', 'pixiehugepanel') . '</p>';
    }
    function pixiehuge_header_options() {

        $topline = get_option('pixiehuge-header-top-line');
        $middleline = get_option('pixiehuge-header-middle-line', '');
        $bottomline = get_option('pixiehuge-header-bottom-line', '');
        $ctaredtext = get_option('pixiehuge-header-cta-red-text', '');
        $ctaredlink = get_option('pixiehuge-header-cta-red-link', '');

        echo '<table>
            <tr><td><label for="pixiehuge-header-top-line">' . esc_html__('Top line', 'pixiehugepanel') . ':</label></td><td><input type="text" size="35" name="pixiehuge-header-top-line" id="pixiehuge-header-top-line" value="' . esc_attr($topline) . '"/></td></tr>
            <tr><td><label for="pixiehuge-header-middle-line">' . esc_html__('Middle line', 'pixiehugepanel') . ':</label></td><td><input type="text" size="35" name="pixiehuge-header-middle-line" id="pixiehuge-header-middle-line" value="' . esc_attr($middleline) . '"/></td></tr>
            <tr><td><label for="pixiehuge-header-bottom-line">' . esc_html__('Bottom line', 'pixiehugepanel') . ':</label></td><td><input type="text" size="35" name="pixiehuge-header-bottom-line" id="pixiehuge-header-bottom-line" value="' . esc_attr($bottomline) . '"/></td></tr>
            <tr><td><label for="pixiehuge-pixiehuge-header-cta-text">' . esc_html__('Button Text', 'pixiehugepanel') . ':</label></td><td><input type="text" size="35" name="pixiehuge-header-cta-red-text" id="pixiehuge-header-cta-red-text" value="' . esc_attr($ctaredtext) . '"/></td></tr>
            <tr><td><label for="pixiehuge-pixiehuge-header-cta-link">' . esc_html__('Button Link', 'pixiehugepanel') . ':</label></td><td><input type="text" size="35" name="pixiehuge-header-cta-red-link" id="pixiehuge-header-cta-red-link" value="' . esc_url($ctaredlink) . '"/></td></tr>
            </table>';

        echo '<p class="description">' . esc_html__('In the fields on the right you can insert texts and link for the content that\'s found over the main hero content on the website.', 'pixiehugepanel') . '</p>';
    }
    
    function pixiehuge_team_background() {
        $icon = get_option('team-background', '');

        echo '<table class="innerTable">
            <tr>
            <td>
                <div class="btn-holder"><input type="button" class="button button-secondary" value="Choose Background" id="uploadteamBG">
                <input type="hidden" name="team-background" id="teamBG" value="' . esc_attr($icon) . '"/>
                <p class="description">Whether the section will be displayed or not.</p>';
    
        // remove button
        echo '<input type="button" class="button button-secondary" style="display: '. ( empty($icon) ? 'none' : 'inline-block' ) .' ;" value="Remove" id="resetteamBG"/></div>';
        
        // holder preview
        echo '<div class="image-preview-holder previewteamBG">';
        
        if( !empty($icon) ){ // if is set show picture
            echo '<img class="image-preview" src="' . esc_attr($icon) . '"/>';
        }
        echo '</div>';
        echo '</td></tr></table>';

        echo '<p class="description">' . esc_html__('The team background image can be found in the header of the team page. The recommended image size is 1920x650. Please take a note that over the image some content takes place & it would wise if the image would be of darker color choice.', 'pixiehugepanel'). '</p>';
    }

    function pixiehuge_team_options() {
        $teamheading = get_option('pixiehuge-team-heading', '');

        echo '<table>
            <tr><td><label for="pixiehuge-team-heading">' . esc_html__('Heading', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-team-heading" id="pixiehuge-team-heading" value="' . esc_attr($teamheading) . '"></td></tr>
            </table>';

        echo '<p class="description">' . esc_html__('Enter the heading text which will be displayed on the ALL teams page and home page.', 'pixiehugepanel'). '</p>';
    }

    function pixiehuge_team_description() {
        $description = get_option('team-description', '');

        echo '<textarea class="medium-text" name="team-description" id="team-description">' . esc_html($description) . '</textarea>';

        echo '<p class="description">' . esc_html__('In tihs area you can add your team description, and to provide some additional information about your teams. The section will be displayed in header area of Teams page.', 'pixiehugepanel'). '</p>';
    }

    function pixiehuge_match_settings() {
        
        $um = get_option('pixiehuge-match-section-enable');
        $um  = ( !empty($um) ? 'checked' : '' );

        echo '<input type="checkbox" id="pixiehuge-match-section-enable" name="pixiehuge-match-section-enable" value="1" ' . esc_attr($um) . '/>
                <div class="labelCheckbox '. esc_attr($um) .'"><span class="check on">show</span><span class="check off">hide</span></div>';
        
        echo '<p class="description">' . esc_html__('Will the given section be displayed or not.', 'pixiehugepanel') . '</p>';
    }
    function pixiehuge_match_options() {
	    $heading = get_option('pixiehuge-match-heading', '');

        echo '<table>
            <tr><td><label for="pixiehuge-match-heading">' . esc_html__('Match Heading', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-match-heading" id="pixiehuge-match-heading" value="' . esc_attr($heading) . '"></td></tr>
            </table>';

        echo '<p class="description">' . esc_html__('In the field on the right enter the heading for the match section which will be displayed on the home page and all matches page.', 'pixiehugepanel'). '</p>';
    }
    
    function pixiehuge_about_background() {
        $bg = get_option('pixiehuge-about-background');
        $icon = (isset($bg)) ? $bg : '';

        echo '<table class="innerTable">
            <tr>
            <td>
                <div class="btn-holder"><input type="button" class="button button-secondary" value="Choose Background" id="uploadaboutBG">
                <input type="hidden" name="pixiehuge-about-background" id="aboutBG" value="' . esc_attr($icon) . '"/>
                <p class="description">Whether the section will be displayed or not.</p>';
    
        // remove button
        echo '<input type="button" class="button button-secondary" style="display: '. ( empty($icon) ? 'none' : 'inline-block' ) .' ;" value="Remove" id="resetaboutBG"/></div>';
        
        // holder preview
        echo '<div class="image-preview-holder aboutBG">';
        
        if( !empty($icon) ){ // if is set show picture
            echo '<img class="image-preview" src="' . esc_attr($icon) . '"/>';
        }
        echo '</div>';
        echo '</td></tr></table>';

        echo '<p class="description">' . esc_html__('Upload a background image that will be displayed on the top of the about us page. The recommended image size is 1200x440px', 'pixiehugepanel'). '</p>';
    }
    
    function pixiehuge_about_categories() {
        $params = array('cat_one' => 'Category one', 'cat_two' => 'Category two', 'cat_three' => 'Category three', 'cat_four' => 'Category four');

        $categories = get_option('pixiehuge-about-category');


        $background = get_option('about-pixiehuge-footer-background', '');
        echo '<table>
            <tr>
                <td colspan="2">
                  <div class="btn-holder"><input type="button" class="button button-secondary" value="Choose Background" id="uploadaboutFooterBG">
                <input type="hidden" name="about-pixiehuge-footer-background" id="aboutFooterBG" value="' . esc_attr($background) . '"/>
                <p class="description">Whether the section will be displayed or not.</p>';

                // remove button
                echo '<input type="button" class="button button-secondary" style="display: '. ( empty($background) ? 'none' : 'inline-block' ) .' ;" value="Remove" id="resetaboutFooterBG"/></div>';

                // holder preview
                echo '<div class="image-preview-holder aboutFooterBG">';

                if( !empty($background) ){ // if is set show picture
                    echo '<img class="image-preview" src="' . esc_attr($background) . '"/>';
                }
                echo '</div>
            <td></td></tr>';


        foreach($params as $id => $param) {
            echo '<tr><td><label for="pixiehuge-about-category-one">' . esc_attr($param) . ':</label></td><td><input type="text" size="50" name="pixiehuge-about-category['.$id.']" id="pixiehuge-about-category-one" value="' . esc_attr($categories[$id]) . '"></td></tr>';
        }
        echo '</table>';

        echo '<p class="description">' . esc_html__('In the fields on the right enter the board members category which will be displayed on the about us page and board member section.', 'pixiehugepanel'). '</p>';
    }

    function pixiehuge_about_options() {
        $title = get_option('pixiehuge-about-title', '');
        $subtitle = get_option('pixiehuge-about-subtitle', '');
        $text = get_option('pixiehuge-about-description', '');
        $footTitle = get_option('pixiehuge-about-foot-title', '');
        $footSubtitle = get_option('pixiehuge-about-foot-subtitle', '');

        $settings = array(
            'textarea_name' => 'pixiehuge-about-description',
            'media_buttons' => false,
            'teeny' => true,
            'quicktags' => array(
                'buttons' => 'strong,em,del,ul,ol,li,close'
            )
        );
        echo '<table>
            <tr><td><label for="pixiehuge-about-title">' . esc_html__('Title', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-about-title" id="pixiehuge-about-title" value="' . esc_attr($title) . '"></td></tr>
            <tr><td><label for="pixiehuge-about-subtitle">' . esc_html__('Subtitle', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-about-subtitle" id="pixiehuge-about-subtitle" value="' . esc_attr($subtitle) . '"></td></tr>
            </table>';
            echo wp_editor( $text , 'pixiehuge-about-description', $settings);

        echo '<table>
            <tr><td><label for="pixiehuge-about-foot-title">' . esc_html__('Department Title', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-about-foot-title" id="pixiehuge-about-foot-title" value="' . esc_attr($footTitle) . '"></td></tr>
            <tr>
                <td><label for="pixiehuge-about-foot-subtitle">' . esc_html__('Department Description', 'pixiehugepanel') . ':</label></td>
                <td><input type="text" size="50" name="pixiehuge-about-foot-subtitle" id="pixiehuge-about-foot-subtitle" value="' . esc_attr($footSubtitle) . '"></td>
            </tr>
            </table>';

        echo '<p class="description">' . esc_html__('In the fields on the right enter the information required that will be displayed over the about us background image and on the top of the about us page.', 'pixiehugepanel'). '</p>';
    }

    function pixiehuge_about_contact() {
        $text1 = get_option('pixiehuge-about-mail-one-text', '');
        $mail1 = get_option('pixiehuge-about-mail-one-link', '');
        $background1 = get_option('pixiehuge-about-mail-one-icon', '');

        $text2 = get_option('pixiehuge-about-mail-two-text', '');
        $mail2 = get_option('pixiehuge-about-mail-two-link', '');
        $background2 = get_option('pixiehuge-about-mail-two-icon', '');

        $text3 = get_option('pixiehuge-about-mail-three-text', '');
        $mail3 = get_option('pixiehuge-about-mail-three-link', '');
        $background3 = get_option('pixiehuge-about-mail-three-icon', '');

        echo '<table>
            <tr><td><label for="pixiehuge-about-mail-one-text">' . esc_html__('Contact 1 Label', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-about-mail-one-text" id="pixiehuge-about-mail-one-text" value="' . esc_attr($text1) . '"></td></tr>
            <tr><td><label for="pixiehuge-about-mail-one-link">' . esc_html__('Contact 1 Mail', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-about-mail-one-link" id="pixiehuge-about-mail-one-link" value="' . esc_attr($mail1) . '"></td></tr>
            <tr>
                <td colspan="2">
                  <div class="btn-holder"><input type="button" class="button button-secondary" value="Choose icon" id="uploadcontactImg">
                <input type="hidden" name="pixiehuge-about-mail-one-icon" id="previewcontactImg" value="' . esc_attr($background1) . '"/>
                <p class="description">Whether the section will be displayed or not.</p>';
    
                // remove button
                echo '<input type="button" class="button button-secondary" style="display: '. ( empty($background1) ? 'none' : 'inline-block' ) .' ;" value="Remove" id="resetpreviewcontactImg"/></div>';
                
                // holder preview
                echo '<div class="image-preview-holder previewcontactImg">';
                
                if( !empty($background1) ){ // if is set show picture
                    echo '<img class="image-preview" src="' . esc_attr($background1) . '"/>';
                }
                echo '</div>
            <td></td></tr>

            <tr><td><label for="pixiehuge-about-mail-two-text">' . esc_html__('Contact 2 Label', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-about-mail-two-text" id="pixiehuge-about-mail-two-text" value="' . esc_attr($text2) . '"></td></tr>
            <tr><td><label for="pixiehuge-about-mail-two-link">' . esc_html__('Contact 2 Mail', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-about-mail-two-link" id="pixiehuge-about-mail-two-link" value="' . esc_attr($mail2) . '"></td></tr>
            <tr>
                <td colspan="2">
                  <div class="btn-holder"><input type="button" class="button button-secondary" value="Choose icon" id="uploadBG">
                <input type="hidden" name="pixiehuge-about-mail-two-icon" id="previewBG" value="' . esc_attr($background2) . '"/>
                <p class="description">Whether the section will be displayed or not.</p>';
    
                // remove button
                echo '<input type="button" class="button button-secondary" style="display: '. ( empty($background2) ? 'none' : 'inline-block' ) .' ;" value="Remove" id="resetteamBG"/></div>';
                
                // holder preview
                echo '<div class="image-preview-holder previewBG">';
                
                if( !empty($background2) ){ // if is set show picture
                    echo '<img class="image-preview" src="' . esc_attr($background2) . '">';
                }
                echo '</div>
            <td></td></tr>

            <tr><td><label for="pixiehuge-about-mail-three-text">' . esc_html__('Contact 3 Label', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-about-mail-three-text" id="pixiehuge-about-mail-three-text" value="' . esc_attr($text3) . '"></td></tr>
            <tr><td><label for="pixiehuge-about-mail-three-link">' . esc_html__('Contact 3 Mail', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-about-mail-three-link" id="pixiehuge-about-mail-three-link" value="' . esc_attr($mail3) . '"></td></tr>
            <tr>
                <td colspan="2">
                  <div class="btn-holder"><input type="button" class="button button-secondary" value="Choose icon" id="uploadsponsorBackground">
                <input type="hidden" name="pixiehuge-about-mail-three-icon" id="sponsorBackground" value="' . esc_attr($background3) . '"/>
                <p class="description">Whether the section will be displayed or not.</p>';
    
                // remove button
                echo '<input type="button" class="button button-secondary" style="display: '. ( empty($background3) ? 'none' : 'inline-block' ) .' ;" value="Remove" id="resetsponsorBackground"/></div>';
                
                // holder preview
                echo '<div class="image-preview-holder sponsorBackground">';
                
                if( !empty($background3) ){ // if is set show picture
                    echo '<img class="image-preview" src="' . esc_attr($background3) . '">';
                }
                echo '</div>
            <td></td></tr>
     
            </table>';
        echo '<p class="description">' . esc_html__('In the fields on the right, you need to enter the departemnts to be contacted and their emails. They are also displayed on the websites footer.', 'pixiehugepanel'). '</p>';
    }

    function pixiehuge_about_footer_options() {
        $heading = get_option('pixiehuge-about-footer-title', '');
        $description = get_option('pixiehuge-about-footer-subtitle', '');
        $btntext = get_option('pixiehuge-about-footer-btn-text', '');
        $btnlink = get_option('pixiehuge-about-footer-btn-file', '');

        echo '<table>
            <tr><td><label for="pixiehuge-about-footer-title">' . esc_html__('Title', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-about-footer-title" id="pixiehuge-about-footer-title" value="' . esc_attr($heading) . '"></td></tr>
            <tr><td><label for="pixiehuge-about-footer-subtitle">' . esc_html__('Description', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-about-footer-subtitle" id="pixiehuge-about-footer-subtitle" value="' . esc_attr($description) . '"></td></tr>
            <tr><td><label for="pixiehuge-about-footer-btn-text">' . esc_html__('Button text', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-about-footer-btn-text" id="pixiehuge-about-footer-btn-text" value="' . esc_attr($btntext) . '"></td></tr>
            <tr><td><label for="pixiehuge-about-footer-btn-file">' . esc_html__('File (Only ZIP)', 'pixiehugepanel') . ':</label></td><td><input type="file" size="50" name="pixiehuge-about-footer-btn-file" id="pixiehuge-about-footer-btn-file"></td></tr>
            </table>';

        echo '<p class="description">' . esc_html__('In the fields on the right enter the required information which will be displayed on the media kit section of the about us page. Also upload the background image for the section. Recommended image size: 1200x190px'). '</p>';
    }
    
    function pixiehuge_adspace_option() {
        $bg = get_option('pixiehuge-sponsor-adspace', '');
        $url = get_option('pixiehuge-sponsor-adspace-url', '');

        $icon = (isset($bg)) ? $bg : '';

        echo '<table class="innerTable">
            <tr>
            <td colspan="2">
                <div class="btn-holder"><input type="button" class="button button-secondary" value="Choose a image" id="uploadAd">
                <input type="hidden" name="pixiehuge-sponsor-adspace" id="adImage" value="' . esc_attr($icon) . '"/>
                <p class="description">Whether the section will be displayed or not.</p>';
    
        // remove button
        echo '<input type="button" class="button button-secondary" style="display: '. ( empty($icon) ? 'none' : 'inline-block' ) .' ;" value="Remove" id="resetAdImage"/></div>';
        
        // holder preview
        echo '<div class="image-preview-holder adImage">';
        
        if( !empty($icon) ){ // if is set show picture
            echo '<img class="image-preview" src="' . esc_attr($icon) . '"/>';
        }
        echo '</div>';
        echo '</td></tr>
        <tr>
            <td>
            ' . esc_html__('Banner url', 'pixiehugepanel') . ' 
            </td>
            <td>
            <input type="text" name="pixiehuge-sponsor-adspace-url" class="pixie-input" placeholder="Link" value="' . esc_url($url) . '">
            </td>
        </tr>
        </table>';
        echo '<p class="description">' . esc_html__('To add an AD banner you need to upload the image and input the link. AD space can be found above the footer on the sponsor page. Recommended image size: 1200x120px.', 'pixiehugepanel'). '</p>';
    }

    function pixiehuge_sponsor_options() {
        $enable = get_option('pixiehuge-sponsor-home-enable');
        $enable  = ( !empty($enable) ? 'checked' : '' );

        echo '<table>
            <tr>
                <td>
                ' . esc_html__('Show/Hide', 'pixiehugepanel') . ': <input type="checkbox" id="pixiehuge-sponsor-home-enable" name="pixiehuge-sponsor-home-enable" value="1" ' . esc_attr($enable) . '/>
                <div class="labelCheckbox '. esc_attr($enable) .'"><span class="check on">show</span><span class="check off">hide</span></div>
                </td>
            </tr>
            </table>';

        echo '<p class="description">' . esc_html__('Will the given section be displayed or not.'). '</p>';
    }

    function pixiehuge_sponsor_cover() {
        $bg = get_option('pixiehuge-sponsor-cover');

        $icon = (isset($bg)) ? $bg : '';

        echo '<table class="innerTable">
                <tr>
                <td>
                    <div class="btn-holder"><input type="button" class="button button-secondary" value="Choose cover" id="uploadsponsorBackground">
                    <input type="hidden" name="pixiehuge-sponsor-cover" id="sponsorBackground" value="' . esc_attr($icon) . '"/>
                    <p class="description">Whether the section will be displayed or not.</p>';

        // remove button
        echo '<input type="button" class="button button-secondary" style="display: '. ( empty($icon) ? 'none' : 'inline-block' ) .' ;" value="Remove" id="resetsponsorBackground"/></div>';

        // holder preview
        echo '<div class="image-preview-holder sponsorBackground">';

        if( !empty($icon) ){ // if is set show picture
            echo '<img class="image-preview" src="' . esc_attr($icon) . '"/>';
        }
        echo '</div>';
        echo '</td></tr></table>';

        echo '<p class="description">' . esc_html__('Upload a background image that will be displayed on the top of the sponsor page. Recommended image size: 1920x369px.', 'pixiehugepanel'). '</p>';
    }

    function pixiehuge_sponsor_custom() {
        $heading = get_option('pixiehuge-sponsor-custom-heading', '');
        $subtitle = get_option('pixiehuge-sponsor-custom-subtitle', '');
        
        $text = get_option('pixiehuge-sponsor-custom-text', '');
        $ctablacktext = get_option('pixiehuge-sponsor-cta-left-text', '');
        $ctablacklink = get_option('pixiehuge-sponsor-cta-left-link', '');
        $ctawhitetext = get_option('pixiehuge-sponsor-cta-right-text', '');
        $ctawhitelink = get_option('pixiehuge-sponsor-cta-right-link', '');
        $bg = get_option('pixiehuge-sponsor-custom-background');

        $icon = (isset($bg)) ? $bg : '';

        echo '<table>
            <tr>
            <td></td>
            <td>
                <div class="btn-holder"><input type="button" class="button button-secondary" value="Choose Background" id="uploadsponsorCustomBackground">
                <input type="hidden" name="pixiehuge-sponsor-custom-background" id="sponsorCustomBackground" value="' . esc_attr($icon) . '"/>
                <p class="description">Whether the section will be displayed or not.</p>';

        // remove button
        echo '<input type="button" class="button button-secondary" style="display: '. ( empty($icon) ? 'none' : 'inline-block' ) .' ;" value="Remove" id="resetsponsorCustomBackground"/></div>';

        // holder preview
        echo '<div class="image-preview-holder sponsorCustomBackground">';

        if( !empty($icon) ){ // if is set show picture
            echo '<img class="image-preview" src="' . esc_attr($icon) . '"/>';
        }
        echo '</div></td></tr>';

        echo '
            <tr><td><label for="pixiehuge-sponsor-custom-heading">' . esc_html__('Custom Heading', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-sponsor-custom-heading" id="pixiehuge-sponsor-custom-heading" value="' . esc_attr($heading) . '"></td></tr>
            <tr><td><label for="pixiehuge-sponsor-custom-subtitle">' . esc_html__('Custom Subtitle', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-sponsor-custom-subtitle" id="pixiehuge-sponsor-custom-subtitle" value="' . esc_attr($subtitle) . '"></td></tr>
            <tr><td><label for="pixiehuge-sponsor-custom-text">' . esc_html__('Custom Text', 'pixiehugepanel') . ':</label></td><td><textarea size="50" name="pixiehuge-sponsor-custom-text" id="pixiehuge-sponsor-custom-text">' . esc_attr($text) . '</textarea></td></tr>
            <tr><td><label for="pixiehuge-sponsor-cta-left-text">' . esc_html__('CTA Left BTN Text', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-sponsor-cta-left-text" id="pixiehuge-sponsor-cta-left-text" value="' . esc_attr($ctablacktext) . '"></td></tr>
            <tr><td><label for="pixiehuge-sponsor-cta-left-link">' . esc_html__('CTA Left BTN Link', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-sponsor-cta-left-link" id="pixiehuge-sponsor-cta-left-link" value="' . esc_url($ctablacklink) . '"></td></tr>
            <tr><td><label for="pixiehuge-sponsor-cta-right-text">' . esc_html__('CTA Right BTN Text', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-sponsor-cta-right-text" id="pixiehuge-sponsor-cta-right-text" value="' . esc_attr($ctawhitetext) . '"></td></tr>
            <tr><td><label for="pixiehuge-sponsor-cta-right-link">' . esc_html__('CTA Right Link', 'pixiehugepanel') . ':</label></td><td><input type="text" size="50" name="pixiehuge-sponsor-cta-right-link" id="pixiehuge-sponsor-cta-right-link" value="' . esc_url($ctawhitelink) . '"></td></tr>
            </table>';

        echo '<p class="description">' . esc_html__('In the fields on the right enter the titles, texts and button information required. It will be displayed on the sponsor page. Please choose background the image for this section as well. Recommended image size: 1200x401px', 'pixiehugepanel'). '</p>';
    }
