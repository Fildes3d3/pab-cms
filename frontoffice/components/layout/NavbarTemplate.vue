<template>
    <div
        v-if="navbarOpened"
        class="custom-navmenu"
    >
        <div class="container py-2 py-md-5">
            <div class="row align-items-start">
                <div class="col-md-2">
                    <ul class="custom-menu">
                        <li v-for="link in links">
                            <NuxtLink to="link">{{link}}</NuxtLink>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 d-none d-md-block  mr-auto">
                    <div class="d-flex">
                        <div><p><em>{{navContent}}</em></p></div>
                    </div>
                </div>
                <div class="col-md-4 d-none d-md-block">
                    <h3>{{navHeader}}</h3>
                    <p>{{navSecContent}}</p>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-light custom-navbar">
        <div class="container">
            <NuxtLink to="/" class="navbar-brand">PAB.</NuxtLink>
            <a href="#" class="burger" :class="{ active: navbarOpened}" @click="openNavbar">
                <span></span>
            </a>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            navbarOpened: false,
            ////////////////////
            links: ["Home", "Profile", "Work", "Passion", "Contact"],
            navContent: "Hello world. I'm Bogdan Web Developer by day and motorcycle rider by night or\n" +
                "                                    whenever I have some spare time :)",
            navHeader: "Need help with a project?",
            navSecContent: "Tell me about it <br> <a href=\"#\">popadrianbogdan@yahoo.com</a>"
            ///////////////////
        }
    },
    methods: {
        openNavbar() {
            this.navbarOpened = !this.navbarOpened
        }
    }
}
</script>
