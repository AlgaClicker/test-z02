<script setup>
import Layout from '../Layout.vue'
</script>
<template>
    <Layout>
        <Deferred data="permissions">
            <template #fallback>
            </template>

            <div v-for="permission in permissions">
                <!-- ... -->
                <span>{{permission}}</span>
            </div>
        </Deferred>
        <!-- Основной контейнер для страницы авторизации -->
        <div class="min-h-screen w-full flex items-center justify-center bg-[#FAFAFA] p-16">
            <!-- Карточка формы -->
            <div class="w-[384px] bg-white shadow-xl rounded-md p-6 flex flex-col gap-6">
                <!-- Заголовок карточки -->
                <h2 class="text-[20px] font-semibold leading-[28px] text-[#030712]">
                    Вход в аккаунт
                </h2>

                <!-- Форма авторизации -->
                <form @submit.prevent="submit" class="flex flex-col gap-4">
                    <!-- Поле ввода email -->
                    <div class="flex flex-col">
                        <label for="email" class="text-[14px] font-medium text-[#111827] mb-1">
                            Email
                        </label>
                        <input
                            id="email"
                            type="email"
                            v-model="form.email"
                            placeholder="example@yandex.ru"
                            required
                            class="h-10 px-3 border border-[#E4E4E7] rounded-md text-[14px] text-[#71717A] focus:outline-none focus:ring-2 focus:ring-orange-300"
                        />
                    </div>
                    <!-- Поле ввода пароля -->
                    <div class="flex flex-col">
                        <label for="password" class="text-[14px] font-medium text-[#111827] mb-1">
                            Пароль
                        </label>
                        <input
                            id="password"
                            type="password"
                            v-model="form.password"
                            placeholder="Введите пароль"
                            required
                            class="h-10 px-3 border border-[#E4E4E7] rounded-md text-[14px] text-[#71717A] focus:outline-none focus:ring-2 focus:ring-orange-300"
                        />
                    </div>
                    <!-- Кнопка входа -->
                    <button
                        type="submit"
                        class="w-full h-10 bg-[#FF6E4E] text-[#FAFAFA] rounded-md flex items-center justify-center text-[14px] font-medium hover:bg-[#ff5a39] transition-colors"
                    >
                        Войти
                    </button>
                </form>

                <!-- Разделитель и ссылка на регистрацию -->
                <div class="flex flex-col items-center gap-4">
                    <div class="w-full h-px bg-[#E4E4E7]"></div>
                    <p class="text-[14px] leading-none text-[#111827]">
                        Нет аккаунта?
                        <a href="/auth/register" class="underline hover:text-[#FF6E4E]">Зарегистрироваться</a>
                    </p>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>
import {router, usePage, Deferred} from "@inertiajs/vue3";
import { mapState, mapActions } from 'pinia'
import { useAuthStore } from './../store/';

import axios from 'axios'
const page = usePage()

export default {
    props: {
      account: Object,
      token: null,
      isAuth: "",
      can: ""
    },
    data() {
        return {
            form: {
                token: page.props?.csrf_token,
                password: 'test@test.local',
                email: 'test@test.local',
            }
        }
    },
    async mounted() {
        await this.checkAuth()
        if (this.getIsAuth === true) {
              router.get(this.getLastPage())
        }


    },
    created() {

    },
    computed: {
        ...mapState(useAuthStore, ['getAccount','getIsAuth']),
    },
    methods: {
        ...mapActions(useAuthStore, ['setToken','setAccount','checkAuth','getLastPage']),
      async submit()  {
          await router.post('/login', this.form, {
              // Используем onSuccess для обработки ответа
              onSuccess: (page) => {
                  this.setToken(page.props.auth);
                  this.setAccount(page.props.account)
                  if (page.props.auth) {
                      router.get("/home")
                  }
              },
              onError: (errors) => {
                  // Обработка ошибок, если необходимо
                  console.error('Ошибка авторизации', errors);
              },
          });
      }
    },

};

</script>
<style scoped>
/* Дополнительные стили можно добавить здесь */
</style>
