<h1>PixelPing</h1>
<?php 

include("database.php");

if (isset($_REQUEST['json'])){

  $datetime_ts = date('Y-m-d H:i:s');
	$day_of_the_month = date('d');
	$month_of_the_year = date('n');
	$date_day = date('Y-m-d')
	$year = date('Y');
	$week_of_the_year = date('W');

	//formato envio de json pixel-ping  [json] => {"f23434":2,"f23434a":1}
	$json = $_REQUEST['json'];//'{"a":1,"b":2,"c":3,"d":4,"e":5}';
	$decodedjson = json_decode($json);
	$rows = array();
	foreach ($decodedjson as $key => $hits){
		$row = array(	'`page_key`' => $key, //el caracter '`' en los campos, es necesario para el correcto funcionamiento del la clase database
				'`hits`' => $hits,
				'`datetime_ts`' => $datetime_ts,
				'`day_of_the_month`' => $day_of_the_month,
				'`month_of_the_year`' => $month_of_the_year,
				'`year`' => $year,
				'`week_of_the_year`' => $week_of_the_year,
				'`date_day`' => $date_day);
		array_push($rows, $row);
	}

	// start database connection
	$connection_information = array(
		'host' => 'localhost',
		'user' => 'root',
		'pass' => 'usuario',
		'db' => 'pixelpingtestbd'
	);

	$m = new mysql($connection_information);
	//guardar datos
	foreach($rows as $row){
		$result = $m->insert('pixel_stats', $row);
		//mas debug		
		/*print_r('<br>');	
		print_r($row);
		var_dump($result);*/
	}
	//print("Error:"); print_r(mysql_errno());
	
	/*
	//output para debug	
	$file = '/var/www/pixel_local_test/testfile.txt';
	$data = '  |||  ';
	$fp = fopen($file, "a") or die("Couldn't open $file for writing!");
	fwrite($fp, $data) ;
	$data = print_r($_REQUEST, true);
	fwrite($fp, $data) ;
	fclose($fp); */
}
else{
	
	/*
	//debug
	$file = '/var/www/pixel_local_test/testfile.txt';
	print_r($_REQUEST);
	$data = '  |||  ';
	$fp = fopen($file, "a") or die("Couldn't open $file for writing!");
	fwrite($fp, $data) ;
	$data = print_r($_REQUEST, true);
	fwrite($fp, $data) ;
	fclose($fp);*/
}

 ?>
