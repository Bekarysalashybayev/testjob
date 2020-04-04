<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$status = "Done";
if(!empty($_GET["id"])) {
    $query = "UPDATE toy set status = '".$status."'  WHERE  id=".$_GET["id"];
    $result = $db_handle->executeQuery($query);
	
	if(!empty($result)){
		header("Location:index.php");
	}
}
?>