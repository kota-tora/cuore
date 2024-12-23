import { createRouter, createWebHistory } from 'vue-router';

import home from '../views/Home.vue';
import about from '../views/About.vue';
import access from '../views/Access.vue';
import gallery from '../views/Gallery.vue';
import contact from '../views/Contact.vue';
import recruit from '../views/Recruit.vue';
import newsDetail from '../views/NewsDetail.vue';
import newsList from '../views/NewsList.vue';

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      component: home,
    },
    {
      path: '/about',
      name: 'about',
      component: about,
    },
    {
      path: '/gallery',
      name: 'gallery',
      component: gallery,
    },
    {
      path: '/access',
      name: 'access',
      component: access,
    },
    {
      path: '/recruit',
      name: 'recruit',
      component: recruit,
    },
    {
      path: '/contact',
      name: 'contact',
      component: contact,
    },
    {
      path: '/newsList',
      name: 'newsList',
      component: newsList,
    },
    {
      path: '/news/:newsId',
      name: 'news',
      component: newsDetail,
    },
  ],
});

export default router;
