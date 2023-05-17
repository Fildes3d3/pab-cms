import {
  NAVIGATION_ITEM_LIST,
  NAVIGATION_ITEM_NEW,
  NAVIGATION_ITEM_EDIT,
} from './routes'
const Container = () => import('@bo/components/Container.vue')
const List = () => import('@bo/navigation/List.vue')
const New = () => import('@bo/components/new/Base.vue')
const Edit = () => import('@bo/components/edit/Base.vue')

export const navigationItemRoutes = [
  {
    path: 'navigation',
    component: Container,
    meta: {
      breadcrumb: 'Navigation Items'
    },
    children: [
      {
        path: '',
        name: NAVIGATION_ITEM_LIST,
        component: List,
        props: true,
        meta: {
          breadcrumb: 'List'
        },
      },
      {
        path: 'new',
        name: NAVIGATION_ITEM_NEW,
        component: New,
        props: true,
        meta: {
          breadcrumb: 'New',
        },
      },
      {
        path: ':id/edit',
        name: NAVIGATION_ITEM_EDIT,
        component: Edit,
        props: route => ({ id: Number(route.params.id) }),
        meta: {
          breadcrumb: 'Edit',
        }
      },
    ]
  }
]
