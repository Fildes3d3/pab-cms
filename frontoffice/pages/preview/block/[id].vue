<template>
    <div v-if="pending">
        Loading ...
    </div>
    <div v-else>
        <div v-if="block.type === 'text'">
            <div v-if="block.settings.type === 'default'">
                <p v-if="block.content.text" class="lead">{{block.content.text}}</p>
                <p v-if="!block.content.text" class="lead">{{block.settings.placeholder.text}}</p>
            </div>
        </div>
        <div v-if="block.type === 'horizontalRule'">
            <hr class="featurette-divider">
        </div>
    </div>
</template>
<script setup>
definePageMeta({
    layout: "Preview",
});

const runtimeConfig = useRuntimeConfig()

import {useLazyFetch} from "#app";

const route = useRoute()
const { pending, data: block } = useLazyFetch(runtimeConfig.public.apiBase + '/block/preview/' + route.params.id)
</script>
