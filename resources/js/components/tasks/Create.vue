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
                    <label for="">Ответственные</label>
                    <users-select   @usersIds="getSelectedIds"
                    ></users-select>
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
        if(this.$route.params.project_id)
            this.task.project_id=this.$route.params.project_id;
        if(this.$route.params.customer_id)
            this.task.customer_id=this.$route.params.customer_id;
    },
    data: function () {
        return {
            projectId: null,
            customerId: null,
            task: {
                name: '',
                deadline: '',
                project_id: '',
                customer_id: '',
                importance: 'default',
                status: 'Новая',
                usersIds:[]
            },
            errors: null,
            options: [
                'foo',
                'bar',
                'baz'
            ]
        }
    },
    methods: {
        saveForm() {
            event.preventDefault();
            let app = this;
            let newTask = app.task;
            axios.post('/api/v1/tasks', newTask)
                .then(function (resp) {
                    if(newTask.project_id)
                        app.$router.push({path: '/projects/show/'+newTask.project_id});
                    if(newTask.customer_id);
                        app.$router.push({path: '/customers/show/'+newTask.customer_id});
                })
                .catch(e => {
                    logoutUnauth(app,e)
                    app.errors = e.response.data.errors;
                });
        },
        getSelectedIds(value) {
            this.task.usersIds=value;
        }
    }
}
</script>
