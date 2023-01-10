<template>
    <div class="bg-gradient-to-tl px-4 text-xs rounded-1.8 py-2 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white" :class="statusClass">
        {{ status }}
    </div>
</template>

<script>
export default {
    name: 'StatusBadge',
    props: {
        status: {
            type: String,
            required: true,
        },
    },
    computed: {
        statusClass() {
            switch (this.status) {
                case 'Новая':
                    return 'from-gray-400 to-slate-800 text-gray';
                case 'В работе':
                    return 'from-blue-600 to-lime-400 text-white';
                case 'Завершена':
                    return 'from-green-600 to-lime-400 text-white';
                default:
                    return 'bg-red-500 text-white';
            }
        },
    },
};
</script>
