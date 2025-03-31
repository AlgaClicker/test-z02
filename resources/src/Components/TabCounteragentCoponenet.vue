<template>
    <table class="min-w-full divide-y divide-gray-200">
        <thead сlass="bg-gray-50">
        <tr>
            <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
                Контрагент
            </th>
            <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
                Инн
            </th>
            <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
                Огрн
            </th>
            <th
                scope="col"
                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
                Адрес
            </th>
        </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
        <tr v-for="counteragent in counteragents" :key="counteragent.id">
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">
                    {{ counteragent.name }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">
                    {{ counteragent.inn }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">
                    {{ counteragent.ogrn }}
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">
                    {{ counteragent.address }}
                </div>
            </td>
        </tr>
        </tbody>
    </table>

</template>
//

<script>
export default {
    props: {
        counteragents: Object,
        errors: Object,
    },
}
</script>
<style>
</style>
