<template>
    <div class="w-full px-6 py-6 mx-auto">
        <!-- table 1 -->

        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6>Клиенты
                            <router-link :to="{name: 'createCustomer'}" class="btn btn-success ml-2">
                                <i class="fa fa-plus"></i> добавить
                            </router-link>
                        </h6>
                    </div>
                    <div class="page-header m-0">
                        <input type="text" v-model="search" @change="getResults"
                               class="border-b mx-6" placeholder="Поиск по клиентам...">
                    </div>
                    <section class="">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    ФИО
                                </th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Email
                                </th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Phone
                                </th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="customer, index in customers.data">
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="px-4 mb-0 font-semibold leading-normal text-sm">
                                        <router-link :to="{name: 'showCustomer', params: {id: customer.id}}">{{
                                                customer.name
                                            }}
                                        </router-link>
                                    </p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    {{ customer.email }}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    {{ customer.phone }}
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <router-link :to="{name: 'editCustomer', params: {id: customer.id}}"
                                                 class="btn btn-success">
                                        <i class="fa fa-edit"></i>
                                    </router-link>
                                    <a href="#"
                                       class="btn btn-danger"
                                       v-on:click="deleteEntry(customer.id, index)">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <Pagination :data="customers" @pagination-change-page="getResults"/>
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
            customers: {},
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
            axios.get('/api/v1/customers?page=' + page + '&search=' + this.search)
                .then(function (resp) {
                    app.customers = resp.data;
                })
                .catch(function (resp) {
                    logoutUnauth(app, resp)
                });
        },
        deleteEntry(id, index) {
            if (confirm("Вы уверены что хотите удалить проект?")) {
                let app = this;
                axios.delete('/api/v1/customers/' + id)
                    .then(function (resp) {
                        app.customers.data.splice(index, 1);
                    })
                    .catch(function (resp) {
                        logoutUnauth(app, resp)
                        alert("Не удалось удалить проект");
                    });
            }
        }
    }
}
</script>
