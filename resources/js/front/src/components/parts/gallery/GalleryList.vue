<script setup lang="ts">

import { onMounted, Ref, ref } from 'vue';
  import { galleryStore } from '../../../store/Gallery';
  import { Gallery } from '../../../types/src/store/Gallery';
  import { VideoGallery } from '../../../types/src/store/VideoGallery';
  
  // ダイアログで表示している画像のindex
  const currentImageIndex = ref(0);
  // ダイアログのDOM
  const dialog = ref();
  const gallery = galleryStore();
  // 画像のDOM
  const imgbox = ref();
  // 表示中のタブ 1:画像 2:動画
  const isActiveTab = ref('1');
  const isOpenDialog = ref(false);
  // 動画再生中フラグ
  const isPlaying = ref(false);
  // videoタグのDOM
  const videos = ref<(HTMLVideoElement | null)[]>([]);
  
  // 垂直スクロール位置
  let scrollY = ref(0);
  // 画像イメージリスト格納場所
  let galleries = ref<Gallery[]>([])
  // 動画リスト格納場所
  let videGalleries = ref<Gallery[]>([])
  
  /**
   * 動画再生停止
   * @param index
   */
  const videoPlay = (index : number) => {
    if (!videos.value) return;
    const video = videos.value[index];
    if (!video) return;
    
    console.log('video click')
    
    if (!isPlaying.value) {
      video.play();
      isPlaying.value = true;
    } else {
      video.pause();
      isPlaying.value = false;
    }
  }
  
  onMounted(async () => {
    // スクロール時イベント
    window.addEventListener('scroll', getScroll, {passive: false});
    // ギャラリー画像取得
    await gallery.fetchAllImages()
    // 画像ギャラリーに追加
    const galleryRecords = gallery.getGalleryList;
    galleryRecords.map((record: Gallery) => {
      galleries.value.push(record);
    })
    // 動画取得
    await gallery.fetchAllVideos();
    // 動画ギャラリーに追加
    const galleryVideoRecords = gallery.getVideoList;
    galleryVideoRecords.map((record: VideoGallery) => {
      videGalleries.value.push(record);
    })
  });
  
  /**
   * スクロールを止める
   * @param e
   */
  const noscroll = (e: MouseEvent | TouchEvent) => {
    e.preventDefault();
  }
  
  /**
   * モーダル開く
   * @param index
   * @param event
   */
  const handleOpenDialog = (index: number, event: MouseEvent) => {
    // スクロール禁止
    document.addEventListener('touchmove', noscroll, {passive: false});
    document.addEventListener('wheel', noscroll, {passive: false});
    
    if (dialog.value) {
      // 画面最上部にスクロールする
      window.scrollTo({
        top: 0,
        behavior: 'smooth'
      });
      
      currentImageIndex.value = index;
      dialog.value.showModal();
      isOpenDialog.value = true;
    }
  }
  
  /**
   * モーダル閉じる
   */
  const handleCloseDialog = () => {
    if (dialog.value) dialog.value.close();
    isOpenDialog.value = false;
    // スクロール禁止
    document.removeEventListener('touchmove', noscroll);
    document.removeEventListener('wheel', noscroll);
    // モーダルを開く前の位置にスクロールする
    window.scrollTo({
      top: scrollY.value,
      behavior: 'smooth'
    });
  }
  
  /**
   * モーダルで次の画像を表示する
   */
  const next = () => {
    currentImageIndex.value++;
    if (currentImageIndex.value >= galleries.value.length) {
      currentImageIndex.value = 0;
    }
  }
  
  /**
   * モーダルで前の画像を表示する
   */
  const prev = () => {
    currentImageIndex.value--;
    if (currentImageIndex.value < 0) {
      currentImageIndex.value = galleries.value.length - 1;
    }
  }
  
  /**
   * 画像モーダルが開いていなければスクロール位置を保持する
   * @param e
   */
  const getScroll = (e: Event) => {
    if (isOpenDialog.value) return;
    scrollY.value = window.scrollY;
  }
  
  const change = (index) => {
    isActiveTab.value = index;
  }
</script>

