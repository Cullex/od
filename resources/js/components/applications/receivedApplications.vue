<template>
    <page-index url="/receivedApplications" prefix="applications" name="Received Applications List">
        <template slot="actions">
            <a v-if="" target="_blank" href="/downloadIndividualRecords" class="btn btn-warning">Download List(Excel)</a>
        </template>
        <template slot="sort-fields">
            <option value="created_at">Created</option>
            <option value="updated_at">Updated</option>
        </template>
        <template slot="table-header">
            <th></th>
            <th>Applicant Name</th>
            <th>Applicant Surname</th>
            <th>Amount</th>
            <th>Status</th>
            <th>Date Applied</th>
            <th></th>
            <th class="text-center"></th>
        </template>
        <template slot="table-row" slot-scope="data">
            <td>
                <span class="text-primary">#{{ data.row.id }}</span>
            </td>
            <td>{{ data.row.applicantName }}</td>
            <td>{{ data.row.applicantSurname }}</td>
            <td>{{ data.row.vacancy }}</td>
            <td>{{ data.row.status }}</td>
            <td>{{ data.row.created_at }}</td>
            <td>
                <router-link :to="`/applications/viewApplication/${data.row.id}`" class="action-icon text-primary">
                    <i class="mdi mdi-eye mdi-24px"/>
                </router-link>
            </td>
        </template>
    </page-index>
</template>
<script>
import PageIndex from "../core/page-index";
export default {
    name: "receivedApplications",
    components : {PageIndex},
    data (){
        return {
            user: window.user,
        }
    },
}
</script>

