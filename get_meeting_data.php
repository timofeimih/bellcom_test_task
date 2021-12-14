<?php 
header('Content-type: application/json');  

require_once './library/db.class.php';

$host 		= 'localhost';
$user 		= 'root';
$password 	= '';
$dbName 	= 'meetings';
$port		= 3308;
$encoding	= 'utf-8';

//check if data is only numeric to be sure that there is no wrong input
if(isset($_GET['meetingId']) && is_numeric($_GET['meetingId'])){
	
	$mdb = new MeekroDB($host, $user, $password, $dbName, $port, $encoding);

	//no need to prepare data(to prevent attacts) because meekro db has build in security
	$meeting_path = $mdb->queryFirstRow("SELECT * FROM meetings_paths WHERE meeting_id='{$_GET['meetingId']}'");

	if($meeting_path){
		if(file_exists($meeting_path['path'])){
			$xmlData 	= file_get_contents($meeting_path['path'], FILE_USE_INCLUDE_PATH);
			$xml 		= simplexml_load_string($xmlData) or die("Error: Cannot create object");

			$data = [];
			$temp = null;

			if($temp = $xml->xpath('//table[@name="meeting"]/fields/field[@name]')){
				$data['name'] 	= (string) 	$temp[0]->attributes()->name;
			}

			if($temp = $xml->xpath('//table[@name="meeting"]/fields/field[@sysid]')){
				$data['sysid'] 	= (int) 	$temp[0]->attributes()->sysid;
			}

			if($temp = $xml->xpath('//table[@name="meeting"]/fields/field[@date]')){
				$data['date'] 	= (string) 	$temp[0]->attributes()->date;
			}

			echo json_encode($data);
		} else{
			echo json_encode(['error' => 'File not found']);
		}
		
	} else{
		echo json_encode(['error' => 'There is no meeting with such number']);
	}

} else{
	echo json_encode(['error' => 'Wrong request or empty meeting number']);
}
?>