<script setup lang="ts">
import Menu from '../components/parts/Menu.vue';
import { ref } from 'vue';
import RecruitForm from '../components/parts/recruit/RecruitForm.vue';
const isOpenMenu = ref(false);
</script>

<template>
  <div id="container">
    <main>
      <section>
        <h2>Recruit<span>メンバー募集</span></h2>
        <RecruitForm></RecruitForm>
      </section>
    </main>

    <Menu :is-show="isOpenMenu"></Menu>

    <!--メニュー開閉用のスクリプト-->
    <div id="menubar_hdr" :class="{ close: isOpenMenu }" @click="isOpenMenu = !isOpenMenu"></div>
    <!--ページの上部へ戻るボタン-->
    <!--    <p class="pagetop"><a href="#">↑</a></p>-->
    <!-- ロゴアニメーション（vivus） -->

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
