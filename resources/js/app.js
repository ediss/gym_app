import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler';
// import { createApp } from "vue";
import App from "./layouts/App.vue";
import router from "./routes/index";
import 'flatpickr/dist/themes/dark.css'


const app= createApp(App)
app.use(router)
app.mount('#app')
// // createApp(Welcome).mount("#app");
//createApp(AppointmentIndex).mount("#app");

