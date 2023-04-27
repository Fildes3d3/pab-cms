import * as constants from "./constants";

export function getAllResources() {
    let resources = [];

    for (let key of Object.keys(constants)) {
        if (key.indexOf("RESOURCE_") === 0) {
            resources.push(constants[key])
        }
    }

    return resources
}
