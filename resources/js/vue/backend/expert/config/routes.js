import ExpertIndex from '@/backend/expert/views/Index.vue';
import ExpertCourse from '@/backend/expert/views/Course.vue';
import ExpertMessages from '@/backend/expert/views/Messages.vue';
import ExpertFiles from '@/backend/expert/views/Files.vue';

const routes = [
  {
    name: 'de-expert-profile',
    path: '/de/experte/profil',
    component: ExpertIndex,
  },
  {
    name: 'en-expert-profile',
    path: '/en/expert/profile',
    component: ExpertIndex,
  },

  {
    name: 'de-expert-course-event',
    path: '/de/experte/profil/kurs/veranstaltung/:uuid',
    component: ExpertCourse,
  },
  {
    name: 'en-expert-course-event',
    path: '/en/expert/profile/course/event/:uuid',
    component: ExpertCourse,
  },

  {
    name: 'de-expert-course-event-message',
    path: '/de/experte/profil/kurs/veranstaltung/:uuid/message',
    component: ExpertMessages,
  },
  {
    name: 'en-expert-course-event-message',
    path: '/en/expert/profile/course/event/:uuid/message',
    component: ExpertMessages,
  },

  {
    name: 'de-expert-course-event-file',
    path: '/de/experte/profil/kurs/veranstaltung/:uuid/file-upload',
    component: ExpertFiles,
  },

  {
    name: 'en-expert-course-event-file',
    path: '/en/expert/profile/course/event/:uuid/file-upload',
    component: ExpertFiles,
  },
];

export default routes;