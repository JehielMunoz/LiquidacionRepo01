$(function() {

    $('#Buscar_Persona').on('keyup keypress', function(e) {
        if ($Persona == null) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        }

    });

    $("#btn-buscar,#tab-1").click(function() { // Esto maneja el ajax. Cuando hago click en el boton para buscar. Hace una consulta por post y remplaza la planilla con la respuesta del pust.
        var url = "./html/tabs/Planilla_ajax.php";
        if ($Persona != null) {
            $.ajax({
                type: "POST",
                url: url,
                data: { Rut: $Persona[0], AutoNombre: $Persona[1] }, // Datos del post. Los cuales recupera del campo rut y nombre.
                success: function(data) { // Si la consulta tiene exito.
                    $("#tabs-1").html(data); // Remplzasa el contedio del div tabs-1
                    $("#tabs").tabs("option", "active", 0);
                    $("#AutoNombre").val("");
                    $("#n_Empleado").html("[ " + $Persona[1] + " ]");
                    $Persona = null;
                }

            });
        }
        return false; // Igual  que al validar formularios, devuelve falso para que se ejecute el enviar del form.

    });
    $("#tab-5").click(function() { // Esto maneja el ajax. Cuando hago click en el boton para buscar. Hace una consulta por post y remplaza la planilla con la respuesta del pust.
        var url = "./html/tabs/Vista_Previa_ajax.php";
        $.ajax({
            type: "POST",
            url: url,
            data: { Rut: $("#Rut").val(), AutoNombre: $("#AutoNombre").val() }, // Datos del post. Los cuales recupera del campo rut y nombre.
            success: function(data) { // Si la consulta tiene exito.
                $("#tabs-5").html(data); // Remplzasa el contedio del div tabs-1
            }

        });
        return false; // Igual  que al validar formularios, devuelve falso para que se ejecute el enviar del form.
    });
});







function AsignarId(nam) {

    var $Nombre = $(nam).val(); // nombre a buscar el index 
    var index = nombre_low.indexOf($Nombre.toLowerCase()); // busca el index del nombre//
    if (index < 0) {
        return null;
    } else {
        var $Rut = id[index]; // devuelve la id.
        $Nombre = nombre[index];
        return [$Rut, $Nombre];
    }

}

function Remover_Rut_Formato(rut) {
    rut = rut.replace('.', '');
    rut = rut.replace('-', '');
    return rut;
}