<template>
  <div class="vue">
    <ul class="tabs">
      <li @click="change('1')" :class="{'active': isActiveTab === '1'}">画像</li>
      <li @click="change('2')" :class="{'active': isActiveTab === '2'}">動画</li>
    </ul>
    
    <ul class="contents">
      <transition>
        <li v-if="isActiveTab === '1'">
          <div ref="figure" class="list-container">
            <div ref="imgbox" v-for="(gallery, index) in galleries" class="list">
              <div
                role="button"
                @click="handleOpenDialog(index, $event)"
                @keydown="handleOpenDialog(index, $event)"
                class="image-box"
                tabindex="0"
              >
                <img :src="`storage/images/gallery/${gallery.name}`" alt="" />
              </div>
            </div>
            <dialog ref="dialog" class="image-dialog" @click="handleCloseDialog()">
              <div class="dialog-contents" @click.stop>
                <div class="close">
                  <button class="close-btn" @click="handleCloseDialog()" name="prev-btn">x</button>
                </div>
                <div @click.stop="" class="contents">
                  <img class="gallery-img" v-if="galleries.length > 0" :src="`storage/images/gallery/${galleries[currentImageIndex].name}`" alt="" />
                </div>
                <span class="ctl-left sp-wide">
                  <div class="inline-ctl">
                    <button class="control-btn Form-Btn mt-0" @click.stop="prev()" name="prev-btn"><</button>
                  </div>
                </span>
                <span class="ctl-right sp-wide">
                  <div class="inline-ctl">
                    <button class="control-btn Form-Btn mt-0" @click.stop="next()" name="next-btn">></button>
                  </div>
                </span>
              </div>
            </dialog>
          </div>
        </li>
      </transition>
      <transition>
        <li v-if="isActiveTab === '2'">
          <div ref="figure" class="list-container">
            <div
              v-for="(video, index) in videGalleries"
              role="button"
              class="image-box one-column-list"
              tabindex="0"
            >
              <div class="title">{{ `${video.photoDate} ${video.title}` }}</div>
              <div id="video-wrap" class="video-wrap" >
                <video id="video-play" ref="videos" :src="`storage/images/gallery/movies/${video.name}`" preload="none" playsinline controls controlslist="nodownload playbackRate" ></video>
                <div class="video-btn" @click="videoPlay(index)"></div>
              </div>
            </div>
          </div>
        </li>
      </transition>
    </ul>
  </div>
  
</template>

<style scoped>
  .title {
    margin-bottom: 10px;
    font-size: 15px;
  }
  .sp-wide {
    display: block;
  }
  .image-box {
    cursor: zoom-in;
    display: inline-block;
  }
  .image-dialog {
    max-width: 100%;
    padding: 0;
    background-color: black;
    
    &::backdrop {
      cursor: zoom-out;
      background: rgba(0, 0, 0, 0.8);
    }
  }
  .contents img {
    vertical-align: top;
    width: 100vw;
  }
  .modal-control {
    margin: 20px 10px;
    text-align: center;
  }
  .control-btn {
    margin-top: 5px;
    margin-bottom: 5px;
    margin-left: auto;
    margin-right: auto;
    display: inline;
  }
  .inline-ctl {
    display: inline;
  }
  .f-right {
    float: right;
  }
  .close {
    text-align: right;
    margin-top: 0px;
    margin-bottom: 3px;
  }
  
  .close-btn {
    background-color: red;
    color: white;
    font-size: 22px;
  }
  
  .mt-0 {
    margin-top: 0px
  }
  
  .Form-Btn {
    width: 40px;
    background-color: rgba(0, 0, 0, 0.5);
    border: none;
  }
  
  .ctl-left {
    position: absolute;
    top: 50%;
    left: 10px;
  }
  
  .ctl-right {
    position: absolute;
    top: 50%;
    right: 10px;
  }
  
  @media (orientation: landscape) {
    /* ここに横向きのデバイスに適用するスタイルを書く */
    
    .sp-vertical {
      display: none;
    }
    .sp-wide {
      display: block;
    }
    
    .image-dialog {
      max-width: 100%;
      max-height: 100%;
      height: 100%;
    }
    .dialog-contents {
      margin-left: auto;
      margin-right: auto;
      height: 100%;
    }
    .close {
      right: 10px;
      position: absolute;
      margin-right: 10px;
    }
    
    .contents img {
      height: 100%;
      object-fit: contain;
    }
    
    .contents {
      height: 100%;
    }
  }
  
  .v-enter-from,
  .v-leave-to {
    opacity: 0;
  }
  
  .v-enter-active {
    transition: opacity 2s ease;
  }
  
  .v-leave-active {
    transition: opacity 0.5s ease;
  }
  
  .video-wrap {
    position: relative;
  }
  .video-btn {
    content: "";
    position: absolute;
    top:30px;
    left:0;
    right:0;
    bottom:60px; /*コントローラー分下部に余白を*/
    cursor: pointer;
  }
  
  .video-over-lay {
    position: relative;
    width: 200px;
    height: 200px;
    z-index: 999;
    background-color: red;
  }
  
  #video-play {
    mix-blend-mode: normal !important;
    z-index: -100;
  }
  
  /*１個あたりのボックス*/
  .one-column-list {
    width: 100%; /*ボックスの幅*/
    margin-bottom: 50px; /*ボックス同士の上下間の余白*/
    text-align: center; /*テキストをセンタリング*/
    font-size: 0.7rem; /*文字サイズ。remの単位についてはテンプレート内の解説をお読み下さい。*/
  }
</style>