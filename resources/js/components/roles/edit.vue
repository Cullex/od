<script>
    import RoleForm from "./form";
    export default {
        components: {RoleForm}
    }
</script>
<template>
    <role-form :id="$route.params.id" :edit="true"/>
</template>
