<script setup lang="ts">
import FooterSlick from '../components/parts/FooterSlick.vue';
import Menu from '../components/parts/Menu.vue';
import News from '../components/parts/home/News.vue';
import { ref, onMounted } from 'vue';
import { IObserver } from '../utils/IObserver';
import Loading from 'vue3-loading-overlay';

import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel'

const lunchA = ref();
const lunchB = ref();
const isOpenMenu = ref(false);
let isLoading = ref(true);

onMounted(function () {
  // ページの完全な読み込みを待つ
  if (document.readyState === "complete") {
    isLoading.value = false;
  } else {
    window.addEventListener("load", () => {
      isLoading.value = false;
    });
  }
  
  if (!isLoading.value) {
    const lunchADom = lunchA.value;
    const lunchBDom = lunchB.value;
    
    IObserver.observe(lunchADom);
    IObserver.observe(lunchBDom);
  }
});


const spSlideimg = [
  './images/sp/IMG_01.jpg',
  './images/sp/IMG_07.jpg',
  './images/sp/IMG_03_1.jpg',
  './images/sp/IMG_03_2.jpg',
  './images/sp/IMG_09.jpg',
  './images/sp/IMG_11.jpg',
];

const pcSlideimg = [
  './images/IMG_1.jpg',
  './images/IMG_2.jpg',
  './images/IMG_3.jpg',
  './images/IMG_4.jpg',
  './images/IMG_5.jpg',
  './images/IMG_6.jpg',
];

</script>
<template>

  <div v-if="isLoading">
    <div id="" class="loader">
      <Loading
        :active="true"
        :color="'#ffffff'"
        :loader="'dots'"
        :width="100"
      ></Loading>
    </div>
  </div>
  <div v-else>
    <!--スライドショー-->
    <div id="mainimg" class="background-slider">
      <Carousel
        :wrap-around="true"
        :transition="0"
        :pause-autoplay-on-hover="false"
        :autoplay="4000"
      >
        <Slide v-for="slide in spSlideimg" :key="slide">
          <div class="carousel__item fade-animation">
            <img class="slide-img" :src="slide" alt="スライド画像" />
          </div>
        </Slide>
        
        <template #addons>
          <Navigation />
          <Pagination />
        </template>
      </Carousel>
    </div>
    
    <!--スクロールを促すアイコン-->
    <div class="scroll"><img :src="`images/arrow1.gif`" alt="" /></div>
    
    <div id="container">
      <main>
        <section>
          <h2>Our memory<span>思い出</span></h2>
          
          <div id="lunchA" class="list2">
            <figure ref="lunchA" class="up">
              <img :src="`images/IMG_home01.jpg`" alt="ホーム写真1" />
            </figure>
            
            <div class="text">
              <h4>2023年 4月 島田</h4>
              <ul>
                <li>ゲーム終了後のビンゴ中</li>
              </ul>
            </div>
          </div>
          
          <div id="lunchB" class="list2">
            <figure ref="lunchB" class="up">
              <img :src="`images/IMG_3.jpg`" alt="ホーム写真2" />
            </figure>
            <div class="text">
              <h4>2023年 12月</h4>
              <ul>
                <li>忘年会にて</li>
              </ul>
            </div>
          </div>
        </section>
        
        <section>
          <h2>Photo's</h2>
          <!--  カルーセル-->
          <FooterSlick></FooterSlick>
        </section>
        
        <section>
<!--          <News :limit="3" :is-show-list-link="true"></News>-->
        </section>
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
    
    <Menu :is-show="isOpenMenu"></Menu>
    
    
    <!--メニュー開閉用のスクリプト-->
    <div id="menubar_hdr" :class="{ close: isOpenMenu }" @click="isOpenMenu = !isOpenMenu"></div>
    <!--ページの上部へ戻るボタン-->
    <p class="pagetop"><a href="#">↑</a></p>
    <!-- ロゴアニメーション（vivus） -->
  </div>
</template>

<style scoped>
.v-enter-active {
  transition: opacity 5s ease;
}

.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}

div.loader {
  text-align: center;
}

.background-slider {
  top: 0;
  left: 0;
  height: 100%;
}
.carousel__item {
  width: 100vw;
  height: 100vh;
  background-size: cover;  /* 画像が切れても画面全体に表示 */
  background-position: center; /* 画像を中央に配置 */
  background-repeat: no-repeat;
  transition: opacity 2s linear;
}

.slide-img {
  height: 100%;
  max-width: 100%;
  display: none;
}

.carousel__slide.carousel__slide--active img {
  animation: fadeEffect 3s linear;
  display: block;
}


/* フェードインアニメーション */
@keyframes fadeEffect {
  0% { opacity: 0; transform: scale(1.5); } /* 少し拡大 */
  10% { opacity: 0.8; transform: scale(1.45); }
  20% { opacity: 0.8; transform: scale(1.4); }
  30% { opacity: 0.8; transform: scale(1.35); }
  40% { opacity: 0.9; transform: scale(1.3); }
  50% { opacity: 0.9; transform: scale(1.25); }
  60% { opacity: 0.9; transform: scale(1.2); }
  70% { opacity: 0.9; transform: scale(1.15); }
  80% { opacity: 1; transform: scale(1.1); }
  90% { opacity: 1; transform: scale(1.05); }
  100% { opacity: 1; transform: scale(1); } /* 元のサイズ */
}

</style>
