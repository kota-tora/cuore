<script setup lang="ts">
import Menu from '../components/parts/Menu.vue';
import { ref } from 'vue';
const isOpenMenu = ref(false);
import News from '../components/parts/home/News.vue';
import Header from '../components/parts/Header.vue';
</script>

<template>
  <Header></Header>
  <div id="container">
    <main>
      <section>
        <News :is-show-list-link="false"></News>
      </section>
    </main>

    <Menu :is-show="isOpenMenu"></Menu>

    <!--メニュー開閉用のスクリプト-->
    <div id="menubar_hdr" :class="{ close: isOpenMenu }" @click="isOpenMenu = !isOpenMenu"></div>
    <footer>
      <ul class="icon">
        <li>
          <a href="#"><img :src="`images/icon_facebook.png`" alt="Facebook" /></a>
        </li>
        <li>
          <a href="#"><img :src="`images/icon_twitter.png`" alt="Twitter" /></a>
        </li>
        <li>
          <a href="#"><img :src="`images/icon_instagram.png`" alt="Instagram" /></a>
        </li>
        <li>
          <a href="#"><img :src="`images/icon_youtube.png`" alt="YouTube" /></a>
        </li>
        <li>
          <a href="#"><img :src="`images/icon_line.png`" alt="LINE" /></a>
        </li>
      </ul>
      <small>Copyright&copy; <a href="index.html">Sample Cafe</a> All Rights Reserved.</small>
      <span class="pr"><a href="https://template-party.com/" target="_blank">《Web Design:Template-Party》</a></span>
    </footer>
  </div>
</template>

<style scoped></style>
