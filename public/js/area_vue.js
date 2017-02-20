/**
 * Created by ANGGELA on 04/12/2016.
 */

new Vue({
    el:'#my_app',
    data:{

        area: '',
        cambio1:false,

    },
    computed:{
        activando: function () {
            return this.area ;
        },
        activando2: function () {
            return this.cambio1;
        }

    },
    watch: {

    },
    methods: {

        changeArea:function (event) {
            if($("#id_o_area").val().toLowerCase()==event.target.value.toLowerCase()){
                this.cambio1=false;
            }else {this.cambio1=true;}

        }
    }

});