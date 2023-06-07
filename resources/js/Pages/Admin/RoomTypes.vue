<script>

import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

export default {
    props: ["roomTypes"],
    components: { AdminLayout, InputError },

    data() {
        return {
            isShowPassword: false,
            isEdit: false,
            form: new useForm({
                name: '',
                description: '',
                id: '',
            }),
        }
    },
    methods: {
        edit(user) {
            this.isEdit = true;
            this.form = new useForm({
                id: user.id,
                name: user.name,
                description: user.description,
            });

        },

        submit() {
            if (this.isEdit) {
                this.form.put(route('admin.room-types.update', {
                    roomType: this.form.id
                }), {
                    onFinish: () => {
                        // location.reload();
                    },
                });
            } else {
                this.form.post(route('admin.room-types.store'), {
                    onFinish: () => {
                        // location.reload();
                    },
                });
            }

        },

        deleteRoomType(roomType) {

            if (confirm('Are you sure you want to delete this room type?')) {
                this.form.delete(route('admin.room-types.delete', {
                    roomType: roomType.id
                }));
            }

        },


    }
}
</script>

<template>
    <AdminLayout>
        <div class="page-content-wrapper p-xxl-4">

            <!-- Title -->
            <div class="row">
                <div class="col-12 mb-4 mb-sm-5">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-3 mb-sm-0">Room Types</h1>
                        <div class="d-grid"><a href="#" data-bs-toggle="modal" data-bs-target="#inquiryForm"
                                class="btn btn-primary mb-0"><i class="bi bi-filetype-pdf me-2"></i>Create Room Type</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters START -->
            <div class="row g-4 align-items-center">
                <!-- Tabs -->


                <!-- Search -->
                <div class="col-md-6 col-lg-6">
                    <form class="rounded position-relative">
                        <input class="form-control bg-transparent" type="search" placeholder="Search" aria-label="Search">
                        <button
                            class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
                            type="submit">
                            <i class="fas fa-search fs-6"></i>
                        </button>
                    </form>
                </div>

                <!-- Select -->

            </div>
            <!-- Filters END -->

            <!-- Guest list START -->
            <div class="card shadow mt-5">
                <!-- Card body START -->
                <div class="card-body">
                    <!-- Table head -->
                    <div class="bg-light rounded p-3 d-none d-lg-block">
                        <div class="row row-cols-7 g-4">
                            <div class="col">
                                <h6 class="mb-0">Name</h6>
                            </div>
                            <div class="col">
                                <h6 class="mb-0">Description</h6>
                            </div>
                            <div class="col">
                                <h6 class="mb-0">Created At</h6>
                            </div>

                            <div class="col">
                                <h6 class="mb-0">Action</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Table data -->
                    <div v-for="roomType in roomTypes"
                        class="row row-cols-xl-7 align-items-lg-center border-bottom g-4 px-2 py-4">


                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-lg-none">Name:</small>
                            <h6 class="mb-0 fw-normal">{{ roomType.name }}</h6>
                        </div>
                        <div class="col">
                            <small class="d-block d-lg-none">Description:</small>
                            <h6 class="mb-0 fw-normal">{{ roomType.description }}</h6>
                        </div>

                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-lg-none">Created At:</small>
                            <h6 class="mb-0 fw-normal">{{ roomType.created_at }}</h6>
                        </div>




                        <!-- Data item -->
                        <div class="col">
                            <a href="#" class="btn btn-sm btn-light mb-0" data-bs-toggle="modal"
                                data-bs-target="#inquiryForm" @click="edit(roomType)">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger mb-0" @click="deleteRoomType(roomType)">Delete</a>
                        </div>
                    </div>


                </div>
                <!-- Card body END -->

                <!-- Card footer START -->
                <div class="card-footer pt-0">

                </div>
            </div>

        </div>
        <div class="modal fade" id="inquiryForm" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Title -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="inquiryFormlabel">{{ isEdit ? `Edit Room Type ${form.name}`
                            : "Create New Room Type" }}</h5>
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
                                <label class="form-label">Description</label>
                                <textarea rows="3" class="form-control" v-model="form.description" />
                                <InputError class="mt-2" :message="form.errors.description" />
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
