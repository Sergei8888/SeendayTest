<template>
  <div class="ui-spinner-loader" :class="[size === 'default' ? '' : size, position]">
    <span />
  </div>
</template>

<script>
export default {
  props: {
    size: {
      default: "default",
      validator(size) {
        return ["small", "large", "default"].includes(size);
      }
    },
    position: {
      default: "center",
      validator(position) {
        return ["top", "center", "bottom"].includes(position);
      }
    }
  }
};
</script>

<style lang="scss">
@import "~/assets/styles/components/spinner-loader.scss";
</style>
