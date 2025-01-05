import './bootstrap';
import '../../css/app.css';
import {createApp} from 'vue';
import App from './src/App.vue';

import router from "./src/router/router";
import { createPinia } from 'pinia';

import axios from 'axios';

import dayjs from 'dayjs';
import 'dayjs/locale/ja';

dayjs.locale('ja');


const app= createApp(App);
// app.use(router).mount("#app");

axios.defaults.baseURL = import.meta.env.VITE_APP_URL;


app.provide('dayjs', dayjs);


app.use(router);
app.use(createPinia());
app.mount("#app");



