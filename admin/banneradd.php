<?php
session_start();
$title="Agregar Banner";
/* Llamar la Cadena de Conexion*/ 
include ("../conexion.php");
//Insert un nuevo producto
$imagen_demo="demo.png";
$insert=mysqli_query($con,"insert into banner (url_image, estado) values ('$imagen_demo','0')");
$sql_last=mysqli_query($con,"select LAST_INSERT_ID(id) as last from banner order by id desc limit 0,1");
$rw=mysqli_fetch_array($sql_last);
$id_banner=intval($rw['last']);
$sql=mysqli_query($con,"select * from banner where id='$id_banner' limit 0,1");
$count=mysqli_num_rows($sql);
if ($count==0){
	//header("location: bannerlist.php");
	//exit;
}
$rw=mysqli_fetch_array($sql);
$titulo=$rw['titulo'];
$descripcion=$rw['descripcion'];
$url_image=$rw['url_image'];
$orden=intval($rw['orden']);
$estado=intval($rw['estado']);

$active_config="active";
$active_banner="active";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/ico/favicon.ico">
    <title><?php echo $title;?></title>
    <!-- Bootstrap core CSS -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">
	<link href="css/preview-image.css" rel="stylesheet">
  </head>
  <body>
		<?php include("top_menu.php");?>

    <div class="container">
		
      <!-- Main component for a primary marketing message or call to action -->
      <div class="row">
 
	   <ol class="breadcrumb">
		  <li><a href="#">Inicio</a></li>
		  <li><a href="bannerlist.php">Banner</a></li>
		  <li class="active">Editar</li>
		</ol>
		 <div class="col-md-7">
		 <h3 ><span class="glyphicon glyphicon-edit"></span> Editar banner</h3>
			<form class="form-horizontal" id="editar_banner">
				 
			 
			  
			  <div class="form-group">
				<label for="titulo" class="col-sm-3 control-label">Titulo</label>
				<div class="col-sm-9">
				  <input type="text" class="form-control" id="titulo" value="<?php echo $titulo;?>" required name="titulo">
				  <input type="hidden" class="form-control" id="id_banner" value="<?php echo intval($id_banner);?>" name="id_banner">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="titulo" class="col-sm-3 control-label">Descripción</label>
				<div class="col-sm-9">
				  <textarea class='form-control' name="descripcion" id="descripcion" required rows=8><?php echo $descripcion;?></textarea>
				</div>
			  </div>	
			  
			
			  
			  <div class="form-group">
				<label for="orden" class="col-sm-3 control-label">Orden</label>
				<div class="col-sm-9">
				  <input type="number" class="form-control" id="orden" name="orden" value="<?php echo $orden;?>">
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-9">
				  <select class="form-control" id="estado" required name="estado">
					<option value="0" <?php if($estado==0){echo "selected";} ?>>Inactivo</option>
					<option value="1" <?php if($estado==1){echo "selected";} ?>>Activo</option>
				 </select>
				</div>
			  </div>
			  
			
			 
			  
			  
			  <div class="form-group">
			  <div id='loader'></div>
			  <div class='outer_div'></div>
				<div class="col-sm-offset-3 col-sm-9">
				  <button type="submit" class="btn btn-success">Actualizar datos</button>
				</div>
			  </div>
			</form>
			
			
			
		</div>
		<div class="col-md-5">
		 <h3 ><span class="glyphicon glyphicon-picture"></span> Imagen</h3>
		 
		 <form class="form-vertical">
		 
			<div class="form-group">
				
				<div class="col-sm-12">
				
				 
				 <div class="fileinput fileinput-new" data-provides="fileinput">
								  <div class="fileinput-new thumbnail" style="max-width: 100%;" >
									  <img class="img-rounded" src="../img/banner/<?php echo $url_image;?>" />
								  </div>
								  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 250px; max-height: 250px;"></div>
								  <div>
									<span class="btn btn-info btn-file"><span class="fileinput-new">Selecciona una imagen</span>
									<span class="fileinput-exists" onclick="upload_image();">Cambiar imagen</span><input type="file" name="fileToUpload" id="fileToUpload" required onchange="upload_image();"></span>
									<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Cancelar</a>
								  </div>
					</div>
					<div class="upload-msg"></div>
					
				</div>
				
			  </div>
			  
			
			  
			 
			  
			  
		 </form>
		</div>
    </div> 
	</div><!-- /container -->

		<?php include("footer.php");?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="js/jasny-bootstrap.min.js"></script>
	
  </body>
</html>
	<script>
			function upload_image(){
				$(".upload-msg").text('Cargando...');
				var id_banner=$("#id_banner").val();
				var inputFileImage = document.getElementById("fileToUpload");
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('fileToUpload',file);
				data.append('id',id_banner);
				
				$.ajax({
					url: "ajax/upload_banner.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$(".upload-msg").html(data);
						window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 5000);
					}
				});
				
			}
			
			function eliminar(id){
				var parametros = {"action":"delete","id":id};
						$.ajax({
							url:'ajax/upload2.php',
							data: parametros,
							 beforeSend: function(objeto){
							$(".upload-msg2").text('Cargando...');
						  },
							success:function(data){
								$(".upload-msg2").html(data);
								
							}
						})
					
				}
				
				
				
				
			
	</script>
	<script>
		$("#editar_banner").submit(function(e) {
			
			  $.ajax({
				  url: "ajax/editar_banner.php",
				  type: "POST",
				  data: $("#editar_banner").serialize(),
				   beforeSend: function(objeto){
					$("#loader").html("Cargando...");
				  },
				  success:function(data){
						$(".outer_div").html(data).fadeIn('slow');
						$("#loader").html("");
					}
			});
			 e.preventDefault();
		});
	</script>

	

