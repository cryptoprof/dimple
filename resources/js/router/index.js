import Vue from 'vue'
import VueRouter from 'vue-router'
import store from '../store'
import axios from "axios";

Vue.use(VueRouter)

/* Guest Component */
const Login = () => import('../components/auth/Login.vue' /* webpackChunkName: "dash" */)
const Register = () => import('../components/auth/Register.vue' /* webpackChunkName: "dash" */)
/* Guest Component */

/* Layouts */
const DahboardLayout = () => import('../components/layouts/Index.vue' /* webpackChunkName: "dash" */)
/* Layouts */

/* Authenticated Component */
const Dashboard = () => import('../components/Dashboard.vue' /* webpackChunkName: "dash" */)

const UsersIndex = () => import('../components/users/Index.vue' /* webpackChunkName: "dash" */)
const UserCreate = () => import('../components/users/Create.vue' /* webpackChunkName: "dash" */)
const UserEdit = () => import('../components/users/Edit.vue' /* webpackChunkName: "dash" */)
const ProjectsIndex = () => import('../components/projects/Index.vue' /* webpackChunkName: "dash" */)
const ProjectCreate = () => import('../components/projects/Create.vue' /* webpackChunkName: "dash" */)
const ProjectEdit = () => import('../components/projects/Edit.vue' /* webpackChunkName: "dash" */)
const ProjectShow = () => import('../components/projects/Show.vue' /* webpackChunkName: "dash" */)
const TaskCreate = () => import('../components/tasks/Create.vue' /* webpackChunkName: "dash" */)
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
            {
                path: '/projects',
                name: 'projects',
                component: ProjectsIndex,
            },
            {path: '/projects/create', component: ProjectCreate, name: 'createProject'},
            {path: '/projects/edit/:id', component: ProjectEdit, name: 'editProject'},
            {path: '/projects/show/:id', component: ProjectShow, name: 'showProject'},
            {path: '/tasks/create/:project_id', component: TaskCreate, name: 'createTask'},
        ]
    }

]

var router  = new VueRouter({
    // mode: 'history',
    routes: Routes
})

router.beforeEach((to, from, next) => {
    let isAuth=store.state.auth.authenticated;
    axios.defaults.headers.common = {'Content-Type': 'application/json','Accept': 'application/json','Authorization': `Bearer ${store.state.auth.token}`}
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
