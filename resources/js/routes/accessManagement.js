import allUsers  from  "../components/accessManagement/allUsers";
import editUser from "../components/accessManagement/editUser";

const routes = [
    {
        path : '/accessManagement/allUsers',
        component : allUsers
    },
    {
        path: '/accessManagement/editUser/:id',
        component: editUser
    }
];

export default routes;
