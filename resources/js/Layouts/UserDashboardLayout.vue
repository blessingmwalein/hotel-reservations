<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Header from '@/Components/Navs/Header.vue';
import Footer from '@/Components/Navs/Footer.vue';
import MainLayout from './MainLayout.vue';


defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <MainLayout>
        <main>
            <!-- =======================
            Content START -->
            <section class="pt-3">
                <div class="container">
                    <div class="row">
                        <!-- Sidebar START -->
                        <div class="col-lg-4 col-xl-3">
                            <!-- Responsive offcanvas body START -->
                            <div class="offcanvas-lg offcanvas-end" tabindex="-1" id="offcanvasSidebar">
                                <!-- Offcanvas header -->
                                <div class="offcanvas-header justify-content-end pb-2">
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                        data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
                                </div>

                                <!-- Offcanvas body -->
                                <div class="offcanvas-body p-3 p-lg-0">
                                    <div class="card bg-light w-100">
                                        <!-- Edit profile button -->
                                        <div class="position-absolute top-0 end-0 p-3">
                                            <a href="#" class="text-primary-hover" data-bs-toggle="tooltip"
                                                data-bs-title="Edit profile">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </div>

                                        <!-- Card body START -->
                                        <div class="card-body p-3">
                                            <!-- Avatar and content -->
                                            <div class="text-center mb-3">
                                                <!-- Avatar -->
                                                <div class="avatar avatar-xl mb-2">
                                                    <img class="avatar-img rounded-circle border border-2 border-white"
                                                        src="/assets/images/user.png" alt="" />
                                                </div>
                                                <h6 class="mb-0">{{ $page.props.auth.user.name }}</h6>
                                                <a href="#" class="text-reset text-primary-hover small">{{
                                                    $page.props.auth.user.email }}</a>
                                                <hr />
                                            </div>

                                            <!-- Sidebar menu item START -->
                                            <ul class="nav nav-pills-primary-soft flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="/user/profile"><i
                                                            class="bi bi-person fa-fw me-2"></i>My
                                                        Profile</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="/user/reservations"><i
                                                            class="bi bi-ticket-perforated fa-fw me-2"></i>My Bookings</a>
                                                </li>

                                                <li class="nav-item">
                                                    <a class="nav-link text-danger bg-danger-soft-hover" href="#"
                                                        @click="logout"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Sign
                                                        Out</a>
                                                </li>
                                            </ul>
                                            <!-- Sidebar menu item END -->
                                        </div>
                                        <!-- Card body END -->
                                    </div>
                                </div>
                            </div>
                            <!-- Responsive offcanvas body END -->
                        </div>
                        <!-- Sidebar END -->

                        <!-- Main content START -->
                        <slot></slot>
                        <!-- Main content END -->
                    </div>
                </div>
            </section>
            <!-- =======================
            Content END -->
        </main>
    </MainLayout>
</template>
