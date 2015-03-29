<?php
include "db.conf.php";
$dbconn = pg_connect("host=$hostname port=$port dbname=$database user=$username password=$password") or die('NO HAY CONEXION: ' . pg_last_error());
$idate = $_REQUEST['idate'];
$fdate = $_REQUEST['fdate'];
$sql = "SELECT study_datetime, study_iuid AS uid, accession_no, study_status AS status, study.study_custom1 AS prioridad, num_instances AS imagenes, 
        study.study_custom2 AS infomed, mods_in_study,
        (SELECT to_char((NOW() - study.study_datetime), 'DD ".'"dias"'."-HH24 ".'"hrs"'."-MI ".'"min"'."')) as tiempo, study_desc, study.pk, pat_name, pat_id 
        FROM study 
        LEFT JOIN patient ON patient.pk=study.patient_fk
        WHERE study.study_datetime between TO_TIMESTAMP('$idate', 'YYYY-MM-DD HH24:MI:SS') AND TO_TIMESTAMP('$fdate', 'YYYY-MM-DD HH24:MI:SS')
        ORDER BY study_datetime DESC";
$result = pg_query($sql) or die("SQL Error 1: " . pg_last_error());
while ($row = pg_fetch_array($result, null, PGSQL_ASSOC)) {
	$pk = $row['pk'];
	$row['pat_name'] = str_replace('.,', ' ', $row['pat_name']);
    $row['pat_name'] = str_replace(',', '', $row['pat_name']);
    $row['pat_name'] = str_replace('.', '', $row['pat_name']);
    $row['pat_name'] = str_replace('^', ' ', $row['pat_name']);
    $row['pat_name'] = str_replace('_', ' ', $row['pat_name']);
	$pat_name = $row['pat_name'];
    $pat_id = $row['pat_id'];
	$uid = $row['uid'];
	$study_datetime = $row['study_datetime'];
	$study_desc = $row['study_desc'];
	$prioridad = $row['prioridad'];
	$imagenes = $row['imagenes'];
	$accession_no = $row['accession_no'];
	$study_status = $row['status'];
	$studies['data'][] = array($pk, $pat_name, $pat_id, $study_datetime, $study_desc, $accession_no, $imagenes, $prioridad, $study_status, $uid, $pk);
}
echo json_encode($studies);
?>