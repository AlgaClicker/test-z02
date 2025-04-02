import { defineStore } from 'pinia'
import axios from 'axios'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        isAuth: false,
        account: {
            id: "",
            email: "",
            full_name: ""
        },
        token: ""
    }),
    getters: {
        getIsAuth (state)  {
            return state.isAuth
        },
        getName(state) {
            return state.full_name
        },
        getAccount (state) {
            return state.account
        }
    },
    actions: {
        setToken(token) {
            this.token = token
            localStorage.setItem('auth_token',token)
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            this.isAuth = true

        },
        setAccount(account) {
            this.account = account
        },
        loginOut() {
            localStorage.setItem('auth_token',"")
            this.isAuth = false
            this.token = null
        },
        checkAuth()  {
            const token =  localStorage.getItem('auth_token');
            if (token) {
               axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
               this.account =  axios.get('/api/me').then(function (response) {
                    return  response.data.data
                }).catch(function (error) {
                    console.log(error.message);

                   return false
                })
                if (this.account) {
                    this.isAuth = true
                } else {
                    this.isAuth = false
                }
            }
        }

    }
})
