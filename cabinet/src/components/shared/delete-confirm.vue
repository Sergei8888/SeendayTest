<template>
  <Modal model-value position-title="center" size="small" @update:model-value="emit('close')">
    <template #title> Подтверждение удаления </template>

    <div class="mt-24">
      <div class="text-center">{{ props.title }}</div>

      <div class="row center-xs mt-20">
        <div class="col-6 col-md-4">
          <Button color="red" width="full" @click="emit('delete')">Удалить</Button>
        </div>

        <div class="col-6 col-md-4">
          <Button :color="gray" width="full" @click="emit('close')">Отмена</Button>
        </div>
      </div>
    </div>
  </Modal>
</template>

<script lang="ts" setup>
import { Button } from "~/ui/button";
import { Modal } from "~/ui/modal";

const props = defineProps<{ title: string }>();

const emit = defineEmits<{ delete: []; close: [] }>();
</script>
