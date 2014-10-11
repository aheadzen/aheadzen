 <!-- contact section Ends here -->
    <footer>
	<?php if ( is_active_sidebar( 'footer' ) ) : ?>
		<div class="footer">
			  <div class="container">
			  <?php dynamic_sidebar( 'footer' ); ?>
		   </div>
            
       <?php endif; ?>
       
        <div class="copyright">
            <div class="container">
                <p>
            	<span><?php _e('Copyright','aheadzen');?> <a class="siteurl" href="<?php echo home_url();?>"><?php echo bloginfo('blogname');?></a></span>  &copy;  <?php echo date('Y');?>  <?php _e('All rights reserved','aheadzen');?>
			   </p>
			   <?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'footer_links','fallback_cb' => '' ) ); ?>
               
            </div>
        </div>
    </footer>
    </div>

	
        </div>
    </div><!-- Wrapper End -->
 
	<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/custom.js"></script>
	
<?php wp_footer(); ?>
<?php do_action('aheadzen_footer_script');?>
<?php echo get_option('aheadzen_footer_code');?>
</body>
</html>