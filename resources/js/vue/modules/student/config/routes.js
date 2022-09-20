import StudentIndex from '@/modules/student/Index.vue';
import StudentDocuments from '@/modules/student/Documents.vue';

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