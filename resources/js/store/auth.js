import axios from 'axios'
import router from '../router'

export default {
    namespaced: true,
    state:{
        authenticated:false,
        token:{}
    },
    getters:{
        authenticated(state){
            return state.authenticated
        },
        token(state){
            return state.token
        }
    },
    mutations:{
        SET_AUTHENTICATED (state, value) {
            state.authenticated = value
            console.log('NEW STATE',state.authenticated)
        },
        SET_TOKEN (state, value) {
            state.token = value
        }
    },
    actions:{
        login({commit},token){
            commit('SET_TOKEN',token)
            commit('SET_AUTHENTICATED',true);
            router.push({name:'dashboard'});
        },
        logout({commit}){
            commit('SET_TOKEN',{})
            commit('SET_AUTHENTICATED',false)
        }
    }
}
