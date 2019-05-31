<?php

include "dbase.php";

$action = null;
$dbsTable = "barang";

if(!isset($_REQUEST['act'])){
	$action = null;
}else{
	$action = $_REQUEST['act'];
}

$d = new Database();
$d->open();

$result = array();

if($action == null){
	$myarray[] = array("response" => "0");
	$result = array("result" => $myarray);
	print json_encode($result);
}
elseif($action == "1"){
	$sqlInsert = "INSERT INTO ". $dbsTable ." (nama, jenis, stok) VALUES ('".
		$_REQUEST['nm'] ."','".
		$_REQUEST['jn'] ."','".
		$_REQUEST['st'] ."')";
	$d->execute($sqlInsert);
	
	$myarray[] = array("pesan" => $_REQUEST['nm']." berhasil disimpan");
	$result = array("hasil"=>$myarray);
	print json_encode($result);
}
elseif($action == "2"){
	$sqlEdit = "UPDATE ". $dbsTable ." SET nama='', jenis='', stok= WHERE id=''";
	$d->execute($sqlEdit);
	
	
}
elseif($action == "3"){
	$sqlDelete = "DELETE FROM ". $dbsTable ." WHERE id='". $_REQUEST['id'] ."'";
	$d->execute($sqlDelete);
	
	$myarray[] = array("pesan" => "ID : ". $_REQUEST['id'] ." berhasil dihapus");
	$result = array("hasil"=>$myarray);
	print json_encode($result);
}
elseif($action == "4"){
	$sqlRes = "SELECT * FROM ".$dbsTable;
	$result = array("hasil"=>$d->getAll($sqlRes));
	print json_encode($result);
}

?>