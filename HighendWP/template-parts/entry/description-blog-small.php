<?php
/**
 * Template part for displaying entry description for template: Blog Small.
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
<div class="small-post-content">

	<h3 class="title" itemprop="headline">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h3>

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
</div><!-- END .small-post-content -->

<div class="clear"></div>

<div class="meta-info clearfix">

	<div class="float-left">

		<?php if ( hb_options( 'hb_blog_enable_by_author' ) ) { ?>
			<!-- Author -->
			<span class="blog-author minor-meta">
				
				<?php esc_html_e( 'By' , 'hbthemes' ); ?>
				<span class="entry-author-link" itemprop="name">
					<span class="vcard author">
						<span class="fn">
							<a href="<?php echo esc_url( get_author_posts_url ( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php esc_html_e( 'Posts by', 'hbthemes' ); echo ' '; the_author_meta( 'display_name' ); ?>" rel="author"><?php the_author_meta( 'display_name' ); ?></a>
						</span>
					</span>
				</span>
			</span>
		<?php } ?>

		<?php if ( hb_options( 'hb_blog_enable_date' ) ) { ?>
			<span class="updated minor-meta">
				<time datetime="<?php echo get_the_time('c'); ?>" itemprop="datePublished">
					<?php the_time( get_option( 'date_format' ) ); ?>
				</time>
			</span>
		<?php } ?>

		<?php if ( has_category() && hb_options( 'hb_blog_enable_categories' ) ) { ?>
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

	<?php if ( hb_options( 'hb_blog_read_more_button' ) ) { ?>
		<div class="float-right">
			<a href="<?php the_permalink(); ?>" class="read-more-button"><?php esc_html_e( 'Read More ' , 'hbthemes' ); ?><i class="icon-double-angle-right"></i></a>
		</div>
	<?php } ?>
	
</div>
