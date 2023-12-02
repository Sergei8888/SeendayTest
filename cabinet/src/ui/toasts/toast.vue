<template>
  <div v-if="toastsStore.toasts.length > 0" ref="toastContainer" class="notifications-center">
    <div class="notifications-center__head">
      <div>Центр уведомлений</div>
      <button class="notifications-center__close" @click="toastsStore.clearToasts">
        <i class="icon icon_small icon-times" />
      </button>
    </div>

    <ul class="notifications-center__list">
      <li v-for="toast in toastsStore.toasts" :key="toast.id" class="notifications-center__block">
        <div v-if="toast.type === 'error'" class="text-12 base-half-margin-bottom" style="color: #9292b4">
          Если проблема повторяется, обновите страницу.
        </div>

        <i v-if="toastIconMap[toast.type]" class="icon icon_small" :class="[toastIconMap[toast.type]]" />

        {{ toast.title }}
      </li>
    </ul>
  </div>
</template>

<script lang="ts" setup>
import { onClickOutside } from "@vueuse/core";

import { useToastStore } from "./store-toast";

const toastContainer = ref();

const toastsStore = useToastStore();

onClickOutside(toastContainer, () => toastsStore.clearToasts());

const toastIconMap = {
  error: "icon-exclamation-circle",
  success: "icon-check-circle",
  loading: "icon-hourglass-start",
  info: ""
};
</script>

<style lang="scss" scoped>
@import "~/assets/styles/components/_notification-center.scss";
</style>
