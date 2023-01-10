<template>
    <div>
    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
        <thead class="align-bottom">
        <tr>
            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                {{$t('task')}}
            </th>
            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                {{ $t('task_creation_time') }}</th>
            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                {{ $t('responsible') }}
            </th>
            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                {{ $t('relations') }}
            </th>
            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Deadline</th>
            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Статус</th>
            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="task, index in tasks.data">
            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                <p class="px-4 mb-0 font-semibold leading-normal text-sm">{{ task.name }}</p>
            </td>
            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-sm">{{ task.created_at }}</td>
            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-center">
                <div class="avatar-container text-cente" v-if="task.assignees.length>0">
                    <span v-for="assignees, index in task.assignees">
                        <avatar :name="assignees.name"></avatar>
                    </span>
                </div>
                <span v-else>{{$t('no_responsibles')}}</span>
            </td>
            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-center">
                <div class="text-center" v-if="task.project">
                    <div class="px-2 py-1 rounded-full text-xs font-medium leading-4 whitespace-no-wrap w-auto inline-block bg-gray-500 text-white">
                        <router-link :to="{name: 'showProject', params: {id: task.project.id}}">
                            {{ $t('project') }}: {{task.project.name}}
                        </router-link>
                    </div>
                </div>
                <div class="text-center" v-else-if="task.customer">
                    <p>{{ $t('client') }}: {{task.customers.name}}</p>
                </div>
                <span v-else>-</span>
            </td>
            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-center">
                <deadline-badge :deadline="Date.parse(task.deadline)" />
            </td>
            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                <status-badge :status="task.status"></status-badge>
            </td>
            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">

            </td>
        </tr>
        </tbody>
    </table>
    <Pagination :data="tasks.data" @pagination-change-page="getResults" />
    </div>
</template>
<script>
    import StatusBadge from "../layouts/partials/StatusBadge.vue";
    import DeadlineBadge from "../layouts/partials/DeadlineBadge.vue";
    export default {
        name: "tasks-list",
        components: {DeadlineBadge, StatusBadge},
        props: ['tasks','getResults'],
        methods:{
            getResults(page=1){
                this.$emit('get_results');
            }
        }
    }
</script>
<style>
.avatar-container {
    /*overflow-x: auto;*/
    white-space: nowrap;
    display: flex;
    align-items: center;
    margin: auto;
    width: 100px;
}
.avatar {
    /* other styles */
    margin-right: -8px; /* this will overlap the avatars by half their width */
}
</style>
