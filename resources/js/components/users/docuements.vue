<script>
    import Documents from "../core/documents";
    export default {
        components: { Documents }
    }
</script>
<template>
   <documents :id="$route.params.id" type="owner"/>
</template>
