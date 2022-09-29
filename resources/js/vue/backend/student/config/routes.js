import StudentIndex from '@/backend/student/views/Index.vue';
import StudentDocuments from '@/backend/student/views/Documents.vue';
import StudentCourse from '@/backend/student/views/Course.vue';

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
];

export default routes;