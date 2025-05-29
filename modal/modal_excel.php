

<div class="modal fade" id="filtroExcel_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Configuración de Exportación Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>


      <div class="modal-body">
        <form id="excelForm" method="POST" action="php/export.php" autocomplete="off">

          <h6 class="modal-title">Seleccione el rango de fechas para filtrar la información.</h6>

          <strong for="fechaInicio">Fecha de Inicio:</strong>
          <input class="form-control" type="date" id="fechaInicio" name="fechaInicio">

          <strong for="fechaFin">Fecha de Fin:</strong>
          <input class="form-control" type="date" id="fechaFin" name="fechaFin">
          <br>

          <strong>Estatus:</strong>
          <ul style="list-style-type: none; padding-left: 0;">

            <li><input type="checkbox" id="activo" name="estatus[]" value="activo"><label
              for="activo">Activo</label>
            </li>

            <li><input type="checkbox" id="inactivo" name="estatus[]" value="inactivo"><label
              for="inactivo">Inactivo</label>
            </li>  
          </ul>
          
          <div class="modal-footer">
            <button class="download-excel btn btn-info">Descargar Excel</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
          
        </form>

      </div>
    </div>
  </div>
</div>
