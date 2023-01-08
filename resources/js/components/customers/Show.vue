<template>
    <div>

        <div class="card-header">
            <h3>
                Список задач по клиенту {{customer.customer.name}}
                <router-link :to="{name: 'createTask', params: {customer_id: customer.customer.id}}" class="btn btn-success ml-2">
                    <i class="fa fa-plus"></i> Новая задача
                </router-link>
            </h3>

        </div>
        <section>
            <tasks-list
                @get_results="getResults"
                :tasks="customer.tasks"
            ></tasks-list>
        </section>
    </div>
</template>
<script>

import {logoutUnauth} from "../../helpers/logout_unauth";
import LaravelVuePagination from 'laravel-vue-pagination';

export default {
    components: {
        'Pagination': LaravelVuePagination
    },
    mounted() {
        this.getResults()
    },
    data: function () {
        return {
            customerId: null,
            errors: null,
            customer: {
                name: '',
                date_start: '',
                date_end: '',
                description:''
            },
        }
    },
    methods:{
        getResults(page=1){
            let app = this;
            let id = app.$route.params.id;
            app.customerId = id;
            axios.get('/api/v1/customers/' + id + '/tasks?page='+page)
                .then(function (resp) {
                    app.customer = resp.data;
                })
                .catch(function (resp) {
                    alert("Не удалось получить информацию о проекте")
                    logoutUnauth(app,resp)
                });
        }
    }
}
</script>
