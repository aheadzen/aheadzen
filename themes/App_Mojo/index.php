<?php get_header(); ?>
    
    <!-- Header div Ends here -->
    <div id="main">
    <!-- home section Starts here -->
    <section id="home" class="content">
        <?php if ( is_active_sidebar( 'sliders' ) ) : ?>
            <?php dynamic_sidebar( 'sliders' ); ?>
       <?php else:?>
       <style>#home {padding-bottom: 0px;}</style>
        <?php endif; ?>    
    </section>
    <!-- home section Ends here -->
    
	<!-- Content section Starts here -->
    <?php if($disable1){ }else{?>
    <section id="content_area1" class="content">
       <?php if ( is_active_sidebar( 'content1' ) ) : ?>
            <?php dynamic_sidebar( 'content1' ); ?>
            <?php else:?>
			<?php include_once('default_code.php');?>
            <?php endif; ?> 
            
    </section>
    <?php }?>
	<!-- Content section Ends here -->
    
<?php get_footer(); ?>
