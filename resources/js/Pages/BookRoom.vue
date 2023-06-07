<script >
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

export default {
    components: {
        MainLayout,
        InputError
    },

    props: ["room", "amenities", "rooms", "clientToken"],

    data() {
        return {
            isShowPassword: false,
            isEdit: false,
            form: new useForm({
                check_in_date: '',
                check_out_date: '',
                number_of_guests: '',
                id: '',
                nonce: '',
                user_id: this.$page?.props?.auth?.user.id,
                room_id: this.room.id,
            }),
        }
    },

    mounted() {
        this.initiliseBrainTree();
    },


    methods: {
        sendFeedback() {

            this.form.post(route('feedback.store'), {
                onFinish: () => {
                    // location.reload();
                },
            });
        },

        initiliseBrainTree() {
            braintree.dropin.create({
                authorization: this.clientToken,
                container: '#dropin-container'
            }, (error, dropinInstance) => {
                if (error) console.error(error);
                document.getElementById('submit-button').addEventListener('click', () => {
                    dropinInstance.requestPaymentMethod((error, payload) => {
                        if (error) console.error(error);
                        this.form.nonce = payload.nonce;
                        this.form.post(route('client.reservations.store'), {
                            onFinish: () => {
                                // location.reload();
                            },
                        });
                    });
                });
            });
        }
    }

}
</script>

