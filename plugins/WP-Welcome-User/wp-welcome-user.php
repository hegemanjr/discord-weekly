<?php
/**
 * @link              https://hegeman.me
 * @since             1.0.0
 * @package           WP_Weclome_User
 *
 * @wordpress-plugin
 * Plugin Name:       WP Weclome User
 * Plugin URI:        https://608.software
 * Description:       Make a logged in user feel welcome to your site! Customize their experience when they first log in with something personalized.
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

    // Do Stuff on the admin_menu action
    function action_admin_menu(){
        $this->disable_default_dashboard_widgets();
    }

    // Do Stuff on the admin_init action
    function action_admin_init(){

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
        ?>

        <div class="custom-welcome-panel-content">
        <h1><img src="<?php echo plugin_dir_url(__FILE__);?>/images/Discord_Thonk_500.png" class="welcome-logo" /><?php $current_user = wp_get_current_user();_e( 'Welcome ' . $current_user->display_name . ' to your dashboard!' ); ?></h1>
        <h3><?php _e( 'Week 01 Discord WordPress challenge!' ); ?></h3>
        <p class="about-description"><?php _e( 'Your challenge for this week: Make a logged in user feel welcome to your site! Customize their experience when they first log in with something personalized.' ); ?></p>
        <div class="welcome-panel-column-container">
            <div class="welcome-panel-column">
                <h4><?php _e( "Let's Get Started" ); ?></h4>
                <a class="button button-primary button-hero load-customize hide-if-no-customize" href="https://hegeman.me/"><?php _e( 'Support!' ); ?></a>
                <p class="hide-if-no-customize"><?php printf( __( 'or, <a href="%s">edit your site settings</a>' ), admin_url( 'options-general.php' ) ); ?></p>
            </div><!-- .welcome-panel-column -->
            <div class="welcome-panel-column">
                <h4><?php _e( 'Next Steps' ); ?></h4>
                <ul>
                    <?php if ( 'page' == get_option( 'show_on_front' ) && ! get_option( 'page_for_posts' ) ) : ?>
                        <li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
                        <li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
                    <?php elseif ( 'page' == get_option( 'show_on_front' ) ) : ?>
                        <li><?php printf( '<a href="%s" class="welcome-icon welcome-edit-page">' . __( 'Edit your front page' ) . '</a>', get_edit_post_link( get_option( 'page_on_front' ) ) ); ?></li>
                        <li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add additional pages' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
                        <li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Add a blog post' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>
                    <?php else : ?>
                        <li><?php printf( '<a href="%s" class="welcome-icon welcome-write-blog">' . __( 'Write your first blog post' ) . '</a>', admin_url( 'post-new.php' ) ); ?></li>
                        <li><?php printf( '<a href="%s" class="welcome-icon welcome-add-page">' . __( 'Add an About page' ) . '</a>', admin_url( 'post-new.php?post_type=page' ) ); ?></li>
                    <?php endif; ?>
                    <li><?php printf( '<a href="%s" class="welcome-icon welcome-view-site">' . __( 'View your site' ) . '</a>', home_url( '/' ) ); ?></li>
                </ul>
            </div><!-- .welcome-panel-column -->
            <div class="welcome-panel-column welcome-panel-last">
                <h4><?php _e( 'More Actions' ); ?></h4>
                <ul>
                    <li><?php printf( '<div class="welcome-icon welcome-widgets-menus">' . __( 'Manage <a href="%1$s">widgets</a> or <a href="%2$s">menus</a>' ) . '</div>', admin_url( 'widgets.php' ), admin_url( 'nav-menus.php' ) ); ?></li>
                    <li><?php printf( '<a href="%s" class="welcome-icon welcome-comments">' . __( 'Turn comments on or off' ) . '</a>', admin_url( 'options-discussion.php' ) ); ?></li>
                    <li><?php printf( '<a href="%s" class="welcome-icon welcome-learn-more">' . __( 'Learn more about getting started' ) . '</a>', __( 'http://codex.wordpress.org/First_Steps_With_WordPress' ) ); ?></li>
                </ul>
            </div><!-- .welcome-panel-column welcome-panel-last -->
        </div><!-- .welcome-panel-column-container -->
        <div><!-- .custom-welcome-panel-content -->

        <?php
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