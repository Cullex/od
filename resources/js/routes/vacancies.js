import addVacancy  from  "../components/vacancies/addVacancy";
import viewVacancy from "../components/vacancies/viewVacancy";
import appliedVacancies from "../components/vacancies/appliedVacancies";
import posted from "../components/vacancies/posted";


const routes = [
    {
        path : '/vacancies/addVacancy',
        component : addVacancy
    },
    {
        path: '/vacancies/viewVacancy/:id',
        component: viewVacancy
    },
    {
        path: '/vacancies/appliedVacancies',
        component: appliedVacancies
    },
    {
        path: '/vacancies/posted',
        component: posted
    }

];

export default routes;
