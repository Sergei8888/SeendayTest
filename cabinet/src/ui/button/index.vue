<template>
  <nuxt-link v-if="to" :class="rootClass" :to="to" :target="target" :data-color="color">
    <slot />
  </nuxt-link>

  <component :is="tagName" v-else-if="tagName" :class="rootClass" :data-color="color">
    <slot />
  </component>
</template>

<script setup>
const props = defineProps({
  tagName: {
    type: String,
    required: false,
    default: "button",
    validator: tagName => ["button", "label", "div"].includes(tagName)
  },

  to: {
    type: [String, Object],
    required: false,
    default: ""
  },

  target: {
    type: String,
    required: false,
    default: "_self",
    validator: target => ["_self", "_blank"].includes(target)
  },

  isIcon: {
    type: Boolean,
    required: false,
    default: false
  },

  mode: {
    type: String,
    required: false,
    default: "normal",
    validator(mode) {
      return ["normal", "icon", "text"].includes(mode);
    }
  },

  color: {
    type: String,
    required: false,
    default: "default",
    validator: color =>
      [
        "green",
        "purple",
        "gray",
        "light-purple",
        "light-purple-reverse",
        "red",
        "purple-reverse",
        "lightness-purple",
        "blue",
        "light-blue",
        "orange",
        "tinkoff",
        "heart",
        "gray-light"
      ].includes(color)
  },

  size: {
    type: String,
    required: false,
    default: "",
    validator: size => ["large", "medium", "x-small", "small"].includes(size)
  },

  width: {
    type: String,
    default: "inline",
    validator(width) {
      return ["inline", "full", "full-lg"].includes(width);
    }
  },
  isMulticolor: {
    type: Boolean,
    default: false
  }
});

const rootClass = computed(() => {
  let modeButton = "button";

  if (props.mode === "icon") {
    modeButton = "button-icon";
  } else if (props.mode === "text") {
    modeButton += `${modeButton} button-text`;
  }

  return [modeButton, { multicolor: props.isMulticolor }, `button_size_${props.size}`, `button_width_${props.width}`];
});
</script>

<style lang="scss">
@import "@/assets/styles/components/button/button";
@import "@/assets/styles/components/button/button-icon";
@import "@/assets/styles/components/button/data-color";
@import "@/assets/styles/components/button/data-size";
</style>
