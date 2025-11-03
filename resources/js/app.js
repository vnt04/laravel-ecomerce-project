import './bootstrap';
import { createApp } from 'vue';
import LoginForm from './components/LoginForm.vue';
import RegisterForm from './components/RegisterForm.vue';
import Home from './components/Home.vue';
import '../css/app.css'; 

import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import ProductPage from './components/admin/product/ProductPage.vue';
import ProductDetail from './components/admin/product/ProductDetail.vue';
import OrderPage from './components/admin/order/OrderPage.vue';
import OrderDetail from './components/admin/order/OrderDetail.vue';

const app = createApp({});

app.use(ElementPlus)

app.component('login-form', LoginForm);
app.component('register-form', RegisterForm);
app.component('home-page', Home);
app.component('product-page', ProductPage);
app.component('product-detail', ProductDetail);
app.component('order-page', OrderPage);
app.component('order-detail', OrderDetail);

app.mount('#app');
