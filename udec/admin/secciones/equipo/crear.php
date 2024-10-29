
<?php
include ("../../bd.php");

if($_POST){
   $imagen=(isset($_FILES["imagen"]["name"]))?$_FILES["imagen"]["name"]:"";
   $nombrecompleto=(isset($_POST["nombrecompleto"]))?$_POST["nombrecompleto"]:"";
   $puesto=(isset($_POST["puesto"]))?$_POST["puesto"]:"";
   $twitter=(isset($_POST["twitter"]))?$_POST["twitter"]:"";
   $facebook=(isset($_POST["facebook"]))?$_POST["facebook"]:"";
   $instagram=(isset($_POST["instagram"]))?$_POST["instagram"]:" ";
   
   
   $fecha_imagen=new DateTime();
   $nombre_archivo_imagen = ($imagen != "") ? $fecha_imagen->getTimestamp() . "_" . $imagen : "";
   
   $tmp_imagen = $_FILES["imagen"]["tmp_name"];
   if($tmp_imagen!=""){
    move_uploaded_file($tmp_imagen,"../../../assets/img/team/".$nombre_archivo_imagen);
    
   }
   
   $sentencia=$conexion->prepare("INSERT INTO `tbl_equipo`
    (`id`,`imagen`,`nombrecompleto`,`puesto`,`twitter`,`facebook`,`instagram`) VALUES 
     (NULL,:imagen,:nombrecompleto,:puesto,:twitter,:facebook,:instagram);");
   
   
   $sentencia->bindparam(":nombrecompleto",$nombrecompleto);
   $sentencia->bindparam(":puesto",$puesto);
   $sentencia->bindparam(":twitter",$twitter); 
   $sentencia->bindparam(":facebook",$facebook);
   $sentencia->bindparam(":instagram",$instagram);
   $sentencia->bindparam(":imagen",$nombre_archivo_imagen);

   $sentencia->execute();
   
   $mensaje ="registro creado con exito...";
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
      <label for="imagen" class="form-label">Imagen:</label>
      <input type="file"
        class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="imagen">
    </div>

    <div class="mb-3">
      <label for="nombrecompleto" class="form-label">Nombre completo:</label>
      <input type="text"
        class="form-control" name="nombrecompleto" id="nombrecompleto" aria-describedby="helpId" 
        placeholder="nombrecompleto"> 
    </div>
    <div class="mb-3">
      <label for="puesto" class="form-label">Puesto:</label>
      <input type="text"
        class="form-control" name="puesto" id="puesto" aria-describedby="helpId" placeholder="puesto">
    </div>
    <div class="mb-3">
      <label for="twitter" class="form-label">Twitter:</label>
      <input type="text"
        class="form-control" name="twitter" id="twitter" aria-describedby="helpId" placeholder="twitter">
    </div>
    <div class="mb-3">
      <label for="facebook" class="form-label">Facebook:</label>
      <input type="text"
        class="form-control" name="facebook" id="facebook" aria-describedby="helpId" placeholder="facebook">
    </div>
    <div class="mb-3">
      <label for="instagram" class="form-label">Instagram:</label>
      <input type="text"
        class="form-control" name="instagram" id="instagram" aria-describedby="helpId" placeholder="instagram">
    </div>

    <button type="submit" class="btn btn-success">Agregar</button>
     
     <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancelar</a>

    </div>

</div>
</form>

<?php
include ("../../template/footer.php");
?>

