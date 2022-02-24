<template>
    <div v-if='getStatusComponent'>
        <section class="hero is-medium">
            <div class="container">
                <br><br><h3 class="title is-4">Resumen de tu orden</h3><br>

                <div class="columns is-centered">
                    <div class="column is-5">
                        <div class="column">
                            <div class="box">
                                <div class="columns">
                                    <div class="column">
                                        <div class="card">
                                            <div class="card-image">
                                                <figure class="image is-4by3 ">
                                                    <img src="http://localhost:8000/storage/pc.jpeg" alt="Placeholder image">
                                                </figure>
                                            </div>
                                            <div class="card-content">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <figure class="image is-48x48">
                                                            <img src="http://localhost:8000/storage/pc.jpeg" alt="Placeholder image">
                                                        </figure>
                                                    </div>
                                                    <div class="media-content">
                                                        <p class="title is-6">Computador Convertible 2en1 Gaming ROG Flow X13 13.4" Pulgadas GV301QE- AMD Ryzen 9- 16 GB RAM - Disco Estado Sólido 1TB- Negro + Obsequios</p>
                                                        <p class="subtitle is-6">Número de producto: 4711081355274</p>
                                                    </div>
                                                </div>

                                                <div class="content">
                                                    <div class="columns">
                                                        <div class="column">
                                                            <h3 class="title is-4">Precio: $16.199.000 </h3>
                                                        </div>
                                                        <div class="column">
                                                            <h3 class="title is-4">Cantidad: 33 </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column is-7">

                            <h3 class="title is-4">Información del cliente</h3><br><br>

                            <div class="field mb-5">
                                <label class="label">Nombres :</label>
                            </div>
                            <div class="field mb-5">
                                <label class="label">Telefono celular :</label>
                            </div>
                            <div class="field mb-5">
                                <label class="label">Tipo de documento :</label>
                            </div>
                            <div class="field mb-5">
                                <label class="label">Numero de documento :</label>
                            </div>
                            <div class="field mb-5">
                                <label class="label">Dirección de residencia :</label>
                            </div>
                            <div class="field mb-5">
                                <label class="label">Email :</label>
                            </div>
                    </div>
                </div>

            <div class="columns">
                <div class="column">
                    <div class="buttons has-addons is-left">
                        <button  @click="stepTwoBuy"  class="button is-warning is-fullwidth">Anterior</button>
                    </div>
                </div>
                <div class="column">
                    <div class="buttons has-addons is-right">
                        <button  @click="walletPayment"  class="button is-primary is-fullwidth">Ir a pagar</button>
                    </div>
                </div>
            </div>


            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
        }
    },
    computed:{
        getStatusComponent(){
            return this.$store.state.isShowingResumeOrder;
        }
    }
}
</script>

<style scoped>
.card .card-image,
.card .card-image .image img {
    height: 250px;

}

</style>
