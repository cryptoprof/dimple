<template>
    <div class="px-2 py-1 rounded-full text-xs font-medium leading-4 whitespace-no-wrap w-auto inline-block" :class="badgeClass">
        {{ daysToDeadline }} дн.
    </div>
</template>

<script>
export default {
    name: 'DeadlineBadge',
    props: {
        deadline: {
            type: Number,
            required: true,
        },
    },
    computed: {
        daysToDeadline() {
            const now = new Date();
            const deadline = new Date(this.deadline);
            const diff = deadline.getTime() - now.getTime();
            return Math.ceil(diff / (1000 * 60 * 60 * 24));
        },
        badgeClass() {
            if (this.daysToDeadline > 7) {
                return 'bg-green-500 text-white';
            } else if (this.daysToDeadline > 0) {
                return 'bg-yellow-500 text-black';
            } else {
                return 'bg-red-500 text-white';
            }
        },
    },
};
</script>
