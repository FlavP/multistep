require('./bootstrap');

//Libraries
import Vue from 'vue';
import VueRouter from 'vue-router';

//My Components
import UserAdd from "./components/profile/UserAdd";
import EditProfile from "./components/profile/EditProfile";
import UploadPicture from "./components/profile/UploadPicture";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/profile/add-user',
            component: UserAdd,
            name: 'add',
        },
        {
            path: '/profile/edit-profile',
            component: EditProfile,
            name: 'edit'
        },
        {
            path: '/profile/upload-picture',
            component: UploadPicture,
            name: 'picture'
        },
        {
            path: '/',
            redirect: '/profile/edit-profile',
        }
    ]
});

const app = new Vue({
    el: '#app',
    components: {UserAdd, EditProfile},
    router,
});
