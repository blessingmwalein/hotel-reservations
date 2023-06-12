<script>

import AdminLayout from '@/Layouts/AdminLayout.vue';
export default {
    props: ["users", "reservations", "pendingReservations", "approvedReservations", "cancelled", "rooms"],
    components: { AdminLayout }
}
</script>

<template>
    <AdminLayout>
        <div class="page-content-wrapper p-xxl-4">
            <!-- Title -->
            <div class="row">
                <div class="col-12 mb-4 mb-sm-5">
                    <div class="d-sm-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-2 mb-sm-0">Dashboard</h1>
                        <div class="d-grid">
                            <a href="#" class="btn btn-primary-soft mb-0"><i class="bi bi-plus-lg fa-fw"></i> New
                                Booking</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Counter boxes START -->
            <div class="row g-4 mb-5">
                <!-- Counter item -->
                <div class="col-md-6 col-xxl-3">
                    <div class="card card-body bg-warning bg-opacity-10 border border-warning border-opacity-25 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Digit -->
                            <div>
                                <h4 class="mb-0">{{ pendingReservations }}</h4>
                                <span class="h6 fw-light mb-0">Pending Reservations</span>
                            </div>
                            <!-- Icon -->
                            <div class="icon-lg rounded-circle bg-warning text-white mb-0">
                                <i class="fa-solid fa-hotel fa-fw"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Counter item -->
                <div class="col-md-6 col-xxl-3">
                    <div class="card card-body bg-success bg-opacity-10 border border-success border-opacity-25 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Digit -->
                            <div>
                                <h4 class="mb-0">{{ approvedReservations }}</h4>
                                <span class="h6 fw-light mb-0">Approved Reservations</span>
                            </div>
                            <!-- Icon -->
                            <div class="icon-lg rounded-circle bg-success text-white mb-0">
                                <i class="fa-solid fa-hand-holding-dollar fa-fw"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Counter item -->
                <div class="col-md-6 col-xxl-3">
                    <div class="card card-body bg-primary bg-opacity-10 border border-primary border-opacity-25 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Digit -->
                            <div>
                                <h4 class="mb-0">{{ rooms }}</h4>
                                <span class="h6 fw-light mb-0">Total Rooms</span>
                            </div>
                            <!-- Icon -->
                            <div class="icon-lg rounded-circle bg-primary text-white mb-0">
                                <i class="fa-solid fa-bed fa-fw"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Counter item -->
                <div class="col-md-6 col-xxl-3">
                    <div class="card card-body bg-info bg-opacity-10 border border-info border-opacity-25 p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Digit -->
                            <div>
                                <h4 class="mb-0">{{ cancelled }}</h4>
                                <span class="h6 fw-light mb-0">Cancelled Reservations</span>
                            </div>
                            <!-- Icon -->
                            <div class="icon-lg rounded-circle bg-info text-white mb-0">
                                <i class="fa-solid fa-building-circle-check fa-fw"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Counter boxes END -->

            <!-- Hotel grid START -->
            <div class="row g-4 mb-5">
                <!-- Title -->
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0">Recent Reservation</h4>
                        <a href="#" class="btn btn-primary-soft mb-0">View All</a>
                    </div>
                </div>

                <!-- Hotel item -->
                <div class="col-lg-12">
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
                                            <img class="avatar-img rounded-circle" src="/assets/images/user.png"
                                                alt="avatar">
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


            </div>

        </div>
    </AdminLayout>
</template>
