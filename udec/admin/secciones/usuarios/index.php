<?php
include ("../../template/header.php");

include ("../../template/footer.php");

// se incluye la conexion  
include ("../../bd.php");

// borrar el registro con el ID correspondiente 

if(isset($_GET["txtID"])){
    // esta recibiendo el dato si exite lo asigna si no lo coloca en blanco 
    $txtID=(isset($_GET["txtID"]) )?$_GET["txtID"]:"";
    $sentencia=$conexion->prepare("DELETE FROM  tbl_usuarios WHERE id=:id ");
    $sentencia->bindparam(":id",$txtID);
    $sentencia->execute();
     
}

// selecionar los registros 
$sentencia=$conexion->prepare("select * from tbl_usuarios");
$sentencia->execute();
$lista_usuarios=$sentencia->fetchALL(PDO::FETCH_ASSOC);

?>
 
<div class="card">
    <div class="card-header"> 
     
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registros</a>
    </div>
    <div class="card-body">
      
    <div class="table-responsive">
        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                
                <?php foreach($lista_usuarios as $registros){?>
                <tr class="">
                    <td><?php echo $registros ["id"];?></td> 
                    <td><?php echo $registros ["usuario"];?></td>
                    <td><?php echo $registros ["password"];?></td>
                    <td><?php echo $registros ["correo"];?></td>
                    <td>
                     <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros ["id"];?>" role="button">Editar</a>
                     |
                     <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros ["id"];?>" role="button">Eliminar</a>
                      
                </tr>
              <?php }?>
            </tbody>
        </table>
    </div>
    


    </div>
    
</div>