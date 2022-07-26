import CourseIndex from '@/modules/dashboard/views/course/Index.vue';
import CourseCreate from '@/modules/dashboard/views/course/partials/Create.vue';
import CourseEdit from '@/modules/dashboard/views/course/partials/Edit.vue';

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

];

export default routes;