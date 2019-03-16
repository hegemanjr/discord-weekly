<?php
/**
 * @link              https://hegeman.me
 * @since             1.0.0
 * @package           WP_Weclome_User
 *
 * @wordpress-plugin
 * Plugin Name:       WP Weclome User
 * Plugin URI:        https://608.software
 * Description:       Make a logged in user feel welcome to your site! Customize their experience when they first log in with something personalized. Remove default welcome panel and widgets from user dashboard. Add custom welcome panel
 * Version:           1.0.0
 * Author:            Jeff Hegeman
 * Author URI:        https://hegeman.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       WP_Weclome_User
 */
class WP_Welcome_User {

    function __construct() {
        add_action('init', array($this, 'action_init'));
        add_action( 'widgets_init', array($this, 'reg_dash_widgets'));
    }

    public function action_init() {
        register_activation_hook( __FILE__, array($this, 'activate_plugin_name'));
        register_deactivation_hook( __FILE__, array($this, 'deactivate_plugin_name'));
        remove_action('welcome_panel', 'wp_welcome_panel');
        add_action('wp_login', array($this, 'action_wp_login'));
        add_action('admin_menu', array($this, 'action_admin_menu'));
        add_action('admin_init', array($this, 'action_admin_init'));
        add_action('wp_dashboard_setup', array($this, 'action_wp_dashboard_setup'));
        add_action( 'admin_enqueue_scripts', array($this, 'action_admin_enqueue_scripts'));
        add_action('welcome_panel', array($this, 'action_welcome_panel'));
    }

    // Do Stuff on the wp_login action
    function action_wp_login(){

    }

    function dash01_widget(){
        ?>
            <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                <?php dynamic_sidebar( 'dash_widget_01' ); ?>
            </div><!-- #primary-sidebar -->
        <?php
    }

    function dash02_widget(){
        ?>
            <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                <?php dynamic_sidebar( 'dash_widget_02' ); ?>
            </div><!-- #primary-sidebar -->
        <?php
    }

    function reg_dash_widgets() {

        register_sidebar( array(
            'name'          => 'Dashboard Widget 01',
            'id'            => 'dash_widget_01',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="rounded">',
            'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
            'name'          => 'Dashboard Widget 02',
            'id'            => 'dash_widget_02',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="rounded">',
            'after_title'   => '</h2>',
        ) );

    }



    // Do Stuff on the admin_menu action
    function action_admin_menu(){
        $this->disable_default_dashboard_widgets();
    }

    // Do Stuff on the admin_init action
    function action_admin_init(){
        if ( is_active_sidebar( 'dash_widget_01' ) ){
            add_meta_box('dash01', 'Dashboard Widget Area 1', array($this, 'dash01_widget'), 'dashboard', 'side', 'high');
        }
        if ( is_active_sidebar( 'dash_widget_02' ) ){
            add_meta_box('dash02', 'Dashboard Widget Area 2', array($this, 'dash02_widget'), 'dashboard', 'normal', 'high');
        }


    }

    // Do Stuff on the wp_dashboard_setup action
    function action_wp_dashboard_setup() {

    }

    // Do Stuff on the admin_enqueue_scripts action
    function action_admin_enqueue_scripts($hook){
        // Load only on dashboard
        $screen = get_current_screen();
        if($screen->base == 'dashboard'){
            wp_enqueue_style( 'custom_wp_admin_css', plugin_dir_url(__FILE__).'/css/admin.css' );
        }
    }

    // Do Stuff on the welcome_panel action
    function action_welcome_panel(){
        $custom_template = locate_template('user-dash-welcome-panel.php');
        if($custom_template){
            include $custom_template;
        }else{
            include (plugin_dir_path(__FILE__) . 'user-dash-welcome-panel.php');
        }
    }

    // disable default dashboard widgets
    function disable_default_dashboard_widgets() {
        // disable default dashboard widgets
        remove_meta_box('dashboard_right_now', 'dashboard', 'core');
        remove_meta_box('dashboard_activity', 'dashboard', 'core');
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
        remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
        remove_meta_box('dashboard_plugins', 'dashboard', 'core');

        remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
        remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
        remove_meta_box('dashboard_primary', 'dashboard', 'core');
        remove_meta_box('dashboard_secondary', 'dashboard', 'core');

        // disable Simple:Press dashboard widget
        remove_meta_box('sf_announce', 'dashboard', 'normal');
    }

    function activate_plugin() {
        // Do stuff
    }

    function deactivate_plugin() {
        // Do stuff
    }
}
new WP_Welcome_User();