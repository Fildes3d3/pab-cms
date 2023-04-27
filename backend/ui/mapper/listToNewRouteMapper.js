import {
    RESOURCE_PAGE,
    RESOURCE_BLOCK
} from '../constants'
import * as routes from '../router/routes'

const mapper = new Map()

mapper.set(RESOURCE_BLOCK, routes.BLOCK_NEW)
mapper.set(RESOURCE_PAGE, routes.PAGE_NEW)
export default mapper
