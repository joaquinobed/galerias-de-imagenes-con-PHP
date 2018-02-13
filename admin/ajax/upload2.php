<?php
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES["fileToUpload"]["type"])){
/* Llamar la Cadena de Conexion*/ 
include ("../../config/conexion.php");

$id_producto=intval($_POST['id']);
$target_dir = "../../images/productos/";
$carpeta=$target_dir.$id_producto."/";
if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
}

$target_file = $carpeta . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $errors[]= "El archivo es una imagen - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $errors[]= "El archivo no es una imagen.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $errors[]="Lo sentimos, archivo ya existe.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 524288) {
    $errors[]= "Lo sentimos, el archivo es demasiado grande.  Tamaño máximo admitido: 0.5 MB";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $errors[]= "Lo sentimos, sólo archivos JPG, JPEG, PNG & GIF  son permitidos.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $errors[]= "Lo sentimos, tu archivo no fue subido.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       $messages[]= "El Archivo ha sido subido correctamente.";
	   $ruta="images/productos/$id_producto/".$_FILES["fileToUpload"]["name"];
	 $insert=mysqli_query($con,"insert into images (id_producto, url) values ('$id_producto','$ruta')");
	   
    } else {
       $errors[]= "Lo sentimos, hubo un error subiendo el archivo.";
    }
}

if (isset($errors)){
	?>
	<div class="alert alert-danger alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Error!</strong> 
	  <?php
	  foreach ($errors as $error){
		  echo"<p>$error</p>";
	  }
	  ?>
	</div>
	<?php
}

if (isset($messages)){
	?>
	<div class="alert alert-success alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <strong>Aviso!</strong> 
	  <?php
	  foreach ($messages as $message){
		  echo"<p>$message</p>";
	  }
	  ?>
	</div>
	<?php
}
$query_images=mysqli_query($con,"select * from images where id_producto='$id_producto'");
while ($rw_images=mysqli_fetch_array($query_images)){
	$url=$rw_images['url'];
	$id_image=$rw_images['id_image'];
	?>
	<div class="fileinput-new thumbnail" style="max-width: 250px; max-height: 250px;" >
	  <img class="img-rounded" src="../<?php echo $url;?>" />
	  <a href="#" onclick="eliminar('<?php echo $id_image;?>');"><i class='glyphicon glyphicon-trash'></i> Eliminar</a>
	</div>
	 
	<?php
}
}
$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
if($action == 'delete'){
	/* Llamar la Cadena de Conexion*/ 
	include ("../../config/conexion.php");
	$id_image=intval($_REQUEST['id']);
	$get_url=mysqli_query($con,"select * from images where id_image='$id_image'");
	$rw_url=mysqli_fetch_array($get_url);
	$url_del=$rw_url['url'];
	$id_producto=$rw_url['id_producto'];
	//Borra el fichero
	$delete='../../'.$url_del;
	@unlink($delete);
	$delete_sql=mysqli_query($con,"delete from  images where id_image='$id_image'");
	$query_images=mysqli_query($con,"select * from images where id_producto='$id_producto'");
	while ($rw_images=mysqli_fetch_array($query_images)){
		$url=$rw_images['url'];
		$id_image=$rw_images['id_image'];
		?>
		<div class="fileinput-new thumbnail" style="max-width: 250px; max-height: 250px;" >
		  <img class="img-rounded" src="../<?php echo $url;?>" />
		  <a href="#" onclick="eliminar('<?php echo $id_image;?>');"><i class='glyphicon glyphicon-trash'></i> Eliminar</a>
		</div>
		 
		<?php
	}
}
?> 