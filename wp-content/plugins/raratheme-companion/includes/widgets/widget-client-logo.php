<?php
/**
 * Client Logo Widget
 *
 * @package Rara_Theme_Companion
 */

// register RaraTheme_Client_Logo_Widget widget
function raratheme_register_client_logo_widget(){
    register_widget( 'RaraTheme_Client_Logo_Widget' );
}
add_action('widgets_init', 'raratheme_register_client_logo_widget');
 
 /**
 * Adds RaraTheme_Client_Logo_Widget widget.
 */
class RaraTheme_Client_Logo_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
			'raratheme_client_logo_widget', // Base ID
			__( 'Rara: Client Logo', 'raratheme-companion' ), // Name
			array( 'description' => __( 'A Client Logo Widget.', 'raratheme-companion' ), ) // Args
		);
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        
        $obj   = new RaraTheme_Companion_Functions();
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '' ;
        $image = ! empty( $instance['image'] ) ? $instance['image'] : '';
        $link  = ! empty( $instance['link'] ) ? $instance['link'] : '';

        $display_bw = '';
        if ( isset( $instance['display_bw'] ) && $instance['display_bw']!= '' )
        {
            $display_bw = 'black-white';
        }
        echo $args['before_widget'];
        ob_start(); 
        ?>
            <div class="raratheme-client-logo-holder">
                <div class="raratheme-client-logo-inner-holder">
                    <div class="fex items-center py-10 w-full gap-x-5 mrNewsletter1">                        
                   <div class="w-1/5 font-extrabold text-white text-left newsletters ">
                     <div class="bg-[#ea751e] ">
                            <div class="container newsletters1 ">
                                <div class="fex items-center py-10 w-full gap-x-5 brnewsletter ">
                                <div class="contentFooter">
                                     <?php echo do_shortcode('[contact-form-7 id="89dc36f" title="Email"]'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
			</div>
        <?php
        $html = ob_get_clean();
        echo apply_filters( 'raratheme_companion_cl', $html, $args, $title, $image, $link );   
        echo $args['after_widget'];
    }

    /**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        $obj        = new RaraTheme_Companion_Functions();
        $title      = ! empty( $instance['title'] ) ? $instance['title'] : '' ;
        $display_bw = ! empty( $instance['display_bw'] ) ? $instance['display_bw'] : '' ;
        $image      = ! empty( $instance['image'] ) ? $instance['image'] : '';
        $target     = ! empty( $instance['target'] ) ? $instance['target'] : '';
        $link       = ! empty( $instance['link'] ) ? $instance['link'] : '';
        
        ?>
		
        <script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('.widget-client-logo-repeater').sortable({
                    cursor: 'move',
                    update: function (event, ui) {
                        $('.widget-client-logo-repeater .link-image-repeat input').trigger('change');
                    }
                });
                $('.check-btn-wrap').on('click', function( event ){
                    $(this).trigger('change');
                });
            });
        </script>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'raratheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />            
		</p>
        
        <p>
            <label class="check-btn-wrap" for="<?php echo esc_attr( $this->get_field_id( 'display_bw' ) ); ?>"><?php esc_html_e( 'Display logo in black and white', 'raratheme-companion' ); ?><input id="<?php echo esc_attr( $this->get_field_id( 'display_bw' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_bw' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $display_bw ); ?>/></label>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open in New Tab', 'raratheme-companion' ); ?>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="checkbox" value="1" <?php echo checked($target,1);?> /> </label>
        </p>

        <div class="widget-client-logo-repeater" id="<?php echo esc_attr( $this->get_field_id( 'rarathemecompanion-logo-repeater' ) ); ?>">
            <p>
            <?php
            if(isset($instance['image']))
            {
                if( count( array_filter( $instance['image'] ) ) != 0 )
                { 
                    foreach ( $instance['image'] as $key => $value) 
                    {   ?>
                        <div class="link-image-repeat" data-id="<?php echo $key;?>"><span class="cross"><i class="fas fa-times"></i></span>
                            <?php
                            $obj->raratheme_companion_get_image_field( $this->get_field_id( 'image['.$key.']' ), $this->get_field_name( 'image['.$key.']' ),  $instance['image'][$key], __( 'Upload Image', 'raratheme-companion' ) ); ?>
                            <label for="<?php echo esc_attr( $this->get_field_id( 'link['.$key.']' ) ); ?>"><?php esc_html_e( 'Featured Link', 'raratheme-companion' ); ?></label> 
                            <input class="widefat demo" id="<?php echo esc_attr( $this->get_field_id( 'link['.$key.']' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link['.$key.']' ) ); ?>" type="text" value="<?php echo isset($instance['link'][$key]) && !empty($instance['link'][$key]) ? esc_url( $instance['link'][$key] ) : ''; ?>" />            
                        </div>
                <?php
                    }
                }
            }
            ?>
            </p>
        <span class="cl-repeater-holder"></span>
        </div>
        <button id="add-logo" class="button"><?php _e('Add Another Logo','raratheme-companion');?></button>
	<?php
    }
    
    /**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

        $instance               = array();
        $instance['title']      = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '' ;
        $instance['display_bw'] = ! empty( $new_instance['display_bw'] ) ? sanitize_text_field( $new_instance['display_bw'] ) : '' ;
        $instance['target']     = ! empty( $new_instance['target'] ) ? esc_attr( $new_instance['target'] ) : '';
        
        if(isset($new_instance['image']))
        {
            if( count( array_filter( $new_instance['image'] ) ) != 0 )
            { 
                foreach ( $new_instance['image'] as $key => $value ) {
                    $instance['image'][$key]   = $value;
                }
            }
        }

        if(isset($new_instance['link']))
        {
            if( count( array_filter( $new_instance['link'] ) ) != 0 )
            { 
                foreach ( $new_instance['link'] as $key => $value ) {
                    $instance['link'][$key]    = $value;
                }
            }
        }
        
        return $instance;
	}
    
}  // class RaraTheme_Client_Logo_Widget