<script setup lang="ts">
import FooterSlick from '../components/parts/FooterSlick.vue';
import Menu from '../components/parts/Menu.vue';
import News from '../components/parts/home/News.vue';
import { ref, onMounted } from 'vue';
import { IObserver } from '../utils/IObserver';
import Loading from 'vue3-loading-overlay';

const lunchA = ref();
const lunchB = ref();
const isOpenMenu = ref(false);
let isLoading = ref(true);

onMounted(function () {
  window.addEventListener("load", () => {
    isLoading.value = false;
    
    const lunchADom = lunchA.value;
    const lunchBDom = lunchB.value;

    if (lunchADom) IObserver.observe(lunchADom);
    if (lunchBDom) IObserver.observe(lunchBDom);
    
    const ua = navigator.userAgent;
    if(ua.indexOf('iPhone') > 0 || ua.indexOf('iPod') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0){
      slideSp();
    }else if(ua.indexOf('iPad') > 0 || ua.indexOf('Android') > 0){
      slideSp();
    }else{
      slidePc();
    }
  });
});

function slidePc() {
  setInterval(function () {
    $('#mainimg').vegas({
      slides: [
        { src: './images/IMG_1.jpg' },	//1枚目の写真指定
        { src: './images/IMG_2.jpg' },	//2枚目の写真指定
        { src: './images/IMG_3.jpg' },	//3枚目の写真指定
        { src: './images/IMG_4.jpg' },	//3枚目の写真指定
        { src: './images/IMG_5.jpg' },	//3枚目の写真指定
        { src: './images/IMG_6.jpg' },	//3枚目の写真指定
        { src: './images/IMG_7.jpg' },	//3枚目の写真指定
      ],
      overlay: true,//写真上にドットを重ねる。不要ならこの１行を削除して下さい。
      transition: 'blur',   //https://vegas.jaysalvat.com/documentation/transitions/から好みのtransitionを選んで置き換えられます。
      animation: 'kenburns',//https://vegas.jaysalvat.com/documentation/transitions/から好みのanimationを選んで置き換えられます。
      delay: 7000,    //次の画像を表示するまでの時間
      animationDuration: 6000,	//アニメーション間の引き継ぎタイミング。ズームアウトが完了する秒数？
    });
  }, 1000);//3秒遅れてスライドショーがスタート
}

function slideSp() {
  setInterval(function () {
    $('#mainimg').vegas({
      slides: [
        { src: './images/sp/IMG_01.jpg' },	//1枚目の写真指定
        { src: './images/sp/IMG_07.jpg' },	//2枚目の写真指定
        { src: './images/sp/IMG_03_1.jpg' },	//3枚目の写真指定
        { src: './images/sp/IMG_03_2.jpg' },	//3枚目の写真指定
        { src: './images/sp/IMG_09.jpg' },	//2枚目の写真指定
        { src: './images/sp/IMG_11.jpg' },	//2枚目の写真指定
      ],
      overlay: true,//写真上にドットを重ねる。不要ならこの１行を削除して下さい。
      transition: 'blur',   //https://vegas.jaysalvat.com/documentation/transitions/から好みのtransitionを選んで置き換えられます。
      animation: 'kenburns',//https://vegas.jaysalvat.com/documentation/transitions/から好みのanimationを選んで置き換えられます。
      delay: 5000,    //次の画像を表示するまでの時間
      // animationDuration: 20000,	//アニメーション間の引き継ぎタイミング。
    });
  }, 1000);//3秒遅れてスライドショーがスタート
}

</script>
<template>

  <div v-if="isLoading">
    <div id="container" class="loader">
      <Loading
        :active="true"
        :color="'#ffffff'"
        :opacity="0.1"
        :loader="'dots'"
        :width="100"
      ></Loading>
    </div>
  </div>
  <div v-else>
    <!--スライドショー-->
    <div id="mainimg"></div>
    
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
          <News :limit="3" :is-show-list-link="true"></News>
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

</style>
