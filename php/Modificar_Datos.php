<?php 
    session_start();
        if(!empty($_SESSION['Rut']))
        {
            if($_POST)
            { 
                include './conex.php';
                include './funciones.php';
                $query = pg_query($dbconn,"UPDATE  \"tEmpleados\" SET \"Nombre\" ='".$_POST['mNombre']."' , \"id_Contrato\"=".$_POST['mContrato'].", \"Sueldo_base\"=".$_POST['mSueldo'].", \"id_AFP\"=".$_POST['mAFP'].", \"id_ISAPRE\"=".$_POST['mIPS']." , \"N_horas\"=".$_POST['mHTrabajo'].", \"Paga_por_hora\"=".$_POST['mValorHora']." WHERE \"Rut\"='".$_SESSION["Rut"]."'" );
                

                
                if (!$query) {
                    echo "Falla en l
                    a consulta.\n";
                    exit;
                }
                else
                {
                    
                    Escribir_Reporte("Se han modificado los datos del empleado con rut: ".$_POST["mRut"].".");
                    
                    $_SESSION['Rut'] =  $_POST["mRut"];
                    $_SESSION['Datos'] = get_Datos();
                    $_SESSION['Nombre'] = trim($_SESSION['Datos']['Nombre']," ");     
                    $_SESSION['Afp'] = get_AFP();
                    $_SESSION['Isapre'] = get_ISAPRE();
                    $_SESSION['Contrato'] = get_Contrato();
                    get_cargos();
                    cal_Total_Imponible();
                    licencias();
                    cal_Total_Descuentos();
                    cal_sub_total();
                    Liquido_Pagar();
                    Liquido_Alcansado();
                    gastos_extras();

                    header('location: ../index.php');

                }              
            }
            else
            {
                if(file_exists("./index.php"))
                {
                    header('location: ./index.php');   
                }
                else
                {
                    header('location: ../index.php');   
                }                
            }                 
        }
    
?>
