<script setup lang="ts">
import Menu from '../components/parts/Menu.vue';
import { ref } from 'vue';
const isOpenMenu = ref(false);
import BaseForm from '../components/parts/BaseForm.vue';
import Header from '../components/parts/Header.vue';

let caption = ref('お問合せ内容を記入してください');
</script>

<template>
  <Header></Header>
  <div id="container">
    <main>
      <section>
        <h3>Contact<span>お問い合わせ</span></h3>
        <BaseForm
          :show-category="true"
          :caption="caption"
          :post-url="'api/contact'"
          @set-caption="(str :string) => caption = str"
        >
        </BaseForm>
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
