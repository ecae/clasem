<div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Asignacion</h4>
            </div>

          <form id="form_actualizar"   class="form-horizontal"  data-parsley-validate novalidate>
            <div class="modal-body form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="id_actualizar">
                <input type="hidden" id="id_o_descripcion">
                <input type="hidden" id="id_o_ficha">
                <input type="hidden" id="id_o_persona">
                <input type="hidden" id="id_o_estado">


                <div class="form-group">
                    <label for="descripcion" class="col-sm-4 control-label">Descripcion:*</label>
                    <div class="col-sm-7">
                        <input type="text" required parsley-type="text"  @keyup="changeDescripcion($event)" class="form-control" id="descripcion2" name="descripcion2"   >
                    </div>
                </div>

                <div class="form-group">
                    <label for="tipousuario" class="col-sm-4 control-label">Tipo Usuario:*</label>

                    <div class="col-sm-7">
                        <select name="fichatecnica_id" class="form-control" @change="changeFicha($event)" id="fichatecnica_id2" required >

                        @foreach ($equipos as $equipo)
                            <option value="{{ $equipo->id }}">{{$equipo->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label for="tipousuario" class="col-sm-4 control-label">Tipo Usuario:*</label>

                    <div class="col-sm-7">
                        <select name="persona_id" class="form-control" @change="changePersona($event)" id="persona_id2" required >
                        @foreach ($personas as $persona)
                            <option value="{{ $persona->id }}">{{$persona->nombre }}</option>
                        @endforeach
                        </select>
                    </div>

                </div>

                <div class="form-group">
                    <label for="estado" class="col-sm-4 control-label">Estado:*</label>
                    <div class="col-sm-7">
                        <select name="estado" class="form-control" @change="changeEstado($event)" id="estado2" required>
                            <option value="1">Activo</option>
                            <option value="0">Suspendido</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" v-on:click="cancelarActualizar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                <button type="submit" v-if="activando2" id="username_actualizar"  class="btn btn-primary waves-effect waves-light">
                    Actualizar
                </button>
            </div>
          </form>
        </div>
    </div>
</div>