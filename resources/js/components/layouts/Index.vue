<template>
    <div>
        <div class="logo">
            <h4><a href="/home">Dimple <strong>Simple</strong></a></h4>
        </div>
        <nav id="sidebar" class="sidebar nav-collapse collapse">
            <ul id="side-nav" class="side-nav">
                <li class="">
                    <router-link :to="{name:'dashboard'}" class="nav-link">
                        <i class="fa fa-home"></i> Дашборд
                    </router-link>
                </li>
                <li class="" v-if="user.user.UserRoles.includes('admin')">
                    <router-link :to="{name:'users'}" class="nav-link">
                        <i class="fa fa-users"></i>Пользователи
                    </router-link>
                </li>
                <li class="">
                    <a href="#"><i class="fa fa-table"></i> Задачи</a>
                </li>
                <li class="">
                    <a href="#"><i class="fa fa-cogs"></i> Проекты</a>
                </li>
            </ul>

            <h5 class="sidebar-nav-title">Метки <a class="action-link" href="#"><i class="glyphicon glyphicon-plus"></i></a></h5>
            <!-- some styled links in sidebar. ready to use as links to email folders, projects, groups, etc -->
            <ul class="sidebar-labels">
                <li>
                    <a href="#">
                        <!-- yep, .circle again -->
                        <i class="fa fa-circle text-success"></i>
                        <span class="label-name">Тикет #29 поправить верстку</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-circle text-primary"></i>
                        <span class="label-name">Разработать функционал поиска по ТЗ</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-circle text-danger"></i>
                        <span class="label-name">Проработать раздел SEO</span>
                    </a>
                </li>
            </ul>

            <h5 class="sidebar-nav-title">Прогресс избранных проектов</h5>
            <!-- A place for sidebar notifications & alerts -->
            <div class="sidebar-alerts">
                <div class="alert fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                    <span class="text-white fw-semi-bold">Разработка e-zh.ru</span> <br>
                    <div class="progress progress-xs mt-xs mb-0">
                        <div class="progress-bar progress-bar-gray-light" style="width: 16%"></div>
                    </div>
                    <small>Calculating x-axis bias... 65%</small>
                </div>
                <div class="alert fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-hidden="true">&times;</a>
                    <span class="text-white fw-semi-bold">Новый функционал simplytourit.com</span> <br>
                    <div class="progress progress-xs mt-xs mb-0">
                        <div class="progress-bar progress-bar-danger" style="width: 23%"></div>
                    </div>
                    <small>Provide required notes</small>
                </div>
            </div>
        </nav>
        <div class="wrap">
            <header class="page-header">
                <div class="navbar">
                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="visible-phone-landscape">
                            <a href="#" id="search-toggle">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="hidden-xs dropdown">
                            <a href="#" title="Account" id="account" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                            </a>
                            <ul id="account-menu" class="dropdown-menu account" role="menu">
                                <li role="presentation" class="account-picture">
                                    <img src="/flatlogic/img/avatars/5.png" alt="" class="img-circle">
                                    {{ user.user.name }}
                                </li>
                                <li role="presentation">
                                    <a href="#" class="link">
                                        <i class="fa fa-user"></i>
                                        Профиль
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="visible-xs">
                            <a href="#" class="btn-navbar" data-toggle="collapse" data-target=".sidebar" title="">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                        <li class="hidden-xs">
                            <a href="#" @click="logout">
                                <i class="glyphicon glyphicon-off"></i>
                            </a>
                        </li>
                    </ul>
                    <form id="search-form" class="navbar-form pull-right" role="search">
                        <input type="search" class="form-control search-query" placeholder="Поиск ...">
                    </form>
                </div>
            </header>
            <div class="content container">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
export default {
    name:"dashboard-layout",
    data(){
        return {
            token:this.$store.state.auth.token,
            user:this.$store.state.auth.user
        }
    },
    methods:{
        ...mapActions({
            signOut:"auth/logout"
        }),
        async logout(){
            axios.defaults.headers.common = {'Content-Type': 'application/json','Accept': 'application/json','Authorization': `Bearer ${this.token}`}
            await axios.post('api/logout',{'Accept':'application/json'}).then(({data})=>{
                this.signOut()
                this.$router.push({ path: 'login' })
            })
        }
    }
}
</script>
