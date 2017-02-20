<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Registrando el Reporte Diario : @{{ detalle }}</h4>

            </div>
            <form id="form_registrar" class="form-horizontal"  data-parsley-validate novalidate>
                <div class="modal-body">
                    {!! csrf_field() !!}

                    <div class="form-group">
                        <label for="detalle" class="col-sm-4 control-label">Detalle*</label>
                        <div class="col-sm-7">
                            <input type="text" id="detalle" required  data-parsley-minlength="6" class="form-control" v-model="detalle" name="detalle" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hora_Inicial" class="col-sm-4 control-label">Hora de entrada*</label>
                        <div class="col-sm-7">
                            <input id="hora_Inicial" type="time" v-model="hora_Inicial" name="hora_Inicial"  required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="hora_Final" class="col-sm-4 control-label">Hora de salida*</label>
                        <div class="col-sm-7">
                            <input id="hora_Final" type="time" v-model="hora_Final" name="hora_Final"  required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inicial_horometro" class="col-sm-4 control-label">Horometro Inicial*</label>
                        <div class="col-sm-7">
                            <input id="inicial_horometro" type="number" v-model="inicial_horometro" name="inicial_horometro"  required class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="final_horometro" class="col-sm-4 control-label">Horometro Final*</label>
                        <div class="col-sm-7">
                            <input id="final_horometro" type="number" v-model="final_horometro" name="final_horometro"  required class="form-control">
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
