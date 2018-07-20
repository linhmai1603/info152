<html>
<head>
<title> The indiana Philosophy Ontology Project</title>


<style type = "text/css">
/*CSS style*/

/*table style*/
table, td, th {
    border: 1px solid black;
	align: center;
}

table {
	text-align: center;
    border-collapse: collapse;
    width: 30%;
	margin: 0px auto;
}

th {
    height: 50px;
}


</style>
</head>

<body>
<?php

		function searchingPho_json($type, $id) {
			$base = "https://inpho.cogs.indiana.edu";
			$format = "json";
			$url = $base . '/' . $type . '/' . $id . '.' . $format;
			$data = @file_get_contents($url,o, null, null);
			return $data;
		}
		
		//Selected Philosophers
		echo '<h1 align="center">Philosophers</h1>';
		$data = searchingPho_json('thinker' , '3724');
		$json = json_decode($data);
		$url = $json->url;
		$label = $json->label;
		echo '<a style= "text-align: center" href = http://inpho.cogs.indiana.edu' . $url . '><h3>'.$label.'</h3></a>';
		echo '<table border="1">';
		echo '<tr><th>Name</th><th>Value</th></tr>';
		echo '<tr><td>' . 'wiki' . '</td><td>' . $json->wiki . '</td></tr>';
		echo '<tr><td>' . 'death' . '</td><td>' . $json->death->year . '</td></tr>';
		echo '<tr><td>' . 'birth' . '</td><td>' . $json->birth->year . '</td></tr>';
		echo '</table>';
		echo'</br></br>';
		//Find influenced thinkers
		echo '<h1 align="center">Influenced</h1>'. '</br></br>';
		$influenced = $json->influenced;
		echo'<table border=1>';
		echo'<tr><th>Name</th><th>Year of Birth</th><th>Year of Death</th></tr>';
		foreach($influenced as $pid) {
			$record = searchingPho_json('thinker', $pid);
			$json = json_decode($record);
			echo'<tr>';
			echo'<td><a href = http://inpho.cogs.indiana.edu/thinker/'.$pid.'>' .$json->label. '</a>' . '</td>' .  '<td>' . $json->birth->year . '</td>' . '<td>' . $json->death->year . '</td>'. '</tr>';
		}
		echo'</table>';
		echo'</br></br>';
	
		//Find Influenced by thinkers
		$influencedBy = $json->influenced_by;
		echo'<h1 align="center">Influenced By</h1>'.'</br></br>';
		echo'<table border=1>';
		echo'<tr><th>Name</th><th>Year of Birth</th><th>Year of Death</th></tr>';
		foreach($influencedBy as $byid) {
			$recordBy = searchingPho_json('thinker', $byid);
			$json = json_decode($recordBy);
			echo'<tr>';
			echo'<td><a href = http://inpho.cogs.indiana.edu/thinker/'.$byid.'>' .$json->label. '</a>' . '</td>' .  '<td>' . $json->birth->year . '</td>' . '<td>' . $json->death->year . '</td>'. '</tr>';
		}
		echo'</table>';
		echo'</br></br>';
		//Find related thinkers
		function getRelatedThinkers($ideaID){
			$result = searchingPho_json('idea',$ideaID);
			$json = json_decode($result);
			return $json->related_thinkers;
		}
	
		$thinkersIDs = array();
		$ideas = $json->related_ideas;
		foreach($ideas as $idea){
			foreach (getRelatedThinkers($idea) as $thinkerID){
				$thinkersIDs[] = $thinkerID;
			}
		}
		$unique_thinkers = array_unique($thinkersIDs);
		echo '<h1 align="center">Related Thinkers</h1>';
		echo'<table border=1>';
			echo'<tr><th>Name</th><th>Year of Birth</th><th>Year of Death</th></th>';
		foreach($unique_thinkers as $thinkerID){
				$relatedThinker = searchingPho_json('thinker', $thinkerID);
				$json = json_decode($relatedThinker);
				echo'<tr>';
				echo'<td><a href = http://inpho.cogs.indiana.edu/thinker/'.$thinkerID.'>' .$json->label. '</a>' . '</td>' .  '<td>' . $json->birth->year . '</td>' . '<td>' . $json->death->year . '</td>'. '</tr>';
			}
		echo'</table>';	
	
		// get Related Ideas
			echo'</br></br>';
			echo'<h1 align="center" >Related Ideas</h1>'.'</br></br>';
			echo'<table border=1>';
			echo'<tr><th>ID</th><th>Label</th>';
			foreach($ideas as $ideaID){
				$recordRelatedID = searchingpho_json('idea',$ideaID);
				$json = json_decode($recordRelatedID);
				echo'<tr>';
				echo'<td>' . $ideaID . '</td>' . '<td><a href = http://inpho.cogs.indiana.edu/idea/'. $ideaID . '>' . $json->label . '</a>' . '</td>';  
			}
			echo'</table>';
?>
	</body>
</html>