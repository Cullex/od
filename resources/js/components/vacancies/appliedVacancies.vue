<template>
    <page-index url="/appliedVacancies" prefix="appliedVacancies" name="Applied Vacancies List">
        <template slot-scope="data" slot="filters">

        </template>
        <template slot="sort-fields">
            <option value="created_at">Created</option>
            <option value="updated_at">Updated</option>
        </template>
        <template slot="table-header">
            <th></th>
            <th>Vacancy</th>
            <th>Application Status</th>
            <th>Date Applied</th>
            <th></th>
            <th class="text-center"></th>
        </template>
        <template slot="table-row" slot-scope="data">
            <td>
                <span class="text-primary">#{{ data.row.id }}</span>
            </td>
            <td>{{ data.row.vacancy }}</td>
            <td>{{ data.row.status }}</td>
            <td>{{ data.row.created_at }}</td>
            <td>
                <router-link :to="`/applications/revokeApplication/${data.row.id}`" class="action-icon text-primary">
                    <i class="mdi mdi-eye mdi-24px"/>
                </router-link>
            </td>
        </template>
    </page-index>
</template>
<script>
import PageIndex from "../core/page-index";
export default {
    name: "appliedVacancies",
    components : {PageIndex},
    data (){
        return {
            user: window.user,
        }
    },
}
</script>
