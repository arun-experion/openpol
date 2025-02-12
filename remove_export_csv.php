<?php

include("includes/config.inc.php");
session_start(); 
error_reporting(1);
$filename  =   $_REQUEST['filename'];

if(!empty($filename)){
    $dir = 'templates/default/csv/'.$filename;
    if (unlink($dir)) {
        $data = array('success' => 'yes');
    } else {
        $data = array('success' => 'no');
    }
}

echo $output = json_encode($data);

?>