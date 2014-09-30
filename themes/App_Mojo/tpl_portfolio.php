<?php
/*
Template Name: Portfolio
*/
?>
<?php get_header(); ?>
<style>.one-third {width: 31%;}.portfolio-detail {min-height: 65px;}</style>
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
				
				<div class="portfolio-container1">
				<?php
				$args = array(
					'post_type' => 'portfolio',
					'posts_per_page' => -1,
					);
				// The Query
				query_posts( $args );

				// The Loop
				while ( have_posts() ) : the_post();
					$pid=get_the_id();
					$designation = get_post_meta($pid,'designation',true);
						$post_data = array();
						//$sql = "select t.name from $wpdb->terms t join $wpdb->term_taxonomy tt on tt.term_id=t.term_id join ";
						$big_image = wp_get_attachment_url( get_post_thumbnail_id($pid) );
						$post_data['id']=$pid;
						$post_data['title']=get_the_title();
						$post_data['cat']=$category;
						$post_data['bimage']=$big_image;
						$post_data['link']=get_permalink();
						$post_data['image']=get_the_post_thumbnail($pid, array(510,400));
						$post_data_arr[] = $post_data;
						?>
						 <div class=" one-third column ">
                        <div class="portfolio-thumb">
                            <?php the_post_thumbnail($pid, array(510,400));?>                
                        </div>
                        <div class="portfolio-detail">
                            <div class="portfolio-title">
                                <h4><a href="#"><?php the_title();?></a></h4>
                            </div>
                        </div>
                    </div>
						<?php
				endwhile;

				// Reset Query
				wp_reset_query();
			?>
			    
                    
                   
					
					
					
                </div>

            </div>
        </div>
    </section>
  
  
  
   </div>
   
    
<?php get_footer(); ?>
