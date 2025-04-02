<script setup>
import Layout from '../Layout.vue'
</script>

<template>
    <Layout></Layout>
</template>

<script>
import axios from "axios";
import { router, usePage } from '@inertiajs/vue3'
import { useAuthStore } from './../store/';
import { mapState, mapActions } from 'pinia'
export default {
    props: {
        account: Object,
    },
    computed: {
        ...mapState(useAuthStore, ['getAccount','getIsAuth']),
    },
    methods: {
        ...mapActions(useAuthStore, ['setToken','setAccount','checkAuth','loginOut']),
    },

    mounted() {
        this.loginOut()
         if (this.getIsAuth !== true) {
             router.get('/login');
         }

    }
}
</script>
