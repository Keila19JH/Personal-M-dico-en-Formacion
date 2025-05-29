

export const httpClients = {

    post: async ( url = '', formData ) => {
        try {
            const response = await $.ajax({
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: 'json',
            });
            return response;
        } catch ( error ){
            console.error( 'Error en la solicitud POST:', error );
            throw error;
        }
    },

    get: async ( url = '' ) => {
        try {
            const response = await $.ajax({
                url: url,
                dataType: 'json',
                type: 'GET',
            });
            return response;
        } catch ( error ){
            console.error( 'Error en la solicitud GET:', error );
            throw error;
        }
    },
    
    post_1: async ( url = '', data ) => {
        try {
            const response = await $.ajax({
                url: url,
                data: data,
                type: 'POST',
                dataType: 'json',
            });
            return response;
        } catch ( error ){
            console.error( 'Error en la solicitud POST_1:', error );
            throw error;
        }
    },
};
