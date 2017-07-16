<?php /* Template Name: 404 Page */ ?>

<?php get_header(); ?>
<section id="notfound">
    
   <div class="container">
       <p>
		   <?php esc_html_e('Seems like this page doesn\'t exist.', 'pixiehuge') ?> <br><?php esc_html_e('You can click the button bellow to get back on home page.', 'pixiehuge') ?>
       </p>

       <a href="<?php echo esc_url(home_url('/')) ?>" class="btn btn-blue"><?php esc_html_e('BACK TO HOME PAGE', 'pixiehuge') ?></a>
   </div>

</section>
<?php get_footer(); ?>