<?php
/**
 * Dropdown menu for user's own groups
 * 
 */

elgg_register_event_handler('init', 'system', 'groups_yours_menu');

function groups_yours_menu() {

	$viewer = elgg_get_logged_in_user_entity();

	//read viewer's groups
	$content = elgg_get_entities_from_relationship(array(
		'type' => 'group',
		'relationship' => 'member',
		'relationship_guid' => elgg_get_logged_in_user_guid(),
		'inverse_relationship' => false,
		'limit' => 0,
	));
	
	//create array of entries ($content object had duplicate entries, array keys prevent duplicates (sry for being lazy)
	$groupmenu_array = Array();
	foreach ($content as $mygroup) {
		$groupmenu_array[(string)$mygroup->get('guid')] = $mygroup->get('name');
		//print_r ($mygroup);
	}

	//sort array while keeping the IDs
	asort($groupmenu_array);

	//create HTML code out of array
	foreach ($groupmenu_array as $group_guid=>$group_name) {
		$groupmenu .= '<div>'.elgg_view('output/url', array('href' => "groups/profile/$group_guid",'text' => $group_name,	'is_trusted' => true,)).'</a></div>';
		
	}	
	
	//add wrapping divs around menu and logo (</a> to close link generated by register_menu_item)
	$groupmenu = '</a><div id="topbar-mygroups" onMouseOut="$(\'#topbar-groupmenu\').hide()" onMouseOver="$(\'#topbar-groupmenu\').show()" style="height:22px;">'. elgg_view('output/url', array('href' => "groups/member/{$viewer->username}",'text' => elgg_view_icon('share'), 'is_trusted' => true, 'title' => 'Your groups')) . '<div id="topbar-groupmenu" style="display:none; position:absolute; background-color:#EEEEEE; white-space:nowrap; padding:3px; margin-top: 4px;">' . $groupmenu . '</div></div><a>';
	

	//adding the new menu to the topbar
	elgg_register_menu_item('topbar', array(
		'name' => 'mygroups',
		'href' => "",
		'text' => $groupmenu,
		'title' => elgg_echo('groups:yours'),
		'priority' => 250,
	));
}
