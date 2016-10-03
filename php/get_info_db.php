<?php 
    function get_Datos(){
        $dbServer = 'localhost';
        $dbUser = 'root';
        $dbPass = '';
        $dbName = 'prueba';
        $db = new mysqli($dbServer,$dbUser,$dbPass,$dbName);
        if (!empty($_POST['id_nombre']))
            {
                $id = $_POST['id_nombre'] ;   
                
            }
        else
        {
            $id = 1;    
        } 
        $query = $db->query("SELECT * FROM datos where id=".$id);
        $row = $query->fetch_assoc();
        return $row;
        
        
    }

?>