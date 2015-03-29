<?php
session_start();
include("../../libs/db.class.php");
$db = new DB();

if (empty($_FILES['audios'])) {
    echo json_encode(['error'=>'No files found for upload.']); 
    // or you can throw an exception 
    return; // terminate
}
 
// get the files posted
$audios = $_FILES['audios'];
 
$success = null;
$calendar = $_REQUEST['calendar'];
$paths= [];
// get file names
$filenames = $audios['name'];
// loop and process files

$ext = explode('.', basename($filenames));
$target = "../../../uploads/audios/".$_REQUEST['calendar'] . "." . array_pop($ext);

if(move_uploaded_file($audios['tmp_name'], $target)) {
    $success = true;
    $paths[] = $target;
} else {
    $success = false;
    break;
}

 
// check and process based on successful status 
if ($success === true) {
	$sql = "UPDATE calendar SET audio='$target', exam_state='audio' WHERE id=$calendar";
	$db->doSql($sql);
	$sql = "UPDATE calendar_exam SET exam_state='audio' WHERE calendar=$calendar";
	$db->doSql($sql);
    $sql = "SELECT username FROM users WHERE id=".$_SESSION['UserId'];
    $row = $db->doSql($sql);
    $desc = "Audio subido por ".$row['username'];
    include("../../libs/insertLog.php");
    insertLog("calendar", $_SESSION['UserId'], $calendar, "u", $desc);

    // call the function to save all data to database
    // code for the following function `save_data` is not 
    // mentioned in this example
 
    // store a successful response (default at least an empty array). You
    // could return any additional response info you need to the plugin for
    // advanced implementations.
    $output = [];
    // for example you can get the list of files uploaded this way
    // $output = ['uploaded' => $paths];
} elseif ($success === false) {
    $output = ['error'=>'Error while uploading audios. Contact the system administrator'];
    // delete any uploaded files
    foreach ($paths as $file) {
        unlink($file);
    }
} else {
    $output = ['error'=>'No files were processed.'];
}
 
// return a json encoded response for plugin to process successfully
echo json_encode($output);
?>