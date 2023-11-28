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
  wp_enqueue_style('clpwp-admin-style', plugins_url('css/clpwp-admin-style.css', __FILE__), false, "1.0.0");
}
add_action('admin_enqueue_scripts', 'clpwp_add_theme_css');


/**
 * Plugin Callback
 */

function clpwp_create_page()
{
?>
  <div class="cplwp_main_area">
    <div class="cplwp_body_area">
      <h3 id="title"> <?php print esc_attr("Customize Your Login Page"); ?> </h3>
      <form action="options.php" method="post">
        <?php wp_nonce_field("update-options"); ?>
        <!-- primary color -->
        <label for="cplwp-primary-color" name="cplwp-primary-color">
          <?php esc_attr("primary color"); ?>
        </label>
        <input type="color" name="cplwp-primary-color" value="<?php print get_option("cplwp-primary-color") ?>">

        <!-- background image -->
        <label for="cplwp-custom-bg-image" name="cplwp-custom-bg-image">
          <?php esc_attr("Paste The Url of your background image"); ?>
        </label>
        <input type="text" name="cplwp-bg-image" value="<?php print get_option("cplwp-bg-image") ?>" placeholder="Paste The Url of your background image">


        <!-- Main Logo -->
        <label for="cplwp-logo-image-url" name="cplwp-logo-image-url">
          <?php esc_attr("Upload Your Logo"); ?>
        </label>
        <input type="text" name="cplwp-logo-image-url" value="<?php print get_option("cplwp-logo-image-url") ?>" placeholder="Paste logo Url">


        <!-- Background Brightness -->
        <label for="cplwp-bg-brightness" name="cplwp-bg-brightness">
          <?php esc_attr("Background Brightness"); ?>
        </label>
        <input type="number" name="cplwp-bg-brightness" value="<?php print get_option("cplwp-bg-brightness") ?>" placeholder="Background Brightness">


        <input type="hidden" name="action" value="update">
        <input type="hidden" name="page_options" value="cplwp-primary-color, cplwp-logo-image-url, cplwp-bg-image, cplwp-bg-brightness">
        <input type="submit" name="submit" class="button button-primary" value="<?php _e("Save Data", "cplwp") ?>">
      </form>


      <div class="clpwp_sidebar_area">
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
      background-image: url(<?php print plugin_dir_url(__FILE__) . '/img/logo-sm.png'; ?>);
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