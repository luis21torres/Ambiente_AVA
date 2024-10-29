<?php
include ("../../bd.php");

if(isset($_GET["txtID"])){

    $txtID=(isset($_GET["txtID"]) )?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_portafolio WHERE id=:id ");
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);

    $titulo=$registro["titulo"];
    $subtitulo=$registro["subtitulo"];
    $imagen=$registro["imagen"];
    $descripcion=$registro["descripcion"];
    $cliente=$registro["cliente"];
    $categoria=$registro["categoria"];
    $url=$registro["url"];


}

if($_POST){
    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";
    $titulo=(isset($_POST["titulo"]))?$_POST["titulo"]:"";
    $subtitulo=(isset($_POST["subtitulo"]))?$_POST["subtitulo"]:"";
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:"";
    $cliente=(isset($_POST["cliente"]))?$_POST["cliente"]:"";
    $categoria=(isset($_POST["categoria"]))?$_POST["categoria"]:"";
    $url=(isset($_POST["url"]))?$_POST["url"]:"";

    $sentencia=$conexion->prepare("UPDATE tbl_portafolio
    set 
    titulo=:titulo,
    subtitulo=:subtitulo,
   
    descripcion=:descripcion,
    cliente=:cliente,
    categoria=:categoria,
    url=:url
    WHERE id=:id");

    $sentencia->bindparam(":titulo",$titulo);
    $sentencia->bindparam(":subtitulo",$subtitulo);
   
    $sentencia->bindparam(":descripcion",$descripcion);
    $sentencia->bindparam(":cliente",$cliente);
    $sentencia->bindparam(":categoria",$categoria);
    $sentencia->bindparam(":url",$url);
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();

// desde aqui es solo para la imagen arriba son datos txt
    if($_FILES["imagen"]["tmp_name"]!=""){

    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";

    $tmp_imagen = $_FILES["imagen"]["tmp_name"];
  
    move_uploaded_file($tmp_imagen,"../../../assets/img/portfolio/".$nombre_archivo_imagen);
  
    // borra el archivo de la carpeta
    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_portafolio WHERE id=:id ");
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    //busca la imagen dentro del proyecto 
    if(isset($registro_imagen["imagen"])){
        if(file_exists("../../../assets/img/portfolio/".$registro_imagen["imagen"])){
           unlink("../../../assets/img/portfolio/".$registro_imagen["imagen"]);

        }
      }

// actualiza la imagen nueva con un nuevo nombre 
$sentencia = $conexion->prepare("UPDATE tbl_portafolio SET imagen=:imagen WHERE id=:id");
$sentencia->bindParam(":imagen", $nombre_archivo_imagen);
$sentencia->bindParam(":id", $txtID);
$sentencia->execute();
    }
    
$mensaje ="registro modificado con exito...";
    header("location:index.php?mensaje=".$mensaje);
    }
  

  
    
include ("../../template/header.php");
?>

<div class="card">
    <div class="card-header">
       Producto del portafolio 
    </div>
    <div class="card-body">
       
    <form action=""enctype="multipart/form-data" method="post"> 
   <div class="mb-3">
     <label for="" class="form-label">ID</label>
     <input type="text"
       
       class="form-control"
       readonly
        name="txtID"
         id="txtID"
         value="<?php echo $txtID;?>"
          aria-describedby="helpId" placeholder="">
     
   </div>



<div class="mb-3">
  <label for="titulo" class="form-label">Titulo:</label>
  <input type="text"
    class="form-control"value="<?php echo $titulo ?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="titulo">

    </div>
    <div class="mb-3">
      <label for="" class="form-label">subtitulo:</label>
      <input type="text"
        class="form-control"value="<?php echo $subtitulo?>" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="subtitulo">
    </div>
    
    <div class="mb-3">
      <label for="imagen" class="form-label">Imagen</label>
      <img width="50"  src ="../../../assets/img/portfolio/"<?php echo $imagen;?>" />
      <input type="file" class="form-control" name="imagen" id="imagen" placeholder="imagen" aria- 
          describedby="fileHelpId">
    </div>

<div class="mb-3">
  <label for="Descripcion" class="form-label">Descripcion:</label>
  <input type="text"
    class="form-control"value="<?php echo $descripcion?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
</div>

<div class="mb-3">
  <label for="Cliente" class="form-label">Cliente:</label>
  <input type="text"
    class="form-control"value="<?php echo $cliente?>" name="cliente" id="cleinte" aria-describedby="helpId" placeholder="cliente">
</div>
<div class="mb-3">
  <label for="" class="form-label">Categoria:</label>
  <input type="text"
    class="form-control"value="<?php echo $categoria?>" name="categoria" id="categoria" aria-describedby="helpId" placeholder="categoria">
</div>
<div class="mb-3">
  <label for="" class="form-label">URL:</label>
  <input type="text"
    class="form-control"value="<?php echo $url?>" name="url" id="url" aria-describedby="helpId" placeholder="url descarga del software">
  
</div>
     <button type="submit" class="btn btn-success">Actualizar</button>
     
     <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancelar</a>

    <div class="card-footer text-muted">
    
    </div>
</div>
</form>



<?php
include ("../../template/footer.php");
?>


