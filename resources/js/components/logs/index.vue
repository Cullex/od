<script>
    import PageIndex from "../core/page-index";
    export default {
        components: {PageIndex}
    }
</script>
<template>
    <page-index url="/messages" prefix="messages" name="Messages">
        <template slot-scope="data" slot="filters">
            <div class="d-flex">
                <div class="form-group mr-3">
                    <select v-model="data.filters['status']" class="custom-select">
                        <option :value="undefined">Choose Status</option>
                        <option value="open">open</option>
                        <option value="closed">closed</option>
                    </select>
                </div>
                <div class="form-group mr-3">
                    <input type="text" v-model="data.filters['id']" class="form-control" placeholder="ID">
                </div>
            </div>
        </template>
        <template slot="sort-fields">
            <option value="created_at">Created</option>
            <option value="updated_at">Updated</option>
        </template>
        <template slot="table-header">
            <th></th>
            <th></th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Message</th>
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
                        {{ data.row.select_name }}
                    </span>
                </div>
            </td>
            <td>{{ data.row.name }}</td>
            <td>{{ data.row.phone }}</td>
            <td>{{ data.row.email }}</td>
            <td>{{ data.row.message | string_limit(20) }}</td>
            <td>{{ data.row.created_at }}</td>
            <td>
                <router-link :to="`/messages/${data.row.id}/view`" class="action-icon text-primary">
                    <i class="mdi mdi-eye mdi-24px"/>
                </router-link>
            </td>
        </template>
    </page-index>
</template>
