<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registrando el Area :@{{ area }}</h4>

            </div>
            <form id="form_registrar" class="form-horizontal"  data-parsley-validate novalidate>
                <div class="modal-body">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="area" class="col-sm-4 control-label">Nombre del Area*</label>
                        <div class="col-sm-7">
                            <input type="text" id="area" required  data-parsley-minlength="6" class="form-control" v-model="area" name="area" >

                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" v-on:click="cancelarCrear" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

                    <button type="submit" v-show="activando" id="area_register"  class="btn btn-primary waves-effect waves-light">
                        Registrar
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>
