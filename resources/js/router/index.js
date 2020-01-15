import Vue from 'vue';
import Router from 'vue-router';
import UserAdd from "../components/profile/UserAdd";
import EditProfile from "../components/profile/EditProfile";
import UploadPicture from "../components/profile/UploadPicture";
import UserDashboard from "../components/operations/UserDashboard";
import StepContainer from "../components/operations/steps/StepContainer";

Vue.use(Router);
export const router = new Router({
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
            name: 'picture',
        },
        {
            path: '/operations/document-steps',
            component: StepContainer,
            name: 'docform'
        },
        {
            path: '/operations',
            component: UserDashboard,
            name: 'operations'
        },
    ]
});
export default router;

