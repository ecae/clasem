<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registrando Orden de Trabajo </h4>
            </div>
            <form id="form_actualizar"  class="form-vertical" data-parsley-validate novalidate>
                <div class="modal-body" id="OrdenTrabjo">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="tokenActualizar">
                    <input type="hidden" id="tamaño">
                    <input type="hidden" id="id_actualizar">
                    <div id="DinamicHidden">

                    </div>
                    <input type="hidden" id="id_o_tipousuario">
                    <input type="hidden" id="id_o_username">
                    <input type="hidden" id="id_o_estado">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label for="fecha" class="col-sm-4 control-label" >Fecha*</label>
                                <input type="text"  class="form-control " id="fecha2" name="fecha"  disabled>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="maquinaria_id" class="col-sm-4 control-label">Maquinaria*</label>
                                <select name="maquinaria_id" class="form-control" id="maquinaria_id2"  v-model="maquinariaUpdate_id" required >
                                    @foreach ($maquinarias as $maquinaria)
                                        <option value="{{ $maquinaria->id }}">{{$maquinaria->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="kilometraje" class="col-sm-4 control-label">Kilomentraje*</label>
                                <input type="number"  class="form-control" id="kilometraje2" name="kilometraje" v-model="kilometrajeUpdate" >
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="horometro" class="col-sm-4 control-label">Horometro*</label>
                                <input type="number"  class="form-control" id="horometro2" name="horometro" v-model="horometroUpdate" step="0.01">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="loca_averia" class="col-sm-4 control-label">Localizaci&oacute;n Aver&iacute;a*</label>
                                <select name="loca_averia" class="form-control"  id="loca_averia2" v-model="loca_averiaUpdate" required >
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
                                <select name="tipo_mantenimiento" class="form-control"  id="tipo_mantenimiento2" v-model="tipo_mantenimientoUpdate" required >
                                    <option value="Preventivo">Preventivo</option>
                                    <option value="Correctivo">Correctivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="Addtemplate_Actualizar">
                    </div>
                    <div class="row" id="obser">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="observacion" class="col-sm-4 control-label" >Observacion*</label>
                                <textarea id="observaciones2" class="form-control" v-model="observacionesUpdate" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" v-on:click="cancelarActualizarOrdenTrabajo"  class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                    <button type="submit" v-show="activandoBTNUpdate" id="equipo_register"  class="btn btn-primary waves-effect waves-light">
                        Actualizar
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>