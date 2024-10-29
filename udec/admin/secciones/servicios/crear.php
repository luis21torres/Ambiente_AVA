
<?php
include ("../../bd.php");

if($_POST){
// recepcionamos los valores del formulario 

$icono=(isset($_POST["icono"]))?$_POST["icono"]:"";
$titulo=(isset($_POST["titulo"]))?$_POST["titulo"]:"";
$descripcion=(isset($_POST["descripcion"]))?$_POST["descripcion"]:"";

   $sentencia=$conexion->prepare("INSERT INTO `tbl_servicios` (`ID`, `icono`, `titulo`, `descripcion`)
    VALUES (NULL,:icono,:titulo,:descripcion);");
   
   // esta diciendo que cuando encuentre 2 puntos envia cada valor
   $sentencia->bindparam(":icono",$icono);
   $sentencia->bindparam(":titulo",$titulo);
   $sentencia->bindparam(":descripcion",$descripcion);
   
   $mensaje ="registro creado con exito...";
   header("location:index.php?mensaje=".$mensaje);
   // hace que los datos se envien n veces 
   $sentencia->execute();
   

}
include ("../../template/header.php");
?>

<div class="card">
    <div class="card-header">
       
    </div>
    <div class="card-body">
       
    <form action=""enctype="multipart/form-data"  method="post">

    <div class="mb-3">
      <label for=icono" class="form-label">icono</label>
      <input type="text"
        class="form-control" name="icono" id="icono" aria-describedby="helpId" placeholder="icono">
     
    </div>
      <div class="mb-3">
        <label for="titulo" class="form-label">titulo:</label>
        <input type="text"
          class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="titulo">
     
      </div>
      <div class="mb-3">
        <label for="descripcion" class="form-label">descripcion</label>
        <input type="text"
          class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="descripcion">
    
      </div>

     <button type="submit" class="btn btn-success">Agregar</button>
     
     <a name="" id="" class="btn btn-primary" href="index.php" role="button">cancelar</a>

</form>

</div>
<?php
include ("../../template/footer.php");
?>



<br>