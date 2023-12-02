<template>
  <Modal model-value position-title="center" size="small" @update:model-value="emit('close')">
    <template #title> Подтверждение действия </template>

    <div class="mt-24">
      <div class="text-center">{{ props.title }}</div>
      <div class="row center-xs mt-20">
        <div class="col-6 col-md-4">
          <Button color="green" width="full" @click="emit('submit')">Подтвердить</Button>
        </div>

        <div class="col-6 col-md-4">
          <Button color="gray" width="full" @click="emit('close')">Отмена</Button>
        </div>
      </div>
    </div>
  </Modal>
</template>

<script setup lang="ts">
import { Modal } from "~/ui/modal";
import { Button } from "~/ui/button";

const props = defineProps<{ title: string }>();
const emit = defineEmits<{ submit: []; close: [] }>();
</script>
