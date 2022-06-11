<template>
    <div>
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Изменить пользователя {{user.email}}</h3>
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
                            <input type="text" v-model="user.name" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Роль</label>
                            <select type="text" v-model="user.role" class="form-control">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Пароль</label>
                            <input type="password" v-model="user.password" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <router-link to="/users" class="btn btn-inverse">Назад</router-link><button class="btn btn-success">Сохранить</button>
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
        app.userId = id;
        axios.get('/api/v1/users/' + id)
            .then(function (resp) {
                app.user = resp.data;
            })
            .catch(function () {
                alert("Не удалось получить информацию о пользователе")
            });
    },
    data: function () {
        return {
            userId: null,
            errors: null,
            user: {
                name: '',
                password: '',
                role: ''
            },
            token:this.$store.state.auth.token,
        }
    },
    methods: {
        saveForm() {
            event.preventDefault();
            var app = this;
            var newUser = app.user;
            axios.patch('/api/v1/users/' + app.userId, newUser)
                .then(function (resp) {
                    app.$router.replace('/users');
                })
                .catch(e => {
                    logoutUnauth(app,e)
                    app.errors = e.response.data.errors;
                });
        }
    }
}
</script>
