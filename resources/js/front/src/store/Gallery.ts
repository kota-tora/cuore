import { defineStore } from 'pinia';
import axios from 'axios';
import { Gallery } from '../types/src/store/Gallery';
import { VideoGallery } from '../types/src/store/VideoGallery';
import { YoutubeMovie } from '../types/src/store/YoutubeMovie';

export const galleryStore = defineStore('gallery', {
  state: () : { galleryList: Gallery[], videoList: VideoGallery[], youtubeMovieList: YoutubeMovie[] } => ({
    galleryList: [],
    videoList: [],
    youtubeMovieList: [],
  }),
  getters: {
    getGalleryList(state) {
      return state.galleryList;
    },
    getVideoList(state) {
      return state.videoList;
    },
    getYoutubeMovieList(state) {
      return state.youtubeMovieList;
    }
  },
  actions: {
    async fetchAllImages() {
      await axios.get('api/get_all_gallery_by_type', {
        params: {
          type: 'image'
        }
      })
        .then((response) => {
          this.galleryList = response.data;
      }).catch((err) => console.log(err));
    },
    async fetchImagesPart(page: number) {
      await axios.get('api/get_images_parts', {
        params: {
          page: page
        }
      })
        .then((response) => {
          this.galleryList = response.data;
        }).catch((err) => console.log(err));
    },
    async fetchAllVideos() {
      await axios.get('api/get_all_gallery_by_type', {
        params: {
          type: 'video'
        }
      })
        .then((response) => {
          this.videoList = response.data;
        }).catch((err) => console.log(err));
    },
    async fetchYoutubeVideos() {
      await axios.get('api/get_youtube_movies')
        .then((response) => {
          this.youtubeMovieList = response.data;
        }).catch((err) => console.log(err));
    }
  }
});