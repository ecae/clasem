/**
 * Created by PC1 on 02/12/2016.
 */
var vm=new Vue({

    el:'#my_app',
    data:{
        detalle:'',
        hora_Inicial:'',
        hora_Final:'',
        inicial_horometro:'',
        final_horometro: '',


        cambio1:false,
        cambio2:false,
        cambio3:false,
        cambio4:false,
        cambio5:false,

    },
    computed:{
        activando: function () {
            return this.detalle && this.hora_Inicial && this.hora_Final && this.inicial_horometro>0 && this.final_horometro>0 ;
        },
        activando2: function () {
            return this.cambio1 || this.cambio2  || this.cambio3 || this.cambio4 || this.cambio5  ;
        },
        required:function () {
            if(this.cambio3 || this.cambio4){
                return true;
            }else{
                return false;
            }
        },

    },
    watch: {

    },
    methods: {
        changeTipousuario:function (event) {
            if($("#id_o_tipousuario").val()==event.target.value){
                this.cambio1=false;
            }else {this.cambio1=true;}

        },
        changeUsername:function (event) {
            if($("#id_o_username").val().toLowerCase()==event.target.value.toLowerCase()){
                this.cambio2=false;
            }else {this.cambio2=true;}

        },
        changePassword:function (event) {
            if(event.target.value==''){
                this.cambio3=false;
            }else {this.cambio3=true;}

        },
        changeRepassword:function (event) {
            if(event.target.value==''){
                this.cambio4=false;
            }else {this.cambio4=true;}

        },
        changeEstado:function (event) {
            if($("#id_o_estado").val()==event.target.value){
                this.cambio5=false;
            }else {this.cambio5=true;}

        },

    }

});