import Index from  "../components/logs/index";
import View  from  "../components/logs/view";
import Open  from  "../components/logs/open";

const routes = [
    {
        path : '/messages',
        component : Index,
    },
    {
        path : '/messages/:id/view',
        component : Open,
        children : [
            {
                path : '/messages/:id/view',
                component : View,
            },
        ]
    },
];


export default routes;
