

export const setAlerts = {
    errorAlert: (text) => {
        return Swal.fire({
            icon: 'error',
            title: 'Error',
            text,
            confirmButtonText: 'OK'
        });
    },

    successAlert: (text, title = 'Éxito', timer = 0, href) => {
        return Swal.fire({
            icon: 'success',
            title,
            text,
            showConfirmButton: true,
            timer,
            willClose: () => {
                if (href) {
                    window.location.href = href;
                }
            }
        });
    },

    confirmAlert: async (title, text, icon = 'warning') => {
        return await Swal.fire({
            title,
            text,
            icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor:  '#d33',
            confirmButtonText:  'Sí, dar de baja', 
            cancelButtonText:   'Cancelar',
        });
    },

    completeFields: () => {
        return Swal.fire({
            icon:  "warning",
            title: "Campos obligatorios",
            text:  "Es necesario que completes los campos faltantes.",
        });
    },

    startDate: () => {
        return Swal.fire({
            icon:  "warning",
            title: "Campo obligatorio",
            text:  "Por favor, selecciona la fecha de inicio.",
        });
    },

    endDate: () => {
        return Swal.fire({
            icon:  "warning",
            title: "Campo obligatorio",
            text:  "Por favor, selecciona la fecha de fin.",
        });
    },

    // statusField: () => {
    //     return Swal.fire({
    //         icon:  "warning",
    //         title: "Campo obligatorio",
    //         text:  "Debes seleccionar al menos un estatus.",
    //     });
    // },

    successDownload: () => {
        return Swal.fire({
            icon:  "success",
            title: "Descarga exitosa",
            text:  "El archivo Excel se ha descargado correctamente.",
        });
    },

    noData: () => {
        return Swal.fire({
            icon:  "error",
            title: "Error",
            text:  "No se encontraron datos con los filtros seleccionados.",
        });
    },

    errorGeneralFile: () => {
        return Swal.fire({
            icon: "error",
            title: "Error",
            text: "Hubo un problema al generar el archivo Excel.",
        });
    }
    
};


