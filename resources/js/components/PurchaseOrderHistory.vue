<template>
    <div v-if='getStatusComponent'>


        <section class="section">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-half">
                       <h3 class="title is-4">  Historial de pagos electronicos  </h3>
                        <button  @click="goToStepOne"  class="button is-primary is-small">Volver</button>
                        <br><br>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Fecha de creación</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(purchase,index) in getPurchases" :key="purchase.id" >
                                <td>{{purchase.id}}</td>
                                <td>{{purchase.qty}}</td>
                                <td>{{purchase.total}}</td>
                                <td>{{purchase.status}}</td>
                                <td>{{purchase.created_at}}</td>
                                <td>
                                    <button  @click="viewDetail(purchase)" class="button is-primary is-small">Ver detalle</button>
                                    <div v-if="purchase.status === 'REJECTED'">
                                        <button  @click="retryPayment(purchase.id)"  class="button is-warning is-small">Re intentar pago</button>
                                    </div>
                                    <div v-if="purchase.status === 'CREATED'">
                                        <button  @click="continuePayment(purchase.id)"  class="button is-warning is-small">Continuar con el pago</button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        <Spinnerwaitpayment :active="getHideLoader" message="" ></Spinnerwaitpayment>

        <vue-final-modal
            v-model="showModal"
            classes="modal-container"
            content-class="modal-content">
            <span class="modal__title">Detalle de la orden de compra</span>
            <div class="modal__content">
                <table class="table">
                    <thead>
                    <tr>
                        <th># de orden</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Nombre del producto </th>
                        <th>Referencia</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(purchaseOrderDetail,index) in purchaseOrderDetail" :key="purchaseOrderDetail.purchase_order_id" >
                        <td>{{purchaseOrderDetail.purchase_order_id}}</td>
                        <td>{{purchaseOrderDetail.qty}}</td>
                        <td>{{purchaseOrderDetail.price}}</td>
                        <td>{{getProduct.product_name}}</td>
                        <td>{{getProduct.code}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </vue-final-modal>

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
            showModal: false,
            purchaseOrderDetail : []
        }
    },
    methods:{
        goToStepOne(){
            this.$store.dispatch('startStepOneBuy',true)
            this.$store.dispatch('startPurchaseOrderHistory',false)
        },
        viewDetail(index){
            this.purchaseOrderDetail = index.details_order;
            this.showModal = true
        },
        retryPayment(purchaseOrderId){
            this.$store.commit('setHideLoader',true)
            this.$store.commit('setPurchaseOrderId',purchaseOrderId);
            axios.get('checkout/'+purchaseOrderId)
                .then((response) => {
                    P.init(response.data.processUrl, { opacity: 0.4 });
                    P.on('response', function(data) {
                        localStorage.setItem('statusTransaction',  data.status.status);
                        localStorage.setItem('messageTransaction',  data.status.message);
                        window.dispatchEvent(new CustomEvent('event-when-client-return-ecommerce-retry-payment', {
                            detail: {
                                statusTransaction: localStorage.getItem('statusTransaction'),
                                messageTransaction: localStorage.getItem('messageTransaction')
                            }
                        }));
                    })
                }).catch((error) => console.error(error))
        },
        continuePayment(purchaseOrderId){
            this.$store.commit('setHideLoader',true)
            this.$store.commit('setPurchaseOrderId',purchaseOrderId);
            axios.get('continuePayment/'+purchaseOrderId)
                .then((response) => {
                    P.init(response.data.processUrl, { opacity: 0.4 });
                    P.on('response', function(data) {
                        localStorage.setItem('statusTransaction',  data.status.status);
                        localStorage.setItem('messageTransaction',  data.status.message);

                        window.dispatchEvent(new CustomEvent('event-when-client-return-ecommerce', {
                            detail: {
                                statusTransaction: localStorage.getItem('statusTransaction'),
                                messageTransaction: localStorage.getItem('messageTransaction')
                            }
                        }));
                    })
                }).catch((error) => console.error(error))
        },
    },
    beforeCreate() {
        axios.get('/api/v1/purchases')
            .then((response) => {
                this.$store.commit('setPurchases',response.data)
            }).catch((error) => console.error(error))
    },
    mounted(){

    },
    computed:{
        getHideLoader(){
            return this.$store.state.loaderWallet;
        },
        getStatusComponent(){
            return this.$store.state.isShowingPurchaseOrderHistory;
        },
        getPurchases(){
            return this.$store.state.purchases;
        },
        getProduct(){
            return this.$store.state.product;
        }
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
