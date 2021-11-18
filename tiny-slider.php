<?php 

/**
* Plugin Name: Tiny Slider
* Plugin URI: http://fb.com/msh.sajib
* Description: A simple slider
* Version: 1.0.0
* Author: Sajib
* Author URI: http://fb.com/msh.sajib
* License: GPL2
*/

function ts_assets(){
	wp_enqueue_style( 'ts-css', '//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css');
	wp_enqueue_script( 'ts-js', '//cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js', array( 'jquery' ), '1.10', true );
	wp_enqueue_script( 'main-js', plugin_dir_url( __FILE__ ).'assets/main.js', array( 'jquery' ), time(), true );
}
add_action( 'wp_enqueue_scripts', 'ts_assets');

function slider_callback($arg,$content){

	$default = array(
		'width'=>800,
		'height'=>600,
		'id'=>'tiny-slider'
	);

	$attributes	= shortcode_atts( $default, $arg );
	$content	= do_shortcode( $content );

	$output = <<<EOD
<div style="width:{$attributes['width']};height:{$attributes['height']}">
		<div class="my-slider">
			{$content}
		</div
	</div>
EOD;
return $output;

}
add_shortcode( 'slider', 'slider_callback' );

function slide_callback($arg){
		$default = array(
		'caption'=>'',
		'id'=>'',
		'size'=>'medium'
	);

	$attributes	= shortcode_atts( $default, $arg );
	$content	= do_shortcode( $content );
	$img = wp_get_attachment_image_src( $attributes['id'], $attributes['size']);

	$output = <<<EOD
<div class="slider">
			<p><img src="{$img[0]}"/></p>
			<p>{$attributes['caption']}</p>
		</div>
EOD;
return $output;
}
add_shortcode( 'slide', 'slide_callback' );
