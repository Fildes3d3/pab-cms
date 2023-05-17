import {
    RESOURCE_PAGE,
    RESOURCE_BLOCK,
    RESOURCE_NAVIGATION_ITEM
} from '../constants'
import * as routes from '../router/routes'

const mapper = new Map()

mapper.set(RESOURCE_BLOCK, routes.BLOCK_EDIT)
mapper.set(RESOURCE_PAGE, routes.PAGE_EDIT)
mapper.set(RESOURCE_NAVIGATION_ITEM, routes.NAVIGATION_ITEM_EDIT)
export default mapper
