import CourseIndex from '@/modules/dashboard/views/course/Index.vue';
import CourseCreate from '@/modules/dashboard/views/course/partials/Create.vue';
import CourseEdit from '@/modules/dashboard/views/course/partials/Edit.vue';
import EventCreate from '@/modules/dashboard/views/course/event/partials/Create.vue';
import EventEdit from '@/modules/dashboard/views/course/event/partials/Edit.vue';

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