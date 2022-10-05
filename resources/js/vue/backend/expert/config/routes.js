import ExpertIndex from '@/backend/expert/views/Index.vue';
import ExpertCourse from '@/backend/expert/views/Course.vue';
import ExpertMessage from '@/backend/expert/views/Message.vue';
import Fileform from '@/backend/expert/views/file/Form.vue';

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
    component: ExpertMessage,
  },
  {
    name: 'expert-course-event-file',
    path: '/expert/profile/course/event/:uuid/file-upload',
    component: Fileform,
  },
];

export default routes;