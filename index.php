<html lang="pt-BR"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title id="title">CASTROMS 2021 PHP </title>
<meta name="description" content="">
<meta name="description" content="">
<link rel="icon" href="https://i.imgur.com/mzXJCRP.png" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="robots" content="all,follow">
<link rel="stylesheet" href="_style/_chks/_one/bootstrap.min.css">
<script src="_style/_chks/_one/jquery.min.js"></script>
<link rel="stylesheet" href="_style/_chks/_one/font-awesome.min.css">
<link rel="stylesheet" href="_style/_chks/_one/fontastic.css">
<link rel="stylesheet" href="_style/_chks/_one/style.default.premium.css" id="theme-stylesheet">
<link rel="stylesheet" href="_style/_chks/_one/custom.css">
<style type="text/css">
  .btn{
    border-radius: 1.25rem;
  }
  .body{
    background-color: #212529;
  }
  .azul{

    background-color: #00073c;
  }
 
</style>

<script>
    var audio = new Audio('_style/_sounds/live.mp3');
    $(document).ready(function () {
    $('#status').html('<span id="bad" class="badge badge-danger">Não iniciado!</span>');
    $('#testar').attr('disabled', null);

    $('#testar').click(function () {
    audio.play();
    var line = $('#list').val().split('\n');
    var total = line.length;
    var ap = 0;
    var rp = 0;
    $('#carregadas').html(total);
    line.forEach(function (value) {
      var list = value.split('|');
      var cc = list[0];
      var mes = list[1];
      var ano = list[2];
      var cvv = list[3];
      var ajaxCall = $.ajax({
        url: 'api/api.php',
        type: 'GET',
        data: 'lista=' + value,
        beforeSend: function () {
          $('#stop').attr('disabled', null);
          $('#testar').attr('disabled', 'disabled');
          $('#status').html('<span id="bad" class="badge badge-info">Testando!</span>');
        },
        
        success: function(data){
          if(data.indexOf("#Correta") >= 0){
            $("#lives").val(data + "\n" + $("#lives").val());
            ap = ap + 1;
            document.getElementById("lives").innerHTML += data + "";
            $('#status').html('<span id="bad" class="badge badge-success">Correta!</span>');
            audio.play();
            removelinha();
            function escondelive() {
              $('#lives').toggle(200, function () {
                  if ($(this).is(':visible')) {
                    $('#btn_live').html('<i class="fa fa-minus-square"></i>');
                  } else {
                    $('#btn_live').html('<i class="fa fa-plus-square"></i>');
                  }
              });
            }
          }else{
            $("#dies").val(data + "\n" + $("#dies").val());
            rp = rp + 1;
            document.getElementById("dies").innerHTML += data + "";
            $('#status').html('<span id="bad" class="badge badge-danger">Reprovada!</span>');
            removelinha();
            function esconderdie() {
              $('#dies').toggle(200, function () {
                if ($(this).is(':visible')) {
                  $('#escondedie').html('<i class="fa fa-minus-square">');
                } else {
                  $('#escondedie').html('<i class="fa fa-plus-square">');
                }
              });
            }
          }
          
          var fila = parseInt(ap) + parseInt(rp);
          $('#cLive').html(ap);
          $('#cDie').html(rp);
          $('#total').html(fila);
          var result = (fila/total)*100;
          $('#pct').html(result);
          $('#title').html('[' + fila + '/' + total + '] CENTRAL ILLUSIONIZE');
          document.getElementById("progreso").style.width = result + "%";
          if (fila == total) {
            $('#testar').attr('disabled', null);
            $('#stop').attr('disabled', 'disabled');
            audio.play();
            $('#status').html('<span class="badge badge-info">Teste Finalizado!</span>');

          }
        }
      });
      
      $('#stop').click(function () {
        ajaxCall.abort();
        $('#testar').attr('disabled', null);
        $('#stop').attr('disabled', 'disabled');
        $('#status').html('<span class="badge badge-danger">Parado!</span>');
      });
    });
  });
});

    function stopado() {
      var lines = $("#list").val().split('\n');
      lines.splice(0, 1);
      $("#list").val(lines.join("\n"));
    }
    
    function removelinha() {
      var lines = $("#list").val().split('\n');
      lines.splice(0, 1);
      $("#list").val(lines.join("\n"));
    }

    $(document).ready(function(){
      $("#bode").hide();
      $("#esconde").show();
      $('#mostra').click(function(){
        $("#bode").slideToggle();
      });
    });

    </script>
<script type="text/javascript">//<![CDATA[

    
jQuery(window).load(function() {
  $(".loader").delay(1500).fadeOut("slow"); //retire o delay quando for copiar!
  $("#tudo_page").toggle("fast");
});



