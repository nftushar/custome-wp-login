<?php

/**
 * Plugin Name:       Customizer Login Page
 * Plugin URI:        https://wordpress.org/plugins/customizer-login-page-wp/
 * Description:       The Customizer Login Page plugin will help you to enable a custom login page to your WordPress website.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ali Hossain
 * Author URI:        https://alihossain.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       clpwp
 */


/*
 * Plugin Option Page Function
 */
function clpwp_add_theme_page()
{
  add_menu_page('Login Option for Admin', 'my Login Option', 'manage_options', 'clpwp-plugin-option', 'clpwp_create_page', 'dashicons-unlock', 101);
}
add_action('admin_menu', 'clpwp_add_theme_page');


/**
 * Plugin option page style
 */
function clpwp_add_theme_css()
{
  wp_enqueue_style('clpwp-admin-style.css', plugins_url('css/clpwp-admin-style.css', __FILE__), false, "1.0.0");
}
add_action('admin_enqueue_scripts', 'clpwp_add_theme_css');


/**
 * Plugin Callback
 */

function clpwp_create_page()
{
?>
  <div class="clpwp_main_area">
    <div class="clpwp_body_area clpwp_common">
      <h3 id="title"> <?php print esc_attr("Customize Your Login Page"); ?> </h3>
      <form action="options.php" method="post">
        <?php wp_nonce_field("update-options"); ?>
        <!-- primary color -->
        <label for="clpwp-primary-color" name="clpwp-primary-color">
          <?php esc_attr("primary color"); ?>
        </label>
        <input type="color" name="clpwp-primary-color" value="<?php print get_option("clpwp-primary-color") ?>">

            <!-- secondary color -->
            <label for="clpwp-secondary-color" name="clpwp-secondary-color">
          <?php esc_attr("secondary color"); ?>
        </label>
        <input type="color" name="clpwp-secondary-color" value="<?php print get_option("clpwp-secondary-color") ?>">

        <!-- background image -->
        <label for="clpwp-custom-bg-image" name="clpwp-custom-bg-image">
          <?php esc_attr("Paste The Url of your background image"); ?>
        </label>
        <input type="text" name="clpwp-bg-image" value="<?php print get_option("clpwp-bg-image") ?>" placeholder="Paste The Url of your background image">


        <!-- Main Logo -->
        <label for="clpwp-logo-image-url" name="clpwp-logo-image-url">
          <?php esc_attr("Upload Your Logo"); ?>
        </label>
        <input type="text" name="clpwp-logo-image-url" value="<?php print get_option("clpwp-logo-image-url") ?>" placeholder="Paste logo Url">


        <!-- Background Brightness -->
        <label for="clpwp-bg-brightness" name="clpwp-bg-brightness">
          <?php esc_attr("Background Brightness"); ?>
        </label>
        <input type="text" name="clpwp-bg-brightness" value="<?php print get_option("clpwp-bg-brightness") ?>" placeholder="Background Brightness">


        <input type="hidden" name="action" value="update">
        <input type="hidden" name="page_options" value="clpwp-primary-color, clpwp-logo-image-url, clpwp-bg-image, clpwp-bg-brightness, clpwp-secondary-color">
        <input type="submit" name="submit" class="button button-primary" value="<?php _e("Save Data", "clpwp") ?>">
      </form>
    </div>

    <div class="clpwp_sidebar_area clpwp_common">
      <h3 id="title"> <?php print esc_attr("About Author"); ?> </h3>
      <p>Hello <strong>NF Tushar</strong>
        welcome to my plugin</p>
    </div>
  </div>
  </div>
<?php
}




// Loading CSS file
function clpwp_login_enqueue_register()
{
  wp_enqueue_style('clpwp_login_enqueue', plugins_url('css/clpwp-styles.css', __FILE__), false, "1.0.0");
}
add_action('login_enqueue_scripts', 'clpwp_login_enqueue_register');


// Changing Login form logo
function clpwp_login_logo_change()
{
?>
  <style>
    #login h1 a,
    .login h1 a {
      background-image: url(<?php print get_option("clpwp-logo-image-url"); ?>) !important;
    }


    #login form p.submit input {
      background: url(<?php print get_option("clpwp-primary-color"); ?>) !important;
    }

    .login #login_error,
    .login .message,
    .login .success {
      border-left: 4px solid <?php print get_option("clpwp-primary-color"); ?> !important;
    }

    input#user_login,
    input#user_pass {
      border-left: 4px solid <?php print get_option("clpwp-primary-color"); ?> !important;
    }

    #login form p.submit input { 
      background:<?php print get_option("clpwp-primary-color"); ?> !important; 
    }
    .login #backtoblog a { 
      background:<?php print get_option("clpwp-secondary-color"); ?> !important; 

    }
    body.login { 
      background-image: url(<?php print get_option("clpwp-bg-image"); ?>) !important; 
    }
    body.login::after {
      opacity: <?php print get_option("clpwp-bg-brightness"); ?> !important; ;
    }

  </style>

<?php
}
add_action('login_enqueue_scripts', 'clpwp_login_logo_change');

// Changing Login form logo url
function clpwp_login_logo_url_change()
{
  return home_url();
}
add_filter('login_headerurl', 'clpwp_login_logo_url_change');

?>