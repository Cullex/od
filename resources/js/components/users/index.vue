<script>
    import PageIndex from "../core/page-index";
    export default {
        components: {PageIndex}
    }
</script>
<template>
    <page-index url="/users" prefix="users" name="Users">
        <template slot="actions">
            <router-link to="/users/create" class="btn btn-primary ml-2">New User</router-link>
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
            <th>Last Name</th>
            <th>Email</th>
            <th>Date</th>
            <th class="text-center"></th>
        </template>
        <template slot="table-row" slot-scope="data">
            <td>
                <span class="text-primary">#{{ data.row.id }}</span>
            </td>
            <td>
                <div class="avatar-sm">
                    <span class="avatar-title bg-light text-dark font-15 rounded-circle">
                        {{ data.row.avatar_name }}
                    </span>
                </div>
            </td>
            <td>{{ data.row.name }}</td>
            <td>{{ data.row.last_name }}</td>
            <td>{{ data.row.email }}</td>
            <td>{{ data.row.created_at }}</td>
            <td>
                <router-link :to="`/users/${data.row.id}/view`" class="action-icon text-primary">
                    <i class="mdi mdi-eye mdi-24px"/>
                </router-link>
            </td>
        </template>
    </page-index>
</template>
