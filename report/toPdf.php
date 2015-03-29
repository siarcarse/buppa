<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
if(isset($_REQUEST['report']))
{
  $id = $_REQUEST['report'];
  $file = "../../../reports/$id.pdf";

  require_once("../../tools/dompdf/dompdf_config.inc.php");
  include("../../libs/db.class.php");

  $db = new DB("report_history", "id");
  $row = $db->doSql("SELECT report FROM report_history WHERE id=$id");
  
  $html = $row['report'];

  $doc = new DOMDocument;
  @$doc->loadHTML($html); 
  $images = $doc->getElementsByTagName('img');
  foreach ($images as $image) {
    $imgPath = $image->getAttribute('src');
    if(substr($imgPath, 0, 4)!='http') {
    	$image->setAttribute('src', 'http://'.$_SERVER['HTTP_HOST'].$imgPath);
    }
  }
  $new_html = $doc->saveHTML();

  $dompdf = new DOMPDF();
  $dompdf->load_html($new_html);
  $dompdf->render();
  $pdf = $dompdf->output();
  if(file_put_contents($file, $pdf)) {
    echo 1;
  } else {
    echo 10;
  }
}
?>

