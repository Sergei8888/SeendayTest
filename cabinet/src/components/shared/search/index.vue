<template>
  <form class="search" @submit.prevent="emit('submit')">
    <div class="search__data">
      <div class="search__select-trigger">
        <Select v-model="type" :items="selectItems" name="searchBy" theme="solid" />
      </div>

      <div class="search__input-wrapper">
        <input v-model="searchQuery" class="search__input" :placeholder="props.types[type].placeholder" />
        <button v-if="searchQuery" type="button" class="search__clear" @click="handleClearClicked">
          <i class="icon icon-xmark" />
        </button>
      </div>
    </div>

    <button type="submit" class="search__submit">
      <i class="icon icon-search" />
    </button>
  </form>
</template>

<script lang="ts" setup>
import { Select } from "~/ui/select";
import type { SelectItems } from "~/ui/select/types";

import type { SearchTypes } from "./type";

type Props = {
  searchQuery: string;
  types: SearchTypes;
  type: keyof SearchTypes;
};

const props = defineProps<Props>();

const emit = defineEmits(["update:searchQuery", "update:type", "submit"]);

const searchQuery = useVModel(props, "searchQuery", emit);
const type = useVModel(props, "type", emit);

const handleClearClicked = () => {
  searchQuery.value = "";
};

const selectItems: Ref<SelectItems> = computed(() => {
  return Object.keys(props.types).map(type => {
    return { value: type, title: props.types[type].title };
  });
});
</script>

<style lang="scss">
@import "~/assets/styles/components/search.scss";
</style>
