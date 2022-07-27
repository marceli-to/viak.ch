import StudentIndex from '@/modules/dashboard/views/student/Index.vue';
import StudentCreate from '@/modules/dashboard/views/student/partials/Create.vue';
import StudentEdit from '@/modules/dashboard/views/student/partials/Edit.vue';

const routes = [
  {
    name: 'students',
    path: '/dashboard/students',
    component: StudentIndex,
  },

  {
    name: 'student-create',
    path: '/dashboard/student/create',
    component: StudentCreate,
  },

  {
    name: 'student-edit',
    path: '/dashboard/student/edit/:id',
    component: StudentEdit,
  },

];

export default routes;