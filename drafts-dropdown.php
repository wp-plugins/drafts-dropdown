<?php
/*
Plugin Name: Drafts Dropdown 
Plugin URI: http://alexking.org/projects/wordpress 
Description: Easy access to your WordPress drafts from within the web admin interface. Drafts are listed in a drop-down menu. 
Version: 1.0dev 
Author: Crowd Favorite
Author URI: http://crowdfavorite.com
*/

// ini_set('display_errors', '1'); ini_set('error_reporting', E_ALL);

if (!defined('PLUGINDIR')) {
	define('PLUGINDIR','wp-content/plugins');
}


load_plugin_textdomain('draft-dropdown');


function cfdd_request_handler() {
	if (!empty($_GET['cf_action'])) {
		switch ($_GET['cf_action']) {

			case 'cfdd_admin_js':
				cfdd_admin_js();
				break;
			case 'cfdd_admin_css':
				cfdd_admin_css();
				die();
				break;
		}
	}
}
add_action('init', 'cfdd_request_handler');


function cfdd_admin_js() {
	header('Content-type: text/javascript');
// TODO
	die();
}

if (is_admin()) {
	wp_enqueue_script('cfdd_admin_js', trailingslashit(get_bloginfo('url')).'?cf_action=cfdd_admin_js', array('jquery'));
}

function cfdd_admin_css() {
	header('Content-type: text/css');
?>
fieldset.options div.option {
	background: #EAF3FA;
	margin-bottom: 8px;
	padding: 10px;
}
fieldset.options div.option label {
	display: block;
	float: left;
	font-weight: bold;
	margin-right: 10px;
	width: 150px;
}
fieldset.options div.option span.help {
	color: #666;
	font-size: 11px;
	margin-left: 8px;
}
<?php
	die();
}

function cfdd_admin_head() {
	echo '<link rel="stylesheet" type="text/css" href="'.trailingslashit(get_bloginfo('url')).'?cf_action=cfdd_admin_css" />';
}
add_action('admin_head', 'cfdd_admin_head');

//a:22:{s:11:"plugin_name";s:15:"Drafts Dropdown";s:10:"plugin_uri";s:38:"http://alexking.org/projects/wordpress";s:18:"plugin_description";s:112:"Easy access to your WordPress drafts from within the web admin interface. Drafts are listed in a drop-down menu.";s:14:"plugin_version";s:3:"1.0";s:6:"prefix";s:4:"cfdd";s:12:"localization";s:14:"draft-dropdown";s:14:"settings_title";N;s:13:"settings_link";N;s:4:"init";b:0;s:7:"install";b:0;s:9:"post_edit";b:0;s:12:"comment_edit";b:0;s:6:"jquery";b:0;s:6:"wp_css";b:0;s:5:"wp_js";b:0;s:9:"admin_css";s:1:"1";s:8:"admin_js";s:1:"1";s:15:"request_handler";b:0;s:6:"snoopy";b:0;s:11:"setting_cat";b:0;s:14:"setting_author";b:0;s:11:"custom_urls";b:0;}

?>