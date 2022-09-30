import ExpertIndex from '@/backend/expert/views/Index.vue';
import ExpertCourse from '@/backend/expert/views/Course.vue';
import MessageForm from '@/shared/modules/messages/Form.vue';

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
    component: MessageForm,
  },
];

export default routes;