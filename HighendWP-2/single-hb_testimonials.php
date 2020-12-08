<?php
/**
 * The template for displaying testimonial single pages.
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package     Highend
 * @since       3.5.0
 */

?>

<?php get_header(); ?>

<div id="main-content">
	<div class="container">

		<?php 
		$sidebar_layout = vp_metabox('layout_settings.hb_page_layout_sidebar'); 
		$sidebar_name = vp_metabox('layout_settings.hb_choose_sidebar');

		if ( $sidebar_layout == "default" || $sidebar_layout == "" ) {
			$sidebar_layout = hb_options('hb_page_layout_sidebar'); 
			$sidebar_name = hb_options('hb_choose_sidebar');
		}
		?>

		<div class="row <?php echo $sidebar_layout; ?> main-row">
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
			<?php if ( $sidebar_layout != "fullwidth") { ?>
				<div class="col-9 hb-equal-col-height hb-main-content">
			<?php } else { ?>
				<div class="col-12 hb-main-content">
			<?php } ?>

				<div class="single-blog-wrapper clearfix">

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemType="https://schema.org/BlogPosting">

						<div class="single-post-content">
		
							<?php highend_testimonial_box( get_the_ID() ); ?>

						</div>
						<!-- END .single-post-content -->
					</article>

					<section class="bottom-meta-section clearfix">

						<?php if ( hb_options( 'hb_blog_enable_likes' ) ) { ?>
							<div class="float-right">
								<?php echo hb_print_likes( get_the_ID() ); ?>
							</div>
						<?php } ?>

						<?php if ( hb_options( 'hb_blog_enable_share' ) ) { ?>
							<div class="float-right">
								<?php get_template_part ( 'includes/hb' , 'share' ); ?>
							</div>
						<?php } ?>

						<?php if ( comments_open() && hb_options( 'hb_blog_enable_comments' ) ) { ?>

							<div class="float-right comments-holder">
								<a href="<?php the_permalink(); ?>#comments" class="comments-link scroll-to-comments" title="<?php _e('View comments on ', 'hbthemes'); the_title(); ?>"><?php comments_number( __( '0 Comments' , 'hbthemes' ) , __( '1 Comment' , 'hbthemes' ), __( '% Comments' , 'hbthemes' ) ); ?></a>
							</div>

						<?php } ?>

					</section>
				</div><!-- END .single-blog-wrapper -->
				
				<?php
				if ( comments_open() ) {
					comments_template(); 
				}
				?>

			</div><!-- END .hb-main-content -->

			<?php if ( $sidebar_layout != "fullwidth" ){ ?>
				
				<div class="col-3 hb-equal-col-height hb-sidebar">
					<?php 		
					if ( $sidebar_name && function_exists( 'dynamic_sidebar' ) ) {
						dynamic_sidebar( $sidebar_name );
					}
					?>
				</div><!-- END .hb-sidebar -->

			<?php } ?>

		<?php endwhile; endif; ?>	

		</div>
	</div>
</div><!-- END #main-content -->

<?php
get_footer();
