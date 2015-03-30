<?php
$today = date("Y-m-d");
$study = $_REQUEST["pk"];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Modulo de informes</title>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="https://bootswatch.com/slate/bootstrap.min.css">
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!--    <link rel="stylesheet" href="../js/flat/dist/css/flat-ui.css">-->
    <script src="js/ckeditor/ckeditor.js"></script>
    <script src="js/ckeditor/config.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <!--<link rel="stylesheet" type="text/css" href="../tools/datepicker-bootstrap/css/datepicker.css">-->
    <link rel="stylesheet" media="screen" href="../tools/file-upload/css/fileinput.css">
    <script type="text/javascript" src="../tools/file-upload/js/fileinput.js"></script>
    <script type="text/javascript" language="javascript" src="../tools/datepicker-bootstrap/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" language="javascript" src="../tools/datepicker-bootstrap/js/locales/bootstrap-datepicker.es.js"></script>
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
                                <div></div>                           
                            </div>
                            <div class="row">
                                <div id="divAudio" style="display:none;" class="col-xs-9 col-sm-9 col-md-9 col-lg-9 col-md-push-7">
                                    <audio id="player" controls="controls">
                                        <source id="src" src="../../../uploads/audios/213251.mp3" type="audio/mpeg">
                                    </audio>
                                </div>
                            </div>
                            
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#sectionA"><i class="fa fa-file-text-o"></i> Informe</a></li>
                                <li id = "patientTab" ><a data-toggle="tab" href="#sectionB"><i class="fa fa-heartbeat"></i> Datos del paciente</a></li>
                                <li id = "anamesadasTab" ><a data-toggle="tab" href="#sectionC"><i class="fa fa-medkit"></i> Anammesis</a></li>
                                <li id = "docsTabs" ><a data-toggle="tab" href="#sectionD"><i class="fa fa-files-o"></i> Documentos</a></li>
                                <li><a data-toggle="tab" href="#sectionE"><i class="fa fa-file-audio-o"></i> Audios</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="sectionA" class="tab-pane fade in active">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        Fecha
                                        <br>
                                        <div class="input-group date">
                                            <input type="text" id="date" class="form-control" maxlength="10"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        Nombre Examen/Informe
                                        <br>
                                        <input type="text" name="" id="name" class="form-control" value="" required="required" pattern="" title="" placeholder="Nombre">
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="divider"></div>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        Médico Informante
                                        <br>
                                        <select name="" id="doctor" class="form-control">
                                            <option value="0">-- Seleccione Doctor --</option>
                                            <option value="1">Doctor 1</option>
                                            <option value="2">Doctor 2</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        Plantillas
                                        <br>
                                        <select name="" id="template" class="form-control">
                                            <option value="">-- Seleccione Plantilla --</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        Informe
                                        <br>
                                        <textarea class="ckeditor" id="report" name="report"></textarea>
                                    </div>

                                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                      <br>
                                        <button id="informar" type="button" class="btn btn-primary">Informar</button>
                                    </div>
                                    <!--
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <button id="audio" type="button" class="btn btn-danger">Subir Audio <i class="fa fa-upload"></i>  <i class="fa fa-file-audio-o"></i></button>
                                    </div>
                                    -->

                                </div>
                                <div id="sectionB" class="tab-pane fade">
                                <div class="container">
                                    <div class="row">
                                        <div class=" col-md-3 -col-sm-3 col-md-3 -col-sm-3">
                                            <b>Antecedentes</b>
                                            <li><input type="checkbox"> DM</li>
                                            <li><input type="checkbox"> HTA</li>
                                            <li><input type="checkbox"> Dislipidemia</li>
                                            <li><input type="checkbox"> IRC</li>
                                            <li><input type="checkbox"> TVP</li>
                                            <li><input type="checkbox"> Insuficiencia Venosa</li>
                                            <li><input type="checkbox"> EAO</li>
                                            <li><input type="checkbox"> Enfermedad Inflamatoria</li>
                                            <li><input type="checkbox"> Cancer</li>
                                            <li><input type="checkbox"> Tabaquismo</li>
                                            <li><input type="checkbox"> OH</li>
                                        </div>
                                        <div class=" col-md-3 -col-sm-3 col-md-3 -col-sm-3">
                                            <b>Antecedentes Familiares</b>
                                            <li><input type="checkbox"> Cancer</li>
                                            <li><input type="checkbox"> DM</li>
                                            <li><input type="checkbox"> HTA</li>
                                            <li><input type="checkbox"> Insuficiencia Venosa</li>
                                            <li><input type="checkbox"> Insuficiencia Arterial</li>
                                            <li><input type="checkbox"> Enfermedades Inflamatorias</li>
                                        </div>
                                        <div class=" col-md-4 -col-sm-4 col-md-4 -col-sm-4">
                                            <b>Enfermedades de transmision sexual</b>
                                            <li><input type="checkbox"> VIH</li>
                                            <li><input type="checkbox"> Hepatitis C</li>
                                            <li><input type="checkbox"> Hepatitis B</li>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                           <b>Alergias:</b>
                                            <br>
                                            <input type="text" name="" id="meh" class="form-control" value="" required="required" pattern="" title="" placeholder="Alergias">
                                        </div>
                                         <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                           <b>Medicamentos:</b>
                                            <br>
                                            <input type="text" name="" id="meh" class="form-control" value="" required="required" pattern="" title="" placeholder="medicamentos">
                                        </div>
                                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                           <b>Otras patologias:</b>
                                            <br>
                                            <input type="text" name="" id="meh" class="form-control" value="" required="required" pattern="" title="" placeholder="patologias">
                                        </div>
                                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                           <b>Peso:</b>
                                            <br>
                                            <input type="text" name="" id="meh" class="form-control" value="" required="required" pattern="" title="" placeholder="peso">
                                        </div>
                                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                           <b>Talla:</b>
                                            <br>
                                            <input type="text" name="" id="meh" class="form-control" value="" required="required" pattern="" title="" placeholder="talla">
                                        </div>
                                        <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                                           <b>Operaciones:</b>
                                            <br>
                                            <input type="text" name="" id="meh" class="form-control" value="" required="required" pattern="" title="" placeholder="operaciones">
                                        </div>
                                    
                                    </div>
                                    <div class="row">
                                        <div class=" col-md-10 col-sm-10">
                                            <br>
                                            <b>Observaciones:</b>
                                            <textarea class="form-control" rows="5" placeholder="Observaciones"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class=" col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                            <button id="meh" type="button" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>

                                </div>
                                    
                                    
                                </div>
                                <div id="sectionC" class="tab-pane fade">
                                    <div class="row">
                                        <div class="col-md-offset-1 col-md-10 col-sm-10">
                                            <br>
                                            <textarea class="form-control" rows="5" placeholder="Ingrese anammesis"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-offset-1 col-xs-1 col-sm-1 col-md-1 col-lg-1">
                                            <button id="meh" type="button" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                                <div id="sectionD" class="tab-pane fade">
                                    <br>
                                    <div class="container">
                                        
                                        <div class="row">
                                            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                                <div id="showDocs">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>N°</th>
                                                            <th>Archivo</th>
                                                            <th>Fecha</th>
                                                            <th>Ver</th>
                                                        </tr>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Orden medica</td>
                                                            <td>10-03-2015</td>
                                                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> <i class="fa fa-eye" ></i></button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Anexos</td>
                                                            <td>10-03-2015</td>
                                                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> <i class="fa fa-eye" ></i></button></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody">
                                                        
                                                    </tbody>
                                                </table>
                                                </div>
                                                <div id="toUpload" style="display:none">
                                                   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                   <legend>Subir documentos</legend>
                                                        <form action="" method="POST" role="form">
                                                            <div class="form-group">
                                                                <input name="files" id="pdfFile" type="file" multiple="true" class="file-loading" data-show-upload="true" data-show-preview="true">
                                                                <input type="hidden" name="calendar" id="calendar" class="form-control" value="" required="required" pattern="" title="">
                                                            </div>
                                                         <button id="close" type="submit" class="btn btn-primary">Salir</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                                <div class="dropdown">
                                                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                                    Acciones
                                                    <span class="caret"></span>
                                                  </button>
                                                  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="viewDocs">Ver documentos</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="upload">Subir documento</a></li>
                                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="scan">Escanear documento</a></li>
                                                  </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div id="sectionE" class="tab-pane fade">
                                 <div class="container"> 
                                 <div class="row">
                                    <br>
                                    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
                                        <div id="showAudios">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>N°</th>
                                                    <th>Audio</th>
                                                    <th>Fecha</th>
                                                    <th>Reproducir</th>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Audio 1</td>
                                                    <td>11-03-2015</td>
                                                    <td>
                                                    <audio id="player" controls="controls">
                                                      <source id="src" src="../../../uploads/audios/213251.mp3" type="audio/mpeg">
                                                    </audio>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Audio 2</td>
                                                    <td>11-03-2015</td>
                                                    <td>
                                                    <audio id="player" controls="controls">
                                                      <source id="src" src="../../../uploads/audios/213251.mp3" type="audio/mpeg">
                                                    </audio>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody">
                                                
                                            </tbody>
                                        </table>
                                        </div>
                                        <div id="contentAudio" style="display:none">
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
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <div class="dropdown">
                                          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                                            Acciones
                                            <span class="caret"></span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                          <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="listAudio">Listar audios</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" id="uploadaudio">Subir audio</a></li>
                                           
                                          </ul>
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
        </div>
    </div>
    
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h6 class="modal-title" id="myModalLabel">Orden medica - 10-03-2015</h6>
      </div>
      <div class="modal-body" id="imageDiv">
        <img src="http://placehold.it/700x500" class="img-thumbnail panelTop" style="margin-right: 3%;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

