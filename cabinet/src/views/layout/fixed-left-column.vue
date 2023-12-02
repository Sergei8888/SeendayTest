<template>
  <main class="main" data-fixed="fixed">
    <div>
      <slot name="fixed" />
    </div>
    <div>
      <slot />
    </div>
  </main>
</template>

<style lang="scss">
@import "~/assets/styles/components/main/main.scss";
</style>
