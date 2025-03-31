<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <main>
        <header>
            <Link href="/">Home</Link>
            <Link href="/about">About</Link>

            <Link v-if="!isAuth" href="/login">Login</Link>
            <Link v-if="isAuth" href="#" @click="loginout">Login Out</Link>
            <div v-if="account">
                {{account}}
            </div>
            <div>Token: {{isAuth}}</div>
        </header>
        <article>
            <slot />
        </article>
    </main>
</template>

<script>
import axios from 'axios'
import {router} from "@inertiajs/vue3";
export default {
    props: {
        account: Object
    },
    data() {
        return {
            isAuth: false
        }
    },
    methods: {
        loginout() {
            localStorage.setItem('auth_token',"")
            router.get("/")
        },

    },
    mounted() {
        console.log("Layout.vue")
        let token =  localStorage.getItem('auth_token')
        this.isAuth = token
        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
            console.log("Layout",token);


        }
    }
}
</script>

