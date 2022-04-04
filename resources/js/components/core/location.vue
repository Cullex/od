<script>
    import Form from "../../core/forms/form";

    export default {
        name: "location",
        props : ['type' , 'id'],
        data() {
            return {
                loading: true,
                form : new Form({
                   city : '',
                   address : '',
                   latitude : '',
                   longitude : '',
                }),
                zoom : 6,
                center: {
                    lat: -19.0169211,
                    lng: 29.1528018
                },
                place: null,
                location : {},
                edit : false,
            };
        },
        methods : {
            init ()
            {
                this.loading = true;
                window.axios.get(`${window.location.origin}/locations/${this.id}/${this.type}/view`).then((response) => {
                    this.location = response.data.body.model;
                    if (this.location)
                    {
                        this.zoom = 14;
                        this.form.extract(response.data.body.model);
                        this.center = {
                            lat: response.data.body.model.latitude,
                            lng: response.data.body.model.longitude
                        };
                        this.edit = true;
                    } else {
                        this.edit = false;
                    }
                }).finally(() => {
                    this.loading = false;
                });
            },
            create()
            {
                this.form.submit(this.edit ? `/locations/${this.location.id}/update`  : `/locations/${this.id}/${this.type}/create`).then((response) => {
                    window.alerts.success(response).then((response) => {
                        this.location = response.data.body.model;
                        this.zoom = 14;
                        this.center = {
                            lat: response.data.body.model.latitude,
                            lng: response.data.body.model.longitude
                        };
                        this.edit = true;
                    });
                }).catch((error) => {
                }).finally(() => {
                });
            },
            setPlace(place)
            {
                if (place != null)
                {
                    this.place = place;
                    console.log(place);
                    this.center = {
                        lat: this.place.geometry.location.lat(),
                        lng: this.place.geometry.location.lng()
                    };
                    this.zoom = 14;
                    this.form.address = place.formatted_address;
                    this.form.latitude = this.center.lat;
                    this.form.longitude = this.center.lng;
                }
            },
            drag(e)
            {
                this.center = {
                    lat: e.latLng.lat(),
                    lng: e.latLng.lng()
                };
                this.zoom = 14;
                this.form.latitude = this.center.lat;
                this.form.longitude = this.center.lng;
            }
        },
        mounted() {
            this.init();
        }
    }
</script>
<template>
    <div :class="['dimmer' , loading ? 'active' : '']">
        <div class="loader"></div>
        <div class="dimmer-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ribbon-box ">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3 flex-wrap">
                                <h4 class="header-title m-0 flex-fill">Location Information</h4>
                            </div>
                            <div class="text-left">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <select name="" v-model="form.city" :class="['form-control rounded-0' , form.errors.get('city') ? 'is-invalid' : '' ]" id="">
                                                <option value="">Choose City</option>
                                                <option value="Harare">Harare</option>
                                                <option value="Bulawayo">Bulawayo</option>
                                                <option value="Mutare">Mutare</option>
                                                <option value="Epworth">Epworth</option>
                                                <option value="Gweru">Gweru</option>
                                                <option value="Kwekwe">Kwekwe</option>
                                                <option value="Kadoma">Kadoma</option>
                                                <option value="Masvingo">Masvingo</option>
                                                <option value="Chinhoyi">Chinhoyi</option>
                                                <option value="Norton">Norton</option>
                                                <option value="Marondera">Marondera</option>
                                                <option value="Chegutu">Chegutu</option>
                                                <option value="Zvishavane">Zvishavane</option>
                                                <option value="Bindura">Bindura</option>
                                                <option value="Beitbridge">Beitbridge</option>
                                                <option value="Redcliff">Redcliff</option>
                                                <option value="Victoria Falls">Victoria Falls</option>
                                                <option value="Hwange">Hwange</option>
                                                <option value="Rusape">Rusape</option>
                                                <option value="Chiredzi">Chiredzi</option>
                                                <option value="Kariba">Kariba</option>
                                                <option value="Karoi">Karoi</option>
                                                <option value="Chipinge">Chipinge</option>
                                                <option value="Gokwe">Gokwe</option>
                                                <option value="Shurugwi">Shurugwi</option>
                                            </select>
                                            <div v-text="form.errors.get('city')" class="invalid-feedback"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <textarea v-model="form.address" :class="['form-control rounded-0' , form.errors.get('address') ? 'is-invalid' : '' ]"></textarea>
                                            <div v-text="form.errors.get('address')" class="invalid-feedback"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Latitude</label>
                                            <input type="text" v-model="form.latitude" :class="['form-control rounded-0' , form.errors.get('latitude') ? 'is-invalid' : '' ]"/>
                                            <div v-text="form.errors.get('latitude')" class="invalid-feedback"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Longitude</label>
                                            <input type="text" v-model="form.longitude"  :class="['form-control rounded-0' , form.errors.get('longitude') ? 'is-invalid' : '' ]"/>
                                            <div v-text="form.errors.get('longitude')" class="invalid-feedback"/>
                                        </div>
                                        <div class="form-group text-center">
                                            <button @click.prevent="create" :class="['btn btn-primary px-4' , form.loading ? 'btn-loading' : '']">{{ this.edit ? 'Edit' : 'Create' }} Location</button>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <GmapAutocomplete
                                            placeholder="Search for place"
                                            class="form-control rounded-0 mb-3"
                                            @place_changed="setPlace"
                                        />
                                        <GmapMap
                                            :center="center"
                                            :zoom="zoom"
                                            map-type-id="roadmap"
                                            class="g-map-container"
                                        >
                                            <GmapMarker
                                                :position="center"
                                                :clickable="true"
                                                :draggable="true"
                                                @dragend="drag"
                                            />
                                        </GmapMap>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
