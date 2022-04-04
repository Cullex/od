import VueRouter from "vue-router";
import Vue from "vue";
Vue.use(VueRouter);


let routes = [];

import users from "../users";
routes = routes.concat(users);

import messages from "../messages";
routes = routes.concat(messages);

import roles from "../roles";
routes = routes.concat(roles);

import dashboard from "../dashboard";
routes = routes.concat(dashboard);

import vacancies from "../vacancies";
routes = routes.concat(vacancies);

import applications from "../applications";
routes = routes.concat(applications);

import accessManagement from "../accessManagement";
routes = routes.concat(accessManagement);

import systemReports from "../systemReports";
routes = routes.concat(systemReports);

const router = new VueRouter({
    routes :  routes
});


export default router;
