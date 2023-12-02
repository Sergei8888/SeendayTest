<template>
  <DefaultLayout>
    <main class="errors-page" :class="`errors-page_${errorCode}`">
      <div class="errors-page__inner" :class="`errors-${errorCode}`">
        <div class="errors-page__container" :class="`errors-${errorCode}__container`">
          <div class="errors-page__number">
            <div class="errors-page__number-text">
              {{ errorCode }}
              <img class="errors-page__number-img" src="/images/icons/error.svg" width="259" height="58" alt="" />
            </div>
          </div>

          <div v-if="errorCode === 404" class="errors-404-images">
            <div class="errors-404-images__item">
              <img src="/images/errors/img-1.png" width="339" height="241" alt="" />
            </div>
            <div class="errors-404-images__item">
              <img src="/images/errors/img-2.png" width="339" height="202" alt="" />
            </div>
            <div class="errors-404-images__item">
              <img src="/images/errors/img-3.png" width="339" height="241" alt="" />
            </div>
          </div>
        </div>
        <div :class="`errors-${errorCode}__img`">
          <img :src="`/lk/images/errors/${errorCode}.png`" :width="errorImg.width" :height="errorImg.height" />
        </div>
      </div>
    </main>
  </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "@/layouts/default.vue";

import "~/assets/styles/pages/errors/errors-page.scss";
import "~/assets/styles/pages/errors/404.scss";
import "~/assets/styles/pages/errors/403.scss";

useHead({
  bodyAttrs: {
    class: ["page-no-bg", "page-no-row-gap"]
  }
});

const props = defineProps({
  error: {
    type: Object,
    required: true
  }
});

const errorCode = ref(props.error.statusCode);

const errorImg = computed(() => {
  const errorMapSize = {
    403: {
      width: 685,
      height: 709
    },
    404: {
      width: 471,
      height: 444
    }
  };

  return errorMapSize[errorCode.value];
});
</script>

<style lang="scss">
.container {
  max-width: 91.875rem;
  width: 100%;
  margin-left: auto;
  margin-right: auto;
  padding-left: 0.9375rem;
  padding-right: 0.9375rem;
}
</style>
