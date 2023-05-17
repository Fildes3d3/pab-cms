import {
  PAGE_LIST,
  PAGE_NEW,
  PAGE_EDIT,
} from './routes'
const Container = () => import('@bo/components/Container.vue')
const List = () => import('@bo/page/List.vue')
const New = () => import('@bo/components/new/Base.vue')
const Edit = () => import('@bo/components/edit/Base.vue')

export const pageRoutes = [
  {
    path: 'pages',
    component: Container,
    meta: {
      breadcrumb: 'Pages'
    },
    children: [
      {
        path: '',
        name: PAGE_LIST,
        component: List,
        props: true,
        meta: {
          breadcrumb: 'List'
        },
      },
      {
        path: 'new',
        name: PAGE_NEW,
        component: New,
        props: true,
        meta: {
          breadcrumb: 'New',
        }
      },
      {
        path: ':id/edit',
        name: PAGE_EDIT,
        component: Edit,
        props: route => ({ id: Number(route.params.id) }),
        meta: {
          breadcrumb: 'Edit',
        }
      },
    ]
  }
]
