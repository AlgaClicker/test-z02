<script setup>
import Layout from '../Layout.vue'
</script>

<template>
    <Layout>
        <h1>About</h1>
        <p>Account: {{account}}</p>
    </Layout>
</template>

<script>
export default {
    props: {
        account: Object
    },
    name: "AboutPage"
}

</script>
