<script setup>
import Layout from '../Layout.vue'
import { Head } from '@inertiajs/vue3'

//import  Button  from '@components/ui/button.tsx'
//import  Card  from '@components/components/ui/card.tsx'

</script>

<template>
    <Head>
        <title>About page</title>
        <meta name="description" content="About page description">
    </Head>
    <Layout>
        <hr>
        <h1>Abounbt</h1>
        <button class="text-white px-4 sm:px-8 py-2 sm:py-3 bg-sky-700 hover:bg-sky-800">Submit</button>

        <Button class="border-2">Нажми меня</Button>
        <p>Hello , welcome to your first Inertia app!</p>
        <Card>
            <CardHeader>
                <CardTitle>Card Title</CardTitle>
                <CardDescription>Card Description</CardDescription>
            </CardHeader>
            <CardContent>
                <p>Card Content</p>
            </CardContent>
            <CardFooter>
                <p>Card Footer</p>
            </CardFooter>
        </Card>
    </Layout>
</template>

<style scoped>

</style>
