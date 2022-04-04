<script>
    export default {
        name: "users-select",
        props  : ['data'],
    }
</script>
<template>
    <div class="d-flex align-items-center">
        <div class="mr-3 text-primary">
            <strong>#{{ data.row.id }}</strong>
        </div>
        <div class="p-1 border rounded-circle">
            <img v-if="data.row.image" style="width: 40px;height: 40px" :src="data.row.image.small" class="rounded-circle" alt="">
            <div style="width: 40px;height: 40px" v-else class="avatar-sm">
                <span class="avatar-title bg-light text-dark font-16 rounded-circle">
                    {{ data.row.avatar_name }}
                </span>
            </div>
        </div>
        <div class="my-0 ml-2">
            <div class="font-weight-bold">{{ data.row.name }} {{ data.row.last_name }} - {{ data.row.email }}</div>
            <div class="text-muted font-12">Created : {{ data.row.created_at }}</div>
        </div>
    </div>
</template>
