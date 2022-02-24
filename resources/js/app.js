require('./bootstrap');

import { createApp } from 'vue'
import Shop from "./components/Shop"
import UserDataConfirmation from "./components/UserDataConfirmation"
import  { createStore } from 'vuex';

const store = createStore({
    state () {
        return {
            isShowingUserData: false
        }
    },
    mutations: {
        getIsShowingUserData(){
            return this.$store.state.isShowingUserData
        },
        setIsShowingUserData(){
            this.state.isShowingUserData=true;
        }
    },
    actions: {
        startStepTwoBuy ({ commit }) {
            commit('setIsShowingUserData')
        }
    }
})

const app = createApp({})
app.component('Shop', Shop)
app.use(store);
app.component('Userdataconfirmation', UserDataConfirmation)
app.mount('#app')
