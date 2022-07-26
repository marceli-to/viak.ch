import DashboardIndex from '@/modules/dashboard/views/Index.vue';
import StudentIndex from '@/modules/dashboard/views/student/Index.vue';
import ExpertIndex from '@/modules/dashboard/views/expert/Index.vue';

const routes = [
  {
    name: '/',
    path: '/dashboard',
    component: DashboardIndex,
  },

  {
    name: 'students',
    path: '/dashboard/students',
    component: StudentIndex,
  },

  {
    name: 'experts',
    path: '/dashboard/experts',
    component: ExpertIndex,
  },

];

export default routes;