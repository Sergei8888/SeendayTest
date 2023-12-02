<template>
  <div class="topbar topbar--justify-end">
    <div class="topbar__id">
      <HeaderTopbarId />
    </div>

    <div class="topbar__balance">
      <HeaderTopbarBalance />
    </div>

    <div class="topbar__login">
      <HeaderTopbarLogin />
    </div>
  </div>
</template>

<script setup>
import HeaderTopbarId from "./user-id.vue";
import HeaderTopbarBalance from "./balance.vue";
import HeaderTopbarLogin from "./login.vue";
</script>

<style lang="scss">
@import "assets/styles/components/topbar/topbar";
@import "assets/styles/components/user-data/user-data";
@import "assets/styles/components/profile-menu/profile-menu";
</style>
