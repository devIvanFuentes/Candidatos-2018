<?php  

/**
 * @package SeunoPoll
 */
/*
Plugin Name: Encuesta seuno
Plugin URI: https://tecline.com.mx
Description: Plugion para registrar encuesta de candidatos para seuno noticias
Version: 1.0.0
Author: Ivan Fuentes Gonzalez
Author URI: https://twitter.com/DevIvanFuentes
License: GPLv2 or later
Text Domain: seuno-poll
*/

defined( 'ABSPATH' ) or die( 'Hey, no tienes permisos para estar aquí' );

class SeunoPoll
{

	function activate(){
		echo "The plugin was activate";
	}

	function deactivate(){

	}

	function uninstall(){

	}

}

if ( class_exists( 'Seuno¨Poll' ) ){
	$seunoPoll = new SeunoPoll();
}

// activation
register_activation_hook( __FILE__, array( $seunoPoll, 'activate' ) );

// deactivate
register_deactivation_hook( __FILE__, array( $seunoPoll, 'activate' ) );

// uninstall