import TeamMemberIndex from '@/backend/dashboard/views/team_member/Index.vue';
import TeamMemberCreate from '@/backend/dashboard/views/team_member/partials/Create.vue';
import TeamMemberEdit from '@/backend/dashboard/views/team_member/partials/Edit.vue';

const routes = [
  {
    name: 'team-members',
    path: '/dashboard/team-members',
    component: TeamMemberIndex,
  },
  {
    name: 'team-member-create',
    path: '/dashboard/team-member/create',
    component: TeamMemberCreate,
  },
  {
    name: 'team-member-edit',
    path: '/dashboard/team-member/edit/:id',
    component: TeamMemberEdit,
  },
];

export default routes;