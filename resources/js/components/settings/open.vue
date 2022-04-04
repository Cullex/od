<script>
    import PageOpen from "../core/page-open";
    export default {
        name: "settings-view",
        components: {PageOpen},
        data()
        {
            return {
              window : window
            };
        }
    }
</script>
<template>
    <page-open>
        <template slot="links">
            <li class="nav-item">
                <router-link exact to="/settings" active-class="active" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="mdi mdi-account font-18 "></i>
                    <span class="d-none d-lg-block">Account Profile</span>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link exact to="/password" active-class="active" data-toggle="tab" aria-expanded="false" class="nav-link rounded-0">
                    <i class="mdi mdi-lock font-18 "></i>
                    <span class="d-none d-lg-block">Password</span>
                </router-link>
            </li>
        </template>
    </page-open>

</template>

