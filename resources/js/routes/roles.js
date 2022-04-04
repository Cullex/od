import Index from "../components/roles/index";
import Create  from "../components/roles/create";
import Edit  from "../components/roles/edit";
import View  from "../components/roles/view";
import Open  from "../components/roles/open";

const routes = [
    {
        path : '/roles/create',
        component : Create
    },
    {
        path : '/roles',
        component : Index,
    },
    {
        path : '/roles/:id/view',
        component : Open,
        children : [
            {
                path : '/roles/:id/view',
                component : View,
            },
            {
                path : '/roles/:id/edit',
                component : Edit,
            }
        ]
    },
];


export default routes;
