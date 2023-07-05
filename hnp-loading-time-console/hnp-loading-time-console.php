<?php
/*
  Plugin Name: HNP - Ladezeiten-Konsole
  Description: Messen Sie Ihre Ladezeiten und lesen Sie die Werte in der Browserkonsole aus.
  Author: Christopher Rohde
  Version: 2.0
  Author URI: https://homepage-nach-preis.de/
  License: GPLv3
 */
 
defined('ABSPATH') or die('Huh, are you trying to cheat?');
$plugin_url = WP_PLUGIN_URL . '/hnp-loading-time-console';
$options = array(); 


function hnp_lt_menu() {
  add_menu_page('HNP-Ladezeiten-Konsole', 'HNP-Ladezeiten-Konsole', 'manage_options', 'hnp_lt_options', 'hnp_lt_display', plugin_dir_url(__FILE__) . 'img/hnp-favi.png');
}
add_action('admin_menu', 'hnp_lt_menu'); 

function hnp_lt_plugin_settings_link($links) {
    $settings_link = '<a href="admin.php?page=hnp_lt_options">Einstellungen</a>';
    array_push($links, $settings_link);
    return $links;
}

$plugin_file = plugin_basename(__FILE__);
add_filter("plugin_action_links_$plugin_file", 'hnp_lt_plugin_settings_link');

function hnp_lt_display() { 
  if (!current_user_can('manage_options')) {
    wp_die('You do not have enough permission to view this page'); 
  } 

  global $plugin_url;
  global $options;

  if (isset($_POST['form_submit'])) {
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
		
    echo '<br><br><h2 style="color:green">Gespeichert</h2>';
	echo '<script src="' . plugin_dir_url( __FILE__ ) . 'js/hnp-lt-admin-safe.js"></script>';

    if (isset($_POST['hnp_loading_time_checked'])) {
      $options['hnp_loading_time_checked'] = esc_html($_POST['hnp_loading_time_checked']);
    } else {
      $options['hnp_loading_time_checked'] = '';
    }

    if (isset($_POST['hnp_loading_time_more_checked'])) {
      $options['hnp_loading_time_more_checked'] = esc_html($_POST['hnp_loading_time_more_checked']);
    } else {
      $options['hnp_loading_time_more_checked'] = '';
    }

    update_option('hnp-loading-time-console', $options); 
  }

  $options = get_option('hnp-loading-time-console');
  require('inc/options-page-wrapper.php');
}

add_action('wp_head', 'hnp_loading_time_header');
function hnp_loading_time_header(){
  $options = get_option('hnp-loading-time-console');		
  if ($options['hnp_loading_time_checked'] != '') {
?>

<script>
  var start = new Date().getTime();
  
  // Benutzerdefinierte Funktionen zur farbigen Konsolenausgabe
  function logBlue(message) {
    console.log('%c' + message, 'color: blue;');
  }
  
  function logGreen(message) {
    console.log('%c' + message, 'color: green;');
  }
  
  function logOrange(message) {
    console.log('%c' + message, 'color: orange;');
  }
  
  function logRed(message) {
    console.log('%c' + message, 'color: red;');
  }
  
  console.log('--- Loading time measurement tool by Christopher Rohde (HNP) ---');
  
  window.onload = function() {
    var end = new Date().getTime();
    var loadingTime = end - start;
    var now = new Date().getTime();
    var perceivedLoadingTime = now - performance.timing.navigationStart;
    var comment;

    // Add comments based on the perceived loading time
    if (perceivedLoadingTime < 500) {
      comment = 'Perfect Loading Time';
      logBlue('' + comment + ' - Perceived loading time (in milliseconds): ' + perceivedLoadingTime + '');
    } else if (perceivedLoadingTime < 1000) {
      comment = 'Very Good Loading Time';
      logGreen('' + comment + ' - Perceived loading time (in milliseconds): ' + perceivedLoadingTime + '');
    } else if (perceivedLoadingTime < 1500) {
      comment = 'Loading Time is OK';
      logOrange('' + comment + ' - Perceived loading time (in milliseconds): ' + perceivedLoadingTime + '');
    } else {
      comment = 'The Loading Time should be fixed';
      logRed('' + comment + ' - Perceived loading time (in milliseconds): ' + perceivedLoadingTime + '');
    }
    console.log('Loading time (in milliseconds): ' + loadingTime);

    <?php if ($options['hnp_loading_time_more_checked'] != '') { ?>
      console.log('Server response time (in milliseconds): ' + (performance.timing.responseStart - performance.timing.navigationStart));
      console.log('DOM interactive time (in milliseconds): ' + (performance.timing.domInteractive - performance.timing.navigationStart));
      console.log('DOM complete time (in milliseconds): ' + (performance.timing.domComplete - performance.timing.navigationStart));
      
      // Modified calculation for Page render time
      var pageRenderTime = performance.timing.domComplete - performance.timing.responseStart;
      console.log('Page render time (in milliseconds): ' + pageRenderTime);
    <?php } ?>

    console.log('------------------------');
  };
</script>

<?php

  }
};

function hnp_loading_time_enqueue_custom_admin_styles() {
   wp_enqueue_style( 'hnp_lt_unique-admin-styles', plugin_dir_url( __FILE__ ) . '/css/hnp_lt_backend_v1.css' );
   wp_enqueue_script( 'hnp_lt_custom-admin-script', plugin_dir_url( __FILE__ ) . '/js/hnp_lt_custom-admin-script.js', array( 'jquery' ), '1.0', true );
}

add_action( 'admin_enqueue_scripts', 'hnp_loading_time_enqueue_custom_admin_styles', 999 );

?>