<?php
/**
 * Template part for displaying entry description.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package     Highend
 * @since       3.5.1
 */

/**
 * Do not allow direct script access.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="post-content">

	<?php if ( hb_options( 'hb_blog_enable_date' ) ) { ?>
		<!-- Post Date -->
		<div class="hb-post-date float-left">
			
			<time datetime="<?php echo esc_html( get_the_time( 'c' ) ); ?>" itemprop="datePublished">
				<span class="day"><?php echo esc_html( the_time( 'd' ) ); ?></span>
				<span class="month"><?php echo esc_html( the_time( 'M' ) ); ?></span>
			</time>

			<?php
			if ( hb_options( 'hb_blog_enable_likes' ) ) {
				echo hb_print_likes( get_the_ID() ); 
			}
			?>
		</div>
	<?php } ?>

	<div class="post-inner">

		<!-- Post Header -->
		<div class="post-header">

			<!-- Title -->
			<h2 class="title" itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					
			<!-- Post Meta -->				
			<div class="post-meta-info">
				
				<?php if ( hb_options( 'hb_blog_enable_by_author' ) ) { ?>
					<!-- Author -->
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

				<?php if ( has_category() && hb_options('hb_blog_enable_categories') ) { ?>
					<!-- Categories -->
					<span class="blog-categories minor-meta"> 
						<?php echo wp_kses_post( get_the_category_list( ', ') ); ?>
					</span>
				<?php } ?>

				<?php if ( ( comments_open() || get_comments_number() ) && hb_options( 'hb_blog_enable_comments' ) ) { ?>
					<!-- Comments -->
					<span class="comment-container minor-meta">
						<?php comments_popup_link( esc_html__( 'No Comments', 'hbthemes' ), esc_html__( '1 Comment', 'hbthemes' ), esc_html__( '% Comments', 'hbthemes' ), 'comments-link' ); ?>
					</span>
				<?php } ?>
			</div>
		</div>

		<!-- Post Content/Excerpt -->
		<div class="hb-post-excerpt clearfix">

			<div class="excerpt">
				<?php 
				if ( post_password_required() ) {
					echo '<p>' . esc_html_e( 'This content is password protected. To view it please go to the post page and enter the password.', 'hbthemes' ) . '</p>';
				} else { 
					if ( hb_options( 'hb_blog_excerpt_disable' ) )  {
						the_content();
					} elseif ( has_excerpt() ) {
						the_excerpt();
					} else {
						$custom_excerpt = wp_trim_words( 
							strip_shortcodes( get_the_content() ),
							hb_options( 'hb_blog_excerpt_length' ),
							'...'
						);

						if ( ! empty( $custom_excerpt ) ) {
							echo wp_kses_post( '<p>' . $custom_excerpt . '</p>' );
						}
					}
				}
				?>
			</div>

			<?php if ( hb_options( 'hb_blog_read_more_button' ) ) { ?>
				<a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Read More', 'hbthemes' ); ?></a>	
			<?php } ?>			
		</div>
	</div><!-- END .post-inner -->

</div><!-- END .post-content -->