</body>
<script type="text/javascript">
var today = '<?php echo $today; ?>';
var study = '<?php echo $study; ?>';
var flag = false,update = false;
function loadDoctor() {
     loadTemplate(0); //DEMO
    /*
    $.ajax({
            url: '../connectors/getDoctor.php',
            dataType: 'json',
        })
        .done(function(data) {
            var html = '';
            console.log(data);
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
*/

}
function loadTemplate(users) {
    var url;
    
    /*
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
               
            }
            $('#template').html(html).removeAttr('disabled');

        });
    }
    else {
        */
        
        if(users == 1 || users == 2){
            $('#template').removeAttr('disabled');
            var html = '';
            html += '<option value="">-- Seleccione Plantilla --</option>';
            if(users == 1){
                html += '<option value="1"> Plantilla 1 </option>';
                html += '<option value="2"> Plantilla 2</option>';
            }else{
                html += '<option value="3"> Tipo 1</option>';
                html += '<option value="4"> Tipo 2</option>';
            }
            $('#template').html(html).removeAttr('disabled');
        }else{
            $("#template").attr('disabled','disabled');
        }
        //$("#template option[value='']").attr("selected","selected");
        
        //if(!update) 
        //url = 'listTemplate.php';
    //}
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
    /*
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
*/
    
}

