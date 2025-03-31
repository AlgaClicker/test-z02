<script setup>
import Layout from '../Layout.vue'
import Table from '../Components/TabCounteragentCoponenet.vue'
</script>


<template>
    <Layout>




        <div class="rounded-lg m-5 shadow-sm border bg-white overflow-hidden">
            <!-- Заголовок карточки -->
            <div class="px-4 py-3 border-b flex items-center justify-between">
                <h2 class="text-lg font-semibold">Контаргенты</h2>
                    <button @click="openModal" class="px-3 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition">
                        Добавить контрагента
                    </button>
            </div>
            <!-- Содержимое карточки -->
            <div class="px-4 py-3 overflow-x-auto">

                    <Table :counteragents="counteragents"></Table>
            </div>
            <!-- Футер карточки с действием -->
            <div class="px-4 py-3 border-t flex justify-end">
                Записей: {{counteragents.length}}
            </div>
        </div>


        <div
            v-if="isOpen"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
        >
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="text-2xl font-bold mb-4">Добавить контрагента</h2>
                <form >
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium mb-1">
                            Название
                        </label>
                        <input
                            id="name"
                            type="text"
                            v-model="model.inn"
                            class="w-full border border-gray-300 rounded px-3 py-2"
                            placeholder="Введите ИНН"
                            required
                        />
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button
                            type="button"
                            @click="closeModal"
                            class="px-4 py-2 bg-gray-300 rounded"
                        >
                            Отмена
                        </button>
                        <button type="button"  @click="addInnCounteragent" class="px-4 py-2 bg-blue-500 text-white rounded">
                            Добавить
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Layout>
</template>
<script>
import {router, usePage} from "@inertiajs/vue3";

export default {
    props: {
        counteragents: Object,
        errors: Object,
    },
    data() {
        return {
            isOpen: false,
            model: {
                inn: ""
            }
        }
    },
    methods: {
        addInnCounteragent() {
            router.post('counteragents/add/inn',this.model)
            this.isOpen = false;
        },
        openModal() {
            this.isOpen = true;
        },
        closeModal() {
            this.isOpen = false;
        }
    }
}
</script>
<style scoped>

</style>
