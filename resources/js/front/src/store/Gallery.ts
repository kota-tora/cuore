import { defineStore } from 'pinia';
import axios from 'axios';
import { Gallery } from '../types/src/store/Gallery';
import { VideoGallery } from '../types/src/store/VideoGallery';

export const galleryStore = defineStore('gallery', {
  state: () : { galleryList: Gallery[], videoList: VideoGallery[] } => ({
    galleryList: [],
    videoList: []
  }),
  getters: {
    getGalleryList(state) {
      return state.galleryList;
    },
    getVideoList(state) {
      return state.videoList;
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
    async fetchAllVideos() {
      await axios.get('api/get_all_gallery_by_type', {
        params: {
          type: 'video'
        }
      })
        .then((response) => {
          this.videoList = response.data;
        }).catch((err) => console.log(err));
    }
  }
});