<template>
    <div v-if='shopStatusComponent'>

    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-half">
                        <div class="box">
                            <div class="columns">
                                <div class="column">
                                    <div class="card">
                                        <div class="card-image">
                                            <figure class="image is-4by3">
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
                                                    <p class="title is-4">Computador Convertible 2en1 Gaming ROG Flow X13 13.4" Pulgadas GV301QE- AMD Ryzen 9- 16 GB RAM - Disco Estado Sólido 1TB- Negro + Obsequios</p>
                                                    <p class="subtitle is-6">Número de producto: 4711081355274</p>
                                                </div>
                                            </div>

                                            <div class="content">
                                                <div class="columns">
                                                    <div class="column">
                                                        <h3 class="title is-4">Precio: $16.199.000 </h3>
                                                    </div>
                                                    <div class="column">
                                                        <h3 class="title is-4">Cantidad: <input v-model="qtyProduct" class="input" size="3" type="number" style="width: 33%;"> </h3>
                                                    </div>
                                                </div>

                                                <button  @click="buyProduct"  class="button is-primary is-medium is-fullwidth">Comprar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
            qtyProduct: '',
            shopStatusComponent:true,
        }
    },
    methods: {
        buyProduct() {
            this.shopStatusComponent=false
            this.$store.dispatch('startStepTwoBuy')
        }
    },

}
</script>

<style scoped>
.card .card-image,
.card .card-image .image img {
    height: 400px;
}
</style>
