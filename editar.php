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
include('php/controllers/edit.controller.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Personal</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="css/styles.css" rel="stylesheet" type="text/css" />
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
          <div class="edicion-personal">
            <h5 class="modal-title text-center">Edición de Personal</h5>
          </div>
          <div class="body-container">
            <div class="titulo-personal">
              <h6 class="bi bi-person-fill-add"> Datos Personales</h6>
            </div> <br>

            <form id="patientForm" method="POST" enctype="multipart/form-data">
              <div class="row">
                <input type="hidden" id="id_enfermero" name="id_enfermero" value="<?php echo $id_enfermero; ?>">

                <div class="col-md-4">
                  <strong>CURP</strong>
                  <input type="text" class="form-control" id="curp" name="curp" required value="<?php echo $curp ?>">
                </div>

                <div class="col-md-4">
                  <strong>Apellido Paterno</strong>
                  <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno"
                    value="<?php echo $apellidoPaterno ?>" required>
                </div>

                <div class="col-md-4">
                  <strong>Apellido Materno</strong>
                  <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno"
                    value="<?php echo $apellidoMaterno ?>" required>
                </div>

                <div class="col-md-4">
                  <strong>Nombre(s)</strong>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre ?>"
                    required>
                </div>

                <div class="col-md-4">
                  <strong>Género</strong>
                  <input type="text" class="form-control" id="genero" name="genero" readonly
                    value="<?php echo $genero ?>">
                </div>

                <div class="col-md-4">
                  <strong>Onomástico</strong>
                  <input type="date" class="form-control" id="onomastico" name="onomastico" readonly
                    value="<?php echo $onomastico ?>">
                </div>

                <div class="col-md-4">
                  <strong>Edad</strong>
                  <input type="text" class="form-control" id="edad" name="edad" readonly value="<?php echo $edad ?>">
                </div>

                <div class="col-md-4">
                  <strong>Domicilio</strong>
                  <input type="text" class="form-control" id="domicilio" name="domicilio" required
                    value="<?php echo $domicilio ?>">
                </div>
                <div class="col-md-4">
                  <strong>Correo personal</strong>
                  <input type="email" class="form-control" id="email" name="email" required
                    value="<?php echo $email ?>">
                </div>
                <div class="col-md-4">
                  <strong>Teléfono personal</strong>
                  <input type="number" class="form-control" id="telefono_personal" name="telefono_personal" required
                    value="<?php echo $telefono_personal ?>">
                </div>

                <div class="col-md-4">
                  <strong>RFC </strong>
                  <input type="text" class="form-control" id="RFC" name="RFC" required value="<?php echo $RFC ?>">
                </div>

              </div> <br>


              <div class="row">
                <div class="col-md-4">
                  <strong>Guarderia</strong>
                  <select name="guarderia" id="guarderia" class="control form-control" required>
                    <option value="" disabled <?php if ($guarderia == '')
                      echo 'selected'; ?>>Seleccione...</option>
                    <option value="Si" <?php if ($guarderia == 'Si')
                      echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($guarderia == 'No')
                      echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-2" id="horas_guarderia" style="display: none;">
                  <strong>Hora guardería</strong>
                  <div class="radio-container">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="entrada" name="tiempo_guarderia" value="Entrada"
                        <?php if ($tiempo_guarderia == 'Entrada')
                          echo "checked"; ?>>
                      <label class="form-check-label" for="entrada">Entrada</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" id="salida" name="tiempo_guarderia" value="Salida"
                        <?php if ($tiempo_guarderia == 'Salida')
                          echo "checked"; ?>>
                      <label class="form-check-label" for="salida">Salida</label>
                    </div>
                  </div>
                </div>

                <div class="col-md-6" id="num_hijos" style="display: none;">
                  <strong>Hijos</strong>
                  <div class="checkbox-container">
                    <div class="form-check form-check-inline">

                      <input class="form-check-input" type="checkbox" id="childrens_1" name="childrens_1" value="Si" <?php if ($childrens_1 == 'Si')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="childrens_1">0 a 5 años</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_2" name="childrens_2" value="Si" <?php if ($childrens_2 == 'Si')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="childrens_2">6 a 10 años</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_3" name="childrens_3" value="Si" <?php if ($childrens_3 == 'Si')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="childrens_3">11 a 15 años</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="childrens_4" name="childrens_4" value="Si" <?php if ($childrens_4 == 'Si')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="childrens_4">más de 15 años</label>
                    </div>
                  </div>
                </div>
              </div> <br>

              <div class="row">

                <div class="col-md-4">
                  <strong>Contacto Emergencia</strong>
                  <select id="contacto_emergencia" name="contacto_emergencia" class="control form-control" required>

                    <option value="" disabled <?php if ($contacto_emergencia == '')
                      echo 'selected'; ?>>Seleccione...
                    </option>
                    <option value="Padre / Madre" <?php if ($contacto_emergencia == 'Padre / Madre')
                      echo 'selected'; ?>>
                      Padre / Madre</option>
                    <option value="Hermano (a)" <?php if ($contacto_emergencia == 'Hermano (a)')
                      echo 'selected'; ?>>
                      Hermano (a)</option>
                    <option value="Esposo (a)" <?php if ($contacto_emergencia == 'Esposo (a)')
                      echo 'selected'; ?>>
                      Esposo (a)</option>
                    <option value="Hijo (a)" <?php if ($contacto_emergencia == 'Hijo (a)')
                      echo 'selected'; ?>>Hijo (a)
                    </option>
                    <option value="Otro" <?php if ($contacto_emergencia == 'Otro')
                      echo 'selected'; ?>>Otro</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Nombre Contacto Emergencia</strong>
                  <input type="text" class="form-control" id="contacto" name="contacto" required
                    value="<?php echo $contacto ?>">
                </div>

                <div class="col-md-4">
                  <strong>No. Contacto Emergencia</strong>
                  <input type="number" class="form-control" id="no_contacto_emergencia" name="no_contacto_emergencia"
                    placeholder="5558585767" required value="<?php echo $no_contacto_emergencia ?>">
                </div>

              </div><br>
            

              <div class="titulo-personal">
                <h6 class="bi bi-mortarboard-fill"> Información Académica</h6>
                
              </div> <br>

              <div class="row">

                <div class="col-md-8">
                  <strong>Escuela de procedencia</strong>
                  <select class="form-control" id="escuela_procedencia" name="informacion_academica" required>
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
                </div>

                <div class="col-md-4">
                  <strong>Observaciones</strong>
                  <input type="text" class="form-control" id="observaciones" name="observaciones" required
                    value="<?php echo $observaciones ?>">
                </div>

              </div>
              <br>


              <div class="titulo-personal">
                <h6 class="bi bi-person-vcard"> Información Contacto </h6>
              </div> <br>

              <div class="row">
              <input type="hidden" id="id_contrato" name="id_contrato" value="<?php echo $id_contrato; ?>">

                <div class="col-md-4">
                  <strong>No. Pasante Médico</strong>
                  <input type="number" name="noempleado" id="noempleado" class="form-control"
                    value="<?php echo $noempleado ?>" required>
                </div>

                <div class="col-md-4">
                  <strong>Fecha Ingreso</strong>
                  <input type="date" class="form-control" id="fechaIngreso" name="fechaIngreso"
                    value="<?php echo $fechaIngreso ?>" required>
                </div>

                <!-- PONER AÑO -->
                <div class="col-md-4">
                  <strong>Año En Curso</strong>
                  <select class="form-control" name="ayo_curso" id="ayo_curso" required>
                    <option value="" disabled <?php if ($ayo_curso == '')
                      echo 'selected'; ?>>Seleccione...</option>
                    
                    <option value="2025-1" <?php if ($ayo_curso == '2025-1')
                      echo 'selected'; ?>>2025-1</option>
                    <option value="2025-2" <?php if ($ayo_curso == '2025-2')
                      echo 'selected'; ?>>2025-2</option>
                    <option value="2026-1" <?php if ($ayo_curso == '2026-1')
                      echo 'selected'; ?>>2026-1</option>
                    <option value="2026-2" <?php if ($ayo_curso == '2026-2')
                      echo 'selected'; ?>>2026-2</option>
                    <option value="2027-1" <?php if ($ayo_curso == '2027-1')
                      echo 'selected'; ?>>2027-1</option>
                    <option value="2027-2" <?php if ($ayo_curso == '2027-2')
                      echo 'selected'; ?>>2027-2</option>
                    <option value="2028-1" <?php if ($ayo_curso == '2028-1')
                      echo 'selected'; ?>>2028-1</option>
                      <option value="2028-2" <?php if ($ayo_curso == '2028-2')
                      echo 'selected'; ?>>2028-2</option>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Turno</strong>
                  <select class="form-control" name="turno" id="turno">
                    <option value="" disabled <?php if ($turno == '')
                      echo 'selected'; ?>>Seleccione...
                    </option>
                    <option value="Matutino" <?php if ($turno == 'Matutino')
                      echo 'selected'; ?>>Matutino</option>
                    <option value="Vespertino" <?php if ($turno == 'Vespertino')
                      echo 'selected'; ?>>Vespertino</option>
                    <option value="Nocturno" <?php if ($turno == 'Nocturno')
                      echo 'selected'; ?>>Nocturno</option>
                    <option value="Jornada Especial" <?php if ($turno == 'Jornada Especial')
                      echo 'selected'; ?>>Jornada
                      Especial</option>
                  </select>
                </div>


                <div class="col-md-8">
                  <strong>Días laborales</strong>
                  <div class="checkbox-container">
                  <input type="hidden" id="id_dias_laborables" name="id_dias_laborables" value="<?php echo $id_dias_laborables; ?>">
                  

                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="lunes" name="lunes" value="Lunes" <?php if ($lunes == 'Lunes')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="lunes">Lunes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="martes" name="martes" value="Martes" <?php if ($martes == 'Martes')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="martes">Martes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="miercoles" name="miercoles" value="Miércoles"
                        <?php if ($miercoles == 'Miércoles')
                          echo "checked"; ?>>
                      <label class="form-check-label" for="miercoles">Miércoles</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="jueves" name="jueves" value="Jueves" <?php if ($jueves == 'Jueves')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="jueves">Jueves</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="viernes" name="viernes" value="Viernes" <?php if ($viernes == 'Viernes')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="viernes">Viernes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="sabado" name="sabado" value="Sábado" <?php if ($sabado == 'Sábado')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="sabado">Sábado</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="domingo" name="domingo" value="Domingo" <?php if ($domingo == 'Domingo')
                        echo "checked"; ?>>
                      <label class="form-check-label" for="domingo">Domingo</label>
                    </div>

                  </div>
                </div>

                <div class="col-md-4">
                  <strong>Servicio</strong>
                  <select class="form-control" name="Servicio" id="Servicio" required>
                    <?php
                    if (!empty($data_servicio)) {
                      foreach ($data_servicio as $row1) {
                        $selected = ($row1["id_servicio"] == $servicio) ? 'selected' : '';
                        echo "<option value='" . $row1["id_servicio"] . "' $selected>" . $row1["servicio"] . "</option>";
                      }
                    } else {
                      echo "<option value=''>No hay datos disponibles</option>";
                    }
                    ?>
                  </select>
                </div>

                <div class="col-md-4">
                  <strong>Horario (De: )</strong>
                  <input type="time" class="form-control" id="horario_de" name="horario_de"
                    value="<?php echo $horario_de ?>">
                </div>

                <div class="col-md-4">
                  <strong>Horario (A: )</strong>
                  <input type="time" class="form-control" id="horario_a" name="horario_a"
                    value="<?php echo $horario_a ?>">
                </div>

                <div class="col-md-4">
                  <strong>Foto</strong>
                  <input type="file" accept=".jpg, .jpeg, .png" class="form-control-file" id="foto" name="foto">
                </div>

                <div class="col-md-4">
                  <strong>Previsualización de la Foto</strong>
                  <img id="imagenPrevisualizacion" src="<?php echo './' . trim($foto); ?>"
                    alt="Previsualización de la Foto" style="max-width: 70%; max-height: 200px;">
                </div>

                <script>
                  document.getElementById('foto').addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (file) {
                      const reader = new FileReader();
                      reader.onload = function (e) {
                        document.getElementById('imagenPrevisualizacion').src = e.target.result;
                      };
                      reader.readAsDataURL(file);
                    }
                  });
                </script>

              </div><br>


              <div class="titulo-personal">
                <h6 class="bi bi-mortarboard-fill"> Capacitación HRAEI </h6>
              </div> <br>

              <div class="row">
              <input type="hidden" id="id_capacitacion" name="id_capacitacion" value="<?php echo $id_capacitacion; ?>">
              

                <div class="col-md-6">
                  <strong>Interculturalidad</strong>
                  <select class="form-control" name="interculturalidad" id="interculturalidad"
                    onchange="toggleFechaExpedicion('interculturalidad')">
                    <option value="" disabled <?php if ($interculturalidad == '') echo 'selected'; ?>>Seleccione...</option>
                    <option value="Si" <?php if ($interculturalidad == 'Si') echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($interculturalidad == 'No') echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_interculturalidad" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_interculturalidad"
                    name="fechaExpedicion_interculturalidad" value="<?php echo $fechaExpedicion_interculturalidad ?>">
                </div>


                <div class="col-md-6">
                  <strong>Capacitación Virtual de Higiene de Manos</strong>
                  <select class="form-control" name="higienemanos" id="higienemanos"
                    onchange="toggleFechaExpedicion('higienemanos')">
                    <option value="" disabled <?php if ($higienemanos == '') echo 'selected'; ?>>Seleccione...</option>
                    <option value="Si" <?php if ($higienemanos == 'Si') echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($higienemanos == 'No') echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_higienemanos" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_higienemanos"
                    name="fechaExpedicion_higienemanos" value="<?php echo $fechaExpedicion_higienemanos ?>">
                </div>


                <div class="col-md-6">
                  <strong>Capacitación Virtual Manejo de Residuos Hospitalarios</strong>
                  <select class="form-control" name="residuoshospitalarios" id="residuoshospitalarios"
                    onchange="toggleFechaExpedicion('residuoshospitalarios')">
                    <option value="" disabled <?php if ($residuoshospitalarios == '') echo 'selected'; ?>>Seleccione...</option>
                    <option value="Si" <?php if ($residuoshospitalarios == 'Si') echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($residuoshospitalarios == 'No') echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_residuoshospitalarios" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_residuoshospitalarios"
                    name="fechaExpedicion_residuoshospitalarios"
                    value="<?php echo $fechaExpedicion_residuoshospitalarios ?>">
                </div>


                <div class="col-md-6">
                  <strong>Acciones Esenciales de Seguridad del Paciente</strong>
                  <select class="form-control" name="seguridadpaciente" id="seguridadpaciente"
                    onchange="toggleFechaExpedicion('seguridadpaciente')">
                    <option value="" disabled <?php if ($seguridadpaciente == '') echo 'selected'; ?>>Seleccione...</option>
                    <option value="Si" <?php if ($seguridadpaciente == 'Si') echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($seguridadpaciente == 'No') echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_seguridadpaciente" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_seguridadpaciente"
                    name="fechaExpedicion_seguridadpaciente" value="<?php echo $fechaExpedicion_seguridadpaciente ?>">
                </div>


                <div class="col-md-6">
                  <strong>Curso Virtual Sobre los Fundamentos del Cuidado Paliativo</strong>
                  <select class="form-control" name="cuidadopaliativo" id="cuidadopaliativo"
                    onchange="toggleFechaExpedicion('cuidadopaliativo')">
                    <option value="" disabled <?php if ($cuidadopaliativo == '') echo 'selected'; ?>>Seleccione...</option>
                    <option value="Si" <?php if ($cuidadopaliativo == 'Si') echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($cuidadopaliativo == 'No') echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_cuidadopaliativo" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_cuidadopaliativo"
                    name="fechaExpedicion_cuidadopaliativo" value="<?php echo $fechaExpedicion_cuidadopaliativo ?>">
                </div>


                <div class="col-md-6">
                  <strong>Curso Básico de Combate de Incendios</strong>
                  <select class="form-control" name="combateincendios" id="combateincendios"
                    onchange="toggleFechaExpedicion('combateincendios')">
                    <option value="" disabled <?php if ($combateincendios == '') echo 'selected'; ?>>Seleccione...</option>
                    <option value="Si" <?php if ($combateincendios == 'Si') echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($combateincendios == 'No') echo 'selected'; ?>>No</option>
                  </select>
                </div>


                <div class="col-md-6" id="divFechaExpedicion_combateincendios" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_combateincendios"
                    name="fechaExpedicion_combateincendios" value="<?php echo $fechaExpedicion_combateincendios ?>">
                </div>


                
                <div class="col-md-6">
                  <strong>Introducción al Modelo Único de Evaluación de la Calidad</strong>
                  <select class="form-control" name="evaluacioncalidad" id="evaluacioncalidad"
                    onchange="toggleFechaExpedicion('evaluacioncalidad')">
                    <option value="" disabled <?php if ($evaluacioncalidad == '') echo 'selected'; ?>>Seleccione...</option>
                    <option value="Si" <?php if ($evaluacioncalidad == 'Si') echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($evaluacioncalidad == 'No') echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_evaluacioncalidad" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_evaluacioncalidad"
                    name="fechaExpedicion_evaluacioncalidad" value="<?php echo $fechaExpedicion_evaluacioncalidad ?>">
                </div>


                <div class="col-md-6">
                  <strong>Trato Digno en los Servicios de Salud</strong>
                  <select class="form-control" name="tratodigno" id="tratodigno"
                    onchange="toggleFechaExpedicion('tratodigno')">
                    <option value="" disabled <?php if ($tratodigno == '') echo 'selected'; ?>>Seleccione...</option>
                    <option value="Si" <?php if ($tratodigno == 'Si') echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($tratodigno == 'No') echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_tratodigno" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_tratodigno"
                    name="fechaExpedicion_tratodigno" value="<?php echo $fechaExpedicion_tratodigno ?>">
                </div>


                <div class="col-md-6">
                  <strong>Reanimación Cardiopulmonar en Adulto para Profesionales de la Salud</strong>
                  <select class="form-control" name="reanimacion" id="reanimacion"
                    onchange="toggleFechaExpedicion('reanimacion')">
                    <option value="" disabled <?php if ($reanimacion == '') echo 'selected'; ?>>Seleccione...</option>
                    <option value="Si" <?php if ($reanimacion == 'Si') echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($reanimacion == 'No') echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_reanimacion" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_reanimacion"
                    name="fechaExpedicion_reanimacion" value="<?php echo $fechaExpedicion_reanimacion ?>">
                </div>


                <div class="col-md-6">
                  <strong>Salud Mental en Profesionales de la Salud</strong>
                  <select class="form-control" name="saludmental" id="saludmental"
                    onchange="toggleFechaExpedicion('saludmental')">
                    <option value="" disabled <?php if ($saludmental == '') echo 'selected'; ?>>Seleccione...</option>
                    <option value="Si" <?php if ($saludmental == 'Si') echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($saludmental == 'No') echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_saludmental" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_saludmental"
                    name="fechaExpedicion_saludmental" value="<?php echo $fechaExpedicion_saludmental ?>">
                </div>


                <div class="col-md-6">
                  <strong style="font-size:13px;">Capacitación de Códigos y Protocolos Hospitalarios de Emergencias y Desastres</strong>
                  <select class="form-control" name="emergenciasydesastres" id="emergenciasydesastres"
                    onchange="toggleFechaExpedicion('emergenciasydesastres')">
                    <option value="" disabled <?php if ($emergenciasydesastres == '') echo 'selected'; ?>>Seleccione...</option>
                    <option value="Si" <?php if ($emergenciasydesastres == 'Si') echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($emergenciasydesastres == 'No') echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_emergenciasydesastres" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_emergenciasydesastres"
                    name="fechaExpedicion_emergenciasydesastres"
                    value="<?php echo $fechaExpedicion_emergenciasydesastres ?>">
                </div>



                <div class="col-md-6">
                  <strong style="font-size:13px;">Medidas Basadas en la Transmisión de Agentes Infecciosos y Procesos de
                    Limpieza</strong>
                  <select class="form-control" name="procesoslimpieza" id="procesoslimpieza"
                    onchange="toggleFechaExpedicion('procesoslimpieza')">
                    <option value="" disabled <?php if ($procesoslimpieza == '') echo 'selected'; ?>>Seleccione...</option>
                    <option value="Si" <?php if ($procesoslimpieza == 'Si') echo 'selected'; ?>>Si</option>
                    <option value="No" <?php if ($procesoslimpieza == 'No') echo 'selected'; ?>>No</option>
                  </select>
                </div>

                <div class="col-md-6" id="divFechaExpedicion_procesoslimpieza" style="display: none;">
                  <strong>Fecha Expedición</strong>
                  <input type="date" class="form-control" id="fechaExpedicion_procesoslimpieza"
                    name="fechaExpedicion_procesoslimpieza" value="<?php echo $fechaExpedicion_procesoslimpieza ?>">
                </div>

              </div>

              <!-- --------------------------------------------------------------------------------------------------------------------------------------------------- -->
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
    import { editForm } from "./js/update.js";
    editForm();
  </script>

</body>
</html>