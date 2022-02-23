require('./bootstrap');

import { createApp } from 'vue'
import Example from "./components/Example"

const app = createApp({})

app.component('Example', Example)
app.mount('#app')
