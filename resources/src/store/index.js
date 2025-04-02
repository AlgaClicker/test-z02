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
        token: "",
        lastPage:""
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
        },
        getPage (state) {
            const page = localStorage.getItem('page');
            state.lastPage()
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

        setPage(page) {

            this.lastPage = page
            if (page !== "/login") {
                localStorage.setItem('page',page)
            }

        },

        loginOut() {
            localStorage.setItem('auth_token',"")
            this.isAuth = false
            this.token = null
        },
        getLastPage() {
            let page = localStorage.getItem('page');
            if (!page) {
                page = "/"
            }
            return page
        },
        async checkAuth()  {
            const token =  localStorage.getItem('auth_token');
            this.token = token

            if (token) {
               axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
               let account =  await axios.get('/api/me').then(function (response) {
                   }).catch(function (error) {
                      return false;
                   })

                if (account !== false) {
                    this.setAccount(account)
                    this.setToken(token)
                }
            }
        }

    }
})
