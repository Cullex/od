<template>
    <page-index url="/showVacancies" prefix="vacancies" name="Posted Vacancies">
        <template slot="actions">
            <a v-if="" target="_blank" href="/downloadIndividualRecords" class="btn btn-warning">Download List(Excel)</a>
        </template>
        <template slot="sort-fields">
            <option value="created_at">Created</option>
            <option value="updated_at">Updated</option>
        </template>
        <template slot="table-header">
            <th></th>
            <th>Title</th>
            <th>Department</th>
            <th>Category</th>
            <th>Date Posted</th>
            <th></th>
            <th class="text-center"></th>
        </template>
        <template slot="table-row" slot-scope="data">
            <td>
                <span class="text-primary">#{{ data.row.id }}</span>
            </td>
            <td>{{ data.row.title }}</td>
            <td>{{ data.row.department }}</td>
            <td>{{ data.row.category }}</td>
            <td>{{ data.row.created_at }}</td>
            <td>
                <router-link :to="`/vacancies/viewVacancy/${data.row.id}`" class="action-icon text-primary">
                    <i class="mdi mdi-eye mdi-24px"/>
                </router-link>
            </td>
        </template>
    </page-index>
</template>
<script>
import PageIndex from "../core/page-index";
export default {
    name: "dashboard",
    components : {PageIndex},
    data (){
        return {
            user: window.user,
        }
    },
}
</script>
