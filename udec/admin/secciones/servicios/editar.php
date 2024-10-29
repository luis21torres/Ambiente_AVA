<?php
include ("../../template/header.php");


include ("../../bd.php");


// recepcionar el id
if(isset($_GET["txtID"])){
    $txtID=(isset($_GET["txtID"]) )?$_GET["txtID"]:"";

    // se estan recuperando los datos de id seleccionado
    // sleccionar informacion de la tabla segun el id
    $sentencia=$conexion->prepare("SELECT * FROM tbl_servicios WHERE id=:id ");
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    

    $icono=$registro["icono"];
    $titulo=$registro["titulo"];
    $descripcion=$registro["descripcion"];
}

if($_POST){
$txtID=(isset($_POST["txtID"]))?$_POST["txtID"]:"";
$icono=(isset($_POST["icono"]))?$_POST["icono"]:"";
$titulo=(isset($_POST["titulo"]))?$_POST["titulo"]:"";
$descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:"";

   $sentencia=$conexion->prepare("UPDATE tbl_servicios
   set 
   icono=:icono,
   titulo=:titulo,
   descripcion=:descripcion
   WHERE id=:id");
 
   $sentencia->bindparam(":icono",$icono);
   $sentencia->bindparam(":titulo",$titulo);
   $sentencia->bindparam(":descripcion",$descripcion);
   $sentencia->bindparam(":id",$txtID);
   $sentencia->execute();
   $mensaje ="registro modificado con exito...";
   header("location:index.php?mensaje=".$mensaje);
}


?>
<div class="card">
    <div class="card-header">
    Editando la informacion de servicios
    </div>
    <div class="card-body">
       
    <form action=""enctype="multipart/form-data"  method="post">

    
    <div class="mb-3">
      <label for="" class="form-label">ID:</label>
      <input readonly value="<?php echo $txtID?>" type="text"
        class="form-control" name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
    
    </div>

    <div class="mb-3">
      <label for=icono" class="form-label">icono</label>
      <input value="<?php echo $icono?>" type="text"
        class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="icono">
     
    </div>
      <div class="mb-3">
        <label for="titulo" class="form-label">titulo:</label>
        <input  value="<?php echo $titulo?>" type="text"
          class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="titulo">
     
      </div>
      <div class="mb-3">
        <label for="descripcion" class="form-label">descripcion</label>
        <input value="<?php echo $descripcion?>"  type="text"
          class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
    
      </div>

     <button type="submit" class="btn btn-success">Actualizar</button>
     
     <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancelar</a>

</form>

</div>
<?php
include ("../../template/footer.php");
?>
