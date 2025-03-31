<script setup>
import Layout from '../Layout.vue'
</script>

<template>
    <Layout>
        <div class="min-h-screen w-full flex items-center justify-center bg-[#FAFAFA] p-16">
            <div class="w-[384px] bg-white shadow-xl rounded-md p-6 flex flex-col gap-6">
                <h2 class="text-[20px] font-semibold leading-[28px] text-[#030712]">
                    Регистрация
                </h2>
                <h3 v-if="account">
                    Аккаунт успешно создан
                    <a href="/login" class="underline hover:text-[#FF6E4E]">
                        Войти
                    </a>
                </h3>
                <div>

                </div>
                <form  class="flex flex-col gap-4">
                    <div class="flex flex-col gap-4" >
                        <!-- Email -->
                        <div>
                            <label class="block text-[14px] font-medium text-[#111827] mb-1">
                                Email
                            </label>
                            <input
                                type="email"
                                v-model="form.email"
                                class="block w-full h-10 px-3 border border-[#E4E4E7] rounded-md text-[14px] text-[#71717A] focus:outline-none focus:ring-2 focus:ring-orange-300"
                                placeholder="example@yandex.ru"
                            />
                            <div v-if="errors?.email">{{ errors.email }}</div>
                        </div>

                        <!-- Пароль -->
                        <div>
                            <label class="block text-[14px] font-medium text-[#111827] mb-1">
                                Пароль
                            </label>
                            <input
                                type="password"
                                v-model="form.password"
                                class="block w-full h-10 px-3 border border-[#E4E4E7] rounded-md text-[14px] text-[#71717A] focus:outline-none focus:ring-2 focus:ring-orange-300"
                                placeholder="Введите пароль"
                            />
                            <div v-if="errors?.password">{{ errors.password }}</div>
                        </div>

                        <!-- Подтверждение пароля (по желанию) -->
                        <div>
                            <label class="block text-[14px] font-medium text-[#111827] mb-1">
                                Подтвердите пароль
                            </label>
                            <input
                                type="password"
                                v-model="form.password_confirm"
                                class="block w-full h-10 px-3 border border-[#E4E4E7] rounded-md text-[14px] text-[#71717A] focus:outline-none focus:ring-2 focus:ring-orange-300"
                                placeholder="Повторите пароль"
                            />
                            <div v-if="errors?.password_confirm">{{ errors.password_confirm }}</div>
                        </div>
                    </div>

                    <button
                        type="button"
                        @click="submit"
                        class="w-full h-10 bg-[#FF6E4E] text-[#FAFAFA] rounded-md flex items-center justify-center text-[14px] font-medium hover:bg-[#ff5a39] transition-colors"
                    >
                        Создать аккаунт
                    </button>
                </form>
                <div class="flex flex-col items-center gap-4">
                    <div class="w-full h-px bg-[#E4E4E7]"></div>
                    <p class="text-[14px] leading-none text-[#111827]">
                        Уже есть аккаунт?
                        <a href="/login" class="underline hover:text-[#FF6E4E]">
                            Войти
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script>

import { router,usePage  } from '@inertiajs/vue3'
const page = usePage()

export default {
    components: {
        page
    },
    props: {
        account: Object ?? null,
        errors: Object,
        token: null,
        auth: "",
        can: ""
    },
    data() {
        return {
            form: {
                email: 'test@test.local',
                password: '',
                password_confirm: '',
                _token: page.props.csrf_token,
            },
        }
    },
    computed: {
    },
    mount() {
        console.log("mount register page")
    },
    methods: {
        async submit() {
            await router.post('/auth/register', this.form)
        }
    }
}
</script>

<style scoped>
/* Дополнительные стили можно добавить здесь */
</style>
