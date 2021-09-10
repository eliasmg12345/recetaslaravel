<template>
    <input 
    type="submit" 
    class="btn btn-danger d-block w-100 mb-2" 
    value="Eliminar ×"
    v-on:click="eliminarReceta">
</template>

<script>
export default {
    props:['recetaId'],
    
    methods:{
        eliminarReceta(){
            this.$swal({
            title: 'desa eliominar esta receta?',
            text: "una vez elimnada no se puede recueperar!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'si, eliminar',
            cancelButtonText:'No'
            }).then((result) => {
                if (result.isConfirmed) {

                    const params={
                        id:this.recetaId
                    }

                    //enviar la peticion al revidor
                    axios.post(`/recetas/${this.recetaId}`,{params,_method:'delete'})
                    .then(respuesta=>{
                        this.$swal({
                        title:'receta eliminada',
                        text:'se elimino la receta',
                        icon:'succes'
                        });
                        //eliminar receta del DOM
                        this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                        
                    })
                    .catch(error=>{
                        console.log(error)
                    })

                    
                }
            })

        }
    }
    
}
</script>