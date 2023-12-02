<template>
  <tippy :content="props.content" :theme="props.theme" :trigger="props.trigger">
    <slot />
  </tippy>
</template>

<script setup lang="ts">
import "tippy.js/dist/tippy.css";
import { Tippy } from "vue-tippy";

import { themes } from "./types";

const props = defineProps({
content: {
    required: true,
    type: String
  },
  trigger: {
    required: false,
    type: String,
    default: "mouseenter focus"
  },
  theme: {
    required: false,
    type: String,
    validator(value: string) {
      return themes.includes(value);
    },
    default: "black"
  }
});
</script>

<style lang="scss">
@import "~/assets/styles/components/tippy-tooltip/tippy-tooltip.scss";
</style>
