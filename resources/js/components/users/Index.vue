<template>
    <div class="w-full px-6 py-6 mx-auto">
        <!-- table 1 -->

        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6>Пользователи
                            <router-link :to="{name: 'createUser'}" class="btn btn-success ml-2">
                                <i class="fa fa-user-plus"></i> добавить
                            </router-link>
                        </h6>
                </div>
                <div class="page-header m-0">
                    <input type="text" v-model="search" @change="getResults"
                           class="border-b mx-6" placeholder="Имя/Email...">
                </div>
                <section class="">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Имя</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Email</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Роль</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Создан</th>
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Изменен</th>
                            <th  class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user, index in users.data">
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p class="px-4 mb-0 font-semibold leading-normal text-sm">{{ user.name }}</p>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                {{ user.email }}
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <p v-for="role in user.UserRoles" class="text-center">
                                    {{ role }}
                                </p>
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                {{ user.created_at }}
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                {{ user.updated_at }}
                            </td>
                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                <router-link :to="{name: 'editUser', params: {id: user.id}}" class="btn btn-success">
                                    <i class="fa fa-edit"></i>
                                </router-link>
                                <a href="#"
                                   class="btn btn-danger"
                                   v-on:click="deleteEntry(user.id, index)">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <Pagination :data="users" @pagination-change-page="getResults"/>
                </section>
            </div>
        </div>
    </div>
    </div>

</template>

<script>
import LaravelVuePagination from 'laravel-vue-pagination';
import {mapActions} from 'vuex';
import {logoutUnauth} from "../../helpers/logout_unauth";

export default {
    components: {
        'Pagination': LaravelVuePagination
    },
    data: function () {
        return {
            users: {},
            search: ''
        }
    },
    mounted() {
        this.getResults()
    },
    methods: {
        ...mapActions({
            signOut: 'auth/logout'
        }),
        getResults(page = 1) {
            let app = this;
            axios.get('/api/v1/users?page=' + page + '&search=' + this.search)
                .then(function (resp) {
                    app.users = resp.data;
                })
                .catch(function (resp) {
                    logoutUnauth(app, resp)
                });
        },
        deleteEntry(id, index) {
            if (confirm("Вы уверены что хотите удалить пользователя?")) {
                let app = this;
                axios.delete('/api/v1/users/' + id)
                    .then(function (resp) {
                        app.users.data.splice(index, 1);
                    })
                    .catch(function (resp) {
                        logoutUnauth(app, resp)
                        alert("Не удалось удалить пользователя");
                    });
            }
        }
    }
}
</script>
<style>
tr:last-child > td {
    border-bottom: none !important;
}
</style>
