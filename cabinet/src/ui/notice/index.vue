<template>
  <div class="notice" :data-color="props.color">
    <slot />
  </div>
</template>

<script setup lang="ts">
const props = defineProps<{
  color?:
    | "yellow"
    | "gray"
    | "purple"
    | "light-purple"
    | "orange"
    | "red"
    | "black"
    | "light-blue"
    | "very-light-blue"
    | "green"
    | "white"
    | "tinkoff";
}>();
</script>

<style>
@import "~/assets/styles/components/notice/_notice.scss";
@import "~/assets/styles/components/notice/_data-color.scss";
</style>
