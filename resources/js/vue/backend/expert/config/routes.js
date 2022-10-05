import ExpertIndex from '@/backend/expert/views/Index.vue';
import ExpertCourse from '@/backend/expert/views/Course.vue';
import ExpertMessages from '@/backend/expert/views/Messages.vue';
import ExpertFiles from '@/backend/expert/views/Files.vue';

const routes = [
  {
    name: 'expert-profile',
    path: '/expert/profile',
    component: ExpertIndex,
  },
  {
    name: 'expert-course-event',
    path: '/expert/profile/course/event/:uuid',
    component: ExpertCourse,
  },
  {
    name: 'expert-course-event-message',
    path: '/expert/profile/course/event/:uuid/message',
    component: ExpertMessages,
  },
  {
    name: 'expert-course-event-file',
    path: '/expert/profile/course/event/:uuid/file-upload',
    component: ExpertFiles,
  },
];

export default routes;