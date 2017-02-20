<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registrando Orden de Trabajo </h4>

            </div>
            <form id="form_registrar"  class="form-vertical" data-parsley-validate novalidate>
                <div class="modal-body" id="OrdenTrabjo">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="fecha" class="col-sm-4 control-label" >Fecha*</label>
                                <input type="text"  class="form-control " id="fecha" name="fecha" value="<?php echo date('d/m/Y'); ?>" disabled>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="maquinaria_id" class="col-sm-4 control-label">Maquinaria*</label>
                                <select name="maquinaria_id" class="form-control" id="maquinaria_id"  v-model="maquinaria_id" required >
                                    @foreach ($maquinarias as $maquinaria)
                                        <option value="{{ $maquinaria->id }}">{{$maquinaria->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="kilometraje" class="col-sm-4 control-label">Kilomentraje*</label>
                                <input type="number"  class="form-control" id="kilometraje" name="kilometraje" v-model="kilometraje">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="horometro" class="col-sm-4 control-label">Horometro*</label>
                                <input type="number"  class="form-control" id="horometro" name="horometro" v-model="horometro" step="0.01">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="loca_averia" class="col-sm-4 control-label">Localizaci&oacute;n Aver&iacute;a*</label>
                                <select name="loca_averia" class="form-control"  v-model="loca_averia"   id="loca_averia" required >
                                    <option value="Mecanico">Mec&aacute;nico</option>
                                    <option value="Electrico">El&eacute;ctrico</option>
                                    <option value="Electronico">Electr&oacute;nico</option>
                                    <option value="Neumatico">Neum&aacute;tico</option>
                                    <option value="Hidraulico">Hidr&aacute;ulico</option>
                                    <option value="Otros">El&eacute;ctrico</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tipo_mantenimiento" class="col-sm-4 control-label">Tipo Mantenimiento*</label>
                                <select name="tipo_mantenimiento" class="form-control"  v-model="tipo_mantenimiento"   id="tipo_mantenimiento" required >
                                    <option value="Preventivo">Preventivo</option>
                                    <option value="Correctivo">Correctivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="cod_material" class="col-sm-4 control-label">Descripción Mantenimiento*</label>
                                <input type="text"  parsley-type="text" class="form-control" id="descripcion_trabajo" name="descripcion_trabajo" v-model="descripcion_trabajo" required   >
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="duracion_tarea" class="col-sm-4 control-label">Duración Tarea*</label>
                                <div class="input-group m-t-10">
                                    <input type="number"  class="form-control" id="duracion_tarea" name="duracion_tarea" v-model="duracion_tarea">
                                    <span class="input-group-addon">Día(s)</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="can_personal" class="col-sm-4 control-label">Cantidad Personal*</label>
                                <input type="number"   class="form-control" id="can_personal" name="can_personal" v-model="can_personal" >
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="cod_material" class="col-sm-4 control-label">Código Material*</label>
                                <input type="text"  parsley-type="text" class="form-control" id="cod_material" name="cod_material" v-model="cod_material">
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="cantidad" class="col-sm-4 control-label">Cantidad Material*</label>
                                <input type="number"  class="form-control" id="cantidad" name="cantidad" v-model="cantidad">
                            </div>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">
                                <label for="cantidad" class="col-sm-4 control-label" style="color:white;">Btn Agregar*</label>
                                <a class="btn btn-icon waves-effect waves-light btn-success m-b-5" v-on:click.stop.prevent="addMantenimiento" > <i class="fa fa-plus"></i> </a>
                            </div>
                        </div>
                    </div>
                    <div id="Addtemplate">
                    </div>
                    <div class="row" id="obser">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="observacion" class="col-sm-4 control-label" >Observacion*</label>
                                <textarea id="observaciones" class="form-control" v-model="observacion" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" v-on:click="cancelarCrearOrdenTrabajo"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                    <button type="submit" v-show="activandoBTNCrear" id="equipo_register"  class="btn btn-primary waves-effect waves-light">
                        Registrar
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>
