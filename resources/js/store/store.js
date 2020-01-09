import Vue from 'vue';
import Vuex from 'vuex';
import getters from './modules/getters';
import mutations from './modules/mutations';
import actions from "./modules/actions";

Vue.use(Vuex);

let email = '';

export const store = new Vuex.Store({
    namespaced: true,
    state: {
        email
    },
    getters,
    actions,
    mutations
});
