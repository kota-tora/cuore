<script setup lang="ts">

  import { nextTick, onMounted, Ref, ref } from 'vue';
  import { galleryStore } from '../../../store/Gallery';
  import { Gallery } from '../../../types/src/store/Gallery';
  import { YoutubeMovie } from '../../../types/src/store/YoutubeMovie';
  import Loading from 'vue3-loading-overlay';
  import { useIntersectionObserver } from "@vueuse/core";
  
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
  
  // 垂直スクロール位置
  let scrollY = ref(0);
  // 画像イメージリスト格納場所
  let galleries = ref<Gallery[]>([])
  // 動画リスト格納場所
  let videGalleries = ref<YoutubeMovie[]>([])
  // ローディングフラグ
  let isLoading = ref(true);
  let isMoreFetching = ref(false);
  
  const observerElement = ref(null);
  const videoElement = ref(null);
  
  const perPage = 10;
  let isAllFetched = ref(false);
  let isAllVideoFetched = ref(false);
  
  let page = ref(1);
  let videoPage = ref(1);
  
  useIntersectionObserver(
    observerElement,
    ([entry]) => {
      {
        if (entry.isIntersecting && !isAllFetched.value) {
          loadMoreImages();
        }
      }
    },
    { threshold: 0.5 }
  );
  
  useIntersectionObserver(
    videoElement,
    ([entry]) => {
      if (entry.isIntersecting && !isAllVideoFetched.value) {
        loadMoreVideos();
      }
    }
  );
  
  const sleep = (ms) => new Promise(resolve => setTimeout(resolve, ms));
  const loadMoreImages = async () => {
    isMoreFetching.value = true;

    // ギャラリー画像取得
    await gallery.fetchImagesPart(page.value);
    page.value++;
    // 画像ギャラリーに追加
    const galleryRecords = gallery.getGalleryList;
    // limit件数よりも取得が少なければ全件ロード完了
    if (galleryRecords.length < perPage) {
      isAllFetched.value = true;
    }
    
    galleryRecords.map((record: Gallery) => {
      galleries.value.push(record);
    })
    await sleep(3000);
    isMoreFetching.value = false;
  };
  
  const loadMoreVideos = async () => {
    isMoreFetching.value = true;
    
    // 動画取得
    await gallery.fetchYoutubeVideosPart(videoPage.value);
    videoPage.value++;
    // 動画ギャラリーに追加
    const galleryVideoRecords = gallery.getYoutubeMovieList;
    // limit件数よりも取得が少なければ全件ロード完了
    if (galleryVideoRecords.length < perPage) {
      isAllVideoFetched.value = true;
    }
    
    galleryVideoRecords.map((record: YoutubeMovie) => {
      videGalleries.value.push(record);
    })
    await sleep(3000);
    isMoreFetching.value = false;
  };
  
  onMounted(async () => {
    // スクロール時イベント
    window.addEventListener('scroll', getScroll, {passive: false});
    // ギャラリー画像取得
    await gallery.fetchImagesPart(1)
    // 画像ギャラリーに追加
    const galleryRecords = gallery.getGalleryList;
    galleryRecords.map((record: Gallery) => {
      galleries.value.push(record);
    })
    page.value++;
    // 動画取得
    await gallery.fetchYoutubeVideosPart(1);
    // 動画ギャラリーに追加
    const galleryVideoRecords = gallery.getYoutubeMovieList;
    galleryVideoRecords.map((record: YoutubeMovie) => {
      videGalleries.value.push(record);
    })
    videoPage.value++;
    
    await nextTick();
    await waitLoading();
  });

async function waitLoading() {
  return new Promise<void>((resolve) => {
    // ページの完全な読み込みを待つ
    if (document.readyState === "complete") {
      // ローディング終了
      isLoading.value = false;
      resolve();
    } else {
      // 読み込み中の場合は１秒待ってから、再帰
      setTimeout(async () => {
        await waitLoading();
        resolve();
      }, 1000);
    }
  });
}
  
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
    isLoading.value = true;
    isMoreFetching.value = false;
    isActiveTab.value = index;
    waitLoading()
  }
</script>

<template>
  <div v-show="isLoading" class="vue">
    <div id="" class="loader">
      <Loading
        :active="true"
        :color="'#ffffff'"
        :loader="'dots'"
        :width="100"
      ></Loading>
    </div>
  </div>
  <div v-show="!isLoading" class="vue">
    <ul class="tabs">
      <li @click="change('1')" :class="{'active': isActiveTab === '1'}">画像</li>
      <li @click="change('2')" :class="{'active': isActiveTab === '2'}">動画</li>
    </ul>
    
    <ul class="contents">
      <transition>
        <li v-show="isActiveTab === '1'">
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
            <div ref="observerElement" class="text-center py-4">
<!--              <p v-if="isMoreFetching">Loading...</p>-->
              <div v-show="isMoreFetching" class="vue">
                <div id="" class="loader">
                  <Loading
                    :active="true"
                    :color="'#ffffff'"
                    :loader="'spinner'"
                    :width="100"
                  ></Loading>
                </div>
              </div>
            </div>
            <dialog ref="dialog" class="image-dialog custom-dialog" @click="handleCloseDialog()">
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
        <li v-show="isActiveTab === '2'">
          <div ref="figure" class="list-container">
            <div
              v-for="(video, index) in videGalleries"
              role="button"
              class="image-box one-column-list"
              tabindex="0"
            >
              <div class="title">{{ `${video.filmingDate} ${video.title}` }}</div>
              <div id="video-wrap" class="video-wrap" >
                <iframe
                  class="youtube"
                  :src="`https://www.youtube.com/embed/${video.url}&quality=hd1080`"
                  title="YouTube video player"
                  frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen>
                </iframe>
              </div>
            </div>
          </div>
          <div ref="videoElement" class="text-center py-4">
            <div v-show="isMoreFetching" class="vue">
              <div id="" class="loader">
                <Loading
                  :active="true"
                  :color="'#ffffff'"
                  :loader="'spinner'"
                  :width="100"
                ></Loading>
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
  
  /* dialogタグの基本スタイル */
  .custom-dialog {
    position: fixed; /* ビューポートに固定 */
    inset: 0; /* top, right, bottom, left を 0 に設定 */
    margin: auto; /* 中央に配置 */
    transform: none; /* transformをリセット */
    flex-direction: column;
    justify-content: center;
    align-items: center;
    border: none;
    border-radius: 8px;
    background-color: black;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    max-width: 500px;
    width: 95%;
    z-index: 1000;
    padding: 1px;
  }
  
  /* 背景の暗幕 */
  .custom-dialog::backdrop {
    background: rgba(0, 0, 0, 0.7);
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
    .sp-wide {
      display: block;
    }
    
    .image-dialog {
      max-width: 100%;
      max-height: 100%;
      height: 95%;
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
    width: 100%;
    padding-top: 56.25%; /* 16:9のアスペクト比 */
    height: 0; /* 高さをゼロにして、paddingで高さを調整 */
  }
  
  /*１個あたりのボックス*/
  .one-column-list {
    width: 100%; /*ボックスの幅*/
    margin-bottom: 50px; /*ボックス同士の上下間の余白*/
    text-align: center; /*テキストをセンタリング*/
    font-size: 0.7rem; /*文字サイズ。remの単位についてはテンプレート内の解説をお読み下さい。*/
  }
  
  iframe.youtube {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
  }
  
  div.loader {
    text-align: center;
  }
  .text-center {
    width: 100%;
  }
  
</style>
