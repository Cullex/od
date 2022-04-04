<script>
    export default {
        name: "roles-select",
        props  : ['data'],
    }
</script>
<template>
    <div class="d-flex align-items-center">
        <div class="mr-3 text-primary">
            <strong>#{{ data.row.id }}</strong>
        </div>
        <div class="my-0 ml-2">
            <div class="font-weight-bold">{{ data.row.select_name}}</div>
            <div class="text-muted font-12">Created : {{ data.row.created_at }}</div>
        </div>
    </div>
</template>
