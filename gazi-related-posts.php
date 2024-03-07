<?php
/**
 * Plugin Name:       Gazi Related Posts
 * Plugin URI:        https://gaziakter/plugin/gazi-related-posts/
 * Description:       Gazi Related Posts for WordPress offers you the ability to link related posts to each other.
 * Version:           1.0.0
 * Author:            Gazi Akter
 * Author URI:        https://gaziakter.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       gazi-post
 * Domain Path:       /languages
 */

 if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Main Class
class Gazi_related_post{

    //construct function for hook
    public function __construct(){
        add_action( 'init', array($this, 'gazi_load_textdomain') );
        add_filter( 'the_content', array($this, 'gazi_show_related_post'));

    }

    // textdomain funciton
    public function gazi_load_textdomain() {
        load_theme_textdomain( 'gazi-post', plugin_dir_path( __FILE__ ) . '/languages' );
    }

    //show related posts
    public function  gazi_show_related_post($content){
        if(is_singular()){
  
            $args = array(
                'post__not_in' => array(get_the_ID(  )),
                'post_type' => 'post',
                'posts_per_page' => 5,
                'orderby' => 'rand',
                'category__in' => wp_get_post_categories(get_the_ID(  )), 
            );

            // The Query.
            $related_posts_query = new WP_Query( $args );
            
            //Loop
            if ($related_posts_query->have_posts()) {
                $related_posts_content = '<div class="related-posts"><h2>'. __( 'Related Posts', 'gazi-post' ) .'</h2>';
                while ($related_posts_query->have_posts()) {
                    $related_posts_query->the_post();
                    $related_posts_content .= '<div class="post-content-area">';
                    $related_posts_content .= get_the_post_thumbnail();
                    $related_posts_content .= '<h2 class="post-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
                    $related_posts_content .= '</div>';
                }
                $related_posts_content .= '</div>';
                wp_reset_postdata();

                // Append related posts content to the main content
                $content .= $related_posts_content;
            }
            
            return $content;
        }
    }
}

new Gazi_related_post();
