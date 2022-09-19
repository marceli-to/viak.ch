import SettingsIndex from '@/modules/dashboard/views/setting/Index.vue';
import CategoryCreate from '@/modules/dashboard/views/setting/category/partials/Create.vue';
import CategoryEdit from '@/modules/dashboard/views/setting/category/partials/Edit.vue';
import LanguageCreate from '@/modules/dashboard/views/setting/language/partials/Create.vue';
import LanguageEdit from '@/modules/dashboard/views/setting/language/partials/Edit.vue';
import LevelCreate from '@/modules/dashboard/views/setting/level/partials/Create.vue';
import LevelEdit from '@/modules/dashboard/views/setting/level/partials/Edit.vue';
import SoftwareCreate from '@/modules/dashboard/views/setting/software/partials/Create.vue';
import SoftwareEdit from '@/modules/dashboard/views/setting/software/partials/Edit.vue';
import TagCreate from '@/modules/dashboard/views/setting/tag/partials/Create.vue';
import TagEdit from '@/modules/dashboard/views/setting/tag/partials/Edit.vue';


const routes = [
  {
    name: 'settings',
    path: '/dashboard/settings/:type?',
    component: SettingsIndex,
  },
  {
    name: 'settings-category-create',
    path: '/dashboard/settings/category/create',
    component: CategoryCreate,
  },
  {
    name: 'settings-category-edit',
    path: '/dashboard/settings/category/edit/:id',
    component: CategoryEdit,
  },
  {
    name: 'settings-language-create',
    path: '/dashboard/settings/language/create',
    component: LanguageCreate,
  },
  {
    name: 'settings-language-edit',
    path: '/dashboard/settings/language/edit/:id',
    component: LanguageEdit,
  },
  {
    name: 'settings-level-create',
    path: '/dashboard/settings/level/create',
    component: LevelCreate,
  },
  {
    name: 'settings-level-edit',
    path: '/dashboard/settings/level/edit/:id',
    component: LevelEdit,
  },  
  {
    name: 'settings-software-create',
    path: '/dashboard/settings/software/create',
    component: SoftwareCreate,
  },
  {
    name: 'settings-software-edit',
    path: '/dashboard/settings/software/edit/:id',
    component: SoftwareEdit,
  }, 
  {
    name: 'settings-tag-create',
    path: '/dashboard/settings/tag/create',
    component: TagCreate,
  },
  {
    name: 'settings-tag-edit',
    path: '/dashboard/settings/tag/edit/:id',
    component: TagEdit,
  }, 
];

export default routes;
