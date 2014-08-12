<?php
/*
Plugin Name: Nichlas Dam Contact Form
Plugin URI: http://nichlasdam.dk/
Description: Kontakt form   
Author: Nichlas Dam
Version: 1.0
Author URI: http://nichlasdam.dk/
*/

class wp_my_plugin extends WP_Widget {
 
    function wp_my_plugin() {
        parent::WP_widget(false, $name = __('Mit første plugin/widget', 'wp_widget_plugin') );
    }
    
    function form($instance) {
        if( $instance) {
            $title = esc_attr($instance['title']);
            $text = esc_attr($instance['text']);   
            $textarea = esc_textarea($instance['textarea']);
            $checkbox =esc_attr($instance['checkbox']);
        } else {
            $title = '';
            $text = '';
            $textarea = '';
        }
        ?>
    <p>
        <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Widget titel', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>"             type="text" value="<?php echo $title; ?>" />     
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Tekst:', 'wp_widget_plugin'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"              type="text" value="<?php echo $text; ?>" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('textarea'); ?>">
            <?php _e('Tekstområde:', 'wp_widget_plugin'); ?></label>
        <textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
    </p>

    <?php
    }
    
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags ($new_instance['title']);
        $instance['text'] = strip_tags ($new_instance['text']);
        $instance['textarea'] = strip_tags ($new_instance['textarea']);
        return $instance;
    }
    
    function widget($args, $instance) {
        extract( $args );
        //Widget options
        $title = apply_filters('widget_title', $instance['title']);
        $ext = $instance['text'];
        $textarea = $instance['textarea'];
        echo $before_widget;
        
        //Vis widget
        echo '<div class="widget-text wp_widget_plugin_box">';
        
        //tjek om title er sat
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
        
        //tjek om text er sat
        if( $text ) {
            echo '<p class="wp_widget_plugin_text">'.$text.'</p>';   
        }
        
        //tjek om textarea er sat
        if( $textarea ) {
            echo '<p class="wp_widget_plugin_textarea">'.$textarea.'</p>';   
        }
        echo '</div>';
        echo $after_widget;
}
}
add_action('widgets_init', create_function('', 'return register_widget("wp_my_plugin");'));
?>