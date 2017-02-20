/**
 * Created by PC1 on 02/12/2016.
 */

new Vue({
    el:'#my_app',
    data:{
        descripcion:'',
        fichatecnica_id:'',
        persona_id:'',
        estado:'',

        cambio1:false,
        cambio2:false,
        cambio3:false,
        cambio4:false,


    },
    computed:{
        activando: function () {
            return this.descripcion && this.fichatecnica_id && this.persona_id && this.estado;
        },
        activando2: function () {
            return this.cambio1 || this.cambio2  || this.cambio3 || this.cambio4;
        }

    },
    watch: {

    },
    methods: {
        changeDescripcion:function (event) {
            if($("#id_o_descripcion").val().toLowerCase()==event.target.value.toLowerCase()){
                this.cambio1=false;
            }else {this.cambio1=true;}

        },
        changeFicha:function (event) {
            if($("#id_o_ficha").val()==event.target.value){
                this.cambio2=false;
            }else {this.cambio2=true;}

        },
        changePersona:function (event) {
            if($("#id_o_persona").val()==event.target.value){
                this.cambio3=false;
            }else {this.cambio3=true;}

        },

        changeEstado:function (event) {
            if($("#id_o_estado").val()==event.target.value){
                this.cambio4=false;
            }else {this.cambio4=true;}

        },

    }

});