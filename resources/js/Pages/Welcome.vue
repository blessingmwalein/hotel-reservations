<script >
import { Head, Link } from '@inertiajs/vue3';
import MainLayout from '@/Layouts/MainLayout.vue';
export default {
    components: {
        MainLayout,
    },

    props: ["roomTypes", "amenities", "rooms"],


}
</script>

<template>
    <MainLayout>
        <main>
            <section class="pt-0">
                <div class="container">
                    <!-- Background image -->
                    <div class="rounded-3 p-3 p-sm-5" style="
                                                                background-image: url(assets/images/bg/05.jpg);
                                                                background-position: center center;
                                                                background-repeat: no-repeat;
                                                                background-size: cover;
                                                              ">
                        <!-- Banner title -->
                        <div class="row my-2 my-xl-5">
                            <div class="col-md-8 mx-auto">
                                <h1 class="text-center text-white">Book a room with us plenty rooms available</h1>
                            </div>
                        </div>

                        <!-- Booking from START -->
                        <form class="bg-mode shadow rounded-3 position-relative p-4 pe-md-5 pb-5 pb-md-4 mb-4">
                            <div class="row g-4 align-items-center">
                                <!-- Location -->
                                <div class="col-lg-4">
                                    <div class="form-control-border form-control-transparent form-fs-md d-flex">
                                        <!-- Icon -->
                                        <i class="bi bi-geo-alt fs-3 me-2 mt-2"></i>
                                        <!-- Select input -->
                                        <div class="flex-grow-1">
                                            <label class="form-label">Location</label>
                                            <select class="form-select js-choice" data-search-enabled="true">
                                                <option value="">Select location</option>
                                                <option selected>First Floor Harare Avenue</option>
                                                <option selected>First Floor Harare Avenue</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Check in -->
                                <div class="col-lg-4">
                                    <div class="d-flex">
                                        <!-- Icon -->
                                        <i class="bi bi-calendar fs-3 me-2 mt-2"></i>
                                        <!-- Date input -->
                                        <div class="form-control-border form-control-transparent form-fs-md">
                                            <label class="form-label">Check in - out</label>
                                            <input type="text" class="form-control flatpickr" data-mode="range"
                                                placeholder="Select date" value="19 Sep to 28 Sep" />
                                        </div>
                                    </div>
                                </div>

                                <!-- Guest -->
                                <div class="col-lg-4">
                                    <div class="form-control-border form-control-transparent form-fs-md d-flex">
                                        <!-- Icon -->
                                        <i class="bi bi-person fs-3 me-2 mt-2"></i>
                                        <!-- Dropdown input -->
                                        <div class="w-100">
                                            <label class="form-label">Guests & rooms</label>
                                            <div class="dropdown guest-selector me-2">
                                                <input type="text" class="form-guest-selector form-control selection-result"
                                                    value="2 Guests 1 Room" id="dropdownShare" data-bs-auto-close="outside"
                                                    data-bs-toggle="dropdown" />

                                                <!-- dropdown items -->
                                                <ul class="dropdown-menu guest-selector-dropdown"
                                                    aria-labelledby="dropdownShare">
                                                    <!-- Adult -->
                                                    <li class="d-flex justify-content-between">
                                                        <div>
                                                            <h6 class="mb-0">Adults</h6>
                                                            <small>Ages 13 or above</small>
                                                        </div>

                                                        <div class="hstack gap-1 align-items-center">
                                                            <button type="button"
                                                                class="btn btn-link adult-remove p-0 mb-0">
                                                                <i class="bi bi-dash-circle fs-5 fa-fw"></i>
                                                            </button>
                                                            <h6 class="guest-selector-count mb-0 adults">
                                                                2
                                                            </h6>
                                                            <button type="button" class="btn btn-link adult-add p-0 mb-0">
                                                                <i class="bi bi-plus-circle fs-5 fa-fw"></i>
                                                            </button>
                                                        </div>
                                                    </li>

                                                    <!-- Divider -->
                                                    <li class="dropdown-divider"></li>

                                                    <!-- Child -->
                                                    <li class="d-flex justify-content-between">
                                                        <div>
                                                            <h6 class="mb-0">Child</h6>
                                                            <small>Ages 13 below</small>
                                                        </div>

                                                        <div class="hstack gap-1 align-items-center">
                                                            <button type="button"
                                                                class="btn btn-link child-remove p-0 mb-0">
                                                                <i class="bi bi-dash-circle fs-5 fa-fw"></i>
                                                            </button>
                                                            <h6 class="guest-selector-count mb-0 child">0</h6>
                                                            <button type="button" class="btn btn-link child-add p-0 mb-0">
                                                                <i class="bi bi-plus-circle fs-5 fa-fw"></i>
                                                            </button>
                                                        </div>
                                                    </li>

                                                    <!-- Divider -->
                                                    <li class="dropdown-divider"></li>

                                                    <!-- Rooms -->
                                                    <li class="d-flex justify-content-between">
                                                        <div>
                                                            <h6 class="mb-0">Rooms</h6>
                                                            <small>Max room 8</small>
                                                        </div>

                                                        <div class="hstack gap-1 align-items-center">
                                                            <button type="button" class="btn btn-link room-remove p-0 mb-0">
                                                                <i class="bi bi-dash-circle fs-5 fa-fw"></i>
                                                            </button>
                                                            <h6 class="guest-selector-count mb-0 rooms">1</h6>
                                                            <button type="button" class="btn btn-link room-add p-0 mb-0">
                                                                <i class="bi bi-plus-circle fs-5 fa-fw"></i>
                                                            </button>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                </div>
                                </div>
                            </div>
                        <!-- Button -->
                            <div class="btn-position-md-middle">
                                <a class="icon-lg btn btn-round btn-primary mb-0" href="#"><i
                                        class="bi bi-search fa-fw"></i></a>
                            </div>
                        </form>
                        <!-- Booking from END -->
                    </div>
                </div>
            </section>
            <!-- =======================
                                                  Main Banner END -->

            <!-- =======================
                                                  Title and Tabs START -->
            <section class="pt-0 pb-4">
                <div class="container position-relative">
                    <!-- Title and button START -->
                    <div class="row">
                        <div class="col-12">
                            <!-- Meta START -->
                            <div class="d-flex justify-content-between">
                                <!-- Filter collapse button -->
                                <input type="checkbox" class="btn-check" id="btn-check-soft" />
                                <label class="btn btn-primary-soft btn-primary-check mb-0" for="btn-check-soft"
                                    data-bs-toggle="collapse" data-bs-target="#collapseFilter"
                                    aria-controls="collapseFilter">
                                <i class="bi fa-fe bi-sliders me-2"></i>Available Rooms
                                </label>


                            </div>
                            <!-- Meta END -->
                        </div>
                    </div>
                    <!-- Title and button END -->


                </div>
            </section>

            <section class="pt-0">
                <div class="container">
                    <div class="row g-4">


                        <!-- Card item START -->
                        <div class="col-md-6 col-xl-4" v-for="room in rooms">
                            <div class="card shadow p-2 pb-0 h-100">
                                <!-- Image -->
                                <img :src="`/storage/images/${room?.images[0].image_path}`" class="rounded-2"
                                    alt="Card image" />

                                <!-- Card body START -->
                                <div class="card-body px-3 pb-0">
                                    <!-- Rating and cart -->
                                    <div class="d-flex justify-content-between mb-3">
                                        <a href="#" class="badge bg-dark text-white"><i
                                                class="bi fa-fw bi-star-fill me-2 text-warning"></i>4.0</a>
                                        <a href="#" class="h6 mb-0 z-index-2"><i class="bi fa-fw bi-bookmark"></i></a>
                                    </div>

                                    <!-- Title -->
                                    <h5 class="card-title">
                                        <a href="#">{{ room.name }}
                                        </a>
                                    </h5>

                                    <!-- List -->
                                    <ul class="nav nav-divider mb-2 mb-sm-3">
                                        <li class="nav-item" v-for="amenity in room.amenities">{{ amenity.amenity.name }}
                                        </li>

                                    </ul>
                                </div>
                                <!-- Card body END -->

                                <!-- Card footer START-->
                                <div class="card-footer pt-0">
                                    <!-- Price and Button -->
                                    <div class="d-sm-flex justify-content-sm-between align-items-center">
                                        <!-- Price -->
                                        <div class="d-flex align-items-center">
                                            <h5 class="fw-normal text-success mb-0 me-1">${{ room.unit_price }}</h5>
                                            <span class="mb-0 me-2">/day</span>
                                        </div>
                                        <!-- Button -->
                                        <div class="mt-2 mt-sm-0 z-index-2">
                                            <a :href="`/rooms/${room.id}`" class="btn btn-sm btn-primary-soft mb-0 w-100">View
                                                Detail<i class="bi bi-arrow-right ms-2"></i></a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <!-- Row END -->

                </div>
            </section>
            <!-- =======================
                                          Hotel grid END -->
        </main>

    </MainLayout>
</template>

<style></style>
