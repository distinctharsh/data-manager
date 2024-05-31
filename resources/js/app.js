import "./bootstrap";
import router from "./router/router";
import { createApp } from "vue";
import App from "./layouts/App.vue";
import vuetify from "./vuetify";
import '@mdi/font/css/materialdesignicons.css';

createApp(App).use(router).use(vuetify).mount("#app");