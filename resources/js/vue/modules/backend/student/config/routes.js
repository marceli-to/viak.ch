import StudentIndex from '@//modules/backend/student/views/Index.vue';
import StudentDocuments from '@//modules/backend/student/views/Documents.vue';
import StudentCourse from '@//modules/backend/student/views/Course.vue';

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
  {
    name: 'student-course-event',
    path: '/student/course/event/:uuid',
    component: StudentCourse,
  },
];

export default routes;