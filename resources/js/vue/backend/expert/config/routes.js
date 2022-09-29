import ExpertIndex from '@/backend/expert/views/Index.vue';
// import ExpertCourse from '@/backend/expert/views/Course.vue';

const routes = [
  {
    name: 'expert-profile',
    path: '/expert/profile',
    component: ExpertIndex,
  },
  // {
  //   name: 'expert-course-event',
  //   path: '/expert/course/event/:uuid',
  //   component: ExpertCourse,
  // },
];

export default routes;