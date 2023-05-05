import './bootstrap';

import {createApp} from 'vue'
import AIImage from "./components/image/AIImage.vue";
import '../css/app.css'
import 'animate.css'

const app = createApp({});

app.component('AIImage', AIImage);
app.mount('#app');
