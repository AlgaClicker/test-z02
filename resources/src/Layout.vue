<script setup>
import { Link } from '@inertiajs/vue3'
import axios from "axios";




</script>

<template>
    <main>
        <header>
            <nav class="navigation-menu">
                <ul class="menu-list">
                    <!-- Перебор пунктов меню -->
                    <li v-for="link in linksItems"  :key="link.name" class="menu-item">
                        <!-- Кнопка-триггер для показа выпадающего меню -->

                        <Link :href="link.href" v-show="link.isAuth === isAuth">

                            <button v-show="!link.submit"   class="menu-trigger">  {{ link.text }} {{link.show }}</button>
                            <button  v-show="link.submit" @click="link.submit" class="menu-trigger">  {{ link.text }}</button>
                        </Link>

                        <!-- Выпадающее меню (если оно открыто) -->
                    </li>
                </ul>
            </nav>

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
            linksItems : [
                {
                    name: "home",
                    text:"Главная",
                    href: '/',
                    isAuth: true
                },
                {
                    name: "about",
                    text:"Описание",
                    href: 'about/',
                    isAuth: true
                },
                {
                    name: "counteragents",
                    text:"Контрагенты",
                    href: '/counteragents',
                    isAuth: true
                },
                {
                    name: "info",
                    text:"Инфо PHP",
                    href: '/info',
                    isAuth: true
                },
                {
                    name: "login",
                    text:"Вход",
                    href: '/login',
                    isAuth: false
                },
                {
                    name: "loginout",
                    text:"Завершить сеанс",
                    href: '/loginout',
                    isAuth: true,
                    submit: this.loginout
                },

            ],
        }
    },
    methods: {
        loginout() {
            console.log("loginout")
            localStorage.setItem('auth_token',"")
            router.get("/")
        },
        toggleDropdown(item) {
            // Закрываем все открытые меню, если нужно (опционально)

            // Переключаем текущее меню
            item.showDropdown = !item.showDropdown;
        },
    },
    computed: {
        isAuth: () =>  {
            console.log("isauth",localStorage.getItem('auth_token') ? true : false)
            return localStorage.getItem('auth_token') ? true : false
        }
    },
    mounted() {
        console.log("Layout.vue")
    }

}
</script>

<style scoped>
.navigation-menu {
    /* Стилизация основного контейнера */
}

.menu-list {
    display: flex;
    list-style: none;
    gap: 1rem;
    padding: 0;
}

.menu-item {
    position: relative;
}

.menu-trigger {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1rem;
}

.menu-content {
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    border: 1px solid #ddd;
    padding: 0.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    z-index: 10;
}

.menu-link {
    display: block;
    padding: 0.25rem 0.5rem;
    text-decoration: none;
    color: inherit;
}

.menu-link:hover {
    background-color: #f0f0f0;
}
</style>
