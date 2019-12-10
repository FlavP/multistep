require('./bootstrap');

//Libraries
import Vue from 'vue';
import VueRouter from 'vue-router';

//My Components
import UserAdd from "./components/profile/UserAdd";
import EditProfile from "./components/profile/EditProfile";
import UploadPicture from "./components/profile/UploadPicture";
import UserDashboard from "./components/operations/UserDashboard";
import StepContainer from "./components/operations/steps/StepContainer";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'abstract',
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
            path: '/operations',
            component: UserDashboard,
            name: 'dashboard'
        },
        {
            path: '/operations/document-steps',
            component: StepContainer,
            name: 'docform'
        },
        {
            path: '/',
            redirect: '/profile/edit-profile',
        }
    ]
});
router.replace('/operations');

const app = new Vue({
    el: '#app',
    components: {UserAdd, EditProfile, UploadPicture, UserDashboard, StepContainer},
    router,
});

