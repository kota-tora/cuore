<script setup lang="ts">
import Menu from '../components/parts/Menu.vue';
import { ref } from 'vue';
const isOpenMenu = ref(false);
</script>

<template>
  <div id="container">
    <main>
      <section>
        <h2>Access<span>アクセス</span></h2>

        <table class="ta1">
          <caption class="left-item">
            <span class="">活動場所1</span>
            <span class="place">ゆめりあフットサル場</span>
          </caption>
          <tr>
            <th>所在地</th>
            <td>
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7933.068603756779!2d137.85465597019504!3d34.75201650566413!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601ae3f6b41b26cb%3A0xd6cf36b81205f149!2z44KG44KB44KK44GC44OV44OD44OI44K144Or5aC0!5e0!3m2!1sja!2sjp!4v1716906190531!5m2!1sja!2sjp"
                width="600"
                height="450"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </td>
          </tr>
          <tr>
            <th>住所</th>
            <td>〒438-0002 静岡県磐田市大久保８９２−３６</td>
          </tr>
        </table>
        

        <table class="ta1">
          <caption class="left-item">
            <span class="">活動場所2</span>
            <span class="place">し〜すぽ (掛川市南体育館)</span>
          </caption>
          <tr>
            <th>所在地</th>
            <td>
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13493.973577508303!2d138.02470861226084!3d34.67370589088161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601af4244da42d5d%3A0x678845365376f39e!2z5o6b5bed5biC5Y2X5L2T6IKy6aSoIOOBl--9nuOBmeOBvQ!5e0!3m2!1sja!2sjp!4v1716906351543!5m2!1sja!2sjp"
                width="600"
                height="450"
                style="border: 0"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
            </td>
          </tr>
          <tr>
            <th>住所</th>
            <td>〒437-1302 静岡県掛川市大渕14234番地の1</td>
          </tr>
        </table>
      </section>
    </main>

    <Menu :is-show="isOpenMenu"></Menu>

    <!--メニュー開閉用のスクリプト-->
    <div id="menubar_hdr" :class="{ close: isOpenMenu }" @click="isOpenMenu = !isOpenMenu"></div>
    <!--ページの上部へ戻るボタン-->
    <p class="pagetop"><a href="#">↑</a></p>
    <!-- ロゴアニメーション（vivus） -->
  </div>
</template>

<style scoped>
  span.place {
    margin-left: 50px;
  }
  .left-item {
    text-align: left;
  }
</style>
