require('./bootstrap');

import { createApp } from 'vue'
import Shop from "./components/Shop"
import UserDataConfirmation from "./components/UserDataConfirmation"
import ResumeOrder from "./components/ResumeOrder";
import SpinnerWaitPayment from "./components/SpinnerWaitPayment"
import ResumeTransaction from "./components/ResumeTransaction";
import PurchaseOrderHistory from "./components/PurchaseOrderHistory";
import  { createStore } from 'vuex';


const store = createStore({
    state () {
        return {
            isShowingUserData: false,
            isShowingShop:true,
            isShowingResumeOrder:false,
            isShowingTransactionResult:false,
            isShowingPurchaseOrderHistory:false,
            customer : {
                customerName : '',
                customerEmail : '',
                customerPhone : '',
                customerDocumentType : [],
                customerDocumentNumber : '',
                customerStreet : '',
            },
            customerDocumentTypeLabel:'',
            qtyProduct:0,
            purchaseOrderId : '',
            purchases : [],
            product: [],
            loaderWallet : false,
            msg : {
                errorEmail : '',
                cellPhone : '',
                address : '',
                documentType : '',
                documentNumber : '',
                name: '',
            },
        }
    },
    mutations: {
        incrementQtyProduct (state,value) {
            state.qtyProduct=value
        },
        setPurchaseOrderId (state,value) {
            state.purchaseOrderId=value
        },
        setPurchases (state,value) {
            state.purchases=value
        },
        setCustomerEmail (state,value) {
            (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) ? state.msg.errorEmail = '' : state.msg.errorEmail = 'Dirección de email invalida'
            state.customer.customerEmail=value
        },
        setCustomerName (state,value) {
            (value.length >=5 && value.length <=80) ? state.msg.mame = '' : state.msg.name = 'Nombre ingresado incorrectamente'
            state.customer.customerName=value
        },
        setCustomerPhone (state,value) {
            (value.length===10 ) ? state.msg.cellPhone = '' : state.msg.cellPhone = 'El número de celular debe contener 10 dígitos'
            state.customer.customerPhone=value
        },
        setCustomerStreet (state,value) {
            (value.length >= 5  && value.length <=255) ? state.msg.address = '' : state.msg.address = 'La dirección de residencia es incorrecta '
            state.customer.customerStreet=value
        },
        setCustomerDocumentType (state,value) {
            (value ) ? state.msg.documentType = '' : state.msg.documentType = 'Por favor ingrese una opción'
            state.customer.customerDocumentType=value
        },
        setCustomerDocumentTypeLabel(state,value){
            state.customer.customerDocumentTypeLabel=value
        },
        setCustomerDocumentNumber (state,value) {
            (value.length >=4 && value.length <= 15 ) ? state.msg.documentNumber = '' : state.msg.documentNumber = 'Número de documento ingresado invalido!'
            state.customer.customerDocumentNumber=value
        },
        SET_PRODUCT(state, posts){
            state.product = posts
        },
        SET_TRANSACTION_STATUS(state, transactionStatus){
            state.transactionStatus = transactionStatus
        },
        SET_TRANSACTION_MESSAGE(state, transactionMsg){
            state.transactionMsg = transactionMsg
        },
        setHideLoader(state,value){
            state.loaderWallet = value
        }
    },
    actions: {
        startStepThreeBuy ({ commit },stepStatus) {
            this.state.isShowingResumeOrder=stepStatus;
            //Send commits if is necessary
        },
        startStepTwoBuy ({ commit },stepStatus) {
            this.state.isShowingUserData=stepStatus;
        },
        startStepOneBuy({ commit },stepStatus){
            this.state.isShowingShop=stepStatus;
        },
        startStepFourBuy({ commit },stepStatus){
            this.state.isShowingTransactionResult=stepStatus;
        },
        startPurchaseOrderHistory({ commit },stepStatus){
            this.state.isShowingPurchaseOrderHistory=stepStatus;
        },
        getProduct({ commit }){
            axios.get('/api/v1/product')
                .then((response) => {
                    commit('SET_PRODUCT', response.data.data.attributes)
                }).catch((error) => console.error(error))
        }
    },
})

const app = createApp({})
app.component('Shop', Shop)
app.component('Userdataconfirmation', UserDataConfirmation)
app.component('Resumeorder', ResumeOrder)
app.component('Spinnerwaitpayment', SpinnerWaitPayment)
app.component('Resumetransaction', ResumeTransaction)
app.component('Purchaseorderhistory', PurchaseOrderHistory)
app.use(store)
app.mount('#app')
