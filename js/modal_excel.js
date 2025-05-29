
import { API_ROUTES } from "./routes/config.js";
import { setAlerts } from "./plugins/alerts.plugin.js";

const exportFileURL = API_ROUTES.exportFile;

$(document).on("click", ".download-excel", function (event) {
    event.preventDefault();

    const startDate  = $("#fechaInicio").val().trim();
    const endDate    = $("#fechaFin").val().trim();
    const checkboxes = $("input[name='estatus[]']:checked");

    const warningWindows = [
        { condition: !startDate && 
                     !endDate   && 
                     checkboxes.length === 0, 
                     alert: setAlerts.completeFields },

        { condition: !startDate, alert: setAlerts.startDate },
        { condition: !endDate, alert: setAlerts.endDate },
        // { condition: checkboxes.length === 0, alert: setAlerts.statusField }
    ];


    const warning = warningWindows.find( error => error.condition );
    if( warning ){
        warning.alert();
        return;
    }


    const formData = new FormData();
    formData.append("fechaInicio", startDate);
    formData.append("fechaFin", endDate);

    [...checkboxes].forEach( cb => formData.append( "estatus[]", cb.value ) );

    const downnloadFile = ( blob ) => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement( "a" );
        a.href = url;
        a.download = "Datos_Personal_Formación.xlsx";
        document.body.appendChild( a );
        a.click();
        a.remove();
    };

    $.ajax({
        url:  exportFileURL,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false, // Importante para FormData
        xhrFields: {
            responseType: "blob",
        },
        success: function (res) {7
            console.log("Respuesta del backend:", res);
            res.size > 0 ? ( downnloadFile( res ), setAlerts.successDownload()) : setAlerts.noData();
        },
        error: setAlerts.errorGeneralFile
    });
});