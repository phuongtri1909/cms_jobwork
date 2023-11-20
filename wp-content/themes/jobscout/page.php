<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package JobScout
 */
get_header();

if (is_page('news')) {
	$blog_heading = get_theme_mod( 'blog_section_title', __( 'Latest Articles', 'jobscout' ) );
	$sub_title    = get_theme_mod( 'blog_section_subtitle', __( 'We will help you find it. We are your first step to becoming everything you want to be.', 'jobscout' ) );
	$blog         = get_option( 'page_for_posts' );
	$label        = get_theme_mod( 'blog_view_all', __( 'See More Posts', 'jobscout' ) );
	$hide_author  = get_theme_mod( 'ed_post_author', false );
	$hide_date    = get_theme_mod( 'ed_post_date', false );
	$ed_blog      = get_theme_mod( 'ed_blog', true );
	
	$args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 8,
		'ignore_sticky_posts' => true
	);
	
	$qry = new WP_Query( $args );
	
	if( $ed_blog && ( $blog_heading || $sub_title || $qry->have_posts() ) ){ ?>
	<div id="newest-blog">
		<section id="blog-section" class="article-section">
			<div class="container">
				<?php 
					if( $blog_heading ) echo '<h2 class="section-title">' . esc_html( $blog_heading ) . '</h2>';
					if( $sub_title ) echo '<div class="section-desc">' . wpautop( wp_kses_post( $sub_title ) ) . '</div>'; 
				?>
				<?php if( $qry->have_posts() ){ ?>
						<div class="row blog-all-item gy-5">
								<?php 
								while( $qry->have_posts() ){
									$qry->the_post(); ?>
									<div class="col-md-6 blog-item">
										<div class="p-3 bg-light blog-item1">
											<div class="row">
												<div class="col-md-5">
													<figure class="post-thumbnail">
														<a href="<?php the_permalink(); ?>" class="post-thumbnail">
														<?php 
															if( has_post_thumbnail() ){
																the_post_thumbnail( 'jobscout-blog', array( 'itemprop' => 'image' ) );
															}else{ 
																jobscout_fallback_svg_image( 'jobscout-blog' ); 
															}                            
														?>                        
														</a>
													</figure>
												</div>
												<div class="col-md-7 blog-item-text">
													<article class="post">
														<header class="entry-header">
															<h3 class="entry-title">
																<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
															</h3>
															<div class="entry-excerpt">
																<?php the_excerpt(); ?>
															</div>
															<div class="read-more">
																<a href="<?php the_permalink(); ?>">Read More</a>
															</div>
														</header>
													</article>
												</div>
											</div>
										</div>
									</div>			
									<?php 
								}
								wp_reset_postdata();
								?>
						</div><!-- .row -->
					<!-- <?php if( $blog && $label ){ ?>
						<div class="btn-wrap">
							<a href="<?php the_permalink( $blog ); ?>" class="btn"><?php echo esc_html( $label ); ?></a>
						</div>
					<?php } ?> -->
				
				<?php } ?>
			</div>
		</section>
	</div>
	<?php 
	}
	} else {?>
		<div class="custom-page">
			<div id="primary" class="content-area">
				<main id="main" class="site-main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				/**
                 * Comment Template
                 * 
                 * @hooked jobscout_comment
                */
                do_action( 'jobscout_after_page_content' );

			endwhile; // End of the loop.
			?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
	<?php }?>
	
<?php
?>
<div class="raratheme-client-logo-holder">
	<div class="raratheme-client-logo-inner-holder">
		<div class="fex items-center py-10 w-full gap-x-5 mrNewsletter1">                        
	   		<div class="w-1/5 font-extrabold text-white text-left newsletters ">
				 <div class="bg-[#ea751e] ">
					<div class="container newsletters1">
						<div class="fex items-center py-10 w-full gap-x-5 brnewsletter ">
							<div class="contentFooter">
						 		<?php echo do_shortcode('[contact-form-7 id="89dc36f" title="Email"]'); ?>
							</div>
						</div>
					</div>
				</div>
	 		</div>
		</div>
	</div>
</div>
<?php
// get_sidebar();
get_footer();
