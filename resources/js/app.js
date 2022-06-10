import './bootstrap';



import { createApp } from 'vue'
import indexvue from './components/index'



const app = createApp({

});

app.component('hello-world', indexvue)

app.mount('#app')

// const app = new Vue({
//     el: '#app',
// });