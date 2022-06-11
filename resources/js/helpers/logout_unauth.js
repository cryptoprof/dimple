export function logoutUnauth(ctx,resp){
    if (resp.response.status === 401) {
        app.signOut()
        app.$router.push({ path: 'login' })
    }
}
