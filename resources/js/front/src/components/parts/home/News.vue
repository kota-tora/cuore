<script setup lang="ts">
import { onMounted, ref, defineProps } from 'vue';
import { newsStore } from '../../../store/News';
import { NewsDetail } from '../../../types/src/store/NewsDetail';
import { inject } from 'vue';

const dayjs = inject('dayjs');
let newsLists = ref<NewsDetail[]>([]);
const news = newsStore();
const props = defineProps({
  limit: {
    type: Number,
    required: false,
  },
  isShowListLink: {
    type: Boolean,
    required: true,
  },
});

onMounted(async () => {
  if (props.limit) {
    await news.fetchNewsList(props.limit);
  } else {
    await news.fetchAllNewsList();
  }
  
  const newsRecords = news.getNewsList;
  newsRecords.map((record: NewsDetail) => {
    newsLists.value.push(record);
  })
});
</script>

<template>
  <div>
    <h3>What's New<span>お知らせ</span></h3>

    <div v-for="news in newsLists">
      <dl id="new">
        <dt>{{ dayjs(news.upDateTime).format('YYYY年M月DD日') }}</dt>
        <dd>
          <router-link :to="{ name: 'news', params: { newsId: news.newsId } }">{{ news.title }}</router-link>
        </dd>
      </dl>
    </div>
    <div v-if="isShowListLink" class="all-news-link">
      <router-link :to="{ name: 'newsList' }">お知らせ一覧へ</router-link>
    </div>
    <div v-else>
      <router-link :to="{name: 'home'}">TOPヘ</router-link>
    </div>
  </div>
</template>

<style scoped>
.all-news-link {
  margin: 30px 10px 10px 10px;
  text-align: right;
}
</style>
