<template>
    <div>

        <div class="card-header">
            <h3>
                Список задач по проекту {{project.project.name}}
                <router-link :to="{name: 'createTask', params: {project_id: project.project.id}}" class="btn btn-success ml-2">
                    <i class="fa fa-plus"></i> Новая задача
                </router-link>
            </h3>

        </div>
        <section class="widget">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Задача</th>
                    <th>Создана</th>
                    <th>Deadline</th>
                    <th>Статус</th>
                    <th width="100">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="task, index in project.tasks.data">
                    <td>{{ task.name }}</td>
                    <td>{{ task.created_at }}</td>
                    <td>{{ task.deadline }}</td>
                    <td>{{ task.status }}</td>
                    <td>

                    </td>
                </tr>
                </tbody>
            </table>
            <Pagination :data="project.tasks.data" @pagination-change-page="getResults" />
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
            project: {
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
            app.projectId = id;
            axios.get('/api/v1/projects/' + id + '/tasks?page='+page)
                .then(function (resp) {
                    app.project = resp.data;
                })
                .catch(function (resp) {
                    alert("Не удалось получить информацию о проекте")
                    logoutUnauth(app,resp)
                });
        }
    }
}
</script>
