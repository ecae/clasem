<div id="myModal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizar Area</h4>
            </div>

          <form id="form_actualizar"   class="form-horizontal"  data-parsley-validate novalidate>
            <div class="modal-body form-horizontal">

                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                <input type="hidden" id="id_actualizar">
                <input type="hidden" id="id_o_area">


                <div class="form-group">
                    <label for="username" class="col-sm-4 control-label">Nombre del Area*</label>
                    <div class="col-sm-7">
                        <input type="text" required parsley-type="text" data-parsley-minlength="6" @keyup="changeArea($event)" class="form-control" id="area2" name="area"   >
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" v-on:click="cancelarActualizar" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                <button type="submit" v-if="activando2" id="area_actualizar"  class="btn btn-primary waves-effect waves-light">
                    Actualizar
                </button>
            </div>
          </form>
        </div>
    </div>
</div>