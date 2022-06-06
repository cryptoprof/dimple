<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createUser'}" class="btn btn-success">Новый пользователь</router-link>
        </div>
        <section class="widget">
            <input type="text" v-model="search" @change="getResults" class="form-control width-initial" placeholder="Имя/Email...">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Email</th>
                        <th>Роль</th>
                        <th>Создан</th>
                        <th>Изменен</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user, index in users.data">
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                            <p v-for="role in user.UserRoles">
                                {{role}}
                            </p>
                        </td>
                        <td>{{ user.created_at }}</td>
                        <td>{{ user.updated_at }}</td>
                        <td>
                            <router-link :to="{name: 'editUser', params: {id: user.id}}" class="btn btn-success">
                                <i class="fa fa-edit"></i>
                            </router-link>
                            <a href="#"
                               class="btn btn-danger"
                               v-on:click="deleteEntry(user.id, index)">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            <Pagination :data="users" @pagination-change-page="getResults" />
        </section>
    </div>
</template>

<script>
import LaravelVuePagination from 'laravel-vue-pagination';
export default {
    components: {
        'Pagination': LaravelVuePagination
    },
    data: function () {
        return {
            users: [],
            token:this.$store.state.auth.token,
            search:''
        }
    },
    mounted() {
        this.getResults()
    },
    methods: {
        getResults(page = 1) {
            let app = this;
            axios.defaults.headers.common = {'Content-Type': 'application/json','Accept': 'application/json','Authorization': `Bearer ${this.token}`}
            axios.get('/api/v1/users?page='+page+'&search='+this.search)
                .then(function (resp) {
                    app.users = resp.data;
                })
                .catch(function (resp) {
                    alert("Не удалось подгрузить пользователей");
                });
        },
        deleteEntry(id, index) {
            if (confirm("Вы уверены что хотите удалить пользователя?")) {
                var app = this;
                axios.delete('/api/v1/users/' + id)
                    .then(function (resp) {
                        app.users.splice(index, 1);
                    })
                    .catch(function (resp) {
                        alert("Could not delete company");
                    });
            }
        }
    }
}
</script>
