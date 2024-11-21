import './bootstrap';
import {createApp} from 'vue';
import App from './App.vue';

const app = createApp({});

app.component('app', App)
    .mount('#app');
