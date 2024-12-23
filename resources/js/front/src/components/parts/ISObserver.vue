<script setup lang="ts">
const ISObserver = new IntersectionObserver(function (e) {
  e.forEach(function (endpoint) {
    if (!endpoint.isIntersecting) {
      endpoint.target.classList.remove('upstyle');
    } else {
      endpoint.target.classList.add('upstyle');
    }
  });
}, {});
</script>

<template></template>

<style scoped></style>
