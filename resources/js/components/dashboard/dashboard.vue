<template>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-5">
                <div class="min-h-135px card cta-box bg-primary text-white">
                    <div class="card-body">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h3 class="m-0 font-weight-normal cta-box-title">Welcome back , <b> {{ user.name }}
                                </b> <br>OVERDRAFTS APPLICATIONS MANAGEMENT</h3>
                                <p class="mt-2">Overdrafts Management Made Easy<br></p>
                            </div>
                            <img class="ml-3" src="/assets/images/email-campaign.svg" width="120" alt="Generic placeholder image">
                        </div>
                    </div>
                    <!-- end card-body -->
                </div>
            </div>

            <div class="col-lg-7">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <router-link to="/applications/receivedApplications" class="card">
                                <div class="card-body py-0">
                                    <div class="d-flex align-items-center px-3 py-1">
                                        <div class="flex-fill">
                                            <h5 class="my-2 py-1  text-center">Received Applications</h5>
                                        </div>
                                        <div class="">
                                            <i class="font-28 uil-comment-alt-verify text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                        <div class="col-md-6">
                            <router-link to="/applications/shortlisted" class="card">
                                <div class="card-body py-0">
                                    <div class="d-flex align-items-center px-3 py-1">
                                        <div class="flex-fill">
                                            <h5 class="my-2 py-1 text-center">Approved Applications</h5>
                                        </div>
                                        <div class="">
                                            <i class="font-28   uil-trees  text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                        <div class="col-md-6 ">
                            <router-link to="/" class="card">
                                <div class="card-body py-0">
                                    <div class="d-flex align-items-center px-3 py-1">
                                        <div class="flex-fill">
                                            <h5 class="my-2 py-1 text-center">Rejected Applications</h5>
                                        </div>
                                        <div class="">
                                            <i class="font-28   uil-star-half-alt  text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                        <div class="col-md-6">
                            <router-link to="/" class="card">
                                <div class="card-body py-0">
                                    <div class="d-flex align-items-center px-3 py-1">
                                        <div class="flex-fill">
                                            <h5 class="my-2 py-1 text-center">System Reports</h5>
                                        </div>
                                        <div class="">
                                            <i class="font-28   uil-selfie  text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>

            <page-index url="/receivedOverdraftApplications" prefix="applications" name="Received Applications">
                <template slot="actions">
                    <a v-if="" target="_blank" href="/downloadOverdraftApplicationsList" class="btn btn-warning">Download List(Excel)</a>
                </template>
                <template slot="sort-fields">
                    <option value="created_at">Created</option>
                    <option value="updated_at">Updated</option>
                </template>
                <template slot="table-header">
                    <th></th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Overdraft Tenure</th>
                    <th>Account #</th>
                    <th>Amount</th>
                    <th></th>
                    <th class="text-center"></th>
                </template>
                <template slot="table-row" slot-scope="data">
                    <td>
                        <span class="text-primary">#{{ data.row.id }}</span>
                    </td>
                    <td>{{ data.row.last_name }}</td>
                    <td>{{ data.row.first_name }}</td>
                    <td>{{ data.row.overdraft_tenure }}</td>
                    <td>{{ data.row.account_number }}</td>
                    <td>{{ data.row.amount }}</td>
                    <td>
                        <router-link :to="`/applications/viewOverdraftApplication/${data.row.id}`" class="action-icon text-primary">
                            <i class="mdi mdi-eye mdi-24px"/>
                        </router-link>
                    </td>
                </template>
            </page-index>
        </div>
    </div>
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
