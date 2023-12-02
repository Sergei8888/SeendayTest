<template>
  <div class="block status-card" :data-status="props.status">
    <slot />
  </div>
</template>

<script setup lang="ts">
const props = defineProps({
  status: {
    type: String,
    validator(value: string) {
      return ["green", "", "light-purple", "primary", "red", "blue"].includes(value);
    },
    required: false,
    default: ""
  }
});
</script>

<style>
@import "~/assets/styles/components/status-card.scss";
</style>
