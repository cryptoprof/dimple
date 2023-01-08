<template>
    <div>
        <div class="form-group">

        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Новый клиент</h3>
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
                            <label class="control-label">ФИО</label>
                            <input type="text" v-model="customer.name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">EMAIL</label>
                            <input type="text" v-model="customer.email" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Phone</label>
                            <input type="text" v-model="customer.phone" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Описание</label>
                            <textarea  v-model="customer.description" class="form-control">
                            </textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <router-link to="/customers" class="btn btn-inverse">Назад</router-link><button class="btn btn-success">Сохранить</button>
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
    data: function () {
        return {
            customer: {
                name: '',
                email: '',
                phone: '',
            },
            errors: null,
        }
    },
    methods: {
        saveForm() {
            event.preventDefault();
            let app = this;
            let newProject = app.customer;
            axios.post('/api/v1/customers', newProject)
                .then(function (resp) {
                    app.$router.push({path: '/customers'});
                })
                .catch(e => {
                    logoutUnauth(app,e)
                    app.errors = e.response.data.errors;
                });
        }
    }
}
</script>
