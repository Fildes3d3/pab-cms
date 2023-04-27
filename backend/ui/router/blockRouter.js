import {
  BLOCK_EDIT,
  BLOCK_LIST,
  BLOCK_NEW,
  BLOCK_VIEW,
} from './routes'
const Container = () => import('@bo/components/Container.vue')
const List = () => import('@bo/block/List.vue')
const New = () => import('@bo/components/new/Base.vue')
const Edit = () => import('@bo/components/edit/Base.vue')
const View = () => import('@bo/components/view/Base.vue')

export const blockRoutes = [
  {
    path: 'blocks',
    component: Container,
    meta: {
      breadcrumb: 'Blocks'
    },
    children: [
      {
        path: '',
        name: BLOCK_LIST,
        component: List,
        props: true,
        meta: {
          breadcrumb: 'List'
        },
      },
      {
        path: 'new',
        name: BLOCK_NEW,
        component: New,
        props: true,
        meta: {
          breadcrumb: 'New',
        },
      },
      {
        path: ':id/edit',
        name: BLOCK_EDIT,
        component: Edit,
        props: route => ({ id: Number(route.params.id) }),
        meta: {
          breadcrumb: 'Edit',
        }
      },
      {
        path: ':id/view',
        name: BLOCK_VIEW,
        component: View,
        props: route => ({ id: Number(route.params.id) }),
        meta: {
          breadcrumb: 'View',
        }
      }
    ]
  }
]
