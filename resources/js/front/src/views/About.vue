<script setup lang="ts">
import Menu from '../components/parts/Menu.vue';
import { ref } from 'vue';
import Header from '../components/parts/Header.vue';

const isOpenMenu = ref(false);
</script>

<template>
  <Header></Header>
  <div id="container">
    <main>
      <section>
        <Transition appear>
          <h3>Introduction<span>チーム紹介</span></h3>
        </Transition>
        <p class="c">FCクオーレです。静岡県西部(掛川~磐田)で活動しているフットサルチームです！！<br /></p>
        <p>
          メインの活動場所は磐田市にあるゆめりあフットサル場で、ほぼ毎週活動しています。<br />エンジョイミックスで30代中盤〜後半が中心で地元の人や県外出身者など様々です。
        </p>
        <p><img :src="`images/sp/IMG_uni.jpg`" alt="" /></p>
      </section>

<!--      <section id="about">-->
<!--        <h3>2021年10月「以前」に弊社テンプレートを利用した事のあるお客様へ</h3>-->
<!--        <p>-->
<!--          2021年11月以降からの配布テンプレートについて、かなり仕様が変更されましたので、メインとなる内容のみピックアップさせて頂きます。<br />-->
<!--          ※今後しばらく仕様の変更が入るかもしれません。-->
<!--        </p>-->
<!--        <ul>-->
<!--          <li><span class="color-check">モバイルファースト</span>のcssに変更しました。小さな端末からの設定になるのでご注意下さい。</li>-->
<!--          <li>-->
<!--            <span class="color-check">IE10以前は考慮しておりません。</span-->
<!--            >Microsoft社のIEサポートが2022年6月で終了する為、IE11の動作チェックも近いうちに終了させて頂きます。-->
<!--          </li>-->
<!--          <li>floatでのレイアウトから、主にflexボックスを使ったレイアウトへ変更されました。</li>-->
<!--        </ul>-->
<!--      </section>-->

      <section></section>
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

  <!--ページの上部へ戻るボタン-->
  <p class="pagetop"><a href="#">↑</a></p>

  <div id="menubar_hdr" :class="{ close: isOpenMenu }" @click="isOpenMenu = !isOpenMenu"></div>
</template>

<style scoped>
.v-leave-active,
.v-enter-active {
  transition: opacity 5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>
