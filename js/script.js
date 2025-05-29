
document.getElementById("limpiarFormularioBtn").addEventListener("click", function () {
  document.getElementById("patientForm").reset();
});

// Función para capitalizar el texto ingresado en el CURP
function capitalizeCURP( input ){
  input.value = input.value.toUpperCase();
}

// Manejar el evento input en el campo "CURP"
document.getElementById( "curp" ).addEventListener( "input", function (){
  capitalizeCURP( this );
})

// Función para capitalizar la primera letra de cada palabra en un texto
function capitalizeFirstLetter(text) {
  return text.toLowerCase().replace(/(?:^|\s)\S/g, function (a) { return a.toUpperCase(); });
}

// Manejar el evento input en el campo "Nombre(s)"
document.getElementById("contacto").addEventListener("input", function () {
  this.value = capitalizeFirstLetter(this.value);
});

// Manejar el evento input en el campo "Apellido Paterno"
document.getElementById("apellidoPaterno").addEventListener("input", function () {
  this.value = capitalizeFirstLetter(this.value);
});

// Manejar el evento input en el campo "Apellido Materno"
document.getElementById("apellidoMaterno").addEventListener("input", function () {
  this.value = capitalizeFirstLetter(this.value);
});

// Manejar el evento input en el campo "Nombre(s)"
document.getElementById("nombre").addEventListener("input", function () {
  this.value = capitalizeFirstLetter(this.value);
});

document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('guarderia').addEventListener('change', function() {
    let guarderia = document.getElementById('guarderia').value;
    let horas_guarderia = document.getElementById('horas_guarderia');
    let hijos = document.getElementById('num_hijos');

    if (guarderia === 'Si') {
      horas_guarderia.style.display = 'block';
      hijos.style.display = 'block';
    } else {
      horas_guarderia.style.display = 'none';
      hijos.style.display = 'none';
    }
  });
});


// AQUÍ EMPIEZAN LAS FUNCIONES PARA MOSTRAR U OCULTAR LOS CAMPOS DE CURSOS, DEPENDIENDO DE SI SE HAN HECHO O NO.
// Función para mostrar/ocultar campos según la selección del selector
function toggleFields(selectorId) {
  var selectValue = document.getElementById(selectorId).value;
  var divFechaExp = document.getElementById('divFechaExpedicion_' + selectorId);
  var divFechaVig = document.getElementById('divFechaVigencia_' + selectorId);
  var divEstatus = document.getElementById('divEstatus_' + selectorId);

  if (selectValue === 'Si') {
    divFechaExp.style.display = 'block';
    divFechaVig.style.display = 'block';
    divEstatus.style.display = 'block';
    // Además, si quieres habilitar los campos de Fecha Vigencia, descomenta la siguiente línea
    // document.getElementById('fechaVigencia_' + selectorId).disabled = false;
  } else {
    divFechaExp.style.display = 'none';
    divFechaVig.style.display = 'none';
    divEstatus.style.display = 'none';
    // Además, si quieres deshabilitar los campos de Fecha Vigencia, descomenta la siguiente línea
    // document.getElementById('fechaVigencia_' + selectorId).disabled = true;
  }
}


// Función para mostrar/ocultar Fecha de Expedición según la selección del selector
function toggleFechaExpedicion(selectorId) {
  var selectValue = document.getElementById(selectorId).value;
  var divFechaExpedicion = document.getElementById('divFechaExpedicion_' + selectorId);

  if (selectValue === 'Si') {
    divFechaExpedicion.style.display = 'block';
  } else {
    divFechaExpedicion.style.display = 'none';
  }
}


// AQUÍ EMPIEZAN LAS FUNCIONES PARA MOSTRAR U OCULTAR LOS CAMPOS DE CURSOS, DEPENDIENDO DE SI SE HAN HECHO O NO.
// Función para mostrar/ocultar campos según la selección del selector
function toggleFields(selectorId) {
  var selectValue = document.getElementById(selectorId).value;
  var divFechaExp = document.getElementById('divFechaExpedicion_' + selectorId);
  var divFechaVig = document.getElementById('divFechaVigencia_' + selectorId);
  var divEstatus = document.getElementById('divEstatus_' + selectorId);

  if (selectValue === 'Si') {
    divFechaExp.style.display = 'block';
    divFechaVig.style.display = 'block';
    divEstatus.style.display = 'block';
    // Además, si quieres habilitar los campos de Fecha Vigencia, descomenta la siguiente línea
    // document.getElementById('fechaVigencia_' + selectorId).disabled = false;
  } else {
    divFechaExp.style.display = 'none';
    divFechaVig.style.display = 'none';
    divEstatus.style.display = 'none';
    // Además, si quieres deshabilitar los campos de Fecha Vigencia, descomenta la siguiente línea
    // document.getElementById('fechaVigencia_' + selectorId).disabled = true;
  }
}


// Función para mostrar/ocultar Fecha de Expedición según la selección del selector
function toggleFechaExpedicion(selectorId) {
  var selectValue = document.getElementById(selectorId).value;
  var divFechaExpedicion = document.getElementById('divFechaExpedicion_' + selectorId);

  if (selectValue === 'Si') {
    divFechaExpedicion.style.display = 'block';
  } else {
    divFechaExpedicion.style.display = 'none';
  }
}

// Manejar el evento change en el campo de entrada de la foto
document.getElementById("foto").addEventListener("change", function () {
  var reader = new FileReader();
  reader.onload = function (e) {
    var img = new Image();
    img.src = e.target.result;
    img.onload = function () {
      var canvas = document.createElement("canvas");
      var ctx = canvas.getContext("2d");
      var MAX_WIDTH = 300;
      var MAX_HEIGHT = 300;
      var width = img.width;
      var height = img.height;
      if (width > height) {
        if (width > MAX_WIDTH) {
          height *= MAX_WIDTH / width;
          width = MAX_WIDTH;
        }
      } else {
        if (height > MAX_HEIGHT) {
          width *= MAX_HEIGHT / height;
          height = MAX_HEIGHT;
        }
      }
      canvas.width = width;
      canvas.height = height;
      ctx.drawImage(img, 0, 0, width, height);
      document.getElementById("imagenPrevisualizacion").src = canvas.toDataURL("image/jpeg");
    }
  }
  reader.readAsDataURL(this.files[0]);
});