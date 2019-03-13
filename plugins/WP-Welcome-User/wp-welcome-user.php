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
        echo '<h1>Custom Widget 01</h1>';
    }

    // Do Stuff on the admin_menu action
    function action_admin_menu(){
        $this->disable_default_dashboard_widgets();
    }

    // Do Stuff on the admin_init action
    function action_admin_init(){
        add_meta_box('dash01', 'Dashboard Widget Title', array($this, 'dash01_widget'), 'dashboard', 'side', 'high');
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
        <div class="welcome-panel-content">
            <h2><img src="<?php echo plugin_dir_url(__FILE__);?>/images/Discord_Thonk_500.png" class="welcome-logo" /><?php $current_user = wp_get_current_user();_e( 'Welcome ' . $current_user->display_name . ' to your dashboard!' ); ?></h2>
            <h3><?php _e( 'Week 01 Discord WordPress challenge!' ); ?></h3>
            <p class="about-description">Your challenge for this week: Make a logged in user feel welcome to your site! Customize their experience when they first log in with something personalized.</p>
            <div class="welcome-panel-body">
                <p>You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man. </p>
                <p>Normally, both your asses would be dead as fucking fried chicken, but you happen to pull this shit while I'm in a transitional period so I don't wanna kill you, I wanna help you. But I can't give you this case, it don't belong to me. Besides, I've already been through too much shit this morning over this case to hand it over to your dumb ass. </p>
                <p>My money's in that office, right? If she start giving me some bullshit about it ain't there, and we got to go someplace else and get it, I'm gonna shoot you in the head then and there. Then I'm gonna shoot that bitch in the kneecaps, find out where my goddamn money is. She gonna tell me too. Hey, look at me when I'm talking to you, motherfucker. You listen: we go in there, and that nigga Winston or anybody else is in there, you the first motherfucker to get shot. You understand? </p>
                <p>You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man. </p>
            </div>
            <div class="welcome-panel-column-container">
                <div class="welcome-panel-column">
                    <?php if ( current_user_can( 'customize' ) ) : ?>
                        <h3><?php _e( 'Get Started' ); ?></h3>
                        <a class="button button-primary button-hero load-customize hide-if-no-customize" href="<?php echo wp_customize_url(); ?>"><?php _e( 'Customize Your Site' ); ?></a>
                    <?php endif; ?>
                    <a class="button button-primary button-hero hide-if-customize" href="<?php echo admin_url( 'themes.php' ); ?>"><?php _e( 'Customize Your Site' ); ?></a>
                    <?php if ( current_user_can( 'install_themes' ) || ( current_user_can( 'switch_themes' ) && count( wp_get_themes( array( 'allowed' => true ) ) ) > 1 ) ) : ?>
                        <?php $themes_link = current_user_can( 'customize' ) ? add_query_arg( 'autofocus[panel]', 'themes', admin_url( 'customize.php' ) ) : admin_url( 'themes.php' ); ?>
                        <p class="hide-if-no-customize"><?php printf( __( 'or, <a href="%s">edit your site settings</a>' ), admin_url( 'options-general.php' ) ); ?></p>
                    <?php endif; ?>
                </div>
                <div class="welcome-panel-column">
                    <h3><?php _e( 'Next Steps' ); ?></h3>
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
                            <li><?php printf( '<a href="%s" class="welcome-icon welcome-setup-home">' . __( 'Set up your homepage' ) . '</a>', current_user_can( 'customize' ) ? add_query_arg( 'autofocus[section]', 'static_front_page', admin_url( 'customize.php' ) ) : admin_url( 'options-reading.php' ) ); ?></li>
                        <?php endif; ?>
                        <li><?php printf( '<a href="%s" class="welcome-icon welcome-view-site">' . __( 'View your site' ) . '</a>', home_url( '/' ) ); ?></li>
                    </ul>
                </div>
                <div class="welcome-panel-column welcome-panel-last">
                    <h3><?php _e( 'More Actions' ); ?></h3>
                    <ul>
                        <?php if ( current_theme_supports( 'widgets' ) || current_theme_supports( 'menus' ) ) : ?>
                            <li><div class="welcome-icon welcome-widgets-menus">
                                    <?php
                                    if ( current_theme_supports( 'widgets' ) && current_theme_supports( 'menus' ) ) {
                                        printf(
                                            __( 'Manage <a href="%1$s">widgets</a> or <a href="%2$s">menus</a>' ),
                                            admin_url( 'widgets.php' ),
                                            admin_url( 'nav-menus.php' )
                                        );
                                    } elseif ( current_theme_supports( 'widgets' ) ) {
                                        echo '<a href="' . admin_url( 'widgets.php' ) . '">' . __( 'Manage widgets' ) . '</a>';
                                    } else {
                                        echo '<a href="' . admin_url( 'nav-menus.php' ) . '">' . __( 'Manage menus' ) . '</a>';
                                    }
                                    ?>
                                </div></li>
                        <?php endif; ?>
                        <?php if ( current_user_can( 'manage_options' ) ) : ?>
                            <li><?php printf( '<a href="%s" class="welcome-icon welcome-comments">' . __( 'Turn comments on or off' ) . '</a>', admin_url( 'options-discussion.php' ) ); ?></li>
                        <?php endif; ?>
                        <li><?php printf( '<a href="%s" class="welcome-icon welcome-learn-more">' . __( 'Learn more about getting started' ) . '</a>', __( 'https://codex.wordpress.org/First_Steps_With_WordPress' ) ); ?></li>
                    </ul>
                </div>
            </div>
        </div>
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