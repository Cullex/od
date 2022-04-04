<template>
    <fragment>
        <fragment v-if="can">
            <slot />
        </fragment>
    </fragment>
</template>
<script>
    export default {
        name: "can",
        props: ['permission' , 'override'],
        computed : {
            can : function (){
                return window.user.permissions.filter(e => e.name === this.permission ).length  >  0 || this.override;
            }
        }
    }
</script>
