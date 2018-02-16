<?php 
	/* Template Name: Data */
	defined( 'ABSPATH' ) or die( 'Hey, no tienes permisos para estar aquí' );
	header('Content-Type: application/json');

	$result = tec_get_general_percentage('Activo');
	print json_encode($result);
