<?php
/**
 * Plugin Name:       Gazi Related Posts
 * Plugin URI:        https://gaziakter/plugin/gazi-related-posts/
 * Description:       Gazi Related Posts for WordPress offers you the ability to link related posts to each other with just 1 click!
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
class Gazi_post_related{

    //construct function for hook
    public function __construct(){
        add_action( 'init', array($this, 'gazi_load_textdomain') );

    }

    // textdomain funciton
    function gazi_load_textdomain() {
        load_theme_textdomain( 'gazi-post', plugin_dir_path( __FILE__ ) . '/languages' );
    }

}

new Gazi_post_related();