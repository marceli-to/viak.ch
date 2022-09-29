import CourseIndex from '@/backend/dashboard/views/course/Index.vue';
import CourseCreate from '@/backend/dashboard/views/course/partials/Create.vue';
import CourseEdit from '@/backend/dashboard/views/course/partials/Edit.vue';
import EventCreate from '@/backend/dashboard/views/course/event/partials/Create.vue';
import EventEdit from '@/backend/dashboard/views/course/event/partials/Edit.vue';

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
    path: '/dashboard/course/create/:courseId',
    component: EventCreate,
  },
  {
    name: 'event-edit',
    path: '/dashboard/course/edit/:courseId/:eventId',
    component: EventEdit,
  },

];

export default routes;