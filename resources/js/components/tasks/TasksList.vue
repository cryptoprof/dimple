<template>
    <div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Задача</th>
            <th>Создана</th>
            <th>Ответственные</th>
            <th>Deadline</th>
            <th>Статус</th>
            <th width="100">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="task, index in tasks.data">
            <td>{{ task.name }}</td>
            <td>{{ task.created_at }}</td>
            <td>
                <ul v-if="task.assignees.length>0">
                    <li v-for="assignees, index in task.assignees">
                        {{assignees.name}}
                    </li>
                </ul>
                <span v-else>Не назначено ответственных</span>
            </td>
            <td>{{ task.deadline }}</td>
            <td>{{ task.status }}</td>
            <td>

            </td>
        </tr>
        </tbody>
    </table>
    <Pagination :data="tasks.data" @pagination-change-page="getResults" />
    </div>
</template>
<script>
    export default {
        name: "tasks-list",
        props: ['tasks','getResults'],
        methods:{
            getResults(page=1){
                this.$emit('get_results');
            }
        }
    }
</script>
