import StudentIndex from '@/backend/dashboard/views/student/Index.vue';
import StudentCreate from '@/backend/dashboard/views/student/partials/Create.vue';
import StudentEdit from '@/backend/dashboard/views/student/partials/Edit.vue';
import StudentShow from '@/backend/dashboard/views/student/Show.vue';
import StudentDocuments from '@/backend/dashboard/views/student/Documents.vue';
import StudentAddressCreate from '@/backend/dashboard/views/student/address/partials/Create.vue';
import StudentAddressEdit from '@/backend/dashboard/views/student/address/partials/Edit.vue';

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
  {
    name: 'student-address-create',
    path: '/dashboard/student/address/create/:id',
    component: StudentAddressCreate,
  },
  {
    name: 'student-address-edit',
    path: '/dashboard/student/address/edit/:id/:uuid',
    component: StudentAddressEdit,
  },

];

export default routes;