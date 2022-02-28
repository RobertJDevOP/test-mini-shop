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
                                                            <p class="title is-5">Precio: ${{getProduct.price}} </p>
                                                            <p class="title is-5">Cantidad: {{getProductQty}} </p>
                                                            <p class="title is-5">Total a pagar: {{getProductQty*16199000}} </p>
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
                                    <button  @click="stepTwoBuy" :disabled="buttonBackDisabled"  class="button is-warning is-fullwidth">Anterior</button>
                                </div>
                            </div>
                            <div class="column">
                                <div class="buttons has-addons">
                                    <button  @click="walletPayment" :disabled="isDisabledButton" class="button is-primary is-fullwidth">Ir a pagar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Spinnerwaitpayment :active="loaderActive" message="Please wait 5 seconds" ></Spinnerwaitpayment>
    </div>
</template>

<script>

export default {

    data() {
        return {
            loaderActive: false,
            buttonPayDisabled:false,
            buttonBackDisabled:false,
        }
    },
    methods:{
        showLoader () {
            this.loaderActive = true;
        },
        hideLoader () {
            this.loaderActive = false;
        },
        stepTwoBuy(){
            this.$store.dispatch('startStepTwoBuy',true)
            this.$store.dispatch('startStepThreeBuy',false)
        },
        walletPayment(){
            this.buttonPayDisabled=true
            this.buttonBackDisabled=true
            this.showLoader();
            axios.post('api/v1/createOrder', {
                    params : {
                        customer  : this.$store.state.customer,
                        qtyProduct: this.$store.state.qtyProduct,
                        product: this.$store.state.product,
                    }
                },
            ).then((response) => {
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
            })
            .catch((error) => console.error(error))
            this.$store.dispatch('startStepFourBuy',true)
            this.$store.dispatch('startStepThreeBuy',false)
        }
    },
    computed:{
        isDisabledButton() {
            return this.buttonPayDisabled;
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
            return this.$store.state.customer.customerDocumentTypeLabel;
        },
        getProductQty(){
            return this.$store.state.qtyProduct;
        },
        getProduct() {
            return this.$store.state.product;
        }
    },

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
</style>
