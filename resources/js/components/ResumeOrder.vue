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
                                                    <img :src="getProduct.picture">
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
                                                    </div>
                                                </div>

                                                <div class="content">
                                                    <div class="columns">
                                                        <div class="column">
                                                            <p class="title is-5">Precio: $  {{Number(getProduct.price).toLocaleString()}} </p>
                                                            <p class="title is-5">Cantidad: {{getProductQty}} </p>
                                                            <p class="title is-5">Total a pagar:   {{Number(getProduct.price*getProductQty).toLocaleString()}} </p>
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

                            <div class="columns">
                                <div class="column is-6">
                                        <label class="label is-pulled-right">Nombres :</label>
                                </div>
                                <div class="column is-6">
                                      {{getCustomerName}}
                                </div>
                            </div>

                        <div class="columns">
                            <div class="column is-6">
                                    <label class="label is-pulled-right">Telefono celular :</label>
                            </div>
                            <div class="column is-6">
                                {{getCustomerPhone}}
                            </div>
                        </div>


                        <div class="columns">
                            <div class="column is-6">
                                    <label class="label is-pulled-right">Tipo de documento :</label>
                            </div>
                            <div class="column is-6">
                               {{getCustomerDocumentType}}
                            </div>
                        </div>

                        <div class="columns ">
                            <div class="column is-6">
                                    <label class="label is-pulled-right">Número de documento:</label>
                            </div>
                            <div class="column is-6">
                                {{getCustomerDocumentNumber}}
                            </div>
                        </div>


                        <div class="columns">
                            <div class="column is-6">
                                    <label class="label is-pulled-right">Email:</label>
                            </div>
                            <div class="column is-6">
                                {{getCustomerEmail}}
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column is-6">
                                    <label class="label is-pulled-right">Dirección de residencia:</label>
                            </div>
                            <div class="column is-6">
                                {{getCustomerStreet}}
                            </div>
                        </div>

                        <div class="columns" id="BottomDiv">
                            <div class="column">
                                <div class="buttons has-addons">
                                    <button  @click="stepTwoBuy" :disabled="buttonDisabled"  class="button is-warning is-fullwidth">Anterior</button>
                                </div>
                            </div>
                            <div class="column">
                                <div class="buttons has-addons">
                                    <button  @click="walletPayment" :disabled="buttonDisabled" class="button is-primary is-fullwidth">Ir a pagar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <Spinnerwaitpayment :active="getHideLoader" message="" ></Spinnerwaitpayment>

        <vue-final-modal
            v-model="showModal"
            classes="modal-container"
            content-class="modal-content">
            <span class="modal__title">La siguiente información debe cumplir con lo requerido</span>
            <div class="modal__content">
                    <br>
                    <div v-for="(value,index) in errorsForm">
                        {{value}}
                    </div>
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
            messageFailed: '',
            buttonDisabled : false,
            showModal: false,
            errorsForm : []
        }
    },
    methods:{
        stepTwoBuy(){
            this.$store.dispatch('startStepTwoBuy',true)
            this.$store.dispatch('startStepThreeBuy',false)
        },
        walletPayment(){
            let bodyFormData = new FormData();
            bodyFormData.append('customerDocumentNumber', this.$store.state.customer.customerDocumentNumber);
            bodyFormData.append('customerAddress', this.$store.state.customer.customerStreet);
            bodyFormData.append('customerDocumentType', this.$store.state.customer.customerDocumentType);
            bodyFormData.append('customerName', this.$store.state.customer.customerName);
            bodyFormData.append('customerEmail', this.$store.state.customer.customerEmail);
            bodyFormData.append('customerPhone', this.$store.state.customer.customerPhone);
            bodyFormData.append('qtyProduct', this.$store.state.qtyProduct);

            this.buttonDisabled = true
            this.$store.commit('setHideLoader',true)
            this.$store.dispatch('enabledButtonBuyResumeOrder',true)

            axios.post('api/v1/createOrder',bodyFormData,
            ).then((response) => {
                if(500===response.data.status.status){
                    window.dispatchEvent(new CustomEvent('event-when-wallet-failed',{
                        detail: {
                            messageBadRequest: response.data.status.message,
                        }
                    }));
                }else{
                    this.$store.commit('setPurchaseOrderId', response.data.purchaseOrderId);
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
                }
            })
            .catch((error) =>
                 this.readingFormErrors(error.response.data.errors)
            )
        },
        readingFormErrors(errors){
            for (const error in errors) {
                this.errorsForm.push(errors[error][0])
            }
            this.buttonDisabled = false
            this.showModal = true;
        }
    },
    computed:{
        getHideLoader(){
            return this.$store.state.loaderWallet;
        },
        getStatusComponent(){
            return this.$store.state.isShowingResumeOrder;
        },
        getCustomerName(){
            return this.$store.state.customer.customerName;
        },
        getCustomerPhone(){
            return this.$store.state.customer.customerPhone;
        },
        getCustomerEmail(){
            return this.$store.state.customer.customerEmail;
        },
        getCustomerStreet(){
            return this.$store.state.customer.customerStreet;
        },
        getCustomerDocumentNumber(){
            return this.$store.state.customer.customerDocumentNumber;
        },
        getCustomerDocumentType(){
            return this.$store.state.customerDocumentTypeLabel;
        },
        getProductQty(){
            return this.$store.state.qtyProduct;
        },
        getProduct() {
            return this.$store.state.product;
        },
    },
    mounted() {
        window.addEventListener('event-when-purchase-has-finished', () => {
            console.log('Evento ejecutado purchase finished..')
            this.buttonDisabled = this.$store.state.buttonPayOrderResume;
        });
    }
}
</script>

<style scoped>
.card .card-image,
.card .card-image .image img {
    height: 250px;

}
#BottomDiv{
    margin-top:150px;
}
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
