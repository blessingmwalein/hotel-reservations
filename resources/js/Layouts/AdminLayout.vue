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
    <main>
        <!-- Sidebar START -->
        <nav class="navbar sidebar navbar-expand-xl navbar-light">
            <!-- Navbar brand for xl START -->
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="/">
                    <img class="light-mode-item navbar-brand-item" src="/assets/images/logo.svg" alt="logo" />
                    <img class="dark-mode-item navbar-brand-item" src="/assets/images/logo-light.svg" alt="logo" />
                </a>
            </div>
            <!-- Navbar brand for xl END -->

            <div class="offcanvas offcanvas-start flex-row custom-scrollbar h-100" data-bs-backdrop="true" tabindex="-1"
                id="offcanvasSidebar">
                <div class="offcanvas-body sidebar-content d-flex flex-column pt-4">
                    <!-- Sidebar menu START -->
                    <ul class="navbar-nav flex-column" id="navbar-sidebar">
                        <!-- Menu item -->
                        <li class="nav-item">
                            <a href="/admin/dashboard" class="nav-link active">Dashboard</a>
                        </li>

                        <!-- Title -->
                        <li class="nav-item ms-2 my-2">Pages</li>

                        <!-- Menu item -->
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#collapsebooking" role="button"
                                aria-expanded="false" aria-controls="collapsebooking">
                                Rooms
                            </a>
                            <!-- Submenu -->
                            <ul class="nav collapse flex-column" id="collapsebooking" data-bs-parent="#navbar-sidebar">
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/rooms">List</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/room-types">Types</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/admin/amenities">Amenities</a>
                                </li>
                            </ul>
                        </li>



                        <!-- Menu item -->
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/reservations">Reservations</a>
                        </li>

                        <!-- Menu item -->
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/transactions">Transactions</a>
                        </li>

                        <!-- Title -->
                        <li class="nav-item ms-2 my-2">Settings</li>

                        <!-- Menu item -->
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/users">Users</a>
                        </li>


                    </ul>
                    <!-- Sidebar menu end -->

                    <!-- Sidebar footer START -->
                    <div class="d-flex align-items-center justify-content-between text-primary-hover mt-auto p-3">
                        <a class="h6 fw-light mb-0 text-body" href="#" @click="logout()" data-bs-toggle="tooltip"
                            data-bs-placement="top" aria-label="Sign out">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Log out
                        </a>
                        <a class="h6 mb-0 text-body" href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                            aria-label="Settings">
                            <i class="bi bi-gear-fill"></i>
                        </a>
                    </div>
                    <!-- Sidebar footer END -->
                </div>
            </div>
        </nav>
        <!-- Sidebar END -->

        <!-- Page content START -->
        <div class="page-content">
            <!-- Top bar START -->
            <nav class="navbar top-bar navbar-light py-0 py-xl-3">
                <div class="container-fluid p-0">
                    <div class="d-flex align-items-center w-100">
                        <!-- Logo START -->
                        <div class="d-flex align-items-center d-xl-none">
                            <a class="navbar-brand" href="/">
                                <img class="navbar-brand-item h-40px" src="/assets/images/logo-icon.svg" alt="" />
                            </a>
                        </div>
                        <!-- Logo END -->

                        <!-- Toggler for sidebar START -->
                        <div class="navbar-expand-xl sidebar-offcanvas-menu">
                            <button class="navbar-toggler me-auto p-2" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar" aria-expanded="false"
                                aria-label="Toggle navigation" data-bs-auto-close="outside">
                                <i class="bi bi-list text-primary fa-fw" data-bs-target="#offcanvasMenu"></i>
                            </button>
                        </div>
                        <!-- Toggler for sidebar END -->

                        <!-- Top bar left -->
                        <div class="navbar-expand-lg ms-auto ms-xl-0">
                            <!-- Toggler for menubar START -->
                            <button class="navbar-toggler ms-auto p-0" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarTopContent" aria-controls="navbarTopContent" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <i class="bi bi-search"></i>
                            </button>

                            <div class="collapse navbar-collapse w-100 z-index-1" id="navbarTopContent">


                            </div>
                        </div>

                        <ul class="nav flex-row align-items-center list-unstyled ms-xl-auto">



                            <!-- Profile dropdown START -->
                            <li class="nav-item ms-3 dropdown">
                                <!-- Avatar -->
                                <a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button"
                                    data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img class="avatar-img rounded-2" src="/assets/images/user.png" alt="avatar" />
                                </a>

                                <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3"
                                    aria-labelledby="profileDropdown">
                                    <!-- Profile info -->
                                    <li class="px-3 mb-3">
                                        <div class="d-flex align-items-center">
                                            <!-- Avatar -->
                                            <div class="avatar me-3">
                                                <img class="avatar-img rounded-circle shadow"
                                                    src="/assets/images/user.png" alt="avatar" />
                                            </div>
                                            <div>
                                                <a class="h6 mt-2 mt-sm-0" href="#">{{ $page.props?.auth?.user?.name }}</a>
                                                <p class="small m-0">{{$page.props?.auth?.email}}</p>
                                            </div>
                                        </div>
                                    </li>

                                    <!-- Links -->
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>

                                    <li>
                                        <a class="dropdown-item bg-danger-soft-hover" href="#" @click="logout()"><i
                                                class="bi bi-power fa-fw me-2"></i>Sign Out</a>
                                    </li>
                                </ul>
                            </li>
                            <!-- Profile dropdown END -->
                        </ul>
                        <!-- Top bar right END -->
                    </div>
                </div>
            </nav>
            <slot></slot>
        </div>
        <!-- Page content END -->
    </main>
</template>