<template>
    <MainLayout>
        <main>

            <section class="py-0">
                <div class="container">
                    <div class="card bg-light overflow-hidden px-sm-5">
                        <div class="row align-items-center g-4">
                            <!-- Content -->
                            <div class="col-sm-9">
                                <div class="card-body">
                                    <!-- Breadcrumb -->
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb breadcrumb-dots mb-0">
                                            <li class="breadcrumb-item">
                                                <a href="/"><i class="bi bi-house me-1"></i> Home</a>
                                            </li>
                                            <li class="breadcrumb-item">Room detail</li>
                                            <li class="breadcrumb-item active">Booking</li>
                                        </ol>
                                    </nav>
                                    <!-- Title -->
                                    <h1 class="m-0 h2 card-title">Review your Booking</h1>
                                </div>
                            </div>

                            <!-- Image -->
                            <div class="col-sm-3 text-end d-none d-sm-block">
                                <img src="/assets/images/element/17.svg" class="mb-n4" alt="" />
                            </div>
                        </div>
                    </div>
                    <!-- Card END -->
                </div>
            </section>

            <section>
                <div class="container">
                    <div class="row g-4 g-lg-5">
                        <!-- Left side content START -->
                        <div class="col-xl-8">
                            <div class="vstack gap-5">
                                <!-- Hotel information START -->
                                <div class="card shadow">
                                    <!-- Card header -->
                                    <div class="card-header p-4 border-bottom">
                                        <!-- Title -->
                                        <h3 class="mb-0">
                                            <i class="fa-solid fa-hotel me-2"></i>Room Information
                                        </h3>
                                    </div>

                                    <!-- Card body START -->
                                    <div class="card-body p-4">
                                        <!-- Card list START -->
                                        <div class="card mb-4">
                                            <div class="row align-items-center">
                                                <!-- Image -->
                                                <div class="col-sm-6 col-md-3">
                                                    <img :src="`/storage/images/${room?.images[0].image_path}`"
                                                        class="card-img" alt="" />
                                                </div>

                                                <!-- Card Body -->
                                                <div class="col-sm-6 col-md-9">
                                                    <div class="card-body pt-3 pt-sm-0 p-0">
                                                        <!-- Title -->
                                                        <h5 class="card-title">
                                                            <a href="#">{{ room.name }}</a>
                                                        </h5>
                                                        <p class="small mb-2">
                                                            <i class="bi bi-geo-alt me-2"></i>{{ room.location }}
                                                        </p>

                                                        <!-- Rating star -->
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item me-0 small">
                                                                <i class="fa-solid fa-star text-warning"></i>
                                                            </li>
                                                            <li class="list-inline-item me-0 small">
                                                                <i class="fa-solid fa-star text-warning"></i>
                                                            </li>
                                                            <li class="list-inline-item me-0 small">
                                                                <i class="fa-solid fa-star text-warning"></i>
                                                            </li>
                                                            <li class="list-inline-item me-0 small">
                                                                <i class="fa-solid fa-star text-warning"></i>
                                                            </li>
                                                            <li class="list-inline-item me-0 small">
                                                                <i class="fa-solid fa-star-half-alt text-warning"></i>
                                                            </li>
                                                            <li class="list-inline-item ms-2 h6 small fw-bold mb-0">
                                                                4.5/5.0
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Card list END -->

                                        <!-- Information START -->

                                        <!-- Information END -->

                                        <!-- Card START -->
                                        <div class="card border mt-4">
                                            <!-- Card header -->
                                            <div class="card-header border-bottom d-md-flex justify-content-md-between">
                                                <h5 class="card-title mb-0">
                                                    Amenities
                                                </h5>
                                            </div>

                                            <!-- Card body -->
                                            <div class="card-body">
                                                <ul class="list-group list-group-borderless mb-0">
                                                    <li class="list-group-item h6 fw-light d-flex mb-0"
                                                        v-for="amenity in room.amenities">
                                                        <i class="bi bi-patch-check-fill text-success me-2"></i>{{
                                                            amenity?.amenity?.name }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- Card END -->
                                    </div>
                                    <!-- Card body END -->
                                </div>
                                <!-- Hotel information END -->

                                <!-- Guest detail START -->
                                <div class="card shadow">
                                    <!-- Card header -->
                                    <div class="card-header border-bottom p-4">
                                        <h4 class="card-title mb-0">
                                            <i class="bi bi-people-fill me-2"></i>Booking Details
                                        </h4>
                                    </div>

                                    <!-- Card body START -->
                                    <div class="card-body p-4">
                                        <!-- Form START -->
                                        <form class="row g-4">
                                            <div class="col-md-6">
                                                <label class="form-label">Check In Date</label>
                                                <input type="datetime-local" class="form-control form-control-lg"
                                                    placeholder="Enter your email" v-model="form.check_in_date" />
                                                    <InputError class="mt-2" :message="form.errors.check_in_date" />
                                            </div>

                                            <!-- Input -->
                                            <div class="col-md-6">
                                                <label class="form-label">Check Out Date</label>
                                                <input type="datetime-local" v-model="form.check_out_date"
                                                    class="form-control form-control-lg" />
                                                    <InputError class="mt-2" :message="form.errors.check_out_date" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Number of Guest</label>
                                                <input type="number" v-model="form.number_of_guests"
                                                    class="form-control form-control-lg" />
                                                    <InputError class="mt-2" :message="form.errors.number_of_guests" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Comments</label>
                                                <textarea class="form-control form-control-lg" rows="3"
                                                    placeholder="Enter your email" v-model="form.comments"></textarea>
                                                    <InputError class="mt-2" :message="form.errors.comments" />
                                            </div>
                                        </form>

                                    </div>
                                    <!-- Card body END -->
                                </div>
                                <!-- Guest detail END -->

                                <!-- Payment Options START -->
                                <div class="card shadow">
                                    <!-- Card header -->
                                    <div class="card-header border-bottom p-4">
                                        <!-- Title -->
                                        <h4 class="card-title mb-0">
                                            <i class="bi bi-wallet-fill me-2"></i>Payment Options
                                        </h4>
                                    </div>

                                    <!-- Card body START -->
                                    <div class="card-body p-4 pb-0">
                                        <div id="dropin-container"></div>
                                    </div>
                                    <!-- Card body END -->

                                    <div class="card-footer p-4 pt-0">
                                        <!-- Condition link -->
                                        <p class="mb-0">
                                            By processing, You accept Booking
                                            <a href="#">Terms of Services</a> and
                                            <a href="#">Policy</a>
                                        </p>

                                        <button class="btn btn-primary submit-button" id="submit-button">Submit</button>
                                    </div>
                                </div>
                                <!-- Payment Options END -->
                            </div>
                        </div>
                        <!-- Left side content END -->

                        <!-- Right side content START -->
                        <aside class="col-xl-4">
                            <div class="row g-4">
                                <!-- Price summary START -->
                                <div class="col-md-6 col-xl-12">
                                    <div class="card shadow rounded-2">
                                        <!-- card header -->
                                        <div class="card-header border-bottom">
                                            <h5 class="card-title mb-0">Price Summary</h5>
                                        </div>

                                        <!-- Card body -->
                                        <div class="card-body">
                                            <ul class="list-group list-group-borderless">

                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span class="h6 fw-light mb-0">Room Unit Price</span>
                                                    <span class="fs-5">${{ room.unit_price }}</span>
                                                </li>

                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span class="h6 fw-light mb-0">Guests</span>
                                                    <span class="fs-5">${{ form.number_of_guests }}</span>
                                                </li>


                                            </ul>
                                        </div>

                                        <!-- Card footer -->
                                        <div class="card-footer border-top">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="h5 mb-0">Payable Now</span>
                                                <span class="h5 mb-0">${{ room.unit_price * form.number_of_guests }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </aside>
                        <!-- Right side content END -->
                    </div>
                    <!-- Row END -->
                </div>
            </section>

        </main>

    </MainLayout>
</template>

<style></style>
