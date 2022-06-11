import store from "../store";

export function logoutUnauth(ctx,resp){
    if (resp.response.status === 401) {
        ctx.signOut()
        ctx.$router.push({ path: 'login' })
    }
}
