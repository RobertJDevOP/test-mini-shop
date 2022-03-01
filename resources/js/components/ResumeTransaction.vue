<template>
    <div v-if='getStatusComponent'>
        <section class="section" >
            <vue-final-modal
                v-model="showModal"
                classes="modal-container"
                content-class="modal-content">
                <span class="modal__title"></span>
                <div class="modal__content">
                    {{messageFailed}}
                    <div class="columns">
                        <div class="column">
                            <button  @click="viewPurchaseOrders" class="button is-primary is-medium is-fullwidth">Ver mis compras</button>
                        </div>
                        <div class="column">
                            <button  @click="stepOneBuy" class="button is-primary is-medium is-fullwidth">Seguir comprando</button>
                        </div>
                    </div>
                </div>
            </vue-final-modal>

            <div class="container" v-if="showingCardContent">
                <div class="columns is-centered">
                    <div class="column is-half">
                        <div class="box">
                            <div class="columns">
                                <div class="column">
                                    <div class="card">
                                        <div class="card-image">
                                        </div>
                                        <div class="card-content" >
                                            <div class="content">
                                                <div class="columns" >
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
            <Spinnerwaitpayment :active="loaderActive" message="" ></Spinnerwaitpayment>
        </section>


    </div>
</template>

<script>
import { VueFinalModal } from "vue-final-modal";

export default {
    components: {
        VueFinalModal,
    },
    data() {
        return {
            statusTransaction : null,
            messageTransaction : '',
            loaderActive: false,
            showingCardContent : false,
            showModal : false,
            messageFailed : ''
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
        },
        showLoader () {
            this.loaderActive = true;
        },
        hideLoader () {
            this.loaderActive = false;
        },
    },
    mounted() {
        this.showLoader();
        window.addEventListener('event-when-wallet-failed', (event) => {
                this.messageFailed=event.detail.messageBadRequest
                this.hideLoader();
                this.showModal = true
        });
        window.addEventListener('event-when-client-return-ecommerce', (event) => {
            axios.get('payment/'+this.$store.state.purchaseOrderId, {})
            .then((response) => {
            })
            axios.get('/api/v1/purchases')
                .then((response) => {
                    this.$store.commit('setPurchases',response.data)
                }).catch((error) => console.error(error))

            this.statusTransaction = event.detail.statusTransaction;
            this.messageTransaction = event.detail.messageTransaction;
            this.hideLoader()
            this.showingCardContent = true;
        });
        window.addEventListener('event-when-client-return-ecommerce-retry-payment', (event) => {
            axios.get('/api/v1/purchases')
                .then((response) => {
                    this.$store.commit('setPurchases',response.data)
                }).catch((error) => console.error(error))

            this.statusTransaction = event.detail.statusTransaction;
            this.messageTransaction = event.detail.messageTransaction;
            this.hideLoader()
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
:deep(.modal-container) {
    display: flex;
    justify-content: center;
    align-items: center;
}
:deep(.modal-content) {
    display: flex;
    flex-direction: column;
    margin: 0 1rem;
    padding: 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.25rem;
    background: #fff;
}
.modal__title {
    font-size: 1.5rem;
    font-weight: 700;
}
</style>
