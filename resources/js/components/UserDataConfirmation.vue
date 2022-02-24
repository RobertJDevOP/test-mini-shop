8<template>
        <div v-if='getStatusComponent'>

            <section class="hero is-medium">
                <div class="container">
                    <br><br><h3 class="title is-4">Para continuar con tu compra es necesario completar los siguientes datos requeridos!</h3><br>

                        <div class="columns is-centered">
                            <div class="column is-4">
                                <div class="field">
                                    <label class="label">Nombres y apellidos</label>
                                    <div class="control">
                                        <input class="input" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <label class="label">Celular</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input" type="text"  >
                                        <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-4">
                                <div class="field">
                                    <label class="label">Email</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input" type="email" >
                                        <span class="icon is-small is-left">
                                          <i class="fas fa-envelope"></i>
                                        </span>
                                        <span class="icon is-small is-right">
                                          <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="columns">
                            <div class="column is-6">
                                <div class="field">
                                    <label class="label">Dirección de residencia</label>
                                    <div class="control">
                                        <input class="input" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="column is-3">
                                <div class="field">
                                    <label class="label">Tipo de documento</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input" type="text"  >
                                        <span class="icon is-small is-left">
                                        <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="column is-3">
                                <div class="field">
                                    <label class="label">Número de documento</label>
                                    <div class="control has-icons-left has-icons-right">
                                        <input class="input" type="number" >
                                        <span class="icon is-small is-left">
                                          <i class="fas fa-envelope"></i>
                                        </span>
                                        <span class="icon is-small is-right">
                                          <i class="fas fa-exclamation-triangle"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="columns">
                        <div class="column is-6">
                            <button  @click="stepTwoBuy"  class="button is-warning is-medium is-fullwidth">Anterior</button>
                        </div>
                        <div class="column is-6">
                            <button  @click="stepTreeBuy"  class="button is-primary is-medium is-fullwidth">Continuar</button>
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
        }
    },
    methods:{
        stepTreeBuy(){
            this.$store.dispatch('startStepThreeBuy',true)
            this.$store.dispatch('startStepTwoBuy',false)
        },
        stepTwoBuy(){
            this.$store.dispatch('startStepTwoBuy',false)
            this.$store.dispatch('startStepOneBuy',true)
        }
    },
    computed:{
        getStatusComponent(){
            return this.$store.state.isShowingUserData;
        }
    }
}
</script>

<style scoped>

</style>
