<script>
    import UserForm from "./form";
    export default {
        components: {UserForm}
    }
</script>
<template>
    <user-form :id="$route.params.id" :edit="true"/>
</template>
