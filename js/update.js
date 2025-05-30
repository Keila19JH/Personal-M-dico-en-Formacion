import { setAlerts } from "./plugins/alerts.plugin.js";
import { httpClients } from "./plugins/http-client.plugin.js";
import { hideLoadingOverlay, showLoadingOverlay } from "./plugins/loader.plugin.js";

const url = "php/controllers/update.controller.php";
const data = $('#patientForm');
const maxFileSize = 5 * 1024 * 1024; // 5 MB

export const editForm = () => {
    data.on( 'submit', async function ( event ) {
        event.preventDefault();
        let formData = new FormData( this );

        // let ia = document.getElementById('id_informacion_academica');
        // console.log(ia);

        // Obtener el archivo
        let file = formData.get( 'foto' );
        if (file) {
            // Verificar tipo de archivo
            const validFileTypes = ["image/jpeg", "image/png", "image/jpg"];
            if (!validFileTypes.includes(file.type)) {
                return setAlerts.errorAlert("El archivo debe ser una imagen (jpg, jpeg, png).");
            }

            // Verificar tamaño del archivo
            if (file.size > maxFileSize) {
                return setAlerts.errorAlert("El archivo debe ser menor a 5 MB.");
            }

            // Obtener los valores de nombre y apellidos del formulario
            let apellidoPaterno = formData.get("apellidoPaterno");
            let apellidoMaterno = formData.get("apellidoMaterno");
            let nombre = formData.get("nombre");

            // Obtener el nombre original del archivo
            let fileName = file.name;

            // Obtener la extensión del archivo
            let fileExtension = fileName.split(".").pop();

            // Construir un nuevo nombre de archivo usando los valores del formulario
            let newFileName = `${apellidoPaterno}_${apellidoMaterno}_${nombre}.${fileExtension}`;

            // Cambiar el nombre del archivo en el FormData
            formData.set("foto", file, newFileName);
            
        }

        showLoadingOverlay();

        try {
            const response = await httpClients.post( url, formData );
            // console.log("Respuesta del servidor:", response);

            hideLoadingOverlay();

            if( response.status === 'success' ){
                setAlerts.successAlert(
                    '¡Tu información se ha guardado correctamente!',
                    null,
                    null,
                    'index.php'
                );
            } else {
                setAlerts.errorAlert( response.message || 'Hubo un error al enviar el formulario :(.' );
            }
        } catch ( error ) {
            hideLoadingOverlay();
            // console.error( 'Error en la solicitud :/ :', error );
            setAlerts.errorAlert( 'Hubo un error al enviar la solicitud' );
        }
    });
};