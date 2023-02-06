import StudentIndex from '@/backend/dashboard/views/student/Index.vue';
import StudentCreate from '@/backend/dashboard/views/student/partials/Create.vue';
import StudentEdit from '@/backend/dashboard/views/student/partials/Edit.vue';
import StudentShow from '@/backend/dashboard/views/student/Show.vue';
import StudentDocuments from '@/backend/dashboard/views/student/Documents.vue';

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
  {
    name: 'student-show',
    path: '/dashboard/student/show/:id',
    component: StudentShow,
  },

  {
    name: 'student-documents',
    path: '/dashboard/student/dokumente/:id',
    component: StudentDocuments,
  },

];

export default routes;