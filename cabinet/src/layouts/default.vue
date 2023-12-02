<template>
  <div id="app">
    <div class="layout">
      <Toast />

      <Header />

      <Navbar />

      <div class="content">
        <slot />

        <Footer />
      </div>
    </div>
  </div>
</template>

<script setup>
import { Toast } from "~/ui/toasts";

import Header from "@/components/header";
import Navbar from "@/components/navbar";
import Footer from "@/components/footer";
</script>

<style lang="scss">
@import "assets/styles/components/layout";
@import "assets/styles/components/content/content";
</style>
