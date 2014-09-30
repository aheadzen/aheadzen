<?php
/*
Template Name: Testimonials
*/
?>
<?php get_header(); ?>
<style>blockquote p {clear: both;display: inline-block; margin-bottom: 20px;}</style>
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
                <div class="testimonial-wrapper">
                    <?php
							$args = array(
									'post_type' => 'testimonial',
									'posts_per_page' => -1,
									);
						// The Query
							query_posts( $args );
						
							// The Loop
							if ( have_posts() ) {
								echo '<ul class="quotes_wrapper">';
								$counter=0;
								// The Loop
								while ( have_posts() ) : the_post();
									$counter++;
									$pid=get_the_id();
									$designation = get_post_meta($pid,'designation',true);
									?>
									<li>
										<figure class="testimonial-thumb <?php if(($counter%2)==0){echo 'alignright';}?> animate" data-animation="fadeInUp">
											<?php the_post_thumbnail($pid, array(180,206));?>   
																						
											
										</figure>
										<div class="testimonial-content-wrapper">
											<div class="author-meta">
												<p><?php the_title();?></p>
												<?php if($designation){?>
												<span><?php echo $designation;?></span>
												<?php }?>
											</div>
											<blockquote> <?php the_content();?> </blockquote>
										</div>
									</li>
									<?php
								endwhile;
								echo '</ul>';
							} 
							/* Restore original Post Data */
							wp_reset_query();
						?>      
                </div>

            </div>
        </div>
    </section>
  
  
  
   </div>
    <!-- contact section Ends here -->
    
    
<?php get_footer(); ?>
