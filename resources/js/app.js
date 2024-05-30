import "./bootstrap";
import router from "./router/router";
import { createApp } from "vue";
import App from "./layouts/App.vue";
import vuetify from "./vuetify";

createApp(App).use(router).use(vuetify).mount("#app");