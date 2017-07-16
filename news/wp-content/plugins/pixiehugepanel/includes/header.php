<?php
/*=======================*
*   PIXIE ADMIN HTML PAGE
*=======================*/
?>
<?php
    $pdata = get_query_var('pixiehuge_data');

    if(!empty($pdata) && !empty($pdata['saveInfo'])):
?>
    <div class="notice notice-success is-dismissible">
        <p class="section-description">
            <?php 
                $saveInfo = $pdata['saveInfo'];
                
                if($saveInfo) {
                    echo esc_html($saveInfo);
                }
            ?>
        </p>
    </div>
<?php 
    endif;
?>
<?php
    // Notification
    if(!empty($pdata) && !empty($pdata['notification'])):
        $notification = $pdata['notification'];
?>
    <div class="notice notice-<?php echo esc_attr($notification['status']) ?> is-dismissible">
        <p class="section-description">
            <?php 
                echo esc_html($notification['message']);
            ?>
        </p>
    </div>
    <script type="text/javascript">
        setTimeout(function() {
            window.location = "<?php echo $notification['redirectUrl'] ?>";
        }, 2000);
    </script>
<?php 
        exit;
    endif;
?>
<?php
    settings_errors();
?>
<header class="admin-header">
    <div class="logo-section">
        <img src="<?php echo plugin_dir_url(__FILE__ ); ?>../assets/admin/images/logo.png" class="logo-img" alt="Shape the gaming"/>
    </div>
    <div class="admin-infobar">
        <section class="links"><a href="<?php echo esc_url('http://support.pixiesquad.com/') ?>" target="_blank" class="support-link"><?php esc_html_e('Need support ?', 'pixiehugepanel') ?></a> <span class="spliter">|</span> <a href="<?php echo esc_url('https://themeforest.net/user/pixiesquad') ?>" target="_blank" class="more-templates"><?php esc_html_e('More templates', 'pixiehugepanel') ?></a></section>
        
    </div>
</header>
<div class="main-content">
	<section class="sections-pick">
		<ul class="admin-pick-list">

			<?php if(get_query_var('pixiehuge_admin_menu')): ?>
				<?php foreach(get_query_var('pixiehuge_admin_menu') as $item): ?>
		    	<li class="admin-pick">
		    		<a href="#<?php echo esc_attr($item['id']) ?>"><?php echo esc_attr($item['name']); ?> <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
		    	</li>
				<?php endforeach; ?>
			<?php endif; // If is not empty?>
		</ul>
	</section>

	<main class="sections">