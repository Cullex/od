import revokeApplication  from  "../components/applications/revokeApplication";
import receivedApplications from "../components/applications/receivedApplications";
import viewApplication from "../components/applications/viewApplication";
import revokeShortListing from "../components/applications/revokeShortListing";
import documents from "../components/applications/documents";
import rejectedOverdrafts from "../components/applications/rejectedOverdrafts";
import approvedOverdrafts from "../components/applications/approvedOverdrafts";
import applyOverdraft from "../components/applications/applyOverdraft";
import viewOverdraftApplication from "../components/applications/viewOverdraftApplication";

const routes = [
    {
        path : '/applications/revokeApplication/:id',
        component : revokeApplication
    },
    {
        path: '/applications/receivedApplications',
        component: receivedApplications
    },
    {
        path: '/applications/viewApplication/:id',
        component: viewApplication
    },
    {
        path: '/applications/revokeShortListing/:id',
        component: revokeShortListing
    },
    {
        path: '/applications/documents',
        component: documents
    },
    {
        path: '/applications/rejectedOverdrafts',
        component: rejectedOverdrafts
    },
    {
        path: '/applications/approvedOverdrafts',
        component: approvedOverdrafts
    },
    {
        path: '/applications/applyOverdraft',
        component: applyOverdraft
    },
    {
        path: '/applications/viewOverdraftApplication/:id',
        component: viewOverdraftApplication
    }


];

export default routes;
