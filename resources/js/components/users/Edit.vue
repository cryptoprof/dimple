<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-secondary">Назад</router-link>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Новый пользователь</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">ФИО</label>
                            <input type="text" v-model="user.name" class="form-control">
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
                            <input type="text" v-model="user.password" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Создать</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
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
            user: {
                name: '',
                password: '',
                email: '',
            }
        }
    },
    methods: {
        saveForm() {
            event.preventDefault();
            var app = this;
            var newUser = app.user;
            axios.patch('/api/v1/users/' + app.userId, newUser)
                .then(function (resp) {
                    app.$router.replace('/');
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Не удалось создать пользователя");
                });
        }
    }
}
</script>
