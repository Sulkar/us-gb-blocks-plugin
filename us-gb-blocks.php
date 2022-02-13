<?php

/**
 * Plugin Name:       Us Gb Blocks
 * Description:       Example block written with ESNext standard and JSX support – build step required.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Richard Scheglmann
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       us-gb-blocks
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_us_gb_blocks_block_init()
{

	$dir = __DIR__;

	$script_asset_path = "$dir/build/index.asset.php";
	if (!file_exists($script_asset_path)) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/starter-block" block first.'
		);
	}
	$index_js     = 'build/index.js';
	$script_asset = require($script_asset_path);
	wp_register_script(
		'create-block-us-gb-block-editor',
		plugins_url($index_js, __FILE__),
		$script_asset['dependencies'],
		$script_asset['version']
	);
	wp_set_script_translations('create-block-us-gb-block-editor', 'starter-block');

	$editor_css = 'build/index.css';
	wp_register_style(
		'create-block-us-gb-block-editor',
		plugins_url($editor_css, __FILE__),
		array(),
		filemtime("$dir/$editor_css")
	);

	$style_css = 'build/style-index.css';
	wp_register_style(
		'create-block-us-gb-block',
		plugins_url($style_css, __FILE__),
		array(),
		filemtime("$dir/$style_css")
	);

	register_block_type('create-block/us-gb-blocks', array(
		'editor_script' => 'create-block-us-gb-block-editor',
		'editor_style'  => 'create-block-us-gb-block-editor',
		'style'         => 'create-block-us-gb-block',
	));
}
add_action('init', 'create_block_us_gb_blocks_block_init');
