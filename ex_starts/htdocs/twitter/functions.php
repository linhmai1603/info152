<?php
	function tweets2array($tweets){
		$records = array();
		foreach($tweets as $tweet){
			$t = new stdClass();
			$t->id = strval($tweet->id);
			$t->date = $tweet-created_at;
			$t->from_user_id= $tweet->from_user_id;
			$t->from_user_name = $tweet->from_user_name;
			$t->to_user_name = $tweet->to_user_name;
			$tgeo = $tweet->geo;
			$tprofile_image_url = $tweet->profile_image_url;
			$t->text = $tweet -> text;
			$records[] = $t;
		}
		return $records;
	}
?>