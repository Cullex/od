<template>
    <div>
        <div class="card p-0">
            <ul class="nav nav-pills nav-justified bg-white">
                <slot name="links"/>
            </ul>
        </div>
        <div class="d-flex">
            <div class="flex-fill">
                <keep-alive>
                    <transition name="slide-in-left">
                        <router-view/>
                    </transition>
                </keep-alive>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "page-open",
    }
</script>

