<div class="modal fade" id="myModal9" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color: red">Eliminar Usuario</h4>
            </div>
            <form id="form_eliminar" class="form-horizontal"  data-parsley-validate novalidate>
            <div class="modal-body">
                <h3 style="color: red">Desea eliminar a  <span id="username_user"></span> ?</h3>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token2">
                <input type="hidden" id="id_user_eliminar">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit"  id="eliminar3"  class="btn btn-danger waves-effect waves-light">
                    Eliminar
                </button>
            </div>
            </form>
        </div>
    </div>
</div>