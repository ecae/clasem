<div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Mantenimiento</h4>
            </div>

            <form id="form_actualizar" class="form-horizontal"  data-parsley-validate novalidate>
                <div class="modal-body">
                    <input type="hidden"  id="id_actualizar_mantenimiento">
                    <div class="form-group">
                        <label for="detalle" class="col-sm-4 control-label">Descripción*</label>
                        <div class="col-sm-7">
                            <input type="text" required class="form-control" v-model="detalle" id="detalle" name="detalle"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fichatecnica_id" class="col-sm-4 control-label">Maquinaria:*</label>

                        <div class="col-sm-7">
                            <select name="fichatecnica_id" class="form-control" v-model="fichatecnica_id" id="fichatecnica_id" required >

                                @foreach ($equipos as $equipo)
                                    <option value="{{ $equipo->id }}">{{$equipo->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="tipo_mantenimiento" class="col-sm-4 control-label">Modalidad:*</label>
                        <div class="col-sm-7">
                            <select name="tipo_modalidadCrear" class="form-control" v-model="tipo_modalidadCrear"  @change="changeModalidadCrear($event)" id="tipo_modalidadCrear" required>
                            <option value="0">Por Horometro</option>
                            <option value="1">Por Dias</option>

                            </select>
                        </div>
                    </div>
                    <div id="div_fecha" class="form-group" v-show="cambiofecha">
                        <label for="fecha_inicial" class="col-sm-4 control-label">Fecha de Inicio*</label>
                        <div class="col-sm-7">
                            <input type="date" id="fecha_inicial" name="fecha_inicial"  v-bind="{required:requi2}"  v-model="fecha_inicial" class="form-control">
                        </div>
                    </div>
                    <div id="div_dia" class="form-group" v-show="cambiofecha">
                        <label for="limite_horometro" class="col-sm-4 control-label">Dias Mantenimiento*</label>
                        <div class="col-sm-7">
                            <input type="number"  class="form-control" id="dias_mantenimiento" v-bind="{required:requi2}" v-model="dias_mantenimiento" name="dias_mantenimiento" >
                        </div>
                    </div>
                    <div id="div_horometro" class="form-group" v-show="cambiohorometro">
                        <label for="limite_horometro" class="col-sm-4 control-label">Horometro*</label>
                        <div class="col-sm-7">
                            <input type="number"  class="form-control" id="limite_horometro" v-bind="{required:requi1}" v-model="horometro" name="limite_horometro" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="estado" class="col-sm-4 control-label">Estado:*</label>
                        <div class="col-sm-7">
                            <select name="estado" class="form-control" v-model="estado" id="estado" required>
                                <option value="1">Activo</option>
                                <option value="0">Suspendido</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" v-on:click="cancelarCrearMantenimiento"   class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                    <button type="submit" v-show="activando_actualizar_preventivo" id="username_register"  class="btn btn-primary waves-effect waves-light">
                        Actualizar
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>