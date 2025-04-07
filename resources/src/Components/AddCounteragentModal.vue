<script setup>
import Button from '@/Components/ui/button'
</script>
<template>
    <Modal :open="open" @close="closeModal">
      <ModalHeader>
        <h3 class="font-bold">Добавление контрагента</h3>
      </ModalHeader>
      <ModalContent>
        <p class="mb-4">Введите ИНН, чтобы добавить контрагента</p>
        <Input placeholder="ИНН" v-model="inn"/>
      </ModalContent>
      <ModalFooter>
        <Button @click="addAgent">Добавить</Button>
      </ModalFooter>
    </Modal>
</template>