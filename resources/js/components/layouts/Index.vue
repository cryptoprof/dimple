<template>
    <div>
        <Sidebar
        :user="user"
        ></Sidebar>


        <div class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
            <TopNavigation></TopNavigation>
            <router-view></router-view>
            <CopyrightForTemplateDevelopers></CopyrightForTemplateDevelopers>
        </div>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
import {logoutUnauth} from "../../helpers/logout_unauth";
import Sidebar from "./navigation/Sidebar";
import TopNavigation from "./navigation/TopNavigation";
import CopyrightForTemplateDevelopers from "./CopyrightForTemplateDevelopers";
export default {
    name: "dashboard-layout",
    data() {
        return {
            token: this.$store.state.auth.token,
            user: this.$store.state.auth.user
        }
    },
    components:{
        CopyrightForTemplateDevelopers,
        TopNavigation,
        Sidebar
    },
    methods: {
        ...mapActions({
            signOut: "auth/logout"
        }),
        async logout() {
            await axios.post('api/logout', {'Accept': 'application/json'}).then(({data}) => {
                this.signOut()
                this.$router.push({path: 'login'})
            }).catch(e => {
                logoutUnauth(app, e)
                app.errors = e.response.data.errors;
            });
        }
    }
}
</script>
