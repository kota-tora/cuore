<script setup lang="ts">
import { onMounted, ref } from 'vue';
import Menu from '../components/parts/Menu.vue';
import { IObserver } from '../utils/IObserver';
import GalleryList from '../components/parts/gallery/GalleryList.vue';
import Header from '../components/parts/Header.vue';

const isOpenMenu = ref(false);
// const figure = ref();
const txtMenu = ref();

onMounted(() => {
  // const figureDom = figure.value;
  // const textMenuDom = txtMenu.value;
  // IObserver.observe(figureDom);
  // IObserver.observe(textMenuDom);
});
</script>

<template>
  <div id="container">
<!--    <header>-->
<!--      <h1 id="logo">-->
<!--        <a href="index.html"><img :src="`images/logo.png`" alt="Sample Cafe" /></a>-->
<!--      </h1>-->
<!--    </header>-->
    
    <Header></Header>
    <main>
      <section>
        <h3>Gallery<span>ギャラリー</span></h3>
        
        <GalleryList></GalleryList>

<!--        <div ref="figure" class="list-container up">-->
<!--          <div class="list">-->
<!--            <figure><img :src="`images/sample1.jpg`" alt="" /></figure>-->
<!--            <h4>メニュータイトル</h4>-->
<!--            <p>1,000yen</p>-->
<!--          </div>-->

<!--          <div class="list">-->
<!--            <figure><img :src="`images/sample1.jpg`" alt="" /></figure>-->
<!--            <h4>メニュータイトル</h4>-->
<!--            <p>1,000yen</p>-->
<!--          </div>-->

<!--          <div class="list">-->
<!--            <figure><img :src="`images/sample1.jpg`" alt="" /></figure>-->
<!--            <h4>メニュータイトル</h4>-->
<!--            <p>1,000yen</p>-->
<!--          </div>-->

<!--          <div class="list">-->
<!--            <figure><img :src="`images/sample1.jpg`" alt="" /></figure>-->
<!--            <h4>メニュータイトル</h4>-->
<!--            <p>1,000yen</p>-->
<!--          </div>-->

<!--          <div class="list">-->
<!--            <figure><img :src="`images/sample1.jpg`" alt="" /></figure>-->
<!--            <h4>メニュータイトル</h4>-->
<!--            <p>1,000yen</p>-->
<!--          </div>-->

<!--          <div class="list">-->
<!--            <figure><img :src="`images/sample1.jpg`" alt="" /></figure>-->
<!--            <h4>メニュータイトル</h4>-->
<!--            <p>1,000yen</p>-->
<!--          </div>-->

<!--          <div class="list">-->
<!--            <figure><img :src="`images/sample1.jpg`" alt="" /></figure>-->
<!--            <h4>メニュータイトル</h4>-->
<!--            <p>1,000yen</p>-->
<!--          </div>-->

<!--          <div class="list">-->
<!--            <figure><img :src="`images/sample1.jpg`" alt="" /></figure>-->
<!--            <h4>メニュータイトル</h4>-->
<!--            <p>1,000yen</p>-->
<!--          </div>-->
<!--        </div>-->
        <!--/.list-container-->
      </section>

<!--      <section>-->
<!--        <h2>Text Menu<span>テキストタイプのメニュー</span></h2>-->

<!--        <dl ref="txtMenu" class="textmenu up">-->
<!--          <dt>メニュータイトル</dt>-->
<!--          <dd>1,000yen</dd>-->
<!--          <dt>メニュータイトル</dt>-->
<!--          <dd>1,000yen</dd>-->
<!--          <dt>メニュータイトル</dt>-->
<!--          <dd>1,000yen</dd>-->
<!--          <dt>メニュータイトル</dt>-->
<!--          <dd>1,000yen</dd>-->
<!--          <dt>メニュータイトル</dt>-->
<!--          <dd>1,000yen</dd>-->
<!--          <dt>メニュータイトル</dt>-->
<!--          <dd>1,000yen</dd>-->
<!--          <dt>メニュータイトル</dt>-->
<!--          <dd>1,000yen</dd>-->
<!--        </dl>-->
<!--      </section>-->
    </main>

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
  <!--/#container-->

  <!--メインメニュー-->
  <Menu :is-show="isOpenMenu"></Menu>

  <!--jQueryファイルの読み込み-->
  <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->

  <!--パララックス（inview）-->
  <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/protonet-jquery.inview/1.1.2/jquery.inview.min.js"></script>-->
  <!--  <script src="js/jquery.inview_set.js"></script>-->

  <!--メニュー開閉用のスクリプト-->
  <div id="menubar_hdr" :class="{ close: isOpenMenu }" @click="isOpenMenu = !isOpenMenu"></div>

  <!--ページの上部へ戻るボタン-->
  <p class="pagetop"><a href="#">↑</a></p>
</template>

<style scoped></style>
