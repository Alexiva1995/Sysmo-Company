var vm_liquidation = new Vue({
    el: '#settlement',
    data: function(){
        return{
            seleAllComision: false,
            StatusProcess: '', 
            CommissionsDetails: []
        }
    },
    methods: {
        /**
         * Permite obtener la informacion de las comisiones de un usuario
         * @param {integer} user_id  
         */
        getDetailComision: function(user_id){
            this.seleAllComision = false
            axios.get('show/' + user_id).then((response) => {
                this.CommissionsDetails = response.data
                $('#modalModalDetalles').modal('show')
            }).catch(function (error) {
                console.log(error)
            }) 
        }, 

        setStatusOrder: function(id){
            axios.get('showOrder/'+ id).then((response) => {
                this.CommissionsDetails = response.data
                console.log(this.CommissionsDetails)
                $('#modalModalSetStatus').modal('show')
            }).catch(function (error) {
                console.log(error)
            })
        },        

        /**
         * Permite obtener la informacion de las comisiones de las liquidaciones
         * @param {integer}  user_id 
         */
         getDetailComisionLiquidation: function(user_id){
            console.log('getDetailComisionLiquidation');

            this.seleAllComision = false
            axios.get('edit/' + user_id).then((response) => {
                this.CommissionsDetails = response.data 
                $('#modalModalDetalles').modal('show')
            }).catch(function (error) {
                console.log(error)
            })
        },

        /** 
         * Permite obtener la informacion de las comisiones de las liquidaciones para aprobar o reversar
         * @param {integer}  user_id
         * @param {string} status
         */
         getDetailComisionLiquidationStatus: function( user_id, status){
            this.StatusProcess = status
            this.seleAllComision = false
            axios.get('edit/' + user_id).then((response) => {
                this.CommissionsDetails = response.data
                $('#modalModalAccion').modal('show')
            }).catch(function (error) {
                console.log(error)
            })
        }
    }
})

    function previewFile(input, preview_id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#" + preview_id).attr('src', e.target.result);
                $("#" + preview_id).css('height', '300px');
                $("#" + preview_id).parent().parent().removeClass('d-none');
            }
            $("label[for='" + $(input).attr('id') + "']").text(input.files[0].name);
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewPersistedFile(url, preview_id) {
        $("#" + preview_id).attr('src', url);
        $("#" + preview_id).css('height', '300px');
        $("#" + preview_id).parent().parent().removeClass('d-none');

    }