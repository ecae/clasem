<div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Personal</h4>
            </div>

          <form id="form_actualizar"   class="form-horizontal"  data-parsley-validate novalidate>
            <div class="modal-body form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="id_actualizar">
                <input type="hidden" id="id_o_nombre">
                <input type="hidden" id="id_o_apellidoPat">
                <input type="hidden" id="id_o_apellidoMat">
                <input type="hidden" id="id_o_area">
                <input type="hidden" id="id_o_user">
                <input type="hidden" id="id_o_email">
                <input type="hidden" id="id_o_estado">

                <div class="form-group">
                    <label for="nombre" class="col-sm-4 control-label">Nombres*</label>
                    <div class="col-sm-7">
                        <input type="text" required class="form-control" id="nombre2" @keyup="changeNombre($event)"  name="nombre"  >
                    </div>
                </div>
                <div class="form-group">
                    <label for="apellidoMat" class="col-sm-4 control-label">Apellido Paterno*</label>
                    <div class="col-sm-7">
                        <input type="text" required class="form-control" id="apellidoPat2" name="apellidoPat" @keyup="changeApellidoPat($event)" >
                    </div>
                </div>
                <div class="form-group">
                    <label for="apellidoPat" class="col-sm-4 control-label">Apellido Materno*</label>
                    <div class="col-sm-7">
                        <input type="text"  required class="form-control" id="apellidoMat2" name="apellidoMat" @keyup="changeApellidoMat($event)"  >
                    </div>
                </div>
                <div class="form-group">
                    <label for="area_id" class="col-sm-4 control-label">Area:*</label>

                    <div class="col-sm-7">
                        <select name="area_id" class="form-control" @change="changeArea($event)" id="area_id2" required >

                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}">{{$area->area }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label for="user_id" class="col-sm-4 control-label">Usuario:*</label>
                    <div class="col-sm-7">
                        <select name="user_id" class="form-control" @change="changeUser($event)" id="user_id2" required >

                            @foreach ($usuarios as $user)
                                <option value="{{ $user->id }}">{{$user->username }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-4 control-label">Email*</label>
                    <div class="col-sm-7">
                        <input type="email" required parsley-type="email" @keyup="changeEmail($event)"  class="form-control" id="email2" name="email"  >
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