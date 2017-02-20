<div id="myModal8" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">PASO #2.</h4>
            </div>

          <form id="form_alta_mantenimiento" class="form-horizontal" enctype="multipart/form-data"  data-parsley-validate novalidate>
            <div class="modal-body ">

                <input type="hidden" name="mantenimiento_id" id="id_actualizar_alta">
                <input type="hidden" id="id_o_fechaInicial">
                <input type="hidden" id="id_o_horometro">

                <div class="form-group">
                    <label for="tipo_mantenimiento" class="col-sm-4 control-label">Modalidad:*</label>
                    <div class="col-sm-7">
                        <select  class="form-control" v-model="tipo_modalidad"  @change="changeTipomodalidad($event)" id="tipo_modalidad" required>
                        <option value="0">Proveedor</option>
                        <option value="1">Interno</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" v-show="cambioproveedor">
                    <label for="proveedor" class="col-sm-4 control-label">Proveedor:*</label>

                    <div class="col-sm-7">
                        <select name="proveedor_id" class="form-control" v-model="proveedor" id="proveedor" v-bind="{required:cambioproveedor}" >
                            @foreach ($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">{{$proveedor->razonsocial }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="form-group" v-show="cambiointerno">
                    <label for="interno" class="col-sm-4 control-label">Operador:*</label>

                    <div class="col-sm-7">
                        <select name="interno" class="form-control"  id="interno" v-model="interno" v-bind="{required:cambiointerno}" >
                            @foreach ($operarios as $operario)
                                <option value="{{ $operario->ncompletos }}">{{$operario->ncompletos}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label for="orden_trabajo" class="col-sm-4 control-label">Orden Trabajo:*</label>
                    <div class="col-sm-7">
                        <select name="ordentrabajo_id" class="form-control"  v-model="ordentrabajo"   id="orden_trabajo" required >
                            @foreach ($ordentrabajos as $ordentrabajo)
                                <option value="{{ $ordentrabajo->id}}">{{$ordentrabajo->ordentrabajo}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="precio" class="col-sm-4 control-label">Precio S/.</label>
                    <div class="col-sm-7">
                        <input type="number" required    class="form-control" id="precio" name="costo" v-model="precio" >
                    </div>
                </div>
                <div id="div_fecha" class="form-group" v-show="cambioaltafecha">
                    <label for="fecha_inicial" class="col-sm-4 control-label">Nueva Fecha *</label>
                    <div class="col-sm-7">
                        <input type="date" id="Nfecha_inicial" name="Nfecha_inicial"  :style="{borderColor:errorNfechaBorder}" v-bind="{required:cambioaltafecha}"  v-model="Nfecha_inicial" @change="VerificandoNFecha($event)"  class="form-control">
                        <label id="nfecha-error" class="error" for="nfecha-error" :style="{display:errorFecha}">La Fecha tiene de ser mayor al anterior!</label>
                    </div>
                </div>
                <div id="div_horometro" class="form-group" v-show="cambioaltahorometro">
                    <label for="limite_horometro" class="col-sm-4 control-label">Nuevo Horometro*</label>
                    <div class="col-sm-7">
                        <input type="number"  class="form-control" id="Nlimite_horometro"  :style="{borderColor:errorNhorometroBorder}"  v-bind="{required:cambioaltahorometro}" v-model="Nhorometro" @keyup="VerificandoNhorometro($event)" name="Nhorometro" >
                        <label id="nlimite-error" class="error" for="nlimite-error" :style="{display:errorLimite}">La Horometro tiene de ser mayor al anterior!</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-4 control-label">Descripción MTTO:</label>
                    <div class="col-sm-7">
                        <textarea class="form-control" id="descripcion_actividad" name="descripcion" rows="3" required> </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="col-sm-4 control-label">Observación:</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="observacion" name="observacion" >
                    </div>
                </div>

                <div class="form-group" v-show="cambioproveedor">
                    <label for="proveedor" class="col-sm-4 control-label">Certificado:*</label>

                    <div class="col-sm-7">
                        <input class="form-control"  id="certificado_file" name="path" type="file" @change="changePath($event)" v-bind="{required:cambioproveedor}" >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" v-on:click="cancelarAlta" class="btn btn-default" data-dismiss="modal">Cancelar</button>

                <button type="submit"  v-show="activando_alta" class="btn btn-success waves-effect waves-light">
                    Aceptar
                </button>
            </div>
          </form>
        </div>
    </div>
</div>