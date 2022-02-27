<template>
    <div v-if='getStatusComponent'>
        <section class="section">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-half">
                        <div class="box">
                            <div class="columns">
                                <div class="column">
                                    <div class="card">
                                        <div class="card-image">
                                        </div>
                                        <div class="card-content">
                                            <div class="content">
                                                <div class="columns">
                                                    <div class="column">
                                                        <h3 class="title is-4">Estado de la transaccion: {{statusTransaction}} </h3><br>
                                                        <h3 class="title is-4">Mensaje:  {{messageTransaction}}   </h3>
                                                    </div>
                                                </div>
                                                <div class="columns">
                                                    <div class="column">
                                                        <button  @click="viewPurchaseOrders" class="button is-primary is-medium is-fullwidth">Ver mis compras</button>
                                                    </div>
                                                    <div class="column">
                                                        <button  @click="stepOneBuy" class="button is-primary is-medium is-fullwidth">Seguir comprando</button>
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
            </div>
        </section>
    </div>
</template>

<script>
export default {
    data() {
        return {
            statusTransaction : null,
            messageTransaction : ''
        }
    },
    methods:{
        stepOneBuy(){
            this.$store.dispatch('startStepFourBuy',false)
            this.$store.dispatch('startStepOneBuy',true)
        },
        viewPurchaseOrders(){
            this.$store.dispatch('startStepFourBuy',false)
            this.$store.dispatch('startPurchaseOrderHistory',true)
        }
    },
    mounted() {
        window.addEventListener('event-when-client-return-ecommerce', (event) => {
            this.statusTransaction = event.detail.statusTransaction;
            this.messageTransaction = event.detail.messageTransaction;
        });
    },
    computed:{
        getStatusComponent(){
            return this.$store.state.isShowingTransactionResult;
        },
    }

}
</script>

<style scoped>

</style>
