require('./bootstrap');

import { createApp } from 'vue'
import Shop from "./components/Shop"
import UserDataConfirmation from "./components/UserDataConfirmation"
import ResumeOrder from "./components/ResumeOrder";
import  { createStore } from 'vuex';

const store = createStore({
    state () {
        return {
            isShowingUserData: false,
            isShowingShop:true,
            isShowingResumeOrder:false,
            customerName : '',
            customerEmail : '',
            customerPhone : '',
            customerDocumentType : '',
            customerDocumentNumber : '',
            customerStreet : '',
        }
    },
    mutations: {
        setCustomerEmail (state,value) {
            state.customerEmail=value
        },
        setCustomerName (state,value) {
            state.customerName=value
        },
        setCustomerPhone (state,value) {
            state.customerPhone=value
        },
        setCustomerStreet (state,value) {
            state.customerStreet=value
        },
        setCustomerDocumentType (state,value) {
            state.customerDocumentType=value
        },
        setCustomerDocumentNumber (state,value) {
            state.customerDocumentNumber=value
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
app.use(store);
app.mount('#app')
