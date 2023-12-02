<template>
  <div class="navbar">
    <div class="navbar__inner">
      <div class="navbar__user">
        <NavbarUser />
      </div>

      <Nav />
    </div>
  </div>
</template>

<script setup>
import Nav from "@/components/nav";

import NavbarUser from "./user/user.vue";
</script>

<style lang="scss">
@import "assets/styles/components/navbar/navbar";
</style>
