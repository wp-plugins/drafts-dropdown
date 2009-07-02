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

load_plugin_textdomain('draft-dropdown');

function cfdd_get_drafts() {
	$drafts = new WP_Query('post_type=post&post_status=draft&posts_per_page=100&order=DESC&orderby=modified');
	return $drafts->posts;
// Testing code
// 	$temp = array();
// 	for ($i = 0; $i < 19; $i++) {
// 		$temp[] = $drafts->posts[0];
// 	}
// 	return $temp;
}

function cfdd_admin_html() {
	$drafts = cfdd_get_drafts();
	echo '
<div id="cfdd-drafts-wrap" class="hidden">
	<h5>'.__('Drafts', 'drafts-dropdown').'</h5>
	<div class="metabox-prefs">
	';
	if (count($drafts)) {
		echo '<ul id="cfdd_drafts">';
		foreach ($drafts as $draft) {
			echo '<li><a href="',get_bloginfo('wpurl'),'/wp-admin/post.php?action=edit&post=',$draft->ID,'">',wp_specialchars($draft->post_title),'</a></li>';
		}
		echo '</ul>';
	}
	else {
		echo '<p>',_e('(none)', 'drafts-dropdown'),'</p>';
	}
	echo '
	</div>
</div>
<div id="cfdd-drafts-link-wrap" class="hide-if-no-js screen-meta-toggle">
<a href="#cfdd-drafts" id="cfdd-drafts-link" class="show-settings">'.__('Drafts', 'drafts-dropdown').'</a>
</div>
	';
?>
<style type="text/css">
#cfdd-drafts-link-wrap {
	float: right;
	background: transparent url( <?php bloginfo('wpurl'); ?>/wp-admin/images/screen-options-left.gif ) no-repeat 0 0;
	font-family: "Lucida Grande", Verdana, Arial, "Bitstream Vera Sans", sans-serif;
	height: 22px;
	padding: 0;
	margin: 0 6px 0 0;
}
#cfdd-drafts-wrap h5 {
	margin: 8px 0;
	font-size: 13px;
}
#cfdd-drafts-wrap {
	border-style: none solid solid;
	border-top: 0 none;
	border-width: 0 1px 1px;
	margin: 0 15px;
	padding: 8px 12px 12px;
	-moz-border-radius: 0 0 0 4px;
	-webkit-border-bottom-left-radius: 4px;
	-khtml-border-bottom-left-radius: 4px;
	border-bottom-left-radius: 4px;
}
.cfdd_col {
	float: left;
	margin-right: 10px;
}
.cfdd_clear {
	clear: both;
	float: none;
}
</style>
<script type="text/javascript">
jQuery("#screen-meta-links").before(jQuery("#cfdd-drafts-wrap")).append(jQuery("#cfdd-drafts-link-wrap"));
jQuery(function($) {
	$('#cfdd-drafts-link').click(function () {
		$('#cfdd-drafts-wrap').slideToggle('fast', function(){
			if ( $(this).hasClass('cfdd-drafts-open') ) {
				$('#cfdd-drafts-link').css({'backgroundImage':'url("images/screen-options-right.gif")'});
				$('#cfdd-drafts-link-wrap').css('visibility', '');
				$(this).removeClass('cfdd-drafts-open');
			} else {
				$('#cfdd-drafts-link').css({'backgroundImage':'url("images/screen-options-right-up.gif")'});
				$(this).addClass('cfdd-drafts-open');
			}
		});
		return false;
	});
	var copy = $("#contextual-help-wrap");
	$("#cfdd-drafts-wrap").css({
		"background-color": copy.css("background-color"),
		"border-color": copy.css("border-bottom-color")
	});
	var drafts = $('#cfdd_drafts li');
	var drafts_count = drafts.size();
	if (drafts_count <= 10) {
// set to 2 columns
		$('#cfdd-drafts-wrap .metabox-prefs').append('<div class="cfdd_col" id="cfdd_col_1"><ul></ul></div><div class="cfdd_col" id="cfdd_col_2"><ul></ul></div><div class="cfdd_clear"></div>');
		var i = 0;
		drafts.each(function() {
			i < ((drafts_count + 1) / 2) ? target = '#cfdd_col_1 ul' : target = '#cfdd_col_2 ul';
			$(this).appendTo(target);
			i++;
		});
	}
	else {
// 3 columns
		$('#cfdd-drafts-wrap .metabox-prefs').append('<div class="cfdd_col" id="cfdd_col_1"><ul></ul></div><div class="cfdd_col" id="cfdd_col_2"><ul></ul></div><div class="cfdd_col" id="cfdd_col_3"><ul></ul></div><div class="cfdd_clear"></div>');
		var i = 0;
		var col_count = Math.ceil(drafts_count / 3);
		drafts.each(function() {
			if (i < col_count) {
				target = '#cfdd_col_1 ul';
			}
			else if (i >= col_count * 2) {
				target = '#cfdd_col_3 ul';
			}
			else {
				target = '#cfdd_col_2 ul';
			}
			$(this).appendTo(target);
			i++;
		});
	}
	$('#cfdd_drafts').remove();
// set size of cfdd_col
	$('.cfdd_col').width(Math.floor($('#wpbody-content').width() - 100) / 3);
});
</script>
<?php
}
add_action('admin_footer', 'cfdd_admin_html');

//a:22:{s:11:"plugin_name";s:15:"Drafts Dropdown";s:10:"plugin_uri";s:38:"http://alexking.org/projects/wordpress";s:18:"plugin_description";s:112:"Easy access to your WordPress drafts from within the web admin interface. Drafts are listed in a drop-down menu.";s:14:"plugin_version";s:3:"1.0";s:6:"prefix";s:4:"cfdd";s:12:"localization";s:14:"draft-dropdown";s:14:"settings_title";N;s:13:"settings_link";N;s:4:"init";b:0;s:7:"install";b:0;s:9:"post_edit";b:0;s:12:"comment_edit";b:0;s:6:"jquery";b:0;s:6:"wp_css";b:0;s:5:"wp_js";b:0;s:9:"admin_css";s:1:"1";s:8:"admin_js";s:1:"1";s:15:"request_handler";b:0;s:6:"snoopy";b:0;s:11:"setting_cat";b:0;s:14:"setting_author";b:0;s:11:"custom_urls";b:0;}

?>