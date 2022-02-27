<template>
    <div v-if='getStatusComponent'>


        <section class="section">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-half">
                        Historial de pagos electronicos
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Creada</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(purchase,index) in purchases" :key="purchase.id" >
                                <td>{{purchase.id}}</td>
                                <td>{{purchase.qty}}</td>
                                <td>{{purchase.total}}</td>
                                <td>{{purchase.status}}</td>
                                <td>{{purchase.created_at}}</td>
                                <td>
                                    <button  @click="viewPurchaseOrderDetail" class="button is-primary is-small">Ver detalle</button>
                                    <button  @click="retryPayment"  class="button is-warning is-small">Re intentar pago</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
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
            purchases : []
        }
    },
    methods:{
        viewPurchaseOrderDetail(){

        },
        retryPayment(){

        }
    },
    beforeCreate() {
        axios.get('/api/v1/purchases')
            .then((response) => {
                this.purchases = response.data
            }).catch((error) => console.error(error))
    },
    mounted() {

    },
    computed:{
        getStatusComponent(){
            return this.$store.state.isShowingPurchaseOrderHistory;
        },
    }
}
</script>

<style scoped>

</style>
