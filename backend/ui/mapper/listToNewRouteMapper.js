import {
    RESOURCE_PAGE,
    RESOURCE_BLOCK,
    RESOURCE_NAVIGATION_ITEM
} from '../constants'
import * as routes from '../router/routes'

const mapper = new Map()

mapper.set(RESOURCE_BLOCK, routes.BLOCK_NEW)
mapper.set(RESOURCE_PAGE, routes.PAGE_NEW)
mapper.set(RESOURCE_NAVIGATION_ITEM, routes.NAVIGATION_ITEM_NEW)
export default mapper
