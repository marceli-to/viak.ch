import BackofficeInvoices from '@/backend/dashboard/views/backoffice/invoice/Index.vue';
import BackofficeInvoiceEdit from '@/backend/dashboard/views/backoffice/invoice/Edit.vue';
import BackofficeExports from '@/backend/dashboard/views/backoffice/export/Index.vue';

const routes = [
  {
    name: 'backoffice-invoices',
    path: '/dashboard/backoffice/invoices',
    component: BackofficeInvoices,
  },
  {
    name: 'backoffice-invoice-edit',
    path: '/dashboard/backoffice/invoice/edit/:id',
    component: BackofficeInvoiceEdit,
  },
  {
    name: 'backoffice-exports',
    path: '/dashboard/backoffice/exports',
    component: BackofficeExports,
  },
];

export default routes;
