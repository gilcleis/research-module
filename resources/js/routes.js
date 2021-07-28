import ListQuestion from './components/questions/List.vue';
import CreateQuestion from './components/questions/Create.vue';
import EditQuestion from './components/questions/Edit.vue';

import ListDimension from './components/dimensions/List.vue';
import CreateDimension from './components/dimensions/Create.vue';
import EditDimension from './components/dimensions/Edit.vue';
 
export const routes = [
    // {
    //     name: 'question.list',
    //     path: '/',
    //     component: ListQuestion
    // },
    {
        name: 'question.list',
        path: '/questions',
        component: ListQuestion
    },
    {
        name: 'question.create',
        path: '/questions/create',
        component: CreateQuestion
    },
    {
        name: 'question.edit',
        path: '/questions/edit/:id',
        component: EditQuestion
    },

    {
        name: 'dimension.list',
        path: '/dimensions',
        component: ListDimension
    },
    {
        name: 'dimension.create',
        path: '/dimensions/create',
        component: CreateDimension
    },
    {
        name: 'dimension.edit',
        path: '/dimensions/edit/:id',
        component: EditDimension
    },
];