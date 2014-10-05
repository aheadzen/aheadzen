<?php 
/*
Template Name: Mobile Wizard
*/
?>
<?php
get_header();
do_action( 'yit_before_primary' );
?>

<!-- START PRIMARY -->
<div id="primary" class="<?php yit_sidebar_layout() ?>">
    <div class="container group">
	    <div class="row">
        
        
         <?php
       /************************************
	   //CONTENT AREA
	   ************************************/
	   ?>
		<?php do_action( 'yit_before_content' ) ?>
        <!-- START CONTENT -->
        <div id="content-page" class="span12 content group">
		
		<?php if(have_posts()) while(have_posts()): the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<?php endwhile; ?>
		
		
		<div style=" padding:20px;"></div>
        <?php
		if (!is_user_logged_in()) {
		?>
		<form method="post" class="register">

			<?php if ( get_option( 'woocommerce_registration_email_for_username' ) == 'no' ) : ?>

				<p class="form-row">
					<label for="reg_username"><?php _e( 'Username', 'yit' ); ?> <span class="required">*</span></label>
					<input type="text" class="input-text" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
				</p>

				<p class="form-row form-row-wide">

			<?php else : ?>
				<p class="form-row form-row-wide">
			<?php endif; ?>
				<label for="reg_email"><?php _e( 'Email', 'yit' ); ?> <span class="required">*</span></label>
				<input type="email" class="input-text" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
			</p>

			<div class="clear"></div>
			<p class="form-row form-row-wide">
				<label for="reg_password"><?php _e( 'Password', 'yit' ); ?> <span class="required">*</span></label>
				<input type="password" class="input-text" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" />
			</p>

			<div class="clear"></div>
			<!-- Spam Trap -->
			<div style="left:-999em; position:absolute;"><label for="trap">Anti-spam</label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
            <?php do_action( 'woocommerce_register_form' ); ?>
			<?php do_action( 'register_form' ); ?>
			<p class="form-row">
                <?php wp_nonce_field( 'woocommerce-register', 'register') ?>
				<input type="submit" class="button" name="register" value="<?php _e( 'Register', 'yit' ); ?>" />
			</p>
			<input type="hidden" value="<?php echo site_url();?>/wp-signup.php" name="_wp_http_referer">
		</form>
        <?php		
	}else{?>
	
	<h2>You are already loged in.</h2>
	<h3>To manage your Profile/Billing Address/Shipping Address/Change Password, go for >>  <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>"><?php _e('My Account','woothemes'); ?></a>
</h3>

<?php }	?>		
		<div style=" padding:50px;"></div>
        </div>
        <!-- END CONTENT -->
        <?php do_action( 'yit_after_content' ) ?>
	   
		</div>
    </div>
</div>
<!-- END PRIMARY -->
<?php
do_action( 'yit_after_primary' );
get_footer() ?>