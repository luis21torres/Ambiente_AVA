<?php
include ("../../template/header.php");



include ("../../bd.php");
// borrar registros

if(isset($_GET["txtID"])){

    $txtID=(isset($_GET["txtID"]) )?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("SELECT imagen FROM tbl_entradas WHERE id=:id ");
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();
    $registro_imagen=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){
        if(file_exists("../../../assets/img/about/".$registro_imagen["imagen"])){
           unlink("../../../assets/img/about/".$registro_imagen["imagen"]);

        }
    }
    
    $sentencia=$conexion->prepare("DELETE FROM  tbl_entradas WHERE id=:id ");
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();

 }

// selecionar registros 
$sentencia=$conexion->prepare("select * from tbl_entradas");
$sentencia->execute();
$lista_entradas=$sentencia->fetchALL(PDO::FETCH_ASSOC);
?>

<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registros</a>
    </div>
    <div class="card-body">
        
    <div class="table-responsive-sm">
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">fecha</th>
                    <th scope="col">titulo</th>
                    <th scope="col">descripcion</th>
                    <th scope="col">imagen</th>
                    <th scope="col">Acciones</th>
           
                </tr>
            </thead>
            <tbody>
             <?php foreach($lista_entradas as $registros){?>

                <tr class="">
                    <td><?php echo $registros ["id"];?></td>
                    <td><?php echo $registros ["fecha"];?></td>
                    <td><?php echo $registros ["titulo"];?></td>
                    <td><?php echo $registros ["descripcion"];?></td>
                    <td>

                    <img width="50"  src ="../../../assets/img/about/<?php echo $registros ["imagen"];?>"/>

                    </td>
                    <td>
                        
                    <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros 
                   ["id"];?>" role="button">Editar</a>
                     |
                     <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros ["id"];?>" 
                      role="button">Eliminar</a>

                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    

    </div>
    <div class="card-footer text-muted">
        
    </div>
</div>

<?php include ("../../template/footer.php");?>

