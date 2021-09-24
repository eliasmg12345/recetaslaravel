<!-- Y2-->
<template>
    <div>
        <!-- BA1-->
        <span class="like-btn" @click="likeReceta" :class="{'like-active':isActive}"></span>
        <p>{{cantidadLikes}} les gusto esta receta </p>
    </div>
</template>


<script>
export default {
    props:['recetaId','like','likes'],
    data:function(){
        return{
            isActive:this.like,
            totalLikes:this.likes
        }
    },
    mounted(){
        console.log(this.like);
    },
    methods:{
        likeReceta(){
            axios.post('/recetas/' + this.recetaId)
            .then(respuesta=>{
                if(respuesta.data.attached.length>0){
                    this.$data.totalLikes++;
                }else{
                    this.$data.totalLikes--;
                }
                this.isActive=!this.isActive
            })
            .catch(error=>{
                if(error.response.status===401){
                    window.location='/register';
                }
            });
        }
    },
    computed:{
        cantidadLikes: function(){
            return this.totalLikes
        }
    }
}
</script>