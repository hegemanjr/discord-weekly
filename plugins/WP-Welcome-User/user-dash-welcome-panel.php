
<div class="welcome-panel-content">
            <h2><img src="<?php echo plugin_dir_url(__FILE__);?>/images/Discord_Thonk_500.png" class="welcome-logo" /><?php $current_user = wp_get_current_user();_e( 'Welcome ' . $current_user->display_name . ' to your dashboard!' ); ?></h2>
<h3><?php _e( 'Week 01 Discord WordPress challenge!' ); ?></h3>
<p class="about-description">Your challenge for this week: Make a logged in user feel welcome to your site! Customize their experience when they first log in with something personalized.</p>
<div class="welcome-panel-body">
    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean cursus nulla id mi tempus accumsan. Aenean ex metus, pulvinar vel tincidunt eget, placerat sit amet massa. Nulla mattis, quam et euismod pulvinar, dui dui porta quam, non porta neque tellus quis est. Vivamus pharetra neque ac risus laoreet, nec eleifend erat aliquam. Nunc ante tellus, commodo vitae facilisis nec, sollicitudin sodales sapien. Nullam sed turpis posuere, ornare mi sit amet, elementum massa. Etiam sit amet sollicitudin enim.
    </p>
    <p>
        Fusce id purus facilisis, fringilla dolor vitae, malesuada libero. Mauris dignissim est id euismod pulvinar. Suspendisse gravida dignissim enim in mollis. Donec tempus pharetra mauris vel dapibus. Proin dictum nisl vel nisl consectetur ultricies. Donec tincidunt facilisis gravida. Vivamus consectetur erat vitae dui vestibulum, accumsan elementum nulla dapibus. Praesent volutpat erat ac arcu pretium vehicula. Nulla interdum pharetra efficitur. Vivamus accumsan enim venenatis sagittis suscipit. Quisque interdum vel lectus vel laoreet. Proin viverra porttitor convallis. Aliquam erat volutpat.
    </p>
    <p>
        Nunc interdum urna id leo lobortis consequat. Quisque viverra cursus ex quis venenatis. Fusce tristique nunc tortor, vitae eleifend sem elementum in. Integer ut euismod nunc. Vestibulum cursus lorem a ultricies consectetur. Integer rutrum dui dictum dolor varius sollicitudin. In est dui, vulputate in sapien eget, rutrum molestie ligula. Duis ultrices, magna in iaculis pretium, sem neque luctus risus, id aliquam mauris sapien a erat.
    </p>
    <p>
        Fusce fermentum, dui ac egestas blandit, neque libero sollicitudin libero, in dignissim mi lorem non lectus. Nulla sit amet lorem risus. Aliquam suscipit quam ligula, vitae tincidunt massa dictum eu. Nam enim nulla, congue ac sem nec, pharetra feugiat metus. Pellentesque non vehicula nisi. Donec dignissim ipsum in lobortis tempus. Integer vulputate elit sollicitudin, pulvinar ligula ut, tincidunt quam.
    </p>
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