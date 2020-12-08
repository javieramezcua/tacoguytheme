<?php
/**
 * The template for displaying single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Highend
 * @since   1.0.0
 */

?>

<?php get_header(); ?>

<div id="main-content"<?php highend_main_content_style(); ?>>

	<div class="container">

		<div class="row main-row <?php echo highend_get_page_layout(); ?>">

			<?php do_action( 'highend_main_content_start' ); ?>
		
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<div class="single-blog-wrapper clearfix">
					
					<?php do_action( 'highend_before_single_content' ); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class( get_post_format() . '-post-format single' ); ?> itemscope itemType="https://schema.org/BlogPosting">
						
						<?php 
						// Featured image.
						if ( hb_options( 'hb_blog_enable_featured_image' ) && ! vp_metabox( 'general_settings.hb_hide_featured_image' ) ) {
							get_template_part( 'template-parts/entry/format/media' , get_post_format() ) ; 
						}
						?>

						<!-- Post Content -->
						<div class="single-post-content">
		
							<?php if ( ! is_attachment() ) { ?>	
								<!-- Post Header -->
								<div class="post-header">
									
									<h1 class="title entry-title" itemprop="headline"><?php the_title(); ?></h1>

									<!-- Post Meta -->
									<div class="post-meta-info">
										
											<?php if ( hb_options('hb_blog_enable_date' ) ) { ?>
												<!-- Post Date -->
												<span class="post-date minor-meta date updated">
													<time datetime="<?php echo esc_attr( get_the_time('c') ); ?>" itemprop="datePublished">
														<?php the_time( get_option( 'date_format' ) ); ?>
													</time>
												</span>
											<?php } ?>

											<?php if ( hb_options('hb_blog_enable_by_author') ) { ?>

												<!-- Post Author -->
												<span class="blog-author minor-meta">
													<?php esc_html_e( 'Posted by' , 'hbthemes' ); ?>
													<span class="entry-author-link" itemprop="name">
														<span class="vcard author">
															<span class="fn">
																<a href="<?php echo esc_url( get_author_posts_url ( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php esc_html_e( 'Posts by', 'hbthemes' ); echo ' '; the_author_meta( 'display_name' ); ?>" rel="author"><?php the_author_meta( 'display_name' ); ?></a>
															</span>
														</span>
													</span>
												</span>
											<?php } ?>

										<?php if ( has_category() && hb_options( 'hb_blog_enable_categories' ) ) { ?>
											<!-- Categories -->
											<span class="blog-categories minor-meta"> 
												<?php echo wp_kses_post( get_the_category_list( ', ') ); ?>
											</span>
										<?php } ?>

										<?php if ( comments_open() && hb_options( 'hb_blog_enable_comments' ) ) { ?>
											<!-- Comments -->
											<span class="comment-container minor-meta">
												<?php comments_popup_link( esc_html__( 'No Comments', 'hbthemes' ), esc_html__( '1 Comment', 'hbthemes' ), esc_html__( '% Comments', 'hbthemes' ), 'comments-link scroll-to-comments' ); ?>
											</span>
										<?php } ?>
									</div>
									<!-- END .post-meta-info -->

								</div>
							<?php } ?>
							
							<?php if ( ! has_post_format( 'quote' ) && ! has_post_format( 'link' ) && ! has_post_format( 'status' ) ) { ?>
								<!-- Post Content -->
								<div class="entry-content clearfix" itemprop="articleBody">
									
									<?php the_content(); ?>
									
									<div class="page-links">
										<?php wp_link_pages( array(
											'next_or_number'   => 'next',
											'previouspagelink' => ' <i class="icon-angle-left"></i> ',
											'nextpagelink'     => ' <i class="icon-angle-right"></i>'
											) );
										?>		
									</div>
								</div>
							<?php } ?>

							<?php
							if ( hb_options( 'hb_blog_enable_tags' ) ) {
								the_tags( '<div class="single-post-tags"><span>' . esc_html__( 'Tags', 'hbthemes' ) . ': </span>', '', '</div>' ); 
							}
							?>

						</div><!-- END .single-post-content -->

					</article>

					<?php if ( ! is_attachment() ) { ?>

						<!-- Bottom meta -->
						<section class="bottom-meta-section clearfix">

							<?php if ( comments_open() && hb_options('hb_blog_enable_comments') ) { ?>
								<div class="float-left comments-holder">
									<?php comments_popup_link( esc_html__( 'No Comments', 'hbthemes' ), esc_html__( '1 Comment', 'hbthemes' ), esc_html__( '% Comments', 'hbthemes' ), 'comments-link scroll-to-comments' ); ?>
								</div>
							<?php } ?>

							<?php if ( hb_options( 'hb_blog_enable_likes' ) ) { ?>
								<div class="float-right">
									<?php echo hb_print_likes( get_the_ID() ); ?>
								</div>
							<?php } ?>

							<?php if ( hb_options( 'hb_blog_enable_share' ) ) { ?>
								<div class="float-right">
									<?php get_template_part( 'includes/hb' , 'share' ); ?>
								</div>
							<?php } ?>

						</section>
					<?php } ?>

					<?php do_action( 'highend_after_single_content' ); ?>

				</div><!-- END #single-blog-wrapper -->

				<?php
				if ( ! is_attachment() && comments_open() ) {
					comments_template();
				}
				?>

			<?php endwhile; endif; ?>	

			<?php do_action( 'highend_main_content_end' ); ?>

		</div><!-- END .row -->

	</div><!-- END .container -->

</div><!-- END #main-content -->

<?php get_footer(); ?>
