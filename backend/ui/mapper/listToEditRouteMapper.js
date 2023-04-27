import {
    RESOURCE_PAGE,
    RESOURCE_BLOCK
} from '../constants'
import * as routes from '../router/routes'

const mapper = new Map()

mapper.set(RESOURCE_BLOCK, routes.BLOCK_EDIT)
mapper.set(RESOURCE_PAGE, routes.PAGE_EDIT)
export default mapper
