<?php
/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @since       1.0.0
 * @version     1.27.0
 */

 
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

global $post;
$job_salary   = get_post_meta(get_the_ID(), '_job_salary', true);
$job_featured = get_post_meta(get_the_ID(), '_featured', true);
$company_name = get_post_meta(get_the_ID(), '_company_name', true);


?>
<article <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr($post->geolocation_lat); ?>" data-latitude="<?php echo esc_attr($post->geolocation_long); ?>">

    <figure class="company-logo ">
        <?php the_company_logo('thumbnail'); ?>
    </figure>

    <div class="job-title-wrap titles">
        <h2 class="entry-title">
            <a href="<?php the_job_permalink(); ?>"><?php wpjm_the_job_title(); ?></a>
        </h2>
	
		
        <div class="job-meta">
            <?php if ($post->post_date) { ?>
                <div class="job-date">
                    <?php echo get_the_date(); ?>
                </div>
            <?php } ?>
		</div>
			

			<div class="job-info">
				<?php 
				if (get_option('job_manager_enable_types')) { 
					$types = wpjm_get_the_job_types(); 
					if (!empty($types)) : foreach ($types as $jobtype) : ?>
						<li class="job-type <?php echo esc_attr(sanitize_title($jobtype->slug)); ?>"><?php echo esc_html($jobtype->name); ?></li>
					<?php endforeach; endif; 
				}
				do_action('job_listing_meta_end'); 
				?>
				<div class="company-name">
					<?php the_company_name(); ?>
				</div>
				<div class="job-location">
					<?php echo get_the_job_location(); ?>
				</div>
			</div>

            
			</div>
            <div class="job-content noidung">
                <?php
                // Display the first three paragraphs of the job description
                $content = get_the_content();
                $paragraphs = preg_split('/\n\s*\n/', $content, 4, PREG_SPLIT_NO_EMPTY); // Split content into paragraphs
                for ($i = 0; $i < min(3, count($paragraphs)); $i++) {
                    $trimmed_paragraph = wp_trim_words(strip_tags($paragraphs[$i]), 10); // Trim each paragraph
                    echo '<p>' . wpautop($trimmed_paragraph) . '</p>';
                }
                ?>
            </div>
</article>

 
 
