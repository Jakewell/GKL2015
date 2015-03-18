<?php
    $host = 'mysql.metropolia.fi';
    $dbname = ''; // your username
    $user = ''; // your username
    $pass = ''; // your database password
	
   // TODO: get the data from the form by using $_POST
   // this is how you convert the date from the form to SQL formatted date:
   // date ("Y-m-d H:i:s", strtotime($_POST['date'].' '.$_POST['time']));
   
   $getName = $_POST['name'];
   $getDesc = $_POST['desc'];
   $getEmail = $_POST['email'];
   $getPhone = $_POST['cell'];
   $getDate = date ("Y-m-d H:i:s", strtotime($_POST['date'].' '.$_POST['time']));
   
// this part was in dbConnect.php in last period:
try {

	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$DBH->query("SET NAMES 'UTF8';");

}catch(PDOException $e) {

	echo "Could not connect to database.";
	file_put_contents('log.txt', $e->getMessage(), FILE_APPEND);
}

    
try {
	// TODO: insert the data from the form to database table 'calendar'
	
	$insertSQL = "INSERT INTO calendar(eName, eDescription, pEmail, pPhone, eDate) VALUES('{$getName}', '{$getDesc}', '{$getEmail}', '{$getPhone}', '{$getDate}')";
	
	$DBH->query($insertSQL);
	

} catch (PDOException $e) {
	echo 'Something went wrong';
	file_put_contents('log.txt', $e->getMessage()."\n\r", FILE_APPEND); // remember to set the permissions so that log.txt can be created
}
?>