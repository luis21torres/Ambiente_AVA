
<?php
include ("../../template/header.php");
include ("../../bd.php");

if($_POST){

 //recepcionar los valores del formulario
 
$titulo=(isset($_POST["titulo"]))?$_POST["titulo"]:"";
$subtitulo=(isset($_POST["subtitulo"]))?$_POST["subtitulo"]:"";

$imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";

$descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:"";
$cliente=(isset($_POST["cliente"]))?$_POST["cliente"]:"";
$categoria=(isset($_POST["categoria"]))?$_POST["categoria"]:"";
$url=(isset($_POST["url"]))?$_POST["url"]:"";


$fecha_imagen=new DateTime();
$nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";

$tmp_imagen = $_FILES["imagen"]["tmp_name"];
if($tmp_imagen!=""){
 move_uploaded_file($tmp_imagen,"../../../assets/img/portfolio/".$nombre_archivo_imagen);
 
}

$sentencia=$conexion->prepare("INSERT INTO `tbl_portafolio` (`id`, `titulo`, `subtitulo`, `imagen`, `descripcion`, `cliente`, `categoria`, `url`) VALUES (NULL,:titulo,:subtitulo,:imagen,:descripcion,:cliente,:categoria,:url);");

$sentencia->bindparam(":titulo",$titulo);
$sentencia->bindparam(":subtitulo",$subtitulo);
$sentencia->bindparam(":imagen",$nombre_archivo_imagen);
$sentencia->bindparam(":descripcion",$descripcion);
$sentencia->bindparam(":cliente",$cliente);
$sentencia->bindparam(":categoria",$categoria);
$sentencia->bindparam(":url",$url);

$sentencia->execute();

$mensaje ="registro creado con exito...";
   header("location:index.php?mensaje=".$mensaje);
   
}

?>

<div class="card">
    <div class="card-header">
        
    Nuevo servicio
    </div>
    <div class="card-body">
       
    <form action=""enctype="multipart/form-data" method="post"> 

<div class="mb-3">
  <label for="titulo" class="form-label">Titulo:</label>
  <input type="text"
    class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="titulo">

    </div>
    <div class="mb-3">
      <label for="" class="form-label">subtitulo:</label>
      <input type="text"
        class="form-control" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="subtitulo">
    </div>
    
    <div class="mb-3">
      <label for="imagen" class="form-label">Imagen</label>
      <input type="file" class="form-control" name="imagen" id="imagen" placeholder="imagen" aria- 
          describedby="fileHelpId">
    </div>

<div class="mb-3">
  <label for="Descripcion" class="form-label">Descripcion:</label>
  <input type="text"
    class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
</div>

<div class="mb-3">
  <label for="Cliente" class="form-label">Cliente:</label>
  <input type="text"
    class="form-control" name="cliente" id="cleinte" aria-describedby="helpId" placeholder="cliente">
</div>
<div class="mb-3">
  <label for="" class="form-label">Categoria:</label>
  <input type="text"
    class="form-control" name="categoria" id="categoria" aria-describedby="helpId" placeholder="categoria">
</div>
<div class="mb-3">
  <label for="" class="form-label">URL:</label>
  <input type="text"
    class="form-control" name="url" id="url" aria-describedby="helpId" placeholder="url descarga del software">
  
</div>
     <button type="submit" class="btn btn-success">Agregar</button>
     
     <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancelar</a>

    <div class="card-footer text-muted">
    
    </div>
</div>
</form>

<?php
include ("../../template/footer.php");
?>

