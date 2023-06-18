import { createApp } from "vue";

import App from "./App.vue";
import router from "./router";
import store from "./store";
import BaseSpinner from "./components/Base/BaseSpinner.vue";
import BaseButton from "./components/Base/BaseButton.vue";

const app = createApp(App);
app.component("BaseSpinner", BaseSpinner);
app.component("BaseButton", BaseButton);
app.use(router);
app.use(store);
app.mount("#app");
