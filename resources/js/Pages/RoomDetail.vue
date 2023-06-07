<script >
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

export default {
    components: {
        MainLayout,
        InputError
    },

    props: ["room", "amenities", "rooms"],

    data() {
        return {
            isShowPassword: false,
            isEdit: false,
            form: new useForm({
                comment: '',
                rating: 0,
                id: '',
                user_id:this.$page?.props?.auth?.user.id,
                room_id:this.room.id,
            }),
        }
    },


    methods:{
        sendFeedback(){

            this.form.post(route('feedback.store'), {
                onFinish: () => {
                    // location.reload();
                },
            });
        }
    }

}
</script>

<template>
    <MainLayout>
        <main>


            <!-- =======================
                                    Main Title START -->
            <section class="py-0 pt-sm-5">
                <div class="container position-relative">
                    <!-- Title and button START -->
                    <div class="row mb-3">
                        <div class="col-12">
                            <!-- Meta -->
                            <div class="d-lg-flex justify-content-lg-between mb-1">
                                <!-- Title -->
                                <div class="mb-2 mb-lg-0">
                                    <h1 class="fs-2">{{ room.name }}</h1>
                                    <!-- Location -->
                                    <p class="fw-bold mb-0">
                                        <i class="bi bi-geo-alt me-2"></i>{{ room.location }}

                                    </p>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- Title and button END -->

                    <!-- Alert box END -->
                </div>
            </section>
            <!-- =======================
                                    Main Title END -->

            <!-- =======================
                                    Image gallery START -->
            <section class="card-grid pt-0">
                <div class="container">
                    <div class="row g-2">


                        <div class="col-md-6" v-for="image in room.images">
                            <!-- Card item START -->

                            <a data-glightbox data-gallery="gallery" :href="`/storage/images/${image.image_path}`">
                                <div class="card card-grid-sm card-element-hover card-overlay-hover overflow-hidden"
                                    :style="`background-image: url(/storage/images/${image.image_path});`" style="

                                                            background-position: center left;
                                                            background-size: cover;
                                                          ">
                                <!-- Card hover element -->
                                    <div class="hover-element position-absolute w-100 h-100">
                                        <i
                                        class="bi bi-fullscreen fs-6 text-white position-absolute top-50 start-50 translate-middle bg-dark rounded-1 p-2 lh-1"></i>
                                    </div>
                                </div>
                            </a>

                            <!-- Card item END -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- =======================
                                    Image gallery END -->

            <!-- =======================
                                    About hotel START -->
            <section class="pt-0">
                <div class="container" data-sticky-container>
                    <div class="row g-4 g-xl-5">
                        <!-- Content START -->
                        <div class="col-xl-7 order-1">
                            <div class="vstack gap-5">
                                <!-- About hotel START -->
                                <div class="card bg-transparent">
                                    <!-- Card header -->
                                    <div class="card-header border-bottom bg-transparent px-0 pt-0">
                                        <h3 class="mb-0">About This Hotel</h3>
                                    </div>

                                    <!-- Card body START -->
                                    <div class="card-body pt-4 p-0">
                                        <h5 class="fw-light mb-4">Main Highlights</h5>

                                        <!-- Highlights Icons -->
                                        <div class="hstack gap-3 mb-3">
                                            <div class="icon-lg bg-light h5 rounded-2" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Free wifi">
                                                <i class="fa-solid fa-wifi"></i>
                                            </div>
                                            <div class="icon-lg bg-light h5 rounded-2" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Swimming Pool">
                                                <i class="fa-solid fa-swimming-pool"></i>
                                            </div>
                                            <div class="icon-lg bg-light h5 rounded-2" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Central AC">
                                                <i class="fa-solid fa-snowflake"></i>
                                            </div>
                                            <div class="icon-lg bg-light h5 rounded-2" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Free Service">
                                                <i class="fa-solid fa-concierge-bell"></i>
                                            </div>
                                        </div>

                                        <p class="mb-3">
                                            {{ room.description }}
                                        </p>




                                    </div>
                                    <!-- Card body END -->
                                </div>
                                <!-- About hotel START -->

                                <!-- Amenities START -->
                                <div class="card bg-transparent">
                                    <!-- Card header -->
                                    <div class="card-header border-bottom bg-transparent px-0 pt-0">
                                        <h3 class="card-title mb-0">Amenities</h3>
                                    </div>

                                    <!-- Card body START -->
                                    <div class="card-body pt-4 p-0">
                                        <div class="row g-4">
                                            <!-- Activities -->
                                            <div class="col-sm-6">

                                                <!-- List -->
                                                <ul class="list-group list-group-borderless mt-2 mb-0">
                                                    <li class="list-group-item pb-0" v-for="amenity in room?.amenities">
                                                        <i class="fa-solid fa-check-circle text-success me-2"></i>{{
                                                            amenity.amenity.name }}
                                                    </li>

                                                </ul>
                                            </div>


                                        </div>
                                    </div>
                                    <!-- Card body END -->
                                </div>

                                <!-- Customer Review START -->
                                <div class="card bg-transparent">
                                    <!-- Card header -->
                                    <div class="card-header border-bottom bg-transparent px-0 pt-0">
                                        <h3 class="card-title mb-0">Customer Reviews</h3>
                                    </div>

                                    <!-- Card body START -->
                                    <div class="card-body pt-4 p-0">

                                        <form class="mb-5" @submit.prevent="sendFeedback">
                                            <!-- Rating -->
                                            <div class="form-control-bg-light mb-3">
                                                <select class="form-select js-choice" v-model="form.rating">
                                                    <option value="5" selected="">★★★★★ (5/5)</option>
                                                    <option value="4">★★★★☆ (4/5)</option>
                                                    <option value="3">★★★☆☆ (3/5)</option>
                                                    <option value="2">★★☆☆☆ (2/5)</option>
                                                    <option value="1">★☆☆☆☆ (1/5)</option>
                                                </select>
                                <InputError class="mt-2" :message="form.errors.rating" />

                                            </div>
                                            <!-- Message -->
                                            <div class="form-control-bg-light mb-3">
                                                <textarea class="form-control" v-model="form.comment" id="exampleFormControlTextarea1"
                                                    placeholder="Your review" rows="3"></textarea>
                                <InputError class="mt-2" :message="form.errors.comment" />

                                            </div>
                                            <!-- Button -->
                                            <button type="submit" class="btn btn-lg btn-primary mb-0">
                                                Post review <i class="bi fa-fw bi-arrow-right ms-2"></i>
                                            </button>
                                        </form>
                                        <!-- Leave review END -->

                                        <!-- Review item START -->
                                        <div class="d-md-flex my-4" v-for="feedback in room.feedbacks">
                                            <!-- Avatar -->
                                            <div class="avatar avatar-lg me-3 flex-shrink-0">
                                                <img class="avatar-img rounded-circle" src="/assets/images/user.png"
                                                    alt="avatar" />
                                            </div>
                                            <!-- Text -->
                                            <div>
                                                <div class="d-flex justify-content-between mt-1 mt-md-0">
                                                    <div>
                                                        <h6 class="me-3 mb-0">{{feedback?.user?.name}}</h6>
                                                        <!-- Info -->
                                                        <ul class="nav nav-divider small mb-2">
                                                            <li class="nav-item">{{feedback.created_at}}</li>
                                                        </ul>
                                                    </div>
                                                    <!-- Review star -->
                                                    <div class="icon-md rounded text-bg-warning fs-6">
                                                        {{ feedback.rating }}
                                                    </div>
                                                </div>

                                                <p class="mb-2">
                                                    {{feedback.comment}}
                                                </p>


                                            </div>
                                        </div>



                                    </div>
                                    <!-- Card body END -->
                                </div>

                            </div>
                        </div>
                        <!-- Content END -->

                        <!-- Right side content START -->
                        <aside class="col-xl-5 order-xl-2">
                            <div data-sticky data-margin-top="100" data-sticky-for="1199">
                                <!-- Book now START -->
                                <div class="card card-body border">
                                    <!-- Title -->
                                    <div class="d-sm-flex justify-content-sm-between align-items-center mb-3">
                                        <div>
                                            <span>Price Start at</span>
                                            <h4 class="card-title mb-0">${{ room.unit_price }}</h4>
                                        </div>
                                        <div>
                                            <h6 class="fw-normal mb-0">1 room per night</h6>
                                            <small>+ $285 taxes & fees</small>
                                        </div>
                                    </div>

                                    <!-- Rating -->
                                    <ul class="list-inline mb-2">
                                        <li class="list-inline-item me-1 h6 fw-light mb-0">
                                            <i class="bi bi-arrow-right me-2"></i>4.5
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
                                            <i class="fa-solid fa-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item me-0 small">
                                            <i class="fa-solid fa-star-half-alt text-warning"></i>
                                        </li>
                                    </ul>

                                    <p class="h6 fw-light mb-4">
                                        <i class="bi bi-arrow-right me-2"></i>Free breakfast
                                        available
                                    </p>

                                    <!-- Button -->
                                    <div class="d-grid">
                                    <a :href="`/rooms/${room.id}/book`" class="btn btn-lg btn-primary-soft mb-0">Proceed
                                            Book</a>
                                    </div>
                                </div>
                                <!-- Book now END -->

                            </div>
                        </aside>
                        <!-- Right side content END -->
                    </div>
                    <!-- Row END -->
                </div>
            </section>
            <!-- =======================
                                    About hotel END -->
        </main>

    </MainLayout>
</template>

<style></style>
