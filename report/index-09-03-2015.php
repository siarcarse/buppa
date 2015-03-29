<?php
session_start();
$users = $_SESSION['UserId'];
$update = $_REQUEST['update'];
if($update) {
    include("../../libs/db.class.php");
    $db = NEW DB();
    $sql = "SELECT * FROM report_history WHERE id=$update";
    $data = $db->doSql($sql);
    $calendar = $data['calendar'];
    $usersInf = $data['users'];
    $template = $data['template'];
    $report = $data['report'];
    $db = NEW DB();
    $sql = "SELECT id AS exams FROM calendar_exam WHERE history=$update";
    $i = 0;
    $exams = "";
    $data = $db->doSql($sql);
    do {
        if ($i == 0) {
            $exams = $data['exams'];
        }else {
            $exams = $exams."-".$data['exams'];
        }
        $i++;
    } while ($data = pg_fetch_assoc($db->actualResults));
    $calendar_exam = $exams; 
}else {
    $calendar = $_REQUEST['calendar'];
    $calendar_exam = $_REQUEST['calendar_exam'];
} 
$flag = $_REQUEST['flag'];
$today = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Modulo de informes</title>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="js/ckeditor/ckeditor.js"></script>
    <script src="js/ckeditor/config.js"></script>
    <link rel="stylesheet" media="screen" href="../../tools/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="../../js/datepicker-bootstrap/css/datepicker.css">
    <link rel="stylesheet" media="screen" href="../../tools/file-upload/css/fileinput.css">
    <script type="text/javascript" src="../../tools/file-upload/js/fileinput.js"></script>
    <script type="text/javascript" language="javascript" src="../../js/datepicker-bootstrap/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" language="javascript" src="../../js/datepicker-bootstrap/js/locales/bootstrap-datepicker.es.js"></script>
    <style type="text/css">
    .label {
        color: black;
        font-size: 12px;
    }
    .divider {
        height: 40px;
        margin: 0 9px;
        border-bottom: 1px solid #d6d6d6;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Modulo de Informes</h3>
                    </div>
                    <div class="panel-body">
                        <div id="contentReport" class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <legend id= "patient">Paciente: </legend>
                                <div ></div>
                            </div>

                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#sectionA"><i class="fa fa-file-text-o"></i> Informe</a></li>
                                <li id = "patientTab" ><a data-toggle="tab" href="#sectionB"><i class="fa fa-heartbeat"></i> Datos del paciente</a></li>
                                <li id = "anamesadasTab" ><a data-toggle="tab" href="#sectionC"><i class="fa fa-medkit"></i> Anammesis</a></li>
                                <li id = "docsTabs" ><a data-toggle="tab" href="#sectionD"><i class="fa fa-files-o"></i> Documentos</a></li>
                                <li><a data-toggle="tab" href="#sectionE"><i class="fa fa-upload"></i>  <i class="fa fa-file-audio-o"></i> Subir Audio</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="sectionA" class="tab-pane fade in active">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <span class="label">Fecha</span>
                                        <br>
                                        <div class="input-group date">
                                            <input type="text" id="date" class="form-control" maxlength="10"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <span class="label">Nombre Examen/Informe</span>
                                        <br>
                                        <input type="text" name="" id="name" class="form-control" value="" required="required" pattern="" title="" placeholder="Nombre">
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="divider"></div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <span class="label">Médico Informante</span>
                                        <br>
                                        <select name="" id="doctor" class="form-control">
                                            <option value="">-- Seleccione Doctor --</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <span class="label">Plantillas</span>
                                        <br>
                                        <select name="" id="template" class="form-control">
                                            <option value="">-- Seleccione Plantilla --</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <span class="label">Informe</span>
                                        <br>
                                        <textarea class="ckeditor" id="report" name="report"></textarea>
                                    </div>
                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                        <button id="informar" type="button" class="btn btn-primary">Informar</button>
                                    </div>
                                    <!--
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <button id="audio" type="button" class="btn btn-danger">Subir Audio <i class="fa fa-upload"></i>  <i class="fa fa-file-audio-o"></i></button>
                                    </div>
                                    -->

                                </div>
                                <div id="sectionB" class="tab-pane fade">
                                    <iframe src="" id="patientData" frameborder="0" style="overflow:hidden;height:500px;width:100%" height="100%" width="100%"></iframe>
                                </div>
                                <div id="sectionC" class="tab-pane fade">
                                    <iframe src="" id="anammesis" frameborder="0" style="overflow:hidden;height:500px;width:100%" height="100%" width="100%"></iframe>
                                </div>
                                <div id="sectionD" class="tab-pane fade">
                                    <iframe src="" id="docs" frameborder="0" style="overflow:hidden;height:500px;width:100%" height="100%" width="100%"></iframe>
                                </div>
                                 <div id="sectionE" class="tab-pane fade">
                                    <div id="contentAudio" class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <form action="" method="POST" role="form">
                                                <div class="form-group">
                                                    <legend>Subir audio</legend>
                                                    <input name="audios" id="audioFile" type="file" class="file-loading" accept="audio" data-show-upload="true" data-show-preview="true">
                                                    <input type="hidden" name="calendar" id="calendar" class="form-control" value="" required="required" pattern="" title="">
                                                    <!-- <input id="audioFile" type="file" class="file" data-show-upload="false" data-show-preview="false"> -->
                                                </div>
                                                <button id="close" type="submit" class="btn btn-primary">Salir</button>
                                            </form>
                                            <br>
                                           <!-- <button id="back" class="btn btn-primary">Volver</button>-->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
<script type="text/javascript">
var users_session = '<?php echo $users ?>';
var calendar = '<?php echo $calendar ?>';
var calendar_exam = '<?php echo $calendar_exam ?>';
var flag = '<?php echo $flag ?>';
var today = '<?php echo $today ?>';
var update = '<?php echo $update ?>';
var template = '<?php echo $template ?>';
var usersInf = '<?php echo $usersInf ?>';

function loadDoctor() {
    $.ajax({
            url: 'getDoctor.php',
            dataType: 'json',
        })
        .done(function(data) {
            var html = '';
            html += '<option value="">-- Seleccione Doctor --</option>';
            for (var i = 0; i < data.length; i++) {
                if(update) {
                    if(usersInf == data[i].id) html += '<option value="' + data[i].id + '" selected>' + data[i].name + '</option>';
                    else html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                }
                else {
                    html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';    
                }
                
            }
            $('#doctor').html(html);
            if(update) loadTemplate(usersInf); //CARGA PLANTILLA SI SE ESTA ACTUALIZANDO
        });

}
function loadTemplate(users) {
    var url;
    if(users !== 0){
        url = 'listTemplate.php?users='+users;
        $.ajax({
            url: url,
            dataType: 'json',
        })
        .done(function(data) {
        	//console.log(data);
            var html = '';
            html += '<option value="">-- Seleccione Plantilla --</option>';
            if(data) {
                for (var i = 0; i < data.length; i++) {
                    if(update) {
                        if(template == data[i].id) html += '<option value="' + data[i].id + '" selected>' + data[i].name + '</option>';
                        else html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }
                    else {
                        html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';  
                    }
                    //html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                }
               /* original = data;
                createReport(original);*/
            }
            $('#template').html(html).removeAttr('disabled');

        });
    }
    else {
        $("#template option[value='']").attr("selected","selected");
        if(!update) $("#template").attr('disabled','disabled');
        //url = 'listTemplate.php';
    }
}
function createReport(original) {
    str = original;
    setEditorValue('report', str);
}
function setEditorValue( instanceName, text )
{
    var oEditor = CKEDITOR.instances[instanceName] ;
    oEditor.insertHtml(text);
}
function patientInfo() {
    $.ajax({
        url: 'getPatient.php',
        type: 'POST',
        data: {calendar: calendar},
    })
    .done(function(data) {
        var json = JSON.parse(data);
        
        var html = json.name +' '+ json.lastname +'  &nbsp;&nbsp;&nbsp; Rut:'+json.rut;
        $("#patient").append(html);
    });
    
}

function fillExamName(){
    if(calendar_exam.indexOf("-") <= -1){
        $.ajax({
            url: 'getExam.php',
            type: 'POST',
            data: {calendar_exam: calendar_exam},
        })
        .done(function(data) {
            var json = JSON.parse(data);
            $("#name").val(json.name);
        });
        
        
    }
}

$(document).ready(function() {
    CKEDITOR.replace('report', 
    {
        //toolbar : "Basic",
        //enterMode: CKEDITOR.ENTER_BR
    });
    CKEDITOR.editorConfig = function( config ) {
        config.removePlugins = 'magicline';
        config.autoParagraph = false;
        //config.enterMode = CKEDITOR.ENTER_BR;
    };
    CKEDITOR.on('instanceReady', function() {
        $('#cke_report iframe').css('height', '400px');
        //
        var iframe = $('#cke_report iframe').contents ();
        iframe.find ('html').css ({
            'background-color': '#b0b0b0'
        });
        iframe.find ('body').css ({
            'width': '216mm',
            'height': '279mm',
            'background-color': '#ffffff',
            'margin': '5mm',
            'padding': '5mm'
        });
        /*var iframe1 = $('#cke_report').contents ();
        iframe1.find ('#cke_1_top').css ({
            'background': '#9DBBE1'

        });*/
       // $('#cke_1_top').css('background-color': '#9DBBE1');
    });
    var instanceName = 'report';
    cke = CKEDITOR.instances[instanceName];
    cke.on('contentDom', function()
    {
        cke.document.on('keydown', function( event )
        {
            
            if((event.data.$.metaKey==true || event.data.$.keyIdentifier=="Win") && event.data.$.which==219) {
                startButton(event);
            }
        }); 
    });
    $('.input-group.date').datepicker({
        language: 'es',
        format: 'yyyy-mm-dd',
    });
    $('.input-group.date').datepicker('setDate', today);
    if (flag =="audio") {
        $('#audio').css('display', 'none');
    };
    $('.input-group.date').datepicker()
            .on('changeDate', function(e) {
                $('.input-group.date').datepicker('hide');
            });
    $('#calendar').val(calendar);
    $("#audioFile").fileinput({
        uploadAsync: false,
        uploadUrl: "uploadAudio.php",
        uploadExtraData: function() {
            return {
                calendar: $("#calendar").val()
            };
        },
        multiple: false,
        previewFileType: "audio",
        allowedFileExtensions: ["m4a","mp3", "wav", "aiff", "au", "aac"],
        previewClass: "bg-warning"
    });
    patientInfo();
    loadDoctor();
    fillExamName();
    loadTemplate(0);
    $('#doctor').change(function(event) {
        ($(this).val() != '') ? loadTemplate($(this).val()) :  loadTemplate(0);
    });
    $('#template').change(function(event) {
        $.post('findTemplate.php', {id:$(this).val(), calendar:calendar}, function(data, textStatus, xhr) {
            createReport(data);
        });
    });
    // SI ES UPDATE CARGO INFORME ANTERIOR
    if(update) {
       // console.log(update);
        $.post('getContentReport.php', {id:update}, function(data, textStatus, xhr) {
            //createReport(data);
            var oEditor = CKEDITOR.instances['report'] ;
            oEditor.setData(data);
        });
    }
    $('#informar').click(function(event) {
        var date= $('#date').val();
        var name = $("#name").val();
        var template = $("#template").val();
        var doctor = $("#doctor").val();
        if(!doctor) doctor = users_session;
        var report = CKEDITOR.instances.report.getData();
        var data = report.split('&');
        data = data.join('*');
        report = data;
        data = report.split('?');
        data = data.join('#');
        report = data;
        //console.log(date,name,doctor,template);

        var inputs = ['#date','#name','#doctor'];
        var canSave = true
        for (var i = 0; i < inputs.length; i++) {
            if($(inputs[i]).val() == '' ){
                $(inputs[i]).fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
                canSave = false;
            }
        };
        if(date.length != 10){
            $("#date").fadeOut(100).fadeIn(100).fadeOut(100).fadeIn(100);
            canSave = false;
        }
        if(canSave){
           $.post('saveReport.php', {name:name,calendar_exam:calendar_exam,users:doctor,report:report,calendar:calendar,date:date, template:template}, function(data, textStatus, xhr) {
                window.close();
            });
        }

        

    });
    /*
    $('#audio').click(function(event) {
        $('#contentReport').fadeOut('200', function() {
            $('#contentAudio').fadeIn('200', function() {
            
            });
        });
    });
    $('#back').click(function(event) {
        $('#contentAudio').fadeOut('200', function() {
            $('#contentReport').fadeIn('200', function() {
            
            });
        });
    });

*/
    $('#close').click(function(event) {
        event.preventDefault();
        window.close();
    });

    
    $("#anamesadasTab").click(function(event) {
        $("#anammesis").attr('src','../consultation/obsPatientFormAnamnesis.php?calendar='+calendar);
    });
    
    $("#docsTabs").click(function(event) {
        $("#docs").attr('src','../consultation/documents.php?calendar='+calendar);
    });
    $("#patientTab").click(function(event) {
        $("#patientData").attr('src','../consultation/obsPatientForm.php?calendar='+calendar);
    });


});
</script>

</html>
