<template>
    <div class="w-full px-6 py-6 mx-auto">
        <!-- table 1 -->

        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div
                    class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6>
                            Управление задачами
                        </h6>

                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <tasks-list
                                @get_results="getResults"
                                :tasks="tasks"
                            ></tasks-list>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import {logoutUnauth} from "../../helpers/logout_unauth";
import LaravelVuePagination from 'laravel-vue-pagination';

export default {
    components: {
        'Pagination': LaravelVuePagination
    },
    mounted() {
        this.getResults()
    },
    data: function () {
        return {
            projectId: null,
            errors: null,
            tasks: {
                name: '',
                date_start: '',
                date_end: '',
                description: ''
            },
        }
    },
    methods: {
        getResults(page = 1) {
            let app = this;
            axios.get('/api/v1/tasks?page=' + page)
                .then(function (resp) {
                    app.tasks = resp.data;
                })
                .catch(function (resp) {
                    alert("Не удалось получить информацию о задачах")
                    logoutUnauth(app, resp)
                });
        }
    }
}
</script>
