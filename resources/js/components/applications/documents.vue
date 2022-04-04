<script>
import Document from "../core/documents";
export default {
    components: { Document },
    data(){
        return {
            auth: window.user,
        }
    },
}
</script>
<template>
    <document :id="auth.id" type="application"/>
</template>

