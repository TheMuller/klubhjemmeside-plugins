<?php

		$context = $vars['context'];
		$offset = $vars['offset'];
		$entities = $vars['entities'];
		$limit = $vars['limit'];
		$count = $vars['count'];
		$baseurl = $vars['baseurl'];
		$context = $vars['context'];
		$viewtype = $vars['viewtype'];
		$pagination = $vars['pagination'];
		$fullview = $vars['fullview'];
		$viewPath = $vars['viewPath'];  

		$html = "";
		$nav = "";
		
		if (isset($vars['viewtypetoggle'])) {
			$viewtypetoggle = $vars['viewtypetoggle'];
		} else {
			$viewtypetoggle = true;
		}

			if ($context == "search" && $count > 0 && $viewtypetoggle) {
				$nav .= elgg_view("navigation/viewtype",array(
			
												'baseurl' => $baseurl,
												'offset' => $offset,
												'count' => $count,
												'viewtype' => $viewtype,
			
														));
			}
			if ($pagination)
				$nav .= elgg_view('navigation/pagination',array(
			
												'baseurl' => $baseurl,
												'offset' => $offset,
												'count' => $count,
												'limit' => $limit,
			
														));
			
			$html .= $nav;

			if ($viewtype == "list") {
				if (is_array($entities) && sizeof($entities) > 0) {
					foreach($entities as $entity) {
						$html .= elgg_view($viewPath, array('entity' => $entity));
					}
				}
			} else {
				if (is_array($entities) && sizeof($entities) > 0)
					$html .= elgg_view("search/gallery",array('entities' => $entities));
			}
			
			if ($count)
				$html .= $nav;
			echo $html;

?>
