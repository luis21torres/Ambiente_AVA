<?php
$servidor= "localhost";
$baseDeDatos="udec";
$usuario ="root";
$contrasenia ="";

try {
 $conexion=new PDO("mysql:host =$servidor;dbname=$baseDeDatos",$usuario,$contrasenia);


}catch(exeption $error){

    echo $error->getMessage();

}

?>