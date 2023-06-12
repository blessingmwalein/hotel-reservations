<script>

import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

export default {
    props: ["reservations", "users", "rooms"],
    components: { AdminLayout, InputError },

    data() {
        return {
            isShowPassword: false,
            isEdit: false,
            form: new useForm({
                room_id: '',
                user_id: '',
                check_in_date: '',
                check_out_date: '',
                number_of_guests: '',
                status: '',
                id: '',
            }),
        }
    },
    methods: {
        edit(reservation) {
            this.isEdit = true;
            this.form = new useForm({
                room_id: reservation.room_id,
                user_id: reservation.user_id,
                check_in_date: reservation.check_in_date,
                check_out_date: reservation.check_out_date,
                number_of_guests: reservation.number_of_guests,
                status: reservation.status,
                id: reservation.id,
            });
        },

        submit() {
            if (this.isEdit) {
                this.form.put(route('admin.reservations.update', {
                    reservation: this.form.id
                }), {
                    onFinish: () => {
                        this.form.reset('password', 'password_confirmation');
                        // location.reload();
                    },

                });
            } else {
                this.form.post(route('admin.reservations.store'), {
                    onFinish: () => {
                        this.form.reset('password', 'password_confirmation')
                        // location.reload();


                    },
                });
            }

        },

        deleteReservation(reservation) {
            if (confirm('Are you sure you want to delete this reservation?')) {
                this.form.delete(route('admin.reservations.delete', {
                    reservation: reservation.id
                }));
            }
        },
        approve(reservation) {
            if (confirm('Are you sure you want to approve this reservation?')) {
                this.form.post(route('admin.reservations.approve', {
                    reservation: reservation.id
                }));
            }
        },
        cancel(reservation) {
            if (confirm('Are you sure you want to cancel this reservation?')) {
                this.form.post(route('admin.reservations.cancel', {
                    reservation: reservation.id
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
                        <h1 class="h3 mb-3 mb-sm-0">Reservation List</h1>
                        <div class="d-grid"><a href="#" data-bs-toggle="modal" data-bs-target="#inquiryForm"
                                class="btn btn-primary mb-0"><i class="bi bi-filetype-pdf me-2"></i>Create Reservation</a>
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
                                <h6 class="mb-0">User</h6>
                            </div>
                            <div class="col">
                                <h6 class="mb-0">Created Date</h6>
                            </div>
                            <div class="col">
                                <h6 class="mb-0">Room</h6>
                            </div>
                            <div class="col">
                                <h6 class="mb-0">Check In Date</h6>
                            </div>
                            <div class="col">
                                <h6 class="mb-0">Check Out Date</h6>
                            </div>
                            <div class="col">
                                <h6 class="mb-0">No Of Guest</h6>
                            </div>
                            <div class="col">
                                <h6 class="mb-0">Total Amount</h6>
                            </div>

                            <div class="col">
                                <h6 class="mb-0">Status</h6>
                            </div>
                            <div class="col">
                                <h6 class="mb-0">Action</h6>
                            </div>
                        </div>
                    </div>

                    <!-- Table data -->
                    <div v-for="reservation in reservations"
                        class="row row-cols-xl-7 align-items-lg-center border-bottom g-4 px-2 py-4">
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
                                    <h6 class="mb-0 fw-light">{{ reservation.user.name }}</h6>
                                </div>
                            </div>
                        </div>

                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-lg-none">Created date:</small>
                            <h6 class="mb-0 fw-normal">{{ reservation.created_at }}</h6>
                        </div>
                        <div class="col">
                            <small class="d-block d-lg-none">Room:</small>
                            <h6 class="mb-0 fw-normal">{{ reservation?.room?.id }}</h6>
                        </div>

                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-lg-none">Check In Date:</small>
                            <h6 class="mb-0 fw-normal">{{ reservation.check_in_date }}</h6>
                        </div>
                        <div class="col">
                            <small class="d-block d-lg-none">Check Out Date:</small>
                            <h6 class="mb-0 fw-normal">{{ reservation.check_out_date }}</h6>
                        </div>

                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-lg-none">No of Guest:</small>
                            <h6 class="mb-0 fw-normal">{{ reservation.number_of_guests }}</h6>
                        </div>
                        <div class="col">
                            <small class="d-block d-lg-none">Total Price:</small>
                            <h6 class="mb-0 fw-normal">${{ reservation.total_price }}</h6>
                        </div>

                        <!-- Data item -->
                        <div class="col">
                            <small class="d-block d-lg-none">Status:</small>
                            <div class="badge bg-success bg-opacity-10 text-success">{{ reservation.status }}</div>
                        </div>

                        <!-- Data item -->
                        <div class="col">
                            <a href="#" class="btn btn-sm btn-light mb-0" data-bs-toggle="modal"
                                data-bs-target="#inquiryForm" @click="edit(reservation)">Edit</a>
                            <a href="#" class="btn btn-sm btn-primary mb-0"
                              @click="approve(reservation)">Approve</a>
                            <a href="#" class="btn btn-sm btn-warning mb-0"
                                @click="cancel(reservation)">Cancel</a>
                            <a href="#" class="btn btn-sm btn-danger mb-0"
                                @click="deleteReservation(reservation)">Delete</a>
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
                        <h5 class="modal-title" id="inquiryFormlabel">{{ isEdit ? `Edit reservation ${form.name}`
                            : "Create Reservation" }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Body -->
                    <div class="modal-body p-3">
                        <form class="mt-4 text-start" @submit.prevent="submit">
                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">User</label>
                                <select v-model="form.user_id" class="form-control" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option selected>Open this select menu</option>
                                    <option :value="user.id" v-for="user in users">{{ user.name }}</option>
                                </select>
                                <label for="floatingSelect">User Type</label>
                                <InputError class="mt-2" :message="form.errors.user_id" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Room</label>
                                <select v-model="form.room_id" class="form-control" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option selected>Open this select menu</option>
                                    <option :value="room.id" v-for="room in rooms">{{ room.name }}</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.room_id" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Check In Date</label>
                                <input type="datetime-local" class="form-control" v-model="form.check_in_date">
                                <InputError class="mt-2" :message="form.errors.check_in_date" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Check Out Date</label>
                                <input type="datetime-local" class="form-control" v-model="form.check_out_date">
                                <InputError class="mt-2" :message="form.errors.check_out_date" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Number of Guest</label>
                                <input type="number" class="form-control" v-model="form.number_of_guests">
                                <InputError class="mt-2" :message="form.errors.number_of_guests" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select v-model="form.status" class="form-control" id="floatingSelect"
                                    aria-label="Floating label select example">
                                    <option selected>Open this select menu</option>
                                    <option value="approved">Approved</option>
                                    <option value="pending">Pending</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.status" />
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
