<template>
  <SelectRoot v-model="modelValue" :name="props.name" :required="props.required" :disabled="props.readonly">
    <SelectTrigger
      class="select-trigger"
      :class="[
        { 'select-trigger_readonly': props.readonly },
        props.theme !== 'default' && `select-trigger_${props.theme}`
      ]"
    >
      <span class="select-trigger__title">
        {{ currentItem?.title }}
      </span>

      <SelectIcon v-if="!props.readonly" as-child>
        <i class="icon icon-angle-down icon_small select-trigger__icon" />
      </SelectIcon>
    </SelectTrigger>

    <SelectPortal>
      <SelectContent position="popper" class="select-content" :side-offset="5" :side="props.side">
        <SelectViewport>
          <div v-if="props.description" class="select-content__description">{{ props.description }}</div>

          <SelectItem v-for="item in props.items" :key="item.value" :value="item.value" class="select-content__item">
            <div class="select-content__title">
              <span v-if="item.icon" class="select-content__title-icon"><i class="icon" :class="item.icon" /></span>
              <span class="select-content__title-text">{{ item.title }}</span>
            </div>

            <SelectItemIndicator as-child>
              <i class="icon icon_small icon-check" />
            </SelectItemIndicator>
          </SelectItem>
        </SelectViewport>
      </SelectContent>
    </SelectPortal>
  </SelectRoot>
</template>

<script lang="ts" setup>
import {
  SelectContent,
  SelectIcon,
  SelectItem,
  SelectItemIndicator,
  SelectPortal,
  SelectRoot,
  SelectTrigger,
  SelectViewport
} from "radix-vue";

import type { SelectItems } from "./types";

type Props = {
  // eslint-disable-next-line vue/require-default-prop
  description?: string;
  items: SelectItems;
  modelValue: string;
  side?: "top" | "bottom";
  name: string | undefined;
  required?: boolean;
  theme?: "default" | "solid";
  readonly?: boolean;
};

const emit = defineEmits(["update:modelValue"]);

const props = withDefaults(defineProps<Props>(), { side: "bottom", theme: "default" });

const modelValue = useVModel(props, "modelValue", emit);

const currentItem = computed(() => {
  return props.items.find(item => {
    return item.value === modelValue.value;
  });
});
</script>

<style lang="scss">
@import "~/assets/styles/components/select.scss";
</style>
