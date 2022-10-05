import CourseIndex from '@/backend/dashboard/views/course/Index.vue';
import CourseCreate from '@/backend/dashboard/views/course/partials/Create.vue';
import CourseEdit from '@/backend/dashboard/views/course/partials/Edit.vue';
import EventCreate from '@/backend/dashboard/views/course/event/partials/Create.vue';
import EventEdit from '@/backend/dashboard/views/course/event/partials/Edit.vue';
import EventShow from '@/backend/dashboard/views/course/event/Show.vue';
import EventMessageCreate from '@/backend/dashboard/views/course/event/partials/message/Create.vue';
import EventFileCreate from '@/backend/dashboard/views/course/event/partials/file/Create.vue';

const routes = [
  {
    name: 'courses',
    path: '/dashboard/courses',
    component: CourseIndex,
  },
  {
    name: 'course-create',
    path: '/dashboard/course/create',
    component: CourseCreate,
  },
  {
    name: 'course-edit',
    path: '/dashboard/course/edit/:id',
    component: CourseEdit,
  },
  {
    name: 'event-create',
    path: '/dashboard/course/event/create/:courseId',
    component: EventCreate,
  },
  {
    name: 'event-edit',
    path: '/dashboard/course/event/edit/:uuid',
    component: EventEdit,
  },
  {
    name: 'event-show',
    path: '/dashboard/course/event/show/:uuid',
    component: EventShow,
  },
  {
    name: 'event-message-create',
    path: '/dashboard/course/event/:uuid/message',
    component: EventMessageCreate,
  },
  {
    name: 'event-file-create',
    path: '/dashboard/course/event/:uuid/file',
    component: EventFileCreate,
  },

];

export default routes;