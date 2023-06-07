
<script>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue';

export default {
    components: {
        UserDashboardLayout,
    },

    props: ['pendingReservations', 'cancelledReservations', 'approvedReservations']
};
</script>
<template>
    <UserDashboardLayout>
        <div class="col-lg-8 col-xl-9 ps-xl-5">
            <!-- Offcanvas menu button -->
            <div class="d-grid mb-0 d-lg-none w-100">
                <button class="btn btn-primary mb-4" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                    <i class="fas fa-sliders-h"></i> Menu
                </button>
            </div>

            <div class="card border bg-transparent">
                <!-- Card header -->
                <div class="card-header bg-transparent border-bottom">
                    <h4 class="card-header-title">My Bookings</h4>
                </div>

                <!-- Card body START -->
                <div class="card-body p-0">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs nav-bottom-line nav-responsive nav-justified">
                        <li class="nav-item">
                            <a class="nav-link mb-0 active" data-bs-toggle="tab" href="#tab-1"><i
                                    class="bi bi-briefcase-fill fa-fw me-1"></i>Upcoming
                                Booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0" data-bs-toggle="tab" href="#tab-2"><i
                                    class="bi bi-x-octagon fa-fw me-1"></i>Canceled
                                Booking</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-0" data-bs-toggle="tab" href="#tab-3"><i
                                    class="bi bi-patch-check fa-fw me-1"></i>Approved</a>
                        </li>
                    </ul>

                    <!-- Tabs content START -->
                    <div class="tab-content p-2 p-sm-4" id="nav-tabContent">
                        <!-- Tab content item START -->
                        <div class="tab-pane fade show active" id="tab-1">

                            <!-- Card item START -->
                            <div class="card border mb-4" v-for="pendingReservation in pendingReservations">
                                <!-- Card header -->
                                <div
                                    class="card-header border-bottom d-md-flex justify-content-md-between align-items-center">
                                    <!-- Icon and Title -->
                                    <div class="d-flex align-items-center">
                                        <div class="icon-lg bg-light rounded-circle flex-shrink-0">
                                            <i class="fa-solid fa-building"></i>
                                        </div>
                                        <!-- Title -->
                                        <div class="ms-2">
                                            <h6 class="card-title mb-0">
                                                {{ pendingReservation.room.name }}
                                            </h6>
                                            <ul class="nav nav-divider small">
                                                <li class="nav-item">
                                                    Room No: {{ pendingReservation.room.id }}
                                                </li>
                                                <li class="nav-item">{{ pendingReservation.room?.roomType?.name }}</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <div class="mt-2 mt-md-0">
                                        <a href="#" class="btn btn-primary-soft mb-0">Manage Booking</a>
                                    </div>
                                </div>

                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-sm-6 col-md-4">
                                            <span>Check In Date</span>
                                            <h6 class="mb-0">{{ pendingReservation.check_in_date }}</h6>
                                        </div>

                                        <div class="col-sm-6 col-md-4">
                                            <span>Check Out Date</span>
                                            <h6 class="mb-0">{{ pendingReservation.check_out_date }}</h6>
                                        </div>

                                        <div class="col-md-4">
                                            <span>Status</span>
                                            <h6 class="mb-0">{{ pendingReservation.status }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Tabs content item END -->

                        <!-- Tab content item START -->
                        <div class="tab-pane fade" id="tab-2">


                            <div class="card border mb-4" v-for="cancelledReservation in cancelledReservations">
                                <!-- Card header -->
                                <div
                                    class="card-header border-bottom d-md-flex justify-content-md-between align-items-center">
                                    <!-- Icon and Title -->
                                    <div class="d-flex align-items-center">
                                        <div class="icon-lg bg-light rounded-circle flex-shrink-0">
                                            <i class="fa-solid fa-building"></i>
                                        </div>
                                        <!-- Title -->
                                        <div class="ms-2">
                                            <h6 class="card-title mb-0">
                                                {{ cancelledReservation.room.name }}
                                            </h6>
                                            <ul class="nav nav-divider small">
                                                <li class="nav-item">
                                                    Room No: {{ cancelledReservation.room.id }}
                                                </li>
                                                <li class="nav-item">{{ cancelledReservation.room?.roomType?.name }}</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <div class="mt-2 mt-md-0">
                                        <a href="#" class="btn btn-primary-soft mb-0">Manage Booking</a>
                                    </div>
                                </div>

                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-sm-6 col-md-4">
                                            <span>Check In Date</span>
                                            <h6 class="mb-0">{{ cancelledReservation.check_in_date }}</h6>
                                        </div>

                                        <div class="col-sm-6 col-md-4">
                                            <span>Check Out Date</span>
                                            <h6 class="mb-0">{{ cancelledReservation.check_out_date }}</h6>
                                        </div>

                                        <div class="col-md-4">
                                            <span>Status</span>
                                            <h6 class="mb-0">{{ cancelledReservation.status }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tabs content item END -->

                        <!-- Tab content item START -->
                        <div class="tab-pane fade" id="tab-3">
                            <div class="card border mb-4" v-for="approvedReservation in approvedReservations">
                                <!-- Card header -->
                                <div
                                    class="card-header border-bottom d-md-flex justify-content-md-between align-items-center">
                                    <!-- Icon and Title -->
                                    <div class="d-flex align-items-center">
                                        <div class="icon-lg bg-light rounded-circle flex-shrink-0">
                                            <i class="fa-solid fa-building"></i>
                                        </div>
                                        <!-- Title -->
                                        <div class="ms-2">
                                            <h6 class="card-title mb-0">
                                                {{ approvedReservation.room.name }}
                                            </h6>
                                            <ul class="nav nav-divider small">
                                                <li class="nav-item">
                                                    Room No: {{ approvedReservation.room.id }}
                                                </li>
                                                <li class="nav-item">{{ approvedReservation.room?.roomType?.name }}</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <!-- Button -->
                                    <div class="mt-2 mt-md-0">
                                        <a href="#" class="btn btn-primary-soft mb-0">Manage Booking</a>
                                    </div>
                                </div>

                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-sm-6 col-md-4">
                                            <span>Check In Date</span>
                                            <h6 class="mb-0">{{ approvedReservation.check_in_date }}</h6>
                                        </div>

                                        <div class="col-sm-6 col-md-4">
                                            <span>Check Out Date</span>
                                            <h6 class="mb-0">{{ approvedReservation.check_out_date }}</h6>
                                        </div>

                                        <div class="col-md-4">
                                            <span>Status</span>
                                            <h6 class="mb-0">{{ approvedReservation.status }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tabs content item END -->
                    </div>
                </div>
                <!-- Card body END -->
            </div>
        </div>
    </UserDashboardLayout>
</template>
