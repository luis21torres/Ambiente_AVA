<?php
include ("../../bd.php");


if(isset($_GET["txtID"])){

  $txtID=(isset($_GET["txtID"]) )?$_GET["txtID"]:"";
  $sentencia=$conexion->prepare("SELECT * FROM tbl_entradas WHERE id=:id ");
  $sentencia->bindparam(":id",$txtID);
  $sentencia->execute();
  $registro=$sentencia->fetch(PDO::FETCH_LAZY);


  $fecha=$registro["fecha"];
  $titulo=$registro["titulo"];
  $descripcion=$registro["descripcion"];
  $imagen=$registro["imagen"];
 
}

if($_POST){

  $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";
  $fecha=(isset($_POST["fecha"]))?$_POST["fecha"]:"";
  $titulo=(isset($_POST["titulo"]))?$_POST["titulo"]:"";
  $descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:"";
  
  $sentencia=$conexion->prepare("UPDATE tbl_entradas
    set 
    fecha=:fecha,
    titulo=:titulo,
    descripcion=:descripcion
    WHERE id=:id");

$sentencia->bindparam(":fecha",$fecha);
$sentencia->bindparam(":titulo",$titulo);
$sentencia->bindparam(":descripcion",$descripcion);
$sentencia->bindparam(":id",$txtID);
$sentencia->execute();
  
if($_FILES["imagen"]["tmp_name"]!=""){

  $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
  $fecha_imagen=new DateTime();
  $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";

  $tmp_imagen = $_FILES["imagen"]["tmp_name"];

  move_uploaded_file($tmp_imagen,"../../../assets/img/about/".$nombre_archivo_imagen);

  // borra el archivo de la carpeta
  $sentencia=$conexion->prepare("SELECT imagen FROM tbl_entradas WHERE id=:id ");
  $sentencia->bindparam(":id",$txtID);
  $sentencia->execute();
  $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

  //busca la imagen dentro del proyecto 
  if(isset($registro_imagen["imagen"])){
      if(file_exists("../../../assets/img/about/".$registro_imagen["imagen"])){
         unlink("../../../assets/img/about/".$registro_imagen["imagen"]);

      }
    }


$sentencia = $conexion->prepare("UPDATE tbl_entradas SET imagen=:imagen WHERE id=:id");
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
        Entradas
    </div>
    <div class="card-body">
     
    <form action=""enctype="multipart/form-data" method="post">


     <div class="mb-3">
       <label for="id" class="form-label">ID:</label>
       <input type="text"
         class="form-control" readonly value="<?php echo $txtID?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="txtID">
       
     </div>

     <div class="mb-3">
       <label for="fecha" class="form-label">Fecha:</label>
       <input type="date"
         class="form-control"value="<?php echo $fecha?>" name="fecha" id="fecha" aria-describedby="helpId" placeholder="fecha">

     </div>

<div class="mb-3">
  <label for="titulo" class="form-label">Tilulo:</label>
  <input type="text"
    class="form-control"value="<?php echo $titulo ?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="titulo">
</div>

<div class="mb-3">
  <label for="descripcion" class="form-label">Descripcion:</label>
  <input type="text"
    class="form-control"value="<?php echo $descripcion ?> "name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
</div>

<div class="mb-3">
  <label for="imagen" class="form-label">Imagen:</label>
  <img width="50"  src ="../../../assets/img/about/"<?php echo $imagen;?>" />
  <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="imagen">
</div>
<button type="submit" class="btn btn-success">Actualizar</button>
     
     <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancelar</a>

</from>

    </div>
    <div class="card-footer text-muted">
       
    </div>
</div>

<?php
include ("../../template/footer.php");
?>


