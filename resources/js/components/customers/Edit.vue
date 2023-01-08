<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Изменить проект {{project.name}}</h3>
                <div v-if="errors" class="alert alert-danger">
                    <div v-for="(v, k) in errors" :key="k">
                        <p v-for="error in v" :key="error" class="text-sm">
                            {{ error }}
                        </p>
                    </div>
                </div>
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Название</label>
                            <input type="text" v-model="project.name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Дата начала</label>
                            <input type="date" v-model="project.date_start" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Дата окончания</label>
                            <input type="date" v-model="project.date_end" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Описание</label>
                            <textarea  v-model="project.description" class="form-control">
                            </textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <router-link to="/projects" class="btn btn-inverse">Назад</router-link><button class="btn btn-success">Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>

import {logoutUnauth} from "../../helpers/logout_unauth";

export default {
    mounted() {
        let app = this;
        let id = app.$route.params.id;
        app.projectId = id;
        axios.get('/api/v1/projects/' + id)
            .then(function (resp) {
                app.project = resp.data;
            })
            .catch(function () {
                alert("Не удалось получить информацию о проекте")
            });
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
    methods: {
        saveForm() {
            event.preventDefault();
            var app = this;
            var newProject = app.project;
            axios.patch('/api/v1/projects/' + app.projectId, newProject)
                .then(function (resp) {
                    app.$router.replace('/projects');
                })
                .catch(e => {
                    logoutUnauth(app,e)
                    app.errors = e.response.data.errors;
                });
        }
    }
}
</script>
