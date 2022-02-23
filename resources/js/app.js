require('./bootstrap');

import { createApp } from "vue";
import Example from './components/Example'


createApp({})
    .component('example',require("./components/Example.vue").default)
    .mount('#app')
