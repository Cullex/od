<template>
    <div class="">
        <div :class="['start border rounded font-weight-bold' , open ? 'open border-primary' : '']">
           <div v-if="false" class="d-flex align-items-center justify-content-between container-start p-1 px-3" @click="open = true" >
               <div class="mr-auto">Select Permissions</div>
               <div class="">
                   <i class="mdi mdi-circle-edit-outline mdi-24px"/>
               </div>
           </div>

        </div>
    </div>
</template>

<script>
    export default {
        name: "test-select",
        data()
        {
            return {
                open : true
            };
        }
    }
</script>

<style scoped>
    .container-start {
        width: 100%;
    }
     .start {
        max-width: 500px;
        transition: all .3s ease-in-out;
     }

    .open {
        max-width: 100%;
    }
</style>
