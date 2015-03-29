<?php
/*error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);*/
if(isset($_REQUEST['id']))
{
  $id = $_REQUEST['id'];
  $file = "../../../reports/$id.pdf";
  $fileSigned = "../../../reports/$id"."_signed.pdf";

  include("../../libs/db.class.php");

  $db = new DB();
  $sql = "SELECT users.cert AS cert, users.sign AS sign, commune.name AS commune
          FROM calendar_exam 
          LEFT JOIN report_history ON report_history.id=$id 
          LEFT JOIN users ON users.id=report_history.users 
          LEFT JOIN calendar ON calendar.id=calendar_exam.calendar 
          LEFT JOIN room ON room.id=calendar.room 
          LEFT JOIN branch ON branch.id=room.branch
          LEFT JOIN commune ON commune.id=branch.commune
          WHERE history=$id LIMIT 1";
  $row = $db->doSql($sql);
  
  $cert = $row['cert'];
  $sign = $row['sign'];
  $commune = $row['commune'];

  if($cert){
    if(file_exists($file)) {
      $command = "java -jar ../../tools/portableSigner/PortableSigner.jar -n -t $file -o $fileSigned -s ../../../uploads/certs/$cert -p $sign -l $commune -r InformeRadiologico";
      $exec = system($command);
      echo 1;
    } else {
      echo 0;
    }
  } else {
    echo 0;
  }

  
}
?>