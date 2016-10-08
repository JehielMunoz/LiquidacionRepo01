
        var id_nombre = <?php get_Personas();?>; 
        var id = [];
        var nombre = [];
        
        $(function(){
            $("#tabs").tabs();
        });

        $(function() {
            
            
            for (var x = 0; x < id_nombre.length; x++)
            {
                id.push(id_nombre[x][0]) ;    
                nombre.push(id_nombre[x][1]) ;    
            }
            
            
            $( "#AutoNombre" ).autocomplete({
            source: nombre
            });
            });