require('./bootstrap');

import { createApp } from 'vue'
import Shop from "./components/Shop"

const app = createApp({})

app.component('Shop', Shop)
app.mount('#app')
