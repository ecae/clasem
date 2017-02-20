<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Asignando Para :@{{ descripcion }}</h4>

            </div>
            <form id="form_registrar" class="form-horizontal"  data-parsley-validate novalidate>
                <div class="modal-body">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="descripcion" class="col-sm-4 control-label">Descripcion*</label>
                        <div class="col-sm-7">
                            <input type="text" required class="form-control" id="descripcion" v-model="descripcion" name="descripcion" >
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
                        <label for="persona_id" class="col-sm-4 control-label">Encargado:*</label>

                        <div class="col-sm-7">
                            <select name="persona_id" class="form-control" v-model="persona_id" id="persona_id" required >

                                @foreach ($personas as $persona)
                                    <option value="{{ $persona->id }}">{{$persona->nombre }}</option>
                                @endforeach
                            </select>
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
                    <button type="button" v-on:click="cancelarCrear" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                    <button type="submit" v-show="activando" id="username_register"  class="btn btn-primary waves-effect waves-light">
                        Registrar
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>
