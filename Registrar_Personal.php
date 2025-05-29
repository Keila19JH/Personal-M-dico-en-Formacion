<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

// Verificar si el usuario ha iniciado sesión y si tiene el sistema correcto
if (!isset($_SESSION['valid_user']) || $_SESSION['system_type'] !== 'personal_enf') {
  // El usuario no ha iniciado sesión o no tiene permiso para este sistema
  header('Location: login/index.php');
  exit;
}
$username = $_SESSION['valid_user'];
require ('php/controllers/datos.controller.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar personal</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="css/styles.css" rel="stylesheet" type="text/css">
  <link href="css/style_logout_admin.css" rel="stylesheet" type="text/css">
  <link href="css/style_logout_general.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

  <?php if ($username == 'admin'): ?>
    <?php include 'components/navbar.php'; ?>
  <?php else: ?>
    <?php include 'components/navbar_general.php'; ?>
  <?php endif; ?>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-center">Alta de Personal</h5>
          </div>



          <div class="body-container">
            <div class="title">
              <h6 class="bi bi-person-fill-add"> Datos Personales</h6>
            </div> <br>

            <form id="patientForm" method="POST" enctype="multipart/form-data">
              <div class="row">

                <div class="col-md-4">
                  <strong>CURP</strong>
                  <input type="text" class="form-control" id="curp" name="curp" required maxlength="18">
                </div>

                <div class="col-md-4">
                  <strong>Apellido Paterno</strong>
                  <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" required>
                </div>

                <div class="col-md-4">
                  <strong>Apellido Materno</strong>
                  <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" required>
                </div>

                <div class="col-md-4">
                  <strong>Nombre(s)</strong>
                  <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="col-md-4">
                  <strong>Género</strong>
                  <input type="text" class="form-control" id="genero" name="genero" readonly>
                </div>
                <div class="col-md-4">
                  <strong>Onomástico</strong>
                  <input type="date" class="form-control" id="onomastico" name="onomastico" readonly>
                </div>
                <div class="col-md-4">
                  <strong>Edad</strong>
                  <input type="text" class="form-control" id="edad" name="edad" readonly>
                </div>
                <div class="col-md-4">
                  <strong>Domicilio</strong>
                  <input type="text" class="form-control" id="domicilio" name="domicilio" required>
                </div>
                <div class="col-md-4">
                  <strong>Correo personal</strong>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-4">
                  <strong>Teléfono personal</strong>
                  <input type="number" class="form-control" id="telefono_personal" name="telefono_personal" required>
                </div>
                <div class="col-md-4">
                  <strong>RFC </strong>
                  <input type="text" class="form-control" id="RFC" name="RFC" required>
                </div>

              </div> <br>

              <div class="row">
                <div class="col-md-4">
                  <strong>Guarderia</strong>
                  <select name="guarderia" id="guarderia" class="control form-control" required>
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-2" id="horas_guarderia" style="display: none;">
                  <strong>Hora guardería</strong>
                  <div class="radio-container">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="entrada" name="tiempo_guarderia" value="Entrada">
                      <label class="form-check-label" for="entrada">Entrada</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="salida" name="tiempo_guarderia" value="Salida">
                      <label class="form-check-label" for="salida">Salida</label>
                    </div>
                  </div>
                </div>

                <div class="col-md-6" id="num_hijos" style="display: none;">
                  <strong>Hijos</strong>
                  <div class="checkbox-container">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_1" name="childrens_1" value="Si">
                      <label class="form-check-label" for="childrens_1">0 a 5 años</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_2" name="childrens_2" value="Si">
                      <label class="form-check-label" for="childrens_2">6 a 10 años</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_3" name="childrens_3" value="Si">
                      <label class="form-check-label" for="childrens_3">11 a 15 años</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_4" name="childrens_4" value="Si">
                      <label class="form-check-label" for="childrens_4">más de 15 años</label>
                    </div>
                  </div>
                </div>
              </div> <br>
              <div class="row">

                <div class="col-md-4">
                  <strong>Contacto Emergencia</strong>
                  <select id="contacto_emergencia" name="contacto_emergencia" class="control form-control" required>
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Padre / Madre">Padre / Madre</option>
                    <option value="Hermano (a)">Hermano (a)</option>
                    <option value="Esposo (a)">Esposo (a)</option>
                    <option value="Hijo (a)">Hijo (a)</option>
                    <option value="Otro">Otro</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Nombre Contacto Emergencia</strong>
                  <input type="text" class="form-control" id="contacto" name="contacto" required>
                </div>

                <div class="col-md-4">
                  <strong>No. Contacto Emergencia</strong>
                  <input type="number" class="form-control" id="no_contacto_emergencia" name="no_contacto_emergencia"
                    placeholder="5558585767" required>
                </div>

              </div><br>


              <div class="title">
                <h6 class="bi bi-mortarboard-fill"> Información Académica </h6>
              </div> <br>

              <div class="row">

                <div class="col-md-8">
                  <strong>Escuela de procedencia</strong>
                  <select class="form-control" id="escuela_procedencia" name="informacion_academica" required>
                    <option value="" disabled selected>Seleccione...</option>
                    <?php
                      if (!empty($data_escuelas)) {
                          foreach ($data_escuelas as $escuela) {
                              $selected = ($escuela['id'] == $informacion_academica) ? 'selected' : '';
                              echo "<option value='" . $escuela['id'] . "' $selected>" 
                                  . htmlspecialchars($escuela['escuela_procedencia']) . "</option>";
                          }
                      } else {
                          echo "<option value=''>No hay escuelas registradas</option>";
                      }
                    ?>
                  </select>
                  <!-- <input type="text" class="form-control" id="grado_licenciatura" name="grado_licenciatura"> -->
                </div>

                <div class="col-md-4">
                  <strong>Observaciones</strong>
                  <input type="text" class="form-control" id="observaciones" name="observaciones" required>
                </div>
              </div>

              <br>
              
              <div class="title">
                <h6 class="bi bi-person-vcard"> Información Contacto </h6>
              </div> <br>

              <div class="row">

                <div class="col-md-4">
                  <strong>No. Pasante Médico</strong>
                  <input type="number" name="noempleado" id="noempleado" class="form-control" required>
                </div>

                <div class="col-md-4">
                  <strong>Fecha Ingreso</strong>
                  <input type="date" class="form-control" id="fechaIngreso" name="fechaIngreso" required>
                </div>


                <div class="col-md-4">
                  <strong>Año En Curso</strong>
                  <select class="form-control" name="ayo_curso" id="ayo_curso" required>
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="2025-1">2025-1</option>
                    <option value="2025-2">2025-2</option>
                    <option value="2026-1">2026-1</option>
                    <option value="2026-2">2026-2</option>
                    <option value="2027-1">2027-1</option>
                    <option value="2027-2">2027-2</option>
                    <option value="2028-1">2028-1</option>
                    <option value="2028-2">2028-2</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Turno</strong>
                  <select class="form-control" name="turno" id="turno" required>
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                    <option value="Nocturno">Nocturno</option>
                    <option value="Jornada">Jornada Especial</option>
                  </select>
                </div>


                <div class="col-md-8">
                  <strong>Días laborales</strong>
                  <div class="checkbox-container">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="lunes" name="lunes" value="Lunes">
                      <label class="form-check-label" for="lunes">Lunes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="martes" name="martes" value="Martes">
                      <label class="form-check-label" for="martes">Martes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="miercoles" name="miercoles" value="Miércoles">
                      <label class="form-check-label" for="miercoles">Miércoles</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="jueves" name="jueves" value="Jueves">
                      <label class="form-check-label" for="jueves">Jueves</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="viernes" name="viernes" value="Viernes">
                      <label class="form-check-label" for="viernes">Viernes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="sabado" name="sabado" value="Sábado">
                      <label class="form-check-label" for="sabado">Sábado</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="domingo" name="domingo" value="Domingo">
                      <label class="form-check-label" for="domingo">Domingo</label>
                    </div>

                  </div>
                </div>


                <div class="col-md-4">
                  <strong>Servicio</strong>
                  <select class="form-control" name="Servicio" id="Servicio" required>
                    <option value="" disabled selected>Seleccione...</option>
                    <?php
                    if (!empty($data_servicio)) {
                      foreach ($data_servicio as $row1) {
                        echo "<option value='" . $row1["id_servicio"] . "'>" . $row1["servicio"] . "</option>";
                      }
                    } else {
                      echo "<option value=''>No hay datos disponibles</option>";
                    }
                    ?>
                  </select>
                </div>
                

                <div class="col-md-4">
                  <strong>Horario (De: )</strong>
                  <input type="time" class="form-control" id="horario_de" name="horario_de">
                </div>

                <div class="col-md-4">
                  <strong>Horario (A: )</strong>
                  <input type="time" class="form-control" id="horario_a" name="horario_a">
                </div>


                <div class="col-md-4">
                  <strong>Foto</strong>
                  <input type="file" accept=".jpg, .jpeg, .png" class="form-control-file" id="foto" name="foto"
                    required>
                </div>


                <div class="col-md-4">
                  <strong>Previsualización de la Foto</strong>
                  <img id="imagenPrevisualizacion" src="#" alt="Previsualización de la Foto"
                    style="max-width: 70%; max-height: 200px;">
                </div>
              </div> 
              <br>


              <div class="titulo-personal">
                <h6 class="bi bi-mortarboard-fill"> Capacitación HRAEI </h6>
              </div> <br>

              <div class="row">

                <div class="col-md-6">
                  <strong>Interculturalidad</strong>
                  <select class="form-control" name="interculturalidad" id="interculturalidad" onchange="toggleFechaExpedicion('interculturalidad')">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_interculturalidad" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_interculturalidad" name="fechaExpedicion_interculturalidad">
                </div>


                <div class="col-md-6">
                  <strong>Capacitación Virtual de Higiene de Manos</strong>
                  <select class="form-control" name="higienemanos" id="higienemanos" onchange="toggleFechaExpedicion('higienemanos')">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_higienemanos" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_higienemanos" name="fechaExpedicion_higienemanos">
                </div>


                <div class="col-md-6">
                  <strong>Capacitación Virtual Manejo de Residuos Hospitalarios</strong>
                  <select class="form-control" name="residuoshospitalarios" id="residuoshospitalarios" onchange="toggleFechaExpedicion('residuoshospitalarios')">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_residuoshospitalarios" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_residuoshospitalarios" name="fechaExpedicion_residuoshospitalarios">
                </div>



                <div class="col-md-6">
                  <strong>Acciones Esenciales de Seguridad del Paciente</strong>
                  <select class="form-control" name="seguridadpaciente" id="seguridadpaciente" onchange="toggleFechaExpedicion('seguridadpaciente')">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_seguridadpaciente" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_seguridadpaciente" name="fechaExpedicion_seguridadpaciente">
                </div>



                <div class="col-md-6">
                  <strong>Curso Virtual Sobre los Fundamentos del Cuidado Paliativo</strong>
                  <select class="form-control" name="cuidadopaliativo" id="cuidadopaliativo" onchange="toggleFechaExpedicion('cuidadopaliativo')">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_cuidadopaliativo" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_cuidadopaliativo" name="fechaExpedicion_cuidadopaliativo">
                </div>


                <div class="col-md-6">
                  <strong>Curso Básico de Combate de Incendios</strong>
                  <select class="form-control" name="combateincendios" id="combateincendios" onchange="toggleFechaExpedicion('combateincendios')">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>
                
                <div class="col-md-6" id="divFechaExpedicion_combateincendios" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_combateincendios" name="fechaExpedicion_combateincendios">
                </div>


                <div class="col-md-6">
                  <strong>Introducción al Modelo Único de Evaluación de la Calidad</strong>
                  <select class="form-control" name="evaluacioncalidad" id="evaluacioncalidad" onchange="toggleFechaExpedicion('evaluacioncalidad')">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_evaluacioncalidad" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_evaluacioncalidad" name="fechaExpedicion_evaluacioncalidad">
                </div>



                <div class="col-md-6">
                  <strong>Trato Digno en los Servicios de Salud</strong>
                  <select class="form-control" name="tratodigno" id="tratodigno" onchange="toggleFechaExpedicion('tratodigno')">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_tratodigno" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_tratodigno" name="fechaExpedicion_tratodigno">
                </div>


                <div class="col-md-6">
                  <strong>Reanimación Cardiopulmonar en Adulto para Profesionales de la Salud</strong>
                  <select class="form-control" name="reanimacion" id="reanimacion" onchange="toggleFechaExpedicion('reanimacion')">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_reanimacion" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_reanimacion" name="fechaExpedicion_reanimacion">
                </div>


                <div class="col-md-6">
                  <strong>Salud Mental en Profesionales de la Salud</strong>
                  <select class="form-control" name="saludmental" id="saludmental" onchange="toggleFechaExpedicion('saludmental')">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_saludmental" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_saludmental" name="fechaExpedicion_saludmental">
                </div>



                <div class="col-md-6">
                  <strong style="font-size:13px;">Capacitación de Códigos y Protocolos Hospitalarios de Emergencias y Desastres</strong>
                  <select class="form-control" name="emergenciasydesastres" id="emergenciasydesastres" onchange="toggleFechaExpedicion('emergenciasydesastres')">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>
                
                <div class="col-md-6" id="divFechaExpedicion_emergenciasydesastres" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_emergenciasydesastres" name="fechaExpedicion_emergenciasydesastres">
                </div>



                <div class="col-md-6">
                  <strong style="font-size:13px;">Medidas Basadas en la Transmisión de Agentes Infecciosos y Procesos de
                    Limpieza</strong>
                  <select class="form-control" name="procesoslimpieza" id="procesoslimpieza" onchange="toggleFechaExpedicion('procesoslimpieza')">
                    <option value="" disabled selected>Seleccione...</option>
                    <option value="Si">Si</option>
                    <option value="No">No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_procesoslimpieza" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_procesoslimpieza" name="fechaExpedicion_procesoslimpieza">
                </div>

              </div>
              <br>
              
              <div class="text-right"> <!-- Agregamos la clase text-right para alinear el contenido a la derecha -->
                <button type="button" class="btn btn-danger btn-sm" id="limpiarFormularioBtn">Limpiar</button>
                <button type="submit" class="btn btn-success btn-sm">Guardar</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include 'components/loader.php'; ?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="./js/script.js"></script>
  <script src="./js/curp.js"></script>

  <script type="module">
    import { mainForm } from './js/insert.js';
    mainForm();
  </script>


</body>

</html>