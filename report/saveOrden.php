<?
/*error_reporting("E_ALL");
ini_set("display_error", "On");*/
include("../../libs/db.class.php");
$db = new DB();
$calendar = $_REQUEST['calendar'];
$valid_exts = array('mp3', 'aac', 'midi'); // valid extensions
$path = '../../../uploads/audios/'; // upload directory
$ext = strtolower(pathinfo($_FILES[0]['name'], PATHINFO_EXTENSION));
$id = $_REQUEST['pk'];
if (in_array($ext, $valid_exts)) {
    $path = $path . $calendar. '.' .$ext;
    // move uploaded file from temp to uploads directory
    var_dump($_FILES[0]);
    if (move_uploaded_file($_FILES[0]['tmp_name'], $path)) {
        $sql = "UPDATE calendar SET audio='$target', exam_state='audio' WHERE id=$calendar";
        $db->doSql($sql);
        $sql = "UPDATE calendar_exam SET exam_state='audio' WHERE calendar=$calendar";
        $db->doSql($sql);
        //echo "<img src='$path' />";
        echo ini_get('upload-max-filesize'),'<br />'
        ,ini_get('post-max-size'),'<br />';
    }
} else {
    echo json_encode(['error'=>'No files found for upload.']);
}
?>