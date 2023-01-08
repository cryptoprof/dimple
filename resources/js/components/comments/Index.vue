<template>
    <div class="comments">
        <div v-for="comment in comments" :key="comment.id" class="comment p-4 mb-4 border-2 border-gray-400 rounded-lg">
            <div class="comment-user text-xl font-bold mb-2">{{ comment.user.name }}</div>
            <div class="comment-text text-lg mb-2">{{ comment.comment }}</div>
            <div class="comment-attachments mb-2">
                <a v-for="attachment in comment.attachments" :key="attachment.id" :href="attachment.path" class="comment-attachment text-blue-500 hover:text-blue-700" target="_blank">
                    {{ attachment.filename }}
                </a>
            </div>
            <div class="comment-date text-sm text-gray-600">{{ comment.created_at }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CommentsIndex',
    props: {
        comments: {
            type: Array,
            default: () => []
        },
    },
};
</script>
