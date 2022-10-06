import StudentIndex from '@/backend/student/views/Index.vue';
import StudentDocuments from '@/backend/student/views/Documents.vue';
import StudentCourse from '@/backend/student/views/Course.vue';
import StudentAddressCreate from '@/backend/student/views/address/partials/Create.vue';
import StudentAddressEdit from '@/backend/student/views/address/partials/Edit.vue';

const routes = [
  {
    name: 'student-profile',
    path: '/student/profile',
    component: StudentIndex,
  },
  {
    name: 'student-documents',
    path: '/student/profile/documents',
    component: StudentDocuments,
  },
  {
    name: 'student-course-event',
    path: '/student/profile/course/event/:uuid',
    component: StudentCourse,
  },
  {
    name: 'student-address-create',
    path: '/student/profile/address/create',
    component: StudentAddressCreate,
  },
  {
    name: 'student-address-edit',
    path: '/student/profile/address/edit/:uuid',
    component: StudentAddressEdit,
  },
];

export default routes;