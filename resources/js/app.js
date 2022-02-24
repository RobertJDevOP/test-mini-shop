require('./bootstrap');

import { createApp } from 'vue'
import Shop from "./components/Shop"
import UserDataConfirmation from "./components/UserDataConfirmation"
import ResumeOrder from "./components/ResumeOrder";
import ModalPayment from "./components/ModalWaitPayment"

import  { createStore } from 'vuex';

const store = createStore({
    state () {
        return {
            isShowingUserData: false,
            isShowingShop:true,
            isShowingResumeOrder:false,
            customer : {
                customerName : '',
                customerEmail : '',
                customerPhone : '',
                customerDocumentType : '',
                customerDocumentNumber : '',
                customerStreet : '',
            },
            qtyProduct:0,
            product: {
                'product_name' : 'Test'
            }
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
        setCustomerDocumentNumber (state,value) {
            state.customer.customerDocumentNumber=value
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
        }
    }
})

const app = createApp({})
app.component('Shop', Shop)
app.component('Userdataconfirmation', UserDataConfirmation)
app.component('Resumeorder', ResumeOrder)
app.component('Waitpayment', ModalPayment)
app.use(store);
app.mount('#app')
