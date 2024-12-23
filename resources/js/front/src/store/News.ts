import { defineStore } from 'pinia';
import axios, { AxiosResponse } from 'axios';
import { RouteParamValue } from 'vue-router';
import { NewsDetail } from '../types/src/store/NewsDetail';
export const newsStore= defineStore('news', {
  state: () : {newsList: NewsDetail[], detailNews: NewsDetail} => ({
    newsList: [],
    detailNews: {
      newsId: 0,
      title: '',
      content: '',
      upDateTime: null,
      createdAt: null,
    }
  }),
  getters: {
    getNewsList: (state) : NewsDetail[] => {
      return state.newsList;
    },
    getDetailNews: (state) : NewsDetail => {
      return state.detailNews;
    },
  },
  actions: {
    async fetchAllNewsList()  {
      await axios
        .get('api/get_news_lists')
        .then((response) => {
          this.newsList = response.data;
        })
        .catch((err) => console.log(err));
    },
    async fetchNewsList(limit: number) {
      await axios
        .get('api/get_news_lists', {
          params: {
            limit: limit,
          },
        })
        .then((response) => {
          this.newsList.splice(0, this.newsList.length);
          response.data.map((news : NewsDetail) => {
            this.newsList.push(news);
          })
        })
        .catch((err) => console.log(err));
    },
    async fetchById(newsId: string | RouteParamValue[]) {
      await axios
        .get('api/get_news', {
          params: {
            id: newsId,
          },
        })
        .then((response) => {
          this.detailNews.newsId = response.data.news_id;
          this.detailNews.title = response.data.title;
          this.detailNews.content = response.data.content;
          this.detailNews.upDateTime = response.data.up_date_time;
          this.detailNews.createdAt = response.data.created_at;
        })
        .catch((err) => console.log(err.response));
    },
  },
});
