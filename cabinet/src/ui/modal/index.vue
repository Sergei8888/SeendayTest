<template>
  <Teleport to="body">
    <div v-if="modelValue" class="modal-wrapper" data-show="1" role="dialog" aria-modal="true" @click="close">
      <div class="modal-overlay show" :style="{ zIndex: zIndex }">
        <div class="modal show" :data-position="position">
          <div class="modal__content block" :class="`modal__content_size_${size}`" role="document" @click.stop="">
            <div class="modal-header">
              <div v-if="hasTitle" :class="`modal-header__title text-${positionTitle}`">
                <slot name="title" />
              </div>

              <span class="modal-header__close" @click="close">
                <i class="far fa-xmark" />
              </span>

              <div v-if="subtitle" class="modal-header__subtitle text-center">
                {{ subtitle }}
              </div>
            </div>

            <div class="modal-body">
              <!-- eslint-disable vue/no-v-html -->
              <slot>
                <div v-html="content" />
              </slot>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Teleport>
</template>

<script>
export default {
  props: {
    modelValue: {
      type: Boolean,
      default: false
    },
    title: {
      type: String,
      default: ""
    },
    subtitle: {
      type: String,
      default: ""
    },

    content: {
      type: String,
      default: ""
    },
    position: {
      type: String,
      default: "center",
      validator(position) {
        return ["top", "center"].includes(position);
      }
    },
    positionTitle: {
      type: String,
      default: "left",
      validator(position) {
        return ["left", "center"].includes(position);
      }
    },
    size: {
      type: String,
      default: "default",
      validator(size) {
        return ["default", "small", "medium", "large"].includes(size);
      }
    },
    zIndex: {
      type: String,
      default: ""
    }
  },
  emits: ["update:model-value"],
  computed: {
    hasTitle() {
      return this.title || this.$slots.title;
    },
    styleZindex() {
      return this.zIndex ? `z-index: ${this.zIndex}` : "";
    }
  },
  watch: {
    modelValue(isActive) {
      if (!isActive) {
        this.close();
      }
    }
  },
  methods: {
    close() {
      this.$emit("update:model-value", false);
    }
  }
};
</script>

<style>
@import "~/../src/assets/styles/components/modal.scss";
</style>
