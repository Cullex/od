<script>
    import Gallery from "../core/gallery";
    export default {
        components: { Gallery }
    }
</script>
<template>
   <gallery :id="$route.params.id" type="owner"/>
</template>
