<template>
    <div>
        <div class="card-header">
            <h3>Проекты
                <router-link :to="{name: 'createProject'}" class="btn btn-success ml-2">
                    <i class="fa fa-plus"></i> добавить
                </router-link>
            </h3>
        </div>
        <div class="page-header m-0">
            <input type="text" v-model="search" @change="getResults" class="form-control width-initial search-query" placeholder="Название проекта...">
        </div>
        <section class="">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Начало проекта</th>
                        <th>Deadline</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="project, index in projects.data">
                        <td><router-link :to="{name: 'showProject', params: {id: project.id}}">{{ project.name }}</router-link></td>
                        <td>{{ project.date_start }}</td>
                        <td>{{ project.date_end }}</td>
                        <td>
                            <router-link :to="{name: 'editProject', params: {id: project.id}}" class="btn btn-success">
                                <i class="fa fa-edit"></i>
                            </router-link>
                            <a href="#"
                               class="btn btn-danger"
                               v-on:click="deleteEntry(project.id, index)">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            <Pagination :data="projects" @pagination-change-page="getResults" />
        </section>
    </div>
</template>

<script>
import LaravelVuePagination from 'laravel-vue-pagination';
import { mapActions } from 'vuex';
import {logoutUnauth} from "../../helpers/logout_unauth";
export default {
    components: {
        'Pagination': LaravelVuePagination
    },
    data: function () {
        return {
            projects: {},
            search:''
        }
    },
    mounted() {
        this.getResults()
    },
    methods: {
        ...mapActions({
            signOut:'auth/logout'
        }),
        getResults(page = 1) {
            let app = this;
            axios.get('/api/v1/projects?page='+page+'&search='+this.search)
                .then(function (resp) {
                    app.projects = resp.data;
                })
                .catch(function (resp) {
                    logoutUnauth(app,resp)
                });
        },
        deleteEntry(id, index) {
            if (confirm("Вы уверены что хотите удалить проект?")) {
                let app = this;
                axios.delete('/api/v1/projects/' + id)
                    .then(function (resp) {
                        app.projects.data.splice(index, 1);
                    })
                    .catch(function (resp) {
                        logoutUnauth(app,resp)
                        alert("Не удалось удалить проект");
                    });
            }
        }
    }
}
</script>
