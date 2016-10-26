function AsignarId(nam)
{   
    
    var name = nam.val(); // nombre a buscar el index 
    var name_index = nombre.indexOf(name); // busca el index //
    var ide = id[name_index]; // devuelve la id.
    document.getElementById("Nombre").value= name;   
    document.getElementById("Ruta").value= ide ;
    document.getElementById("Rut").value= ide ;   
    
}

function Remover_Rut_Formato(rut)
{
    rut=rut.replace('.', '');
    rut=rut.replace('-', '');
    return rut;
}