<script setup>
import Layout from '../Layout.vue'
</script>

<template>
    <Layout></Layout>
</template>

<script>
import axios from "axios";
import { router, usePage } from '@inertiajs/vue3'
export default {
    props: {
        account: Object,
    },
    computed: {},
    mounted() {
        localStorage.setItem('auth_token','');
        // Устанавливаем заголовок для Axios
        axios.defaults.headers.common['Authorization'] = null;
        router.get('/');
    }
}
</script>
