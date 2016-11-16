<?php
require "./conex.php";
require "./funciones.php";
session_start();
$q_Registro = "INSERT INTO \"tEmpleados\" (\"Nombre\",\"F_nacimiento\",\"F_ingreso\",\"id_Contrato\",\"Sueldo_base\",\"id_AFP\",\"Rut\",\"id_ISAPRE\",\"N_horas\",\"Paga_por_hora\",\"Activo\",\"Cargas\") values ('".$_POST['r_Nombre']."','".$_POST['r_Cumpleaños']."','".$_POST['r_fContrato']."','".$_POST['Tipo_Contrato']."','".$_POST['r_SueldoBase']."','".$_POST['r_AFP']."','".$_POST['r_Rut']."','".$_POST['r_ISAPRE']."','".$_POST['HTrabajo']."','".$_POST['V_HTrabajo']."',TRUE,'".$_POST['nCargas']."')";

$q_Telefono = "INSERT INTO \"tEmpleado_Fono\" (\"Rut\",\"N_telefono\") values ('".$_POST['r_Rut']."','".Formato_Tel_Cel($_POST['r_Telefono'])."')";

$Registro_Usuario = pg_query($dbconn, $q_Registro);

if($Registro_Usuario!=false)
{
    $Registro_Telefono = pg_query($dbconn,$q_Telefono);

    foreach($_POST['Cargo'] as $Cargo)
    { 
        $q_Cargo = "INSERT INTO \"rel_tEmpleados_tCargos\" (\"Rut\",\"id_Cargo\") values ('".$_POST['r_Rut']."','".$Cargo."')";
        $Registro_Cargo = pg_query($dbconn,$q_Cargo);
    }    

    get_Empleado();

    header('location: ../index.php');  

}

else
{
    $_SESSION["Error_Registro"] = true;
    header('location: ../html/Agregar_empleado.php');  
    
}


?>
