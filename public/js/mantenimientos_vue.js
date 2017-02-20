/**
 * Created by PC1 on 02/12/2016.
 */

var vue=new Vue({

    el:'#my_app',
    data:{
        fichatecnica_id:'',
        detalle:'',
        tipo_mantenimiento:'',
        fecha_inicial:'',
        horometro: '',
        estado:'',

        cambio1:false,
        cambio2:false,
        cambio3:false,
        cambio4:false,
        cambio5:false,

        cambiofecha:false,
        cambiohorometro:false,


        requi1:false,
        requi2:false,


    },
    computed:{
        activando: function () {
             return this.fichatecnica_id && this.detalle && this.tipo_mantenimiento && this.estado;
        },
        activando2: function () {
        //    return this.cambio1 || this.cambio2  || this.cambio3 || this.cambio4 || this.cambio5  ;
        },
        activando3: function () {
            return this.fecha_inicial || this.horometro;
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
        changeTipomantenimiento:function (event) {

            if(event.target.value==0){
                this.cambiohorometro=true;
                this.cambiofecha=false;
                this.requi1=true;
                this.requi2=false;
                this.fecha_inicial='';
                this.horometro='';

            }else {
                this.cambiofecha=true;
                this.cambiohorometro=false;
                this.requi2=true;
                this.requi1=false;
                this.fecha_inicial='';
                this.horometro='';
            }

            console.log(event.target.value)
        },

        changeVisible:function (event) {
            if(event.target.value==''){
                this.horometro=false;
            }
            else{
                this.horometro=true;
            }


        },
        /*
        changeTipomantenimiento:function (event) {
            if(this.tipo_mantenimiento!=0){
                this.cambiofecha=true;
            }else {this.cambio1=true;}

        },
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
        */

    }

});