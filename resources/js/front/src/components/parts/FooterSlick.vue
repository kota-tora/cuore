<script setup lang="ts">
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';
</script>

<template>
  <carousel
    :items-to-show="3.5"
    :autoplay="1000"
    :wrap-around="true"
    :items-to-scroll="1"
    :transition="3000"
    :model-value="3"
    :pause-autoplay-on-hover="true"
  >
    <slide v-for="slide in 7" :key="slide">
      <figure><img :src="`images/IMG_${slide}.jpg`" alt="" /></figure>
    </slide>

    <template #addons>
      <navigation />
      <pagination />
    </template>
  </carousel>
</template>

<style scoped>
.carousel__slide {
  height: 200px;
  margin: 5px;
}
</style>
