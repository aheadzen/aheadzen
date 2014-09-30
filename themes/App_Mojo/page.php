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
					
            </div>

        </div>
			
			<?php endwhile; ?>
		<?php endif; ?>
        </div>
    </section>
  
  
  
   </div>
   
    
<?php get_footer(); ?>
