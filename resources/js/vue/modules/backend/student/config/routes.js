import StudentIndex from '@//modules/backend/student/views/Index.vue';
import StudentDocuments from '@//modules/backend/student/views/Documents.vue';

const routes = [
  {
    name: 'student-profile',
    path: '/student',
    component: StudentIndex,
  },
  {
    name: 'student-documents',
    path: '/student/documents',
    component: StudentDocuments,
  },
];

export default routes;