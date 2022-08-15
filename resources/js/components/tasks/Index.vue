<template>
    <div>

        <div class="card-header">
            <h3>
                Моя работа
            </h3>

        </div>
        <section>
            <tasks-list
                @get_results="getResults"
                :tasks="tasks"
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
            projectId: null,
            errors: null,
            tasks: {
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
            axios.get('/api/v1/tasks/my?page='+page)
                .then(function (resp) {
                    app.tasks = resp.data;
                })
                .catch(function (resp) {
                    alert("Не удалось получить информацию о задачах")
                    logoutUnauth(app,resp)
                });
        }
    }
}
</script>
