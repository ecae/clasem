/**
 * Created by PC1 on 02/12/2016.
 */

var vm=new Vue({

    el:'#my_app',
    data:{
        nombre:'',
        apellidoPat:'',
        apellidoMat:'',
        area:'',
        usuario: '',
        email:'',
        estado:'',

        cambio1:false,
        cambio2:false,
        cambio3:false,
        cambio4:false,
        cambio5:false,
        cambio6:false,
        cambio7:false,

    },
    computed:{
        activando: function () {
            return this.nombre && this.apellidoPat && this.apellidoMat && this.area && this.usuario && this.email && this.estado;
        },
        activando2: function () {
            return this.cambio1 || this.cambio2  || this.cambio3 || this.cambio4 || this.cambio5 || this.cambio6 || this.cambio7;
        }

    },
    watch: {

    },
    methods: {
        changeNombre:function (event) {
            if($("#id_o_nombre").val().toLowerCase()==event.target.value.toLowerCase()){
                this.cambio1=false;
            }else {this.cambio1=true;}

        },
        changeApellidoPat:function (event) {
            if($("#id_o_apellidoPat").val().toLowerCase()==event.target.value.toLowerCase()){
                this.cambio2=false;
            }else {this.cambio2=true;}

        },
        changeApellidoMat:function (event) {
            if($("#id_o_apellidoMat").val().toLowerCase()==event.target.value.toLowerCase()){
                this.cambio3=false;
            }else {this.cambio3=true;}

        },
        changeArea:function (event) {
            if($("#id_o_area").val()==event.target.value){
                this.cambio4=false;
            }else {this.cambio4=true;}

        },
        changeUser:function (event) {
            if($("#id_o_user").val()==event.target.value){
                this.cambio5=false;
            }else {this.cambio5=true;}

        },
        changeEmail:function (event) {
            if($("#id_o_email").val().toLowerCase()==event.target.value.toLowerCase()){
                this.cambio6=false;
            }else {this.cambio6=true;}

        },
        changeEstado:function (event) {
            if($("#id_o_estado").val()==event.target.value){
                this.cambio7=false;
            }else {this.cambio7=true;}

        },

    }

});