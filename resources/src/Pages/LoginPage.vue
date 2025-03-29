<script setup>

import Layout from '@src/Layout.vue'
import { useForm } from '@inertiajs/vue3'
</script>

<template>
    <Layout>

        <div class="grid">

            <form  @submit.prevent="submit">
                <!-- email -->
                <input type="text" v-model="form.email">
                <div v-if="form.errors.email">{{ form.errors.email }}</div>
                <!-- password -->
                <input type="password" v-model="form.password">
                <div v-if="form.errors.password">{{ form.errors.password }}</div>
                <!-- remember me -->
                <input type="checkbox" v-model="form.remember"> Remember Me
                <!-- submit -->
                <button type="submit" class="btn bg-inherit" :disabled="form.processing">Login</button>
            </form>

        </div>

    </Layout>
</template>
<script>
import { router } from '@inertiajs/vue3'
export default {
    name: 'my-component',
    components: {
        router,
    },
    data () {
        return {
            form: {
                password: null,
                email: null,
                remember: false,
                processing: 0,
                errors: {
                    email:"",
                    password:""
                }
            }
        }
    },
    methods: {
        submit(e) {
            console.log("dfsdf")
            router.post('/users', form)

        }
    }
}
</script>
<style scoped>
/* Можно добавить стили для формы */
</style>
