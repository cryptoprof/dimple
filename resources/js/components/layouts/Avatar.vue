<template>
    <div :class="showFullName ? 'avatar full-name':'avatar'" :style="{ backgroundColor: avatarColor }" @mouseenter="showFullName = true" @mouseleave="showFullName = false">
        <template v-if="showFullName">
            <div class="full-name" :style="{ backgroundColor: avatarColor }">
                {{ name }}
            </div>
        </template>
        <template v-else>{{ initials }}</template>
    </div>
</template>

<script>
export default {
    name: 'Avatar',
    props: {
        name: {
            type: String,
            required: true,
        }
    },
    data() {
        return {
            showFullName: false,
        };
    },
    computed: {
        initials() {

            const name = this.name.split(' ')[0];
            const surname = this.name.split(' ')[1];
            return name.charAt(0) + surname.charAt(0);
        },
        avatarColor() {
            const name = this.name.split(' ')[0];
            const surname = this.name.split(' ')[1];
            const code = name.charCodeAt(0) + surname.charCodeAt(0);
            const color = Math.floor(code / 3);
            return `hsl(${color}, 50%, 50%)`;
        },
    },
};
</script>

<style>
.avatar {
    width: 25px;
    height: 25px;
    border-radius: 12.5px;
    text-align: center;
    font-size: 12px;
    line-height: 25px;
    color: white;
    position: relative;
}

.full-name {
    height: 25px;
    border-radius: 12.5px;
    text-align: center;
    font-size: 12px;
    /*line-height: 25px;*/
    color: white;
    position: relative;
    width: 100px;
    overflow: hidden;
    padding-left: 3px;
    text-overflow: ellipsis;
}
</style>
