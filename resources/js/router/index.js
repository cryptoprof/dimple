import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'

Vue.use(VueRouter)

/* Guest Component */
const Login = () => import('../components/auth/Login.vue' /* webpackChunkName: "resource/js/components/login" */)
const Register = () => import('../components/auth/Register.vue' /* webpackChunkName: "resource/js/components/register" */)
/* Guest Component */

/* Layouts */
const DahboardLayout = () => import('../components/layouts/Index.vue' /* webpackChunkName: "resource/js/components/layouts/dashboard" */)
/* Layouts */

/* Authenticated Component */
const Dashboard = () => import('../components/Dashboard.vue' /* webpackChunkName: "resource/js/components/dashboard" */)

const UsersIndex = () => import('../components/users/Index.vue' /* webpackChunkName: "resource/js/components/dashboard" */)
const UserCreate = () => import('../components/users/Create.vue' /* webpackChunkName: "resource/js/components/dashboard" */)
const UserEdit = () => import('../components/users/Edit.vue' /* webpackChunkName: "resource/js/components/dashboard" */)
/* Authenticated Component */


const Routes = [
    {
        name:"login",
        path:"/login",
        component:Login,
        meta:{
            middleware:"guest",
            title:`Login`
        }
    },
    {
        name:"register",
        path:"/register",
        component:Register,
        meta:{
            middleware:"guest",
            title:`Register`
        }
    },
    {
        path:"/",
        component:DahboardLayout,
        meta:{
            middleware:"auth"
        },
        children:[
            {
                name:"dashboard",
                path: '/',
                component: Dashboard,
            },
            {
                path: '/users',
                name: 'users',
                component: UsersIndex,
                meta:{middleware:"admin"}
            },
            {path: '/users/create', component: UserCreate, name: 'createUser'},
            {path: '/users/edit/:id', component: UserEdit, name: 'editUser'},
        ]
    }

]

var router  = new VueRouter({
    // mode: 'history',
    routes: Routes
})

router.beforeEach((to, from, next) => {
    let isAuth=store.state.auth.authenticated;
    console.log('token',store.state.auth.token);

    if(typeof store.state.auth.token !== 'string' || typeof store.state.auth.user.user==='undefined'){
        isAuth=false;
    }
    if(to.meta.middleware==="guest"){
        if(isAuth){
            next({name:"dashboard"})
        }
        next()
    }else{
        if(isAuth){
            if(to.meta.middleware==="admin"){
                let Role=store.state.auth.user.user.UserRoles;
                if (!Role.includes('admin')){
                    return next({path:"/"})
                }
            }
            next()
        }else{
            next({path:"login"})
        }
    }
})

export default router
