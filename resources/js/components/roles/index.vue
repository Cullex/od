<script>
    import PageIndex from "../core/page-index";
    export default {
        components: {PageIndex}
    }
</script>
<template>
    <page-index url="/roles" prefix="roles" name="Roles">
        <template slot="actions">
            <router-link to="/roles/create" class="btn btn-primary ml-2">New Role</router-link>
        </template>
        <template slot-scope="data" slot="filters">

        </template>
        <template slot="sort-fields">
            <option value="created_at">Created</option>
            <option value="updated_at">Updated</option>
        </template>
        <template slot="table-header">
            <th></th>
            <th></th>
            <th>Name</th>
            <th>Date</th>
            <th class="text-center"></th>
        </template>
        <template slot="table-row" slot-scope="data">
            <td>
                <span class="text-primary">#{{ data.row.id }}</span>
            </td>
            <td>
                <div class="avatar-md">
                    <span class="avatar-title bg-light text-dark font-22 rounded-circle">
                        {{ data.row.avatar_name }}
                    </span>
                </div>
            </td>
            <td>
                <div class="">{{ data.row.name }}</div>
            </td>
            <td>{{ data.row.created_at }}</td>
            <td>
                <router-link :to="`/roles/${data.row.id}/view`" class="action-icon text-primary">
                    <i class="mdi mdi-eye mdi-24px"/>
                </router-link>
            </td>
        </template>
    </page-index>
</template>
