<?php get_header(); ?>
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
		
        <div class="content-main">
            <div class="container">         
                               
                <div class="margin30"></div>
				<?php the_content();?>
				<div class="margin50"></div>
				<?php
			// Previous/next post navigation.
			twentyfourteen_post_nav();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
			comments_template();
			}
			?>
            </div>
			
        </div>
			
			<?php endwhile; ?>
		<?php endif; ?>
        </div>
    </section>
  
  
  
   </div>
   
    
<?php get_footer(); ?>
