8<template>
        <div v-if='getStatusComponent'>

            <section class="section">
                <div class="container">
                    <h3 class="title is-4">Para continuar con tu compra es necesario completar los siguientes datos requeridos!</h3><br>

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
    computed:{
        getStatusComponent(){
            return this.$store.state.isShowingUserData;
        }
    }
}
</script>

<style scoped>

</style>
