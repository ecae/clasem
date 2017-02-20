<div class="modal fade" id="myModal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel" >PASO #1.</h4>
            </div>
            <div class="modal-body form-horizontal">
                <h3 >Se ha realizado el mantenimiento ?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="submit" v-on:click.prevent="confirmacionSi($event)"   id="eliminar3"  class="btn btn-success waves-effect waves-light">
                    Si
                </button>
            </div>

        </div>
    </div>
</div>