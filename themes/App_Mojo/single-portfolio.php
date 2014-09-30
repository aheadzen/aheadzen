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
				<?php 
				if ( has_post_thumbnail() ) {
					the_post_thumbnail('large', array('class' => 'alignleft')); 
				}				
				?>
                <div class="margin50"></div>
				<p><?php the_content();?></p>
				<div class="margin50"></div>
			</div>
			
        </div>			
			<?php endwhile; ?>
		<?php endif; ?>
        </div>
    </section>
  
  
  
   </div>
   
    
<?php get_footer(); ?>
