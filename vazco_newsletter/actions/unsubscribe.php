<?php //ł ?><?php

	// must be logged in
	//action_gatekeeper();
	//must be admin
	//admin_gatekeeper();
	
	// get parameters that were posted
	$guid = get_input('guid');
	$entity = get_entity($guid);
	
	// perform action on entity
	if (!vazco_newsletter::unsubscribe($entity)) {
		register_error(elgg_echo('vazco_newsletter:unsubscribe:failure'));
		forward($_SERVER['HTTP_REFERER']);
	}

	// we had success so forward the user somewhere and display success message
	system_message(elgg_echo('vazco_newsletter:unsubscribe:success'));
	forward($_SERVER['HTTP_REFERER']);
?>