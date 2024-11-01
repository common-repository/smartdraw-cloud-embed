<?php
/*
Plugin Name: SmartDraw Shortcode for Wordpress
Plugin URI: http://smartdraw.com
Description: This plugin allows the embedding of SmartDraw diagrams from SmartDraw Cloud using a simple [smartdraw] shortcode.
Version: 1.0
Author: SmartDraw Software LLC
Author URI: http://smartdraw.com
License: MIT
*/

/*
Copyright (c) 2018 SmartDraw Software LLC

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be included
in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

/* Create a unique class name to provide a unique plugin namespace: */
class SmartDraw {

	// Use the latest PHP5 style construtor:
	function __construct() {

		// This plugin is WP 2.5+ only:
		if ( !function_exists('add_shortcode') ) return;

		// Shortcode handler for [smartdraw], which WordPress runs at priority 11.
		add_shortcode( 'smartdraw', array(&$this, 'SDJS_Embed') );
	}

	// Inspired by media.php

	function SDJS_Embed($atts, $content = null, $code = "" ) {

		$atts = shortcode_atts(
			array(
				'embed' => '',
		), $atts);

		$toParse = $atts['embed'];

		$toParse = html_entity_decode($toParse, ENT_NOQUOTES, 'UTF-8');

		parse_str($toParse,$output);

   		return '<div id="'.$output['doc'].'_'.$output['unique'].'"><div id="'.$output['doc'].'_'.$output['unique'].'_robot"><a href="https://cloud.smartdraw.com/share.aspx/?widgetToken='.$output['doc'].'"><img src="https://cloud.smartdraw.com/cloudstorage/'.$output['doc'].'/preview2.png"></a></div></div><script src="https://cloud.smartdraw.com/plugins/wordpress/sdjswidget_wp.js" type="text/javascript"></script><script type="text/javascript">SDJS_Widget("'.$output['doc'].'",'.$output['unique'].','.$output['mode'].',"'.$output['caption'].'");</script><br/>';
	}
}

add_action( 'plugins_loaded', create_function( '', 'global $smartdraw; $smartdraw = new SmartDraw();' ) );

// Hooks your functions into the correct filters
function sdjs_my_add_mce_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'sdjs_my_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'sdjs_my_register_mce_button' );
	}
}
add_action('admin_head', 'sdjs_my_add_mce_button');

// Declare script for new button
function sdjs_my_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['sdjs_my_mce_button'] = plugins_url('sdjsmce.js', __FILE__);
	return $plugin_array;
}

// Register new button in the editor
function sdjs_my_register_mce_button( $buttons ) {
	array_push( $buttons, 'sdjs_my_mce_button' );
	return $buttons;
}
