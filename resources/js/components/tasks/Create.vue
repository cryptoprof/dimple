<template>
    <div>
        <div class="form-group">

        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Новая задача</h3>
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
                            <label class="control-label">Название задачи</label>
                            <input type="text" v-model="task.name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">deadline</label>
                            <input type="date" v-model="task.deadline" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <router-link to="/projects" class="btn btn-inverse">Отмена</router-link><button class="btn btn-success">Создать</button>
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
        this.task.project_id=this.$route.params.project_id;
    },
    data: function () {
        return {
            projectId: null,
            task: {
                name: '',
                deadline: '',
                project_id: '',
                importance: 'default',
                status: 'Новая'
            },
            errors: null,
        }
    },
    methods: {
        saveForm() {
            event.preventDefault();
            let app = this;
            let newTask = app.task;
            axios.post('/api/v1/tasks', newTask)
                .then(function (resp) {
                    app.$router.push({path: '/projects/show/'+newTask.project_id});
                })
                .catch(e => {
                    logoutUnauth(app,e)
                    app.errors = e.response.data.errors;
                });
        }
    }
}
</script>
