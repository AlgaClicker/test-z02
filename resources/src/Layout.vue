<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <main>

        <header class="list-inside">

            <Link href="/">Home</Link> |
            <Link href="/about">About</Link> |
            <Link href="/login">login</Link> |
            <Link href="/register">register</Link> |
            <div>

            </div>
        </header>
        <article class="border-2 p-3">
            <slot />
        </article>
    </main>
</template>

