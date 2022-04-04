import Index from  "../components/users/index";
import Create  from  "../components/users/create";
import Edit  from  "../components/users/edit";
import View  from  "../components/users/view";
import Open  from  "../components/users/open";
import SettingsOpen from "../components/settings/open";
import Profile from "../components/settings/profile";
import Password from "../components/settings/password";

const routes = [
    {
        path : '/users/create',
        component : Create
    },
    {
        path : '/users',
        component : Index,
    },
    {
        path : '/users/:id/view',
        component : Open,
        children : [
            {
                path : '/users/:id/view',
                component : View,
            },
            {
                path : '/users/:id/edit',
                component : Edit,
            },
        ]
    },

    {
        path : '/settings',
        component : SettingsOpen,
        children : [
            {
                path : '/settings',
                component : Profile,
            },
            {
                path : '/password',
                component : Password,
            },
        ]
    },
];


export default routes;
