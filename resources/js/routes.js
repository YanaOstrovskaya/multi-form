import Vue from 'vue';
import VueRouter from 'vue-router'



Vue.use(VueRouter);


const routes = [
        {
            path: '/',
            name: 'posts',
            component: require('./views/main/AppPosts')
        },
        {
            path: '/create',
            name: 'create.post',
            component: require('./views/main/AppCreatePost'),
        },
        {
            path: '/posts/:id',
            name: 'post',
            component: require('./views/main/AppOnePost')
        }
    ];

export const router = new VueRouter({
    routes
});