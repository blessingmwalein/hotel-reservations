<script>

import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

export default {
    props: ["users"],
    components: { AdminLayout, InputError },

    data() {
        return {
            isShowPassword: false,
            isEdit: false,
            form: new useForm({
                name: '',
                email: '',
                password: '',
                user_type: '',
                password_confirmation: '',
                phone_number: '',
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
                email: user.email,
                password: '',
                user_type: user.user_type,
                password_confirmation: '',
                phone_number: user.phone_number,
            });

        },

        submit() {
            if (this.isEdit) {
                this.form.put(route('admin.users.update', {
                    user: this.form.id
                }), {
                    onFinish: () => {
                        this.form.reset('password', 'password_confirmation');
                        // location.reload();
                    },

                });
            } else {
                this.form.post(route('admin.users.store'), {
                    onFinish: () => {
                        this.form.reset('password', 'password_confirmation')
                        // location.reload();


                    },
                });
            }

        },

        deleteUser(user) {

            if (confirm('Are you sure you want to delete this user?')) {
                this.form.delete(route('admin.users.delete', {
                    user: user.id
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
                        <h1 class="h3 mb-3 mb-sm-0">Users List</h1>
                        <div class="d-grid"><a href="#" data-bs-toggle="modal" data-bs-target="#inquiryForm"
                                class="btn btn-primary mb-0"><i class="bi bi-filetype-pdf me-2"></i>Create User</a> </div>
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
                                <h6 class="mb-0">Created Date</h6>
                            </div>
                            <div class="col">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col">
                                <h6 class="mb-0">Phone Number</h6>
                            </div>

                            <div class="col">
                                <h6 class="mb-0">User Type</h6>
                            </div>
                            <div class="col">
                                <h6 class="mb-0">Action</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Table data -->
                    <div v-for="user in users" class="row row-cols-xl-7 align-items-lg-center border-bottom g-4 px-2 py-4">
                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-lg-none">Booked by:</small>
                            <div class="d-flex align-items-center">
                                <!-- Avatar -->
                                <div class="avatar avatar-xs flex-shrink-0">
                                    <img class="avatar-img rounded-circle" src="/assets/images/user.png" alt="avatar">
                                </div>
                                <!-- Info -->
                                <div class="ms-2">
                                    <h6 class="mb-0 fw-light">{{ user.name }}</h6>
                                </div>
                            </div>
                        </div>

                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-lg-none">Created date:</small>
                            <h6 class="mb-0 fw-normal">{{ user.created_at }}</h6>
                        </div>

                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-lg-none">Email:</small>
                            <h6 class="mb-0 fw-normal">{{ user.email }}</h6>
                        </div>

                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-lg-none">Phone Number:</small>
                            <h6 class="mb-0 fw-normal">{{ user.phone_number }}</h6>
                        </div>



                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-lg-none">User Type:</small>
                            <div class="badge bg-success bg-opacity-10 text-success">{{ user.user_type }}</div>
                        </div>

                        <!-- Data item -->
                        <div class="col">
                            <a href="#" class="btn btn-sm btn-light mb-0" data-bs-toggle="modal"
                                data-bs-target="#inquiryForm" @click="edit(user)">Edit</a>
                            <a href="#" class="btn btn-sm btn-danger mb-0" @click="deleteUser(user)">Delete</a>
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
                        <h5 class="modal-title" id="inquiryFormlabel">{{ isEdit ? `Edit user ${form.name}`
                            : "Create New User" }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body p-3">
                        <form class="mt-4 text-start" @submit.prevent="submit">
                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Full name</label>
                                <input type="text" class="form-control" v-model="form.name">
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone number</label>
                                <input type="text" class="form-control" v-model="form.phone_number">
                                <InputError class="mt-2" :message="form.errors.phone_number" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Enter email</label>
                                <input type="email" class="form-control" v-model="form.email">
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>
                            <div class="form-floating">
                                <select v-model="form.user_type" class="form-select" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option selected>Open this select menu</option>
                                    <option value="customer">Customer</option>
                                    <option value="admin">Clerk</option>
                                </select>
                                <label for="floatingSelect">User Type</label>
                            </div>
                            <!-- Password -->
                            <div class="mb-3 position-relative">
                                <label class="form-label">Enter password</label>
                                <input class="form-control fakepassword" v-model="form.password" type="password"
                                    id="psw-input">
                                <span @click="toogleShowPassword()"
                                    class="position-absolute top-50 end-0 translate-middle-y p-0 mt-3">
                                    <i class="fakepasswordicon fas fa-eye-slash cursor-pointer p-2"></i>
                                </span>
                                <InputError class="mt-2" :message="form.errors.password" />

                            </div>
                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input v-model="form.password_confirmation" type="password" class="form-control">

                                <InputError class="mt-2" :message="form.errors.password_confirmation" />

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
