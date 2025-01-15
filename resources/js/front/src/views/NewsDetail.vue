<script setup lang="ts">
import Menu from '../components/parts/Menu.vue';
import { onMounted, ref } from 'vue';
import { newsStore } from '../store/News';
import { useRoute } from 'vue-router';
import { inject } from 'vue';
import Header from '../components/parts/Header.vue';
const dayjs = inject('dayjs');

const isOpenMenu = ref(false);
const newsDetail = ref({
  newsId: 0,
  title: '',
  content: '',
  upDateTime: null,
  createdAt: null,
});
const news = newsStore();
const route = useRoute();

onMounted(async () => {
  await news.fetchById(route.params.newsId);
  newsDetail.value = news.detailNews;
});
</script>

<template>
  <Header></Header>
  <div id="container">
    <main>
      <section>
        <div v-if="newsDetail.title">
          <h3>News<span>ニュース</span></h3>

          <h4 class="center">{{ newsDetail.title }}</h4>

          <p v-html="newsDetail.content"></p>
          
          <br />
          <p>{{ dayjs(newsDetail.upDateTime).format('YYYY年M月DD日') }}</p>
        </div>
        <div>
          <router-link :to="{name: 'newsList'}">一覧へ</router-link>
        </div>
        <a></a>
      </section>
    </main>

    <Menu :is-show="isOpenMenu"></Menu>

    <!--メニュー開閉用のスクリプト-->
    <div id="menubar_hdr" :class="{ close: isOpenMenu }" @click="isOpenMenu = !isOpenMenu"></div>
    <footer>
      <ul class="icon">
        <li>
          <a href="#"><img :src="`/images/icon_facebook.png`" alt="Facebook" /></a>
        </li>
        <li>
          <a href="#"><img :src="`/images/icon_twitter.png`" alt="Twitter" /></a>
        </li>
        <li>
          <a href="#"><img :src="`/images/icon_instagram.png`" alt="Instagram" /></a>
        </li>
        <li>
          <a href="#"><img :src="`/images/icon_youtube.png`" alt="YouTube" /></a>
        </li>
        <li>
          <a href="#"><img :src="`/images/icon_line.png`" alt="LINE" /></a>
        </li>
      </ul>
      <small>Copyright&copy; <a href="index.html">Sample Cafe</a> All Rights Reserved.</small>
      <span class="pr"><a href="https://template-party.com/" target="_blank">《Web Design:Template-Party》</a></span>
    </footer>
  </div>
</template>

<style scoped>
  h4.center {
    text-align: center;
  }
</style>
