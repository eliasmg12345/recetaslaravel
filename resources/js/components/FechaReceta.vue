<template>
    <!--<span v-text="formatearFecha"></span> -->
    <span> {{formatearFecha}} </span>
</template>
<script>
export default {
    props:['fecha'],
    //mounted(){
    //    console.log('la fechas es  ',this.fecha);
    //},
    computed:{
        formatearFecha(){
            return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY')
        }
    }
}
</script>