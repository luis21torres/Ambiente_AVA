<?php
include ("../../bd.php");
if(isset($_GET["txtID"])){

    $txtID=(isset($_GET["txtID"]) )?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("SELECT * FROM tbl_equipo WHERE id=:id ");
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    
    
    $nombrecompleto=$registro["nombrecompleto"];
    $puesto=$registro["puesto"];
    $twitter=$registro["twitter"];
    $facebook=$registro["facebook"];
    $instagram=$registro["instagram"];
    $imagen=$registro["imagen"];
    
    }
    
    if($_POST){
    
    $txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";
    $nombrecompleto=(isset($_POST["nombrecompleto"]))?$_POST["nombrecompleto"]:"";
    $puesto=(isset($_POST["puesto"]))?$_POST["puesto"]:"";
    $twitter=(isset($_POST["twitter"]))?$_POST["twitter"]:"";
    $facebook=(isset($_POST["facebook"]))?$_POST["facebook"]:"";
    $instagram=(isset($_POST["instagram"]))?$_POST["instagram"]:"";
    
    $sentencia=$conexion->prepare("UPDATE tbl_equipo
      set 
      nombrecompleto=:nombrecompleto,
      puesto=:puesto,
      twitter=:twitter,
      facebook=:facebook,
      instagram=:instagram
      WHERE id=:id");
    
    $sentencia->bindparam(":nombrecompleto",$nombrecompleto);
    $sentencia->bindparam(":puesto",$puesto);
    $sentencia->bindparam(":twitter",$twitter);
    $sentencia->bindparam(":facebook",$facebook);
    $sentencia->bindparam(":instagram",$instagram);
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();
    
    if($_FILES["imagen"]["tmp_name"]!=""){
    
    $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
    $fecha_imagen=new DateTime();
    $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";
    
    $tmp_imagen = $_FILES["imagen"]["tmp_name"];
    
    move_uploaded_file($tmp_imagen,"../../../assets/img/team/".$nombre_archivo_imagen);
    
    // borra el archivo de la carpeta
    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_equipo WHERE id=:id ");
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);
    
    //busca la imagen dentro del proyecto 
    if(isset($registro_imagen["imagen"])){
        if(file_exists("../../../assets/img/team/".$registro_imagen["imagen"])){
           unlink("../../../assets/img/team/".$registro_imagen["imagen"]);
    
        }
      }
    
    
    $sentencia = $conexion->prepare("UPDATE tbl_equipo SET imagen=:imagen WHERE id=:id");
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
        Datos de la persona
    </div>
    <div class="card-body">
     
    <form action=""enctype="multipart/form-data" method="post">

    <div class="mb-3">
       <label for="id" class="form-label">ID:</label>
       <input type="text"
         class="form-control" readonly value="<?php echo $txtID?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="txtID">
       
     </div>
    <div class="mb-3">
      <label for="imagen" class="form-label">Imagen:</label>
      <img width="50"  src ="../../../assets/img/about/"<?php echo $imagen;?>" />
      <input type="file"
      class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="imagen">
    </div>

    <div class="mb-3">
      <label for="nombrecompleto" class="form-label">Nombre completo:</label>
      <input type="text"
        class="form-control"value="<?php echo $nombrecompleto?>"name="nombrecompleto" id="nombrecompleto" aria-describedby="helpId" 
        placeholder="nombrecompleto"> 
    </div>
    <div class="mb-3">
      <label for="puesto" class="form-label">Puesto:</label>
      <input type="text"
        class="form-control"value="<?php echo $puesto?>" name="puesto" id="puesto" aria-describedby="helpId" placeholder="puesto">
    </div>
    <div class="mb-3">
      <label for="twitter" class="form-label">Twitter:</label>
      <input type="text"
        class="form-control"value="<?php echo $twitter?>" name="twitter" id="twitter" aria-describedby="helpId" placeholder="twitter">
    </div>
    <div class="mb-3">
      <label for="facebook" class="form-label">Facebook:</label>
      <input type="text"
        class="form-control"value="<?php echo $facebook?>" name="facebook" id="facebook" aria-describedby="helpId" placeholder="facebook">
    </div>
    <div class="mb-3">
      <label for="instagram" class="form-label">Instagram:</label>
      <input type="text"
        class="form-control"value="<?php echo $instagram?>" name="instagram" id="instagram" aria-describedby="helpId" placeholder="instagram">
    </div>

    <button type="submit" class="btn btn-success">Agregar</button>
     
     <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancelar</a>

    </div>

</div>
</form>

<?php
include ("../../template/footer.php");
?>


