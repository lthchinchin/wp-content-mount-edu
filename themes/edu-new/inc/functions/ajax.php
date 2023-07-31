<?php 

add_action('wp_ajax_sayGreeting', 'testGreeting');
add_action('wp_ajax_nopriv_sayGreeting', 'testGreeting');
function testGreeting()
{
	echo json_encode('greeting!');
	die();
}