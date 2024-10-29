<?php
include ("../../template/header.php");
include ("../../bd.php");

if(isset($_GET["txtID"])){

    $txtID=(isset($_GET["txtID"]) )?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_portafolio WHERE id=:id ");
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){
        if(file_exists("../../../assets/img/portfolio/".$registro_imagen["imagen"])){
           unlink("../../../assets/img/portfolio/".$registro_imagen["imagen"]);

        }
    }
    
    $sentencia=$conexion->prepare("DELETE FROM  tbl_portafolio WHERE id=:id ");
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();

 }
$sentencia=$conexion->prepare("select * from tbl_portafolio");
$sentencia->execute();
$lista_portafolio=$sentencia->fetchALL(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registros</a>
    </div>
    <div class="card-body">
    
   <div class="table-responsive-sm">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">titulo</th>
                <th scope="col">imagen</th>
                <th scope="col">descripcion</th>
                <th scope="col">cliente&categoria</th>
                <th scope="col">acciones</th>


            </tr>
        </thead>
        <tbody>
            <?php foreach($lista_portafolio as $registros){?>
                <tr class="">
                <td scope="col"><?php echo $registros ["id"];?></td>
                <td scope="col">
                    <h6><?php echo $registros ["titulo"];?></h6>
                    <?php echo $registros ["subtitulo"];?>
                    <br><?php echo $registros ["url"];?>
                </td>   
              
                <td scope="col">
                <img width="50"  src ="../../../assets/img/portfolio/<?php echo $registros ["imagen"];?>"/>
                </td>

                <td scope="col"><?php echo $registros ["descripcion"];?></td>
                <td scope="col">
                 -<?php echo $registros ["categoria"];?>
                 <br>-<?php echo $registros ["cliente"];?> </td>
                <td scope="col"><a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros 
                   ["id"];?>" role="button">Editar</a>
                     |
                     <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros ["id"];?>" 
                      role="button">Eliminar</a></td>
                <?php }?>
            </tr>
          
        </tbody>
    </table>
   </div>
   

    </div>
    <div class="card-footer text-muted">
     
    </div>
</div>

<?php
include ("../../template/footer.php");
?>
