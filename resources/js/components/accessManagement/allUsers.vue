<template>
    <page-index url="/allUsers" prefix="users" name="System Users List">
        <template slot="actions">
            <a v-if="" target="_blank" href="/downloadIndividualRecords" class="btn btn-warning">Download List(Excel)</a>
        </template>
        <template slot="sort-fields">
            <option value="created_at">Created</option>
            <option value="updated_at">Updated</option>
        </template>
        <template slot="table-header">
            <th></th>
            <th>Name</th>
            <th>Surname</th>
            <th>Status</th>
            <th>Role</th>
            <th>Email</th>
            <th>Date Created</th>
            <th></th>
            <th class="text-center"></th>
        </template>
        <template slot="table-row" slot-scope="data">
            <td>
                <span class="text-primary">#{{ data.row.id }}</span>
            </td>
            <td>{{ data.row.name }}</td>
            <td>{{ data.row.last_name }}</td>
            <td>{{ data.row.status }}</td>
            <td>{{ data.row.accessLevel }}</td>
            <td>{{ data.row.email }}</td>
            <td>{{ data.row.created_at }}</td>
            <td>
                <router-link :to="`/accessManagement/editUser/${data.row.id}`" class="action-icon text-primary">
                    <i class="mdi mdi-eye mdi-24px"/>
                </router-link>
            </td>
        </template>
    </page-index>
</template>
<script>
import PageIndex from "../core/page-index";
export default {
    name: "allUsers",
    components : {PageIndex},
    data (){
        return {
            user: window.user,
        }
    },
}
</script>


