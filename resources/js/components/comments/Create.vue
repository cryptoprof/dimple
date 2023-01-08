<template>
    <form @submit.prevent="submit" class="comment-form">
        <textarea v-model="comment" class="bg-grey-lighter rounded leading-normal resize-none w-full h-10 py-2 px-3 mt-8" placeholder="комментарий"></textarea>
        <input type="file" ref="attachment" class="form-control mb-4">
        <button type="submit" class="border border-blue bg-slate-700 text-white hover:bg-blue-dark py-2 px-4 rounded tracking-wide mr-1">
            Отправить
        </button>
    </form>
</template>

<script>
export default {
    name: 'CreateComment',
    props: ['commentable', 'commentable_id'],
    data() {
        return {
            comment: '',
        };
    },
    methods: {
        async submit() {
            // Create a new FormData instance
            const formData = new FormData();

            // Add the comment and attachment to the form data
            formData.append('comment', this.comment);
            formData.append('attachment', this.$refs.attachment.files[0]);
            formData.append('commentable_type', this.commentable)
            formData.append('commentable_id', this.commentable_id)

            // Send a POST request to the server to create the comment
            const response = await axios.post('/api/v1/comments', formData);

            // Clear the form
            this.comment = '';
            this.$refs.attachment.value = '';

            // Emit an event to notify the parent component of the new comment
            this.$emit('comment-created', response.data);
        },
    },
};
</script>
