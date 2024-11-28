import './bootstrap';
import {createApp} from 'vue';
import { createPinia } from 'pinia'

import Chat from './components/Chat.vue';

const app = createApp({});
const pinia = createPinia()

app.component('app', Chat)
    .use(pinia)
    .mount('#app');
