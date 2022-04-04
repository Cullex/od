<template>
    <div style="overflow-y: scroll;height: 100%" class="bg-light">
        <div class="col-12 py-3">
            <div class="timeline">

                <div class="timeline-show mb-3">
                    <h5 class="m-0 time-show-name">Start</h5>
                </div>

                <div :key="item.id" v-for="item in data.content.data" class="timeline-lg-item font-12">
                    <div class="timeline-desk">
                        <div class="timeline-box">
                            <span class="arrow"></span>
                            <span class="timeline-icon"><i class="mdi mdi-adjust"></i></span>
                            <h5 class="mt-0 mb-0 font-16">
                                {{ item.event }} : {{ item.user.full_name }} - {{ item.user.email }} - <span class="text-primary">#{{ item.user.id }}</span>
                            </h5>
                            <p class="mb-3">
                                <span class="text-muted">Date : </span> {{ item.created_at }}<br>
                                <span class="text-muted">IP : </span> {{ item.ip_address }}<br>
                                <span class="text-muted">User Agent : </span> {{ item.user_agent }}<br>
                                <span class="text-muted">Url : </span> <span class="text-primary"> {{ item.url }} </span> <br>
                            </p>

                            <table v-if="Object.entries(item.old_values).length > 0 || Object.entries(item.new_values).length > 0 " class="table border-bottom border-right border-left">
                                <thead>
                                <tr>
                                    <th v-if="Object.entries(item.old_values).length > 0" class="w-50">Old</th>
                                    <th v-if="Object.entries(item.new_values).length > 0 " class="w-50">New</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td  v-if="Object.entries(item.old_values).length > 0"  class="">
                                        <div :key="`${i}-${k}-${item.id}-old-values`" v-for="(i , k ) in item.old_values"><span class="text-muted">{{ k.replace('_',' ') }} : </span>{{ i }}</div>
                                    </td>

                                    <td v-if="Object.entries(item.new_values).length > 0 "  class="">
                                        <div :key="`${i}-${k}-${item.id}-new-values`" v-for="(i , k ) in item.new_values"><span class="text-muted">{{ k.replace('_',' ') }} : </span>{{ i }}</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="timeline-show my-3">
                    <h5 class="m-0 time-show-name">
                        <a href="#" @click.prevent="data.append()" class="btn btn-sm btn-white">Load</a>
                    </h5>
                </div>


            </div>
            <!-- end timeline -->
        </div>
    </div>
</template>

<script>
    import Data from "../../core/data/Data";

    export default {
        name: "timeline",
        mounted() {
            this.data.fetch()
        },
        props : ['name'],
        data(){
            return {
                data : new Data({
                    url : `/${this.name}/${this.$route.params.id}/timeline`,
                    prefix : 'audits',
                })
            }
        }
    }
</script>


