<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <main>
        <header>
            <Link href="/">Home</Link>
            <Link href="/about">About</Link>

            <Link v-if="!isAuth" href="/login">Login</Link>
            <Link v-if="isAuth" href="/loginout">Login Out</Link>

        </header>
        <article>
            <slot />
        </article>
    </main>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            isAuth: false
        }
    },
    mounted() {
        let token =  localStorage.getItem('auth_token')
        this.isAuth = token
        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
        }
    }
}
</script>

