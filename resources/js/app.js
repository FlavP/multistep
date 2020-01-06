require('./bootstrap');

//Libraries
import Vue from 'vue';
import router from "./router";
import {store} from "./store/store";

//My Components


const app = new Vue({
    el: '#app',
    router,
    store
});

