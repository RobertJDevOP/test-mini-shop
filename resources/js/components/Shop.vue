<template>
    <div v-if='getStatusComponent'>

    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-half">
                        <div class="box">
                            <div class="columns">
                                <div class="column">
                                    <button  @click="viewPurchaseOrder" class="button is-warning is-small">Ver mis compras</button>
                                    <div class="card">
                                        <div class="card-image">
                                            <figure class="image is-4by3">
                                                <img :src="getProduct.picture" alt="PC ROC">
                                            </figure>
                                        </div>
                                        <div class="card-content">
                                            <div class="media">
                                                <div class="media-left">
                                                    <figure class="image is-48x48">
                                                        <img :src="getProduct.picture">
                                                    </figure>
                                                </div>
                                                <div class="media-content">
                                                    <p class="title is-3">{{getProduct.product_name}}</p>
                                                    <p class="subtitle is-5">{{getProduct.description}}</p>
                                                    <p class="subtitle is-4">Número de producto: {{getProduct.code}}</p>
                                                </div>
                                            </div>

                                            <div class="content">
                                                <div class="columns">
                                                    <div class="column">
                                                        <h3 class="title is-4">Precio: ${{getProduct.price}} </h3>
                                                    </div>
                                                    <div class="column">
                                                        <h3 class="title is-4">Cantidad: <input :value="getPrdouctQty"  @change="setIncrementQtyProduct" class="input" size="3" type="number" style="width: 30%;height: 30px;"> </h3>
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
        }
    },
    methods: {
        buyProduct() {
            this.$store.dispatch('startStepOneBuy',false)
            this.$store.dispatch('startStepTwoBuy',true)
        },
        setIncrementQtyProduct(event){
            this.$store.commit('incrementQtyProduct',event.target.value)
        },
        viewPurchaseOrder(){
            this.$store.dispatch('startStepOneBuy',false)
            this.$store.dispatch('startPurchaseOrderHistory',true)
        }
    },
    computed:{
        getStatusComponent() {
            return this.$store.state.isShowingShop;
        },
        getPrdouctQty() {
            return this.$store.state.qtyProduct;
        },
        getProduct() {
            return this.$store.state.product;
        }
    },
    beforeCreate() {
        this.$store.dispatch('getProduct')
    }

}
</script>

<style scoped>
.card .card-image,
.card .card-image .image img {
    height: 400px;
}
</style>
