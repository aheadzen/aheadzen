<?php
/*
Template Name: JS Wizard for Signup MU
*/
?>
<?php
if ( !is_multisite() ) {
	wp_redirect( site_url('wp-login.php?action=register') );
	die();
}

/** Sets up the WordPress Environment. */
require( ABSPATH . 'wp-signup.php' );

?>
<?php get_header(); ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/normalize.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/main.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/jquery.steps.css">
<script src="<?php echo get_template_directory_uri();?>/lib/modernizr-2.6.2.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/lib/jquery-1.9.1.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/lib/jquery.cookie-1.3.1.js"></script>
<script src="<?php echo get_template_directory_uri();?>/build/jquery.steps.js"></script>

   <div id="main">
    
	<section id="content_area1" class="content">
        <?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="margin80"></div>
		<div class="main-title">
            <div class="container">
                <h2><?php the_title();?></h2>
            </div>
        </div>
		<?php endwhile; ?>
		<?php endif; ?>
        <div class="content-main">
            <div class="container">         
                               
                <div class="margin30"></div>
				
				<script>
                jQuery(function ()
                {
                    jQuery("#wizard").steps({
                        headerTag: "h2",
                        bodyTag: "section",
                        transitionEffect: "slideLeft"
                    });
                });
            </script>

            <div id="wizard">
                <h2>First Step</h2>
                <section>
				<?php validate_blog_signup();?>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut nulla nunc. Maecenas arcu sem, hendrerit a tempor quis, 
                        sagittis accumsan tellus. In hac habitasse platea dictumst. Donec a semper dui. Nunc eget quam libero. Nam at felis metus. 
                        Nam tellus dolor, tristique ac tempus nec, iaculis quis nisi.</p>
                </section>

                <h2>Second Step</h2>
                <section>
                    <p>Donec mi sapien, hendrerit nec egestas a, rutrum vitae dolor. Nullam venenatis diam ac ligula elementum pellentesque. 
                        In lobortis sollicitudin felis non eleifend. Morbi tristique tellus est, sed tempor elit. Morbi varius, nulla quis condimentum 
                        dictum, nisi elit condimentum magna, nec venenatis urna quam in nisi. Integer hendrerit sapien a diam adipiscing consectetur. 
                        In euismod augue ullamcorper leo dignissim quis elementum arcu porta. Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                        Vestibulum leo velit, blandit ac tempor nec, ultrices id diam. Donec metus lacus, rhoncus sagittis iaculis nec, malesuada a diam. 
                        Donec non pulvinar urna. Aliquam id velit lacus.</p>
                </section>

                <h2>Third Step</h2>
                <section>
                    <p>Morbi ornare tellus at elit ultrices id dignissim lorem elementum. Sed eget nisl at justo condimentum dapibus. Fusce eros justo, 
                        pellentesque non euismod ac, rutrum sed quam. Ut non mi tortor. Vestibulum eleifend varius ullamcorper. Aliquam erat volutpat. 
                        Donec diam massa, porta vel dictum sit amet, iaculis ac massa. Sed elementum dui commodo lectus sollicitudin in auctor mauris 
                        venenatis.</p>
                </section>

                <h2>Forth Step</h2>
                <section>
                    <p>Quisque at sem turpis, id sagittis diam. Suspendisse malesuada eros posuere mauris vehicula vulputate. Aliquam sed sem tortor. 
                        Quisque sed felis ut mauris feugiat iaculis nec ac lectus. Sed consequat vestibulum purus, imperdiet varius est pellentesque vitae. 
                        Suspendisse consequat cursus eros, vitae tempus enim euismod non. Nullam ut commodo tortor.</p>
                </section>
            </div>

            </div>
        </div>
    </section>
  
  
  
   </div>
   
    
<?php get_footer(); ?>
