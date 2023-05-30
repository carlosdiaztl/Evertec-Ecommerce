import "./bootstrap";
import { createApp } from "vue";
import App from "./components/App.vue";
import ProductsExample  from "./components/Products.vue";
import Products from "./components/ProductsExample.vue";
const app = createApp({});
app.component("products-component", Products);
app.component("product-example", ProductsExample);
app.component("example", App);
app.mount("#app");

