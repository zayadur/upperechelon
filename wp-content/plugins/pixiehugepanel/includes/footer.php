	
	<input type="hidden" id="redirectUrl" name="redirectUrl" value="<?php echo (isset($pixiehuge_data['redirectUrl']) && !empty($pixiehuge_data['redirectUrl'])) ? esc_url($pixiehuge_data['redirectUrl']) : '' ?>">
	<!-- /FOOTER SETTINGS -->
    <footer class="text">
        <p class="footer"><?php esc_html_e('Crafted with hype by ', 'pixiehugepanel'); ?><a href="<?php echo esc_url('http://pixiesquad.com') ?>" target="_blank">PixieSquad.com</a></footer>
    </footer>
</main>
</div>