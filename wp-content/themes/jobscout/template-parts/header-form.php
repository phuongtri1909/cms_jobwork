<?php
/**
 *
 * Creating a custom job search form for homepage
 * The [jobs] shortcode is will use search_location and search_keywords variables from the query string.
 *
 * @link https://wpjobmanager.com/document/tutorial-creating-custom-job-search-form/
 *
 * @package JobScout
 */
$find_a_job_link = get_option( 'job_manager_jobs_page_id', 0 );
$post_slug       = get_post_field( 'post_name', $find_a_job_link );
$ed_job_category = get_option( 'job_manager_enable_categories' );  

if( $post_slug ){
    $action_page =  home_url( '/'. $post_slug );
}else {
    $action_page =  home_url( '/' );
}
?>

<div class="job_listings">
  <form class="jobscout_job_filters" method="GET" action="<?php echo esc_url( $action_page ) ?>">
    <div class="search_jobs">
      <div class="row g-3">
        <div class="col-md-7">
          <div class="search_keywords">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path fill="#ea751e" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
            <label for="search_keywords"><?php esc_html_e( 'Keywords', 'jobscout' ); ?></label>
            <input type="text" id="search_keywords" name="search_keywords" placeholder="<?php esc_attr_e( 'Search for jobs, companies, skills', 'jobscout' ); ?>">
          </div>
        </div>
        <div class="col-md-3">
          <div class="search_location">											
            <?php											
            global $wpdb;											
            $table  = $wpdb->prefix . 'postmeta';											
            $sql = "SELECT DISTINCT SUBSTRING_INDEX(`meta_value`,',',-1) as location FROM `wp_postmeta` WHERE `meta_key` like '%location%' ORDER BY location";											
            $data = $wpdb->get_results($wpdb->prepare($sql));											
            ?>		
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"><path fill="#ea751e" d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/></svg>									                  
            <svg id="svg-chevron" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
            <select id="search_location" name="search_location" value="Khu vực">											
              <option value="">Khu vực</option>											
              <?php foreach ($data as $value) : ?>											
              <option value="<?php echo $value->location; ?>"><?php echo $value->location; ?></option>											
              <?php endforeach ?>											
            </select>											                 
          </div>
        </div>
        <div class="col-md-2">
          <div class="search_submit">
            <input type="submit" value="<?php esc_attr_e( 'SEARCH JOB', 'jobscout'); ?>" />
          </div>
        </div>

        <!-- <?php if( $ed_job_category ){ ?>
            <div class="search_categories custom_search_categories">
              <label for="search_category"><?php esc_html_e( 'Job Category', 'jobscout' ); ?></label>
              <select id="search_category" class="robo-search-category" name="search_category">
              <option value=""><?php _e( 'Select Job Category', 'jobscout' ); ?></option>
                <?php foreach ( get_job_listing_categories() as $jobcat ) : ?>
                  <option value="<?php echo esc_attr( $jobcat->term_id ); ?>"><?php echo esc_html( $jobcat->name ); ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        <?php } ?> -->
											
        
      </div>
    </div>
  </form>
</div>