//]]></script>
<div id="loader" class="loader"></div>
<head>
<body class="page body">
  <section class="dashboard-header">
    <div class="container-fluid">
      <div class="card-header azul">
        <a class="btn btn-info" href="?central=login">VOLTAR</a><br><br>
          <h4 class="card-title" id="basic-layout-form" align='left'>
            <li class="list-group-item">Status: <b id="status"></b></li><br>
          </h4>
        </div>
      <div class="row">
        <div class="statistics col-lg-3 col-12">
          <div class="statistic d-flex align-items-center bg-white has-shadow">
            <div class="icon bg-green"><i style="padding-top: 25%;" class="fa fa-check"></i></div>
            <div class="text"><strong id="cLive">0</strong><br><small>Corretas</small></div>
          </div>
          
          <div class="statistic d-flex align-items-center bg-white has-shadow">
              <div class="icon bg-red"><i style="padding-top: 25%;" class="fa fa-close"></i></div>
              <div class="text"><strong id="cDie">0</strong><br><small>Reprovadas</small></div>
          </div>
          
          <div class="statistic d-flex align-items-center bg-white has-shadow">
            <div class="icon bg-info"><i style="padding-top: 25%;" class="fa fa-battery-full"></i></div>
            <div class="text"><strong id="carregadas">0</strong><br><small>Carregadas</small></div>
          </div>
          
          <div class="statistic d-flex align-items-center bg-white has-shadow">
            <div class="icon bg-primary"><i style="padding-top: 25%;" class="fa fa-handshake-o "></i></div>
            <div class="text"><strong id="total">0</strong><br><small>Testadas</small></div>
          </div>
        </div>
      
        <div class="statistics col-lg-9 col-12">
            <div class="statistic bg-white has-shadow">
              <blockquote class="blockquote mb-0 card-body">
                <h4 style="text-align: center;"><b>PROJETO PHP OASGAMES</b></h4>
                 <textarea rows="7" class="form-control" id="list" style="resize: none; outline: 0; text-align: center; width: 100%;"></textarea>
                 <br>
                 <div class="progress">
                    <div role="progressbar" id="progreso" style="height: 100%; border: solid 1px purpul;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-primary"></div>
                </div><br>

                <button id="testar" style="float: left; width: 48%;" class="btn btn-success btn-min-width">
                 	<i class="fa fa-play"></i> Iniciar</button>
         
                <button disabled="" id="stop" style="float: left; width: 48%; margin-left: 3%;" class="btn btn-danger btn-min-width"><i class="fa fa-pause"></i> Pausar</button><br>
              </blockquote>
            </div>
        </div>

      <div style="margin-top: 10px;" class="statistics col-lg-20 col-12">
        <div class="articles card">
          <div class="card-close">
            <div class="dropdown">
              <span class="pull-right">
                  <button type="button" id="btn_live1" class="btn btn-outline-info">Mostrar/Ocultar</button>
                
              </span>
            </div>
          </div>
          
          <div class="card-header d-flex align-items-center">
            <h4 class="card-title" align='left' >Corretas</h4>
            <div id="bode"></div>
          </div>
          <div class="card-body no-padding">
        <table class="table table-bordered">
          <thead></thead>
          <tbody>
          </tr><span>
          <div> 
            <tbody id="lives" class="lives"></span></tbody>
        </table>
         </div>
         </div>
         </div>
        </div>
        
        <div style="margin-top: 10px;" class="statistics col-lg-15 col-15">
          <div class="articles card">
            <div class="card-close">
              <div class="dropdown">
                <span class="pull-right">
                  <button type="button" id="btn_die" class="btn btn-outline-info">Mostrar/Ocultar</button>
                </span>
              </div>
            </div>

            <div class="card-header d-flex align-items-center">
                <h4 class="card-title" align='left' >Reprovadas</h4>
                <div id="bode2"></div>
            </div>
            <div class="card-body no-padding">
            <table class="table table-bordered">
            <thead></thead>
            <tbody>
            </tr><span>
            <tbody id="dies" class="dies"></span></tbody>
          </table>
        </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js" type="text/javascript"></script>

<script type="text/javascript">
            $(document).ready(function () {
                $('#btn_live1').click(function () {
                    $('#lives').toggle(1000);
                });
                $('#btn_die').click(function () {
                    $('#dies').toggle(1000);
                });
                $('#btn-sock-hide').click(function () {
                    $('#sock_ruim').toggle(1000);
                });

            });
        </script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/js/mdb.min.js"></script>
<script src="_style/_chks/_one/popper.min.js"> </script>
<script src="_style/_chks/_one/bootstrap.min.js"></script>
<script src="_style/_chks/_one/jquery.cookie.js"> </script>
<script src="_style/_chks/_one/jquery.validate.min.js"></script>
<script src="_style/_chks/_one/charts-home.js"></script>
    
    <script src="_style/_chks/_one/front.js"></script>
  