function fillExamName(){
    /*
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
    */
}

$(document).ready(function() {

    $("#pdfFile").fileinput({
        uploadAsync: false,
        uploadUrl: "uploadPdf.php",
        uploadExtraData: function() {
            return {
                calendar: calendar
            };
        },
        multiple: true,
        showUpload:true, 
        previewFileType:'text',
        allowedFileExtensions: ["pdf"],
        previewClass: "bg-active"
    });

    $("#upload").click(function(event) {
        $("#showDocs").fadeOut('fast', function() {
            $("#toUpload").fadeIn();
        });
    });
    $("#viewDocs").click(function(event) {
        $("#toUpload").fadeOut('fast', function() {
            
            $("#showDocs").fadeIn();
        });
    });

    $("#uploadaudio").click(function(event) {
        $("#showAudios").fadeOut('fast', function() {
            $("#contentAudio").fadeIn();
        });
    });
    $("#listAudio").click(function(event) {
        $("#contentAudio").fadeOut('fast', function() {
            
            $("#showAudios").fadeIn();
        });
    });

    /*$.post('../calendar/findAudioExam.php', {
        calendar_exam: calendar_exam
    }, function(data, textStatus, xhr) {
        var path = data;
        //$("#src")[0].src = path;
        if(path){
            var audio = $("#player");      
            $("#src").attr("src", path);
            $("#divAudio").css('display', '');
            audio[0].load();
            audio[0].play();

            console.log($("#src"));
            tableExam.ajax.url('../calendar/getCalendarExamAudio.php?calendar=' + calendar).load();
            tableExam.ajax.reload();
        }
    });*/
    CKEDITOR.replace('report', 
    {
        //contentsCss: [CKEDITOR.basePath + 'https://bootswatch.com/slate/bootstrap.min.css', 'https://bootswatch.com/slate/bootstrap.min.css'],
        allowedContent: true,
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
                calendar_exam: calendar_exam
            };
        },
        multiple: false,
        previewFileType: "audio",
        allowedFileExtensions: ["m4a","mp3", "wav", "aiff", "au", "aac"],
        previewClass: "bg-active"
    });

    //patientInfo();
    loadDoctor();
    //fillExamName();
    loadTemplate(0);
    $('#doctor').change(function(event) {
        
        //($(this).val() != '') ? loadTemplate($(this).val()) :  loadTemplate(0);
        loadTemplate($(this).val());
    });
    $('#template').change(function(event) {
        /*
        $.post('findTemplate.php', {id:$(this).val(), calendar:calendar}, function(data, textStatus, xhr) {
            createReport(data);
        });
        */
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
           $.post('../connectors/updateState.php', {study:study}, function(data, textStatus, xhr) {
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


});
</script>

</html>
