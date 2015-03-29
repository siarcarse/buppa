<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Asignación de Tipeadoras</title>
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../js/datatable/extensions/Plugins/integration/bootstrap/3/dataTables.bootstrap.css">
    <link rel="stylesheet" media="screen" href="../../tools/font-awesome/css/font-awesome.css">
    <style type="text/css">
    #example tbody tr.highlight td {
        background-color: #4cb3d6;
    }
    </style>
    <script type="text/javascript" language="javascript" src="../../js/datatable/media/js/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="../../js/datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" language="javascript" src="../../js/datatable/extensions/Plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Asignacion de Tipeadoras</h3>
                    </div>
                    <div class="panel-body">
                        <section>
                            <legend>Pacientes <strong>Asignados</strong>
                            </legend>
                            <table id="example" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Rut</th>
                                        <th>Tipeadora</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Rut</th>
                                        <th>Tipeadora</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </section>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tipeadoras</h4>
              </div>
              <div class="modal-body">
                <table class="table">

                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Asignada</th>
                        </tr>
                    </thead>
                    <tbody id ='tableBody'>

                    </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">x</button>
              </div>
            </div>
          </div>
        </div>


    </div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    var ajaxComplete = false;
    var url;
    url = "listDoctor.php";
    var table = $('#example').DataTable({
        "ajax": {
            "url": url,
            "data": function(d) {
                ajaxComplete = true;
            }
        },
        "lengthMenu": [
            [5, 10, 20],
            [5, 10, 20]
        ],
        "language": {
            "url": "../../js/datatable/Spanish.json"
        },
        //"bSort":false,
        "aaSorting": [],
        "serverSide": false,
        "processing": true,
        "deferRender": true,
        "fnRowCallback": function(nRow, aData, iDisplayIndex) {
            $(nRow).on("click", function(event) {
                if ($(this).hasClass('highlight')) {
                    $(this).removeClass('highlight');
                } else {
                    table.$('tr.highlight').removeClass('highlight');
                    $(this).addClass('highlight');
                    var calendar = $(this).children().first().text();
                }
            });
            $('td:eq(3)', nRow).addClass('text-center');
            var imgTag = '<i onclick="view(' + aData[0] + ')" style="cursor:pointer;" class="fa fa-users fa-2x"></i>';
            $('td:eq(3)', nRow).html(imgTag);

            return nRow;
        },
        "fnDrawCallback": function(oSettings) {
            if (ajaxComplete) {
                table.columns().eq(0).each(function(colIdx) {
                    $('input', table.column(colIdx).footer()).on('keyup change', function(e) {
                        if (e.keyCode == 13) {
                            table
                                .column(colIdx)
                                .search(this.value)
                                .draw();
                        }
                    });
                });

            }
        },
        "fnInfoCallback": function(oSettings, iStart, iEnd, iMax, iTotal, sPre) {

        }
    });
});


function view (id) {
    console.log(id);
    $('#myModal').modal('toggle');

    $.ajax({
        url: 'typist.php',
        type: 'POST',
        data: {type: 'show',id : id},
    })
    .done(function(data) {
        var json = JSON.parse(data);
        fillTable(json);
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    


}

function fillTable(data) {
    var html = '';
    for (var i = 0; i < data.length; i++) {
        html += '<tr>';

        html += '<td>';
        html += data.id;
        html += '</td>';

        html += '<td>';
        html += data.name;
        html += '</td>';

        html += '<td>';
        html += data.lastname;
        html += '</td>';

        html += '<td>';
        html += ' <input type="checkbox" id="C'+data.id+'"> ';
        html += '</td>';

        html += '</tr>';
    };
    $("#tableBody").append(html);
}

</script>

</html>
