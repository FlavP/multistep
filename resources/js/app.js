require('./bootstrap');

//Libraries
import Vue from 'vue';
import router from "./router";

//My Components


const app = new Vue({
    el: '#app',
    router,
});

