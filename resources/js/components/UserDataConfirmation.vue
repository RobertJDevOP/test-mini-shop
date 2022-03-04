<template>
        <div v-if='getStatusComponent'>

            <section class="hero is-medium">
                <div class="container">
                    <br><br><h3 class="title is-4">Para continuar con tu compra es necesario completar los siguientes datos requeridos!</h3><br>


                        <div class="columns is-centered">
                            <div class="column is-4">
                                <div class="field">
                                    <label class="label">Nombres y apellidos</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input" :value="getCustomerName"  @change="setCustomerName" type="text">
                                        <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                        </span>
                                        <p v-if="getStatusName" class="help is-danger">{{getStatusName}}</p>

                                    </div>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <label class="label">Número de celular</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input" :value="getCustomerPhone"  @change="setCustomerPhone" type="number">
                                        <span class="icon is-small is-left">
                                        <i class="fas fa-phone"></i>
                                        </span>
                                        <p v-if="getStatusPhone" class="help is-danger">{{getStatusPhone}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <label class="label">Email</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input" type="email" :value="getCustomerEmail"  @change="setCustomerEmail">
                                        <span class="icon is-small is-left">
                                          <i class="fas fa-envelope"></i>
                                        </span>
                                        <p v-if="getStatusEmail" class="help is-danger">{{getStatusEmail}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="columns">
                            <div class="column is-6">
                                <div class="field">
                                    <label class="label">Dirección de residencia</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input" :value="getCustomerStreet"  @change="setCustomerStreet" type="text">
                                        <span class="icon is-small is-left">
                                          <i class="fas fa-location-pin"></i>
                                        </span>
                                        <p v-if="getStatusAddress" class="help is-danger">{{getStatusAddress}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-3">
                                <div class="field">
                                    <label class="label">Tipo de documento</label>
                                    <div class="control has-icons-left has-icons-right">
                                    <div class="select">
                                        <select v-model="typeDocumentSelected" @change="setCustomerDocumentType">
                                            <option value="">Seleccione tipo de documento</option>
                                            <option v-for="option in documentType" v-bind:value="option.attributes">{{option.attributes.name}}-{{option.attributes.desc}}</option>
                                        </select>
                                        <span class="icon is-small is-left">
                                          <i class="fas fa-id-card"></i>
                                        </span>
                                        <p v-if="getStatusDocumentType" class="help is-danger">{{getStatusDocumentType}}</p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-3">
                                <div class="field">
                                    <label class="label">Número de documento</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input" type="number" :value="getCustomerDocumentNumber"  @change="setCustomerDocumentNumber">
                                        <span class="icon is-small is-left">
                                          <i class="fas fa-id-card"></i>
                                        </span>
                                        <p v-if="getStatusDocumentNumber" class="help is-danger">{{getStatusDocumentNumber}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>



                    <div class="columns">
                        <div class="column is-6">
                            <div class="buttons has-addons is-left">
                                <button  @click="stepTwoBuy"  class="button is-warning is-fullwidth">Anterior</button>
                            </div>
                        </div>
                        <div class="column is-6">
                            <div class="buttons has-addons is-right">
                                <button  @click="stepTreeBuy"  class="button is-primary is-fullwidth">Continuar</button>
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
            documentType : [],
            typeDocumentSelected : [],
        }
    },
    beforeCreate(){
        axios.get('/api/v1/documentType')
            .then((response) => {
                this.documentType=response.data.data
            }).catch((error) => console.error(error))
    },
    methods:{
        setCustomerName(event) {
            this.$store.commit('setCustomerName',event.target.value)
        },
        setCustomerEmail(event) {
            this.$store.commit('setCustomerEmail',event.target.value)
        },
        setCustomerPhone(event) {
            this.$store.commit('setCustomerPhone',event.target.value)
        },
        setCustomerStreet(event) {
            this.$store.commit('setCustomerStreet',event.target.value)
        },
        setCustomerDocumentType() {
            this.$store.commit('setCustomerDocumentType',this.typeDocumentSelected.id)
            this.$store.commit('setCustomerDocumentTypeLabel',this.typeDocumentSelected.name+'-'+this.typeDocumentSelected.desc)
        },
        setCustomerDocumentNumber(event) {
            this.$store.commit('setCustomerDocumentNumber',event.target.value)
        },
        stepTreeBuy(){
            let count = 0;
            for (const property in this.$store.state.customer) {
                    (this.$store.state.customer[property].length == 0) ?  count++ : 0;
            }

            if(count>0){
                alert('Completa todos los campos..');
            }else{
                this.$store.dispatch('startStepThreeBuy',true)
                this.$store.dispatch('startStepTwoBuy',false)
            }
        },
        stepTwoBuy(){
            this.$store.dispatch('startStepTwoBuy',false)
            this.$store.dispatch('startStepOneBuy',true)
        },
    },
    computed:{
        getStatusComponent(){
            return this.$store.state.isShowingUserData;
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
            return this.$store.state.customer.customerDocumentType;
        },
        getStatusEmail(){
            return this.$store.state.msg.errorEmail
        },
        getStatusPhone(){
            return this.$store.state.msg.cellPhone
        },
        getStatusAddress(){
            return this.$store.state.msg.address
        },
        getStatusDocumentType(){
            return this.$store.state.msg.documentType
        },
        getStatusDocumentNumber(){
            return this.$store.state.msg.documentNumber
        },
        getStatusName(){
            return this.$store.state.msg.name
        }

    },
}
</script>

<style scoped>

</style>
