$(function() {
    $('#Guardar_Empleado').submit(function(evento) {
        var rLenR = 9;
        var $Largo = $("#Registro_Rut").val().length;
        var $Rut = $("#Registro_Rut").val();
        if ($Largo < 9) {
            alert("Rut demaciado corto  ( falta/n (" + (9 - $Largo).toString() + ") digito/s.)");
            $("#Registro_Rut").focus();
            return false;
        }
        if ($Largo > 9) {
            alert("Rut demaciado largo. ( sobra/n +(" + ($Largo - 9).toString() + ") digito/s.)");
            $("#Registro_Rut").focus();
            return false;
        } else if (isNaN($Rut)) {
            alert("Ingrese un rut valido.");
            $("#Registro_Rut").focus();
            return false;
        }
        var $rLenT = 8;
        var $lenTelefono = $("#Telefono").val().length;
        var $Telefono = $("#Telefono").val();
        if ($lenTelefono < 8) {
            alert("Telefono demaciado corto. ( faltan (" + (8 - $lenTelefono).toString() + ") digito/s.)");
            $("#Telefono").focus();
            return false;
        }
        if ($lenTelefono > 8) {
            alert("Telefono demaciado largo. ( sobran (" + ($lenTelefono - 8).toString() + ") digito/s.)");
            $("#Telefono").focus();
            return false;

        } else if (isNaN($Rut)) {
            alert("Ingrese un Telefono valido.");
            $("#Telefono").focus();
            return false;
        }
    });
});

function Remover_Rut_Formato(rut) {
    rut = rut.replace('.', '');
    rut = rut.replace('-', '');
    return rut;
}