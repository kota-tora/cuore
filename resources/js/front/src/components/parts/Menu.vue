<script setup lang="ts">
const props = defineProps({
  isShow: {
    type: Boolean,
    required: true,
  },
});
</script>

<template>
  <!--メインメニュー-->
  <nav v-show="isShow" id="menubar">
    <ul>
      <li>
        <router-link :to="{ name: 'home' }">Home<span>ホーム</span></router-link>
      </li>
      <li>
        <router-link :to="{ name: 'about' }">About<span>チームについて</span></router-link>
      </li>
      <li>
        <router-link :to="{ name: 'gallery' }">Gallery<span>ギャラリー</span></router-link>
      </li>
      <li>
        <router-link :to="{ name: 'access' }">Access<span>アクセス</span></router-link>
      </li>
      <li>
        <router-link :to="{ name: 'recruit' }">Recruit<span>メンバー募集</span></router-link>
      </li>
      <li>
        <router-link :to="{ name: 'contact' }">Contact<span>お問い合わせ</span></router-link>
      </li>
    </ul>
  </nav>
</template>

<style scoped></style>
