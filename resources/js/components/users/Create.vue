<template>
    <div>
        <div class="form-group">

        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Новый пользователь</h3>
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
                            <select type="text" v-model="user.role" class="form-control" placeholder="Выберите роль">
                                <option value="user" selected="selected">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Email</label>
                            <input type="text" v-model="user.email" class="form-control">
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
                            <router-link to="/users" class="btn btn-inverse">Отмена</router-link><button class="btn btn-success">Создать</button>
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
            user: {
                name: '',
                email: '',
                password: '',
                //Роль по умолчанию
                role: 'user'
            },
            errors: null,
            token:this.$store.state.auth.token,
        }
    },
    methods: {
        saveForm() {
            event.preventDefault();
            let app = this;
            let newUser = app.user;
            axios.post('/api/v1/users', newUser)
                .then(function (resp) {
                    app.$router.push({path: '/users'});
                })
                .catch(e => {
                    logoutUnauth(app,e)
                    app.errors = e.response.data.errors;
                });
        }
    }
}
</script>
