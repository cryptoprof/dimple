<template>
    <div>
        <div class="card-header">
            <h3>Dashboard</h3>
        </div>
        <div class="card-body">
            <p class="mb-0">You are logged in</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "dashboard",
    data() {
        return {
            user: this.$store.state.auth.token
        }
    }
}
</script>
