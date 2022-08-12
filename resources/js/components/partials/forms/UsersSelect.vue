<template>
    <div>
        <input type="hidden" name="usersIds" v-model="getSelectedIds">
        <v-select multiple label="name"
                  :filterable="false"
                  :options="options"
                  @search="onSearch"
                  item-value="id" item-text="name"
                  v-model="selected">
            <template slot="no-options">
                Начните вводить ФИО пользователя для поиска..
            </template>
            <template slot="option" slot-scope="option">
                <div class="d-center">
    <!--                <img :src='option.owner.avatar_url'/>-->
                    {{ option.name }}
                </div>
            </template>
            <template slot="selected-option" slot-scope="option">
                <div class="selected d-center">
    <!--                <img :src='option.owner.avatar_url'/>-->
                    {{ option.name }}
                </div>
            </template>
        </v-select>
    </div>
</template>
<script>
export default {
    name: "dashboard-layout",
    data() {
        return{
            options: [],
            selected: [],
        }
    },
    methods: {
        onSearch(search, loading) {
            if(search.length) {
                loading(true);
                this.search(loading, search, this);
            }
        },
        search: _.debounce((loading, search, vm) => {
            axios.get(
                `/api/v1/users?search=${escape(search)}`
            ).then(res => {
                vm.options = res.data.data;
                loading(false);
            });
        }, 350)
    },
    computed: {

        getSelectedIds() {
            let usersIds=this.selected.map(function (item){
                return item.id;
            });
            this.$emit('usersIds',usersIds);
            return usersIds;
        }
    }
}
</script>
