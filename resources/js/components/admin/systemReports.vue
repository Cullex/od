<template>
    <div class="col-lg-12">
        <div style="height: 650px; overflow-y: auto" class="card" >
            <div class="">
                <h6 class="text-muted px-3 py-2 text-uppercase">Audit Trail</h6>
            </div>
            <div class="table-responsive font-12">
                <table class="table table-centered">
                    <thead class="thead-light">
                    <tr>
                        <th />
                        <th />
                        <th>#</th>
                        <th>user_id</th>
                        <th>event</th>
                        <th>auditable_type</th>
                        <th>auditable_id</th>
                        <th>new_values</th>
                        <th>old_values</th>
                        <th>url</th>
                        <th>user_agent</th>
                        <th>created_at</th>

                        <th>updated_at</th>
                        <th />
                        <th />
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="report in reports" :key="report.id">
                        <td />
                        <td class="text-primary"></td>
                        <td>
                            {{ report.id }}
                        </td>
                        <td class="font-weight-bolder">
                            {{ report.user_id }}
                        </td>
                        <td> <span class="badge badge-light p-2">{{ report.event}}</span>
                        </td>
                        <td class="font-weight-bolder">
                            {{ report.auditable_type }}
                        </td>
                        <td class="font-weight-bolder">
                            {{ report.auditable_id }}
                        </td>
                        <td class="font-weight-bolder">
                            {{ report.new_values }}
                        </td>
                        <td class="font-weight-bolder">
                            {{ report.old_values }}
                        </td>

                        <td class="font-weight-bolder">
                            {{ report.url }}
                        </td>
                        <td class="font-weight-bolder">
                            {{ report.user_agent }}
                        </td>

                        <td class="font-weight-bolder">
                            {{ report.created_at }}
                        </td>
                        <td class="font-weight-bolder">
                            {{ report.updated_at }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>
<script>
export default {
    data() {
        return {
            reports: [],
        };
    },
    mounted() {
        //return reports from DB
        window.axios.get('systemReports').then((response) =>{
            this.reports = response.data.body.reports
            console.log(response)
        }).then((errors) =>{
            console.log(errors)
        })
    },
};
</script>


