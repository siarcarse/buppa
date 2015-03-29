<?
include("../../libs/db.class.php");
$db = NEW DB();
$calendar = $_REQUEST['calendar'];
$sql = "SELECT COUNT(id) AS contador FROM report_history WHERE calendar=$calendar";
$data = $db->doSql($sql);
echo $data['contador'];
?>