import TeamMemberIndex from '@/backend/dashboard/views/team_member/Index.vue';
import TeamMemberCreate from '@/backend/dashboard/views/team_member/partials/Create.vue';
import TeamMemberEdit from '@/backend/dashboard/views/team_member/partials/Edit.vue';

const routes = [
  {
    name: 'content-team-members',
    path: '/dashboard/team-members',
    component: TeamMemberIndex,
  },
  {
    name: 'content-team-member-create',
    path: '/dashboard/team-member/create',
    component: TeamMemberCreate,
  },
  {
    name: 'content-team-member-edit',
    path: '/dashboard/team-member/edit/:id',
    component: TeamMemberEdit,
  },
];

export default routes;