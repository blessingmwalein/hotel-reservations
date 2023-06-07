<script>

import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import Multiselect from '@vueform/multiselect'

export default {
    props: ["rooms", "roomTypes", "amenities"],
    components: { AdminLayout, InputError, Multiselect },

    data() {
        return {
            isShowPassword: false,
            isEdit: false,
            options: [

            ],
            statutes: [
                'Available',
                'Unavailable',
                'Maintenance',
            ],
            form: new useForm({
                name: '',
                description: '',
                location: '',
                room_type_id: '',
                status: '',
                unit_price: 0,
                images: [],
                amenities: [],
                id: '',
            }),
        }
    },
    mounted() {
        this.options = this.amenities.map((amenity) => {
            return {
                value: amenity.id,
                label: amenity.name,
            }
        });
    },
    methods: {
        edit(room) {
            this.isEdit = true;
            this.form = new useForm({
                id: room.id,
                name: room.name,
                description: room.description,
                location: room.location,
                room_type_id: room.room_type_id,
                status: room.status,
                unit_price: room.unit_price,
            });

        },

        submit() {
            if (this.isEdit) {
                this.form.put(route('admin.rooms.update', {
                    room: this.form.id
                }), {
                    onFinish: () => {
                        // location.reload();
                    },
                });
            } else {
                this.form.post(route('admin.rooms.store'), {
                    onFinish: () => {
                        // location.reload();
                    },
                });
            }
        },

        deleteRoom(room) {

            if (confirm('Are you sure you want to delete this room?')) {
                this.form.delete(route('admin.rooms.delete', {
                    room: room.id
                }));
            }

        },

        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.form.images = files;
        },



    }
}
</script>

<template>
    <AdminLayout>
        <div class="page-content-wrapper p-xxl-4">

            <!-- Title -->
            <div class="row">
                <div class="col-12 mb-5">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-2 mb-sm-0">Rooms</h1>
                        <div class="d-grid"><a href="#" class="btn btn-primary-soft mb-0" data-bs-toggle="modal"
                                data-bs-target="#inquiryForm"><i class="bi bi-plus-lg fa-fw"></i> Add New Room</a></div>
                    </div>
                </div>
            </div>
            <!-- Tabs and search START -->
            <div class="row g-4 justify-content-between align-items-center">

                <div class="col-lg-6 col-xxl-6">
                    <div class="d-sm-flex gap-4 justify-content-between justify-content-lg-end">
                        <!-- Search -->
                        <div class="col-md-12">
                            <form class="rounded position-relative">
                                <input class="form-control bg-transparent" type="search" placeholder="Search"
                                    aria-label="Search">
                                <button
                                    class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
                                    type="submit">
                                    <i class="fas fa-search fs-6"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Tabs and search END -->

            <!-- Tab content START -->
            <div class="tab-content mt-5" id="myTabContent">

                <div class="tab-pane fade show active" id="grid-tab-pane">
                    <!-- Rooms START -->
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xxl-5 g-4">
                        <!-- Room item -->
                        <div class="col" v-for="room in rooms">
                            <div class="card shadow h-100">
                                <!-- Overlay item -->
                                <div class="position-relative">
                                    <!-- Image -->
                                    <img :src="`/storage/images/${room?.images[0]?.image_path}`" class="card-img-top"
                                        alt="Card image">
                                    <!-- Overlay -->
                                    <div class="card-img-overlay d-flex flex-column p-3">
                                        <!-- Card overlay top -->
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="badge text-bg-dark"><i
                                                    class="bi fa-fw bi-star-fill me-2 text-warning"></i>4.5</div>
                                            <!-- Buttons -->
                                            <div class="list-inline-item dropdown">
                                                <!-- Dropdown button -->
                                                <a href="#" class="btn btn-sm btn-round btn-light" role="button"
                                                    id="dropdownAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </a>
                                                <!-- dropdown items -->
                                                <ul class="dropdown-menu dropdown-menu-end min-w-auto shadow rounded small"
                                                    aria-labelledby="dropdownAction1">
                                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#inquiryForm" @click="edit(room)"><i
                                                                class="bi bi-info-circle me-2"></i>Edit</a></li>
                                                    <li><a class="dropdown-item" href="#" @click="deleteRoom(room)"><i
                                                                class="bi bi-slash-circle me-2"></i>Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Card body START -->
                                <div class="card-body px-3">
                                    <!-- Title -->
                                    <h5 class="card-title mb-1"><a href="#">{{ room.name }}</a></h5>
                                    <ul class="list-group list-group-borderless small mt-2 mb-0">
                                        <li class="list-group-item pb-0" v-for="amenity in room.amenities">
                                            <i class="fa-solid fa-building fa-fw me-2"></i>{{ amenity.amenity.name }}
                                        </li>

                                    </ul>
                                </div>
                                <!-- Card body END -->

                                <!-- Card footer START-->
                                <div class="card-footer pt-0">
                                    <!-- Price -->
                                    <div class="hstack gap-2 mb-2">
                                        <h6 class="fw-normal mb-0">${{ room.unit_price }}</h6>
                                        <small>/per person</small>
                                    </div>
                                    <a href="#" class="btn btn-sm btn-primary-soft mb-0 w-100">View
                                        detail</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- Tab content END -->
        </div>
        <div class="modal fade" id="inquiryForm" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Title -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="inquiryFormlabel">{{ isEdit ? `Edit Room ${form.name}`
                            : "Create New Room" }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body p-3">
                        <form class="mt-4 text-start" @submit.prevent="submit">
                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" v-model="form.name">
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Unit price</label>
                                <input type="number" class="form-control" v-model="form.unit_price">
                                <InputError class="mt-2" :message="form.errors.unit_price" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea rows="3" class="form-control" v-model="form.description" />
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Amenities</label>
                                <Multiselect v-model="form.amenities" mode="multiple" :close-on-select="false"
                                    :options="options" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Location</label>
                                <textarea rows="3" class="form-control" v-model="form.location" />
                                <InputError class="mt-2" :message="form.errors.location" />
                            </div>

                            <div class="mb-3">
                                <label for="floatingSelect">Room Type</label>

                                <select v-model="form.room_type_id" class="form-control" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option selected>Open this select menu</option>
                                    <option v-for="roomType in roomTypes" :value="roomType.id">{{ roomType.name }}</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="floatingSelect">Status</label>

                                <select v-model="form.status" class="form-control" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option selected>Open this select menu</option>
                                    <option v-for="status in statutes" :value="status">{{ status }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="file" class="form-control" @change="onFileChange" multiple>
                            </div>


                            <div><button type="submit" class="btn btn-primary w-100 mb-0" :disabled="form.processing"
                                    :class="{ 'opacity-25': form.processing }">Submit</button></div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<style src="@vueform/multiselect/themes/default.css"></style>
