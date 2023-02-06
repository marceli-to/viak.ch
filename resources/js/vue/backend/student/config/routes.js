import StudentIndex from '@/backend/student/views/Index.vue';
import StudentDocuments from '@/backend/student/views/Documents.vue';
import StudentCourse from '@/backend/student/views/Course.vue';
import StudentAddressCreate from '@/backend/student/views/address/partials/Create.vue';
import StudentAddressEdit from '@/backend/student/views/address/partials/Edit.vue';

const routes = [
  {
    name: 'de-student-profile',
    path: '/de/student/profil',
    component: StudentIndex,
  },
  {
    name: 'en-student-profile',
    path: '/en/student/profile',
    component: StudentIndex,
  },
  {
    name: 'de-student-documents',
    path: '/de/student/profil/dokumente',
    component: StudentDocuments,
  },
  {
    name: 'en-student-documents',
    path: '/en/student/profile/documents',
    component: StudentDocuments,
  },
  {
    name: 'de-student-course-event',
    path: '/de/student/profil/kurs/veranstaltung/:uuid',
    component: StudentCourse,
  },
  {
    name: 'en-student-course-event',
    path: '/en/student/profile/course/event/:uuid',
    component: StudentCourse,
  },
  {
    name: 'de-student-address-create',
    path: '/de/student/profil/adresse/erstellen',
    component: StudentAddressCreate,
  },
  {
    name: 'en-student-address-create',
    path: '/en/student/profile/address/create',
    component: StudentAddressCreate,
  },
  {
    name: 'de-student-address-edit',
    path: '/de/student/profil/adresse/bearbeiten/:uuid',
    component: StudentAddressEdit,
  },
  {
    name: 'en-student-address-edit',
    path: '/en/student/profile/address/edit/:uuid',
    component: StudentAddressEdit,
  },

];

export default routes;