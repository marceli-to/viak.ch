import BackofficeInvoices from '@/backend/dashboard/views/backoffice/invoice/Index.vue';
import BackofficeInvoiceEdit from '@/backend/dashboard/views/backoffice/invoice/Edit.vue';

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
];

export default routes;
