<?php


function get_events($id_user){
	global $db;
	$query = "SELECT id,title, start, end FROM fcalendar WHERE id_user=$id_user ";
	$res = mysqli_query($db, $query);
	return mysqli_fetch_all($res, MYSQL_ASSOC);

}
function set_events($ntitle,$nstart,$nend,$nid){
	global $db;
	$query="INSERT INTO fcalendar (title, start, end, id_user) VALUES ('$ntitle', '$nstart', '$nend','$nid')";
	 mysqli_query($db, $query);
	return get_events($nid);

	//return mysqli_fetch_all($res, MYSQL_ASSOC);

}

function get_json($arr){
	$date = '[';
	foreach($arr as $item){
		$date .= '{"start": "'.$item['start'].'", "end": "'.$item['end'].'","title": "'.$item['title'].'"},';
	}
	$date .= ']';
	return $date;

}

function print_arr($arr){
	echo '<pre>' . print_r($arr,true) . '</pre>';
}

