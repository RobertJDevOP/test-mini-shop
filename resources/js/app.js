require('./bootstrap');

import { createApp } from 'vue'
import Shop from "./components/Shop"
import UserDataConfirmation from "./components/UserDataConfirmation"
import ResumeOrder from "./components/ResumeOrder";
import SpinnerWaitPayment from "./components/SpinnerWaitPayment"
import ResumeTransaction from "./components/ResumeTransaction";
import PurchaseOrderHistory from "./components/PurchaseOrderHistory";
import  { createStore } from 'vuex';
import Echo from 'laravel-echo'

/*
window.Pusher = require('pusher-js')
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: true,
    forceTLS: false,
})*/

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
                customerDocumentTypeLabel:'',
                transactionMsg:'',
                transactionStatus:'',
            },
            qtyProduct:0,
            product:[],
            idPurchaseOrderId: ''
        }
    },
    mutations: {
        incrementQtyProduct (state,value) {
            state.qtyProduct=value
        },
        setCustomerEmail (state,value) {
            state.customer.customerEmail=value
        },
        setCustomerName (state,value) {
            state.customer.customerName=value
        },
        setCustomerPhone (state,value) {
            state.customer.customerPhone=value
        },
        setCustomerStreet (state,value) {
            state.customer.customerStreet=value
        },
        setCustomerDocumentType (state,value) {
            state.customer.customerDocumentType=value
        },
        setCustomerDocumentTypeLabel(state,value){
            state.customer.customerDocumentTypeLabel=value
        },
        setCustomerDocumentNumber (state,value) {
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
                    console.log('que monda');
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
