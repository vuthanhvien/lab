<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content , $matches);
$first_img = $matches [1] [0];
$img = get_the_post_thumbnail() ? get_the_post_thumbnail() :  '<img src="'.$first_img.'">' ;
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = urlencode($actual_link);
?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="post-detail">
		<div class="post-banner">
			<?php echo $img ?>
		<div class="post-banner-content">
			<h1><?php echo get_the_title() ?></h1>
			<h3><?php echo get_the_date() ?></h3>
		</div>
		</div>
		<div class="post-main">
			<div class="post-sidebar">

			<p>Share</p>
				<a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $actual_link ?>" class="post-share">
					<i class="fa fa-twitter"></i>
					<span>Tweet</span>
				</a>
				<a  target="_blank" href="https://www.facebook.com/sharer/sharer.php=<?php echo $actual_link ?>" class="post-share">
					<i class="fa fa-facebook"></i>
					<span>Share</span>
				</a>
				<a  target="_blank" href="https://www.linkedin.com/shareArticle?mini=<?php echo $actual_link ?>" class="post-share">
					<i class="fa fa-linkedin"></i>
					<span>Post</span>
				</a>
				<a  target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo $actual_link ?> " class="post-share">
					<i class="fa fa-envelope"></i>
					<span>Sent</span>
				</a>
			
			</div>
			<div class="post-content">
				<div class="post-header">
					<div class="post-author"><?php echo get_avatar( get_the_author_meta( 'ID' )) ?></div>
					<span class="post-author-name"><? echo get_the_author_meta('display_name') ?></span>
					<div class="post-space"></div>
						<img class="icon" src="/assets/heart.png" />
						<?php echo get_comments_number() ?>
						<img  class="icon" src="/assets/share.png" />
						<?php echo get_comments_number() ?>
						<img  class="icon" src="/assets/chat.png" />
						<?php echo get_comments_number() ?>
						
				</div>
				<div class="post-video">
				<?php if(get_field('video_url')){
					?>
						<iframe width="100%" height="500" src="<?php echo get_field('video_url') ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					<?php
				} ?>
				</div>
				<div class="post-text">
					<?php the_content(); ?>

					<hr>
					<div class="post-action">
					<button class="btn btn-seconday">
						<img class="icon" src="/assets/heart.png" />
					</button>
					<button class="btn btn-warning" id="view-comment">
						<img class="icon" src="/assets/chat.png" />
						<?php echo get_comments_number() ?> comments
					</button>

					</div>
					<hr>
				</div>

					<div class="post-next">
						<h3>Up Next</h3>
						<?php echo do_shortcode('[posts limit="4" fields="img,category,title"]'); ?>
					</div>
					

				</div>
			</div>
		</div>

		<div class="post-relate-outer">
		<h3>Related Articles</h3>

		<div class="post-relate">
			<div class="post-relate-left">
			<?php echo do_shortcode('[posts limit="1" fields="img,category,title"]'); ?>
			</div>
			<div class="post-relate-right">
			<?php echo do_shortcode('[posts limit="4" fields="img,category,title"]'); ?>
			</div>
		
		</div>
		</div>

	</div>


	<div class="post-comment-out">
	<div class="post-comment">
	<?php

		if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
			?>

			<div class="comments-wrapper section-inner">

				<?php comments_template(); ?>

			</div><!-- .comments-wrapper -->

			<?php
		}
		?>
		</div>
		</div>

	

</article><!-- .post -->
