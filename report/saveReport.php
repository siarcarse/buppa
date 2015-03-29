<?
session_start();
$users_tipe = $_SESSION['UserId'];
include("../../libs/db.class.php");
$db = NEW DB();
$db2 = NEW DB();
$exams = explode("-", $_REQUEST['calendar_exam']);
$calendar = $_REQUEST['calendar'];
$name = $_REQUEST['name'];
$users = $_REQUEST['users'];
$date = date('Y-m-d');
$template = $_REQUEST['template'];
$report = $_REQUEST['report'];
$report = str_replace('*', '&', $report);
$report = str_replace('#', '?', $report);
$calendar = $_REQUEST['calendar'];
$sql = "INSERT INTO report_history (date, template, report, users, calendar, users_tipe) VALUES ('$date', $template, '$report', $users, $calendar, $users_tipe)";
$db->doSql($sql);
$sql = "SELECT last_value as id FROM report_history_seq";
$row = $db->doSql($sql);
$history = $row['id'];
$contador = count($exams);
for ($i=0; $i < $contador; $i++) {
    $id = $exams[$i];
    $calendar_exam = $data['id'];
    $sql = "UPDATE calendar_exam SET exam_state='informado', history=$history WHERE id=$id";
    $db->doSql($sql);

    /*$sql = "INSERT INTO history_calendar (calendar_exam, history, state ) VALUES ($id, $history, 'informado')";
    $db->doSql($sql);*/
}
$sql = "SELECT username FROM users WHERE id=$users_tipe";
$row = $db->doSql($sql);
$desc = "Agendamiento Informado por ".$row['username'];
include("../../libs/insertLog.php");
insertLog("calendar", $_SESSION['UserId'], $calendar, "u", $desc);

$sql = "SELECT COUNT(id) AS total FROM calendar_exam WHERE calendar=$calendar";
$data = $db->doSql($sql);
$total = $data['total'];
$sql = "SELECT COUNT(id) AS total_exams FROM calendar_exam WHERE calendar=$calendar AND exam_state='informado'";
$data = $db->doSql($sql);
$total_exams = $data['total_exams'];

if($total != $total_exams){
    $informado = 'No';
}
if($informado !='No')
{
    $sql = "UPDATE calendar SET exam_state='informado' WHERE id=$calendar";
    $db->doSql($sql);
    echo 'informado';
}else {
    echo "ok";
}
?>