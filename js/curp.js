
$( document ).ready( function(){
    $( '#curp' ).on( 'input', function() {
        let curp = $( this ).val().toUpperCase();

        if( curp.length === 18 ){
            let genero = curp.charAt( 10 );
            let fechaNacimiento = curp.substr( 4, 6 );
            let año = parseInt( fechaNacimiento.substr( 0, 2 ), 10 );
            let mes = parseInt( fechaNacimiento.substr( 2, 2 ), 10 );
            let dia = parseInt( fechaNacimiento.substr( 4, 2 ), 10 );

            //Determinar siglo correcto
            let siglo = ( año >= 0 && año <=23 ) ? 2000 : 1900;  // Para años 00-23 entran en -> Siglo XXI ; los demás entran en -> Siglo XX 
            let añoCompleto = siglo + año;

            // Crear la fecha de nacimiento
            let fechaNacimientoCompleta = new Date( añoCompleto, mes - 1, dia );
            
            // Validar si la fecha es correcta
            let onomastico = !isNaN( fechaNacimientoCompleta ) ? fechaNacimientoCompleta.toISOString().split( 'T' )[0] : '';
            
            //Calcular edad
            let hoy = new Date();
            let edad = hoy.getFullYear() - fechaNacimientoCompleta.getFullYear();
           
            if( 
                hoy.getMonth() < fechaNacimientoCompleta.getMonth() ||
                (hoy.getMonth() === fechaNacimientoCompleta.getMonth() && hoy.getDate() < fechaNacimientoCompleta.getDate())
            ){
                edad--;
            }

            //Obtener RFC sin homoclave
            let rfc = curp.substr( 0, 10 );

            //Asignar valor a los campos
            $( '#genero' ).val( genero );
            $( '#onomastico' ).val( onomastico );
            $( '#edad' ).val( !isNaN( edad ) ? edad: '' );
            $( '#RFC' ).val( rfc );
        } else {
            $( '#genero, #onomastico, #edad, #RFC' ).val( '' );
        }
    });
});