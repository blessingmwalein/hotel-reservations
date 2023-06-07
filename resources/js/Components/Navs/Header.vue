
<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';

const logout = () => {
  router.post(route('logout'));
};
</script><template>
    <header class="navbar-light header-sticky">
        <!-- Logo Nav START -->
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <!-- Logo START -->
                <a class="navbar-brand" href="/">
                    <img class="light-mode-item navbar-brand-item" src="/assets/images/logo.svg" alt="logo" />
                    <img class="dark-mode-item navbar-brand-item" src="/assets/images/logo-light.svg" alt="logo" />
                </a>
                <!-- Logo END -->

                <!-- Responsive navbar toggler -->
                <button class="navbar-toggler ms-auto mx-3 p-0 p-sm-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-animation">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- Main navbar START -->
                <div class="navbar-collapse collapse" id="navbarCollapse">
                    <ul class="navbar-nav navbar-nav-scroll mx-auto">
                        <!-- Nav item Listing -->
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="#" id="listingMenu"  aria-expanded="false">Home</a>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="#" id="listingMenu"  aria-expanded="false">Rooms</a>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="#" id="listingMenu"  aria-expanded="false">Account</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="#" id="listingMenu"  aria-expanded="false">Customer Support</a>
                        </li>

                    </ul>
                </div>
                <!-- Main navbar END -->

                <!-- Profile and Notification START -->
                <ul class="nav flex-row align-items-center list-unstyled ms-xl-auto">
                    <!-- Search dropdown START -->
                    <li class="nav-item dropdown nav-search me-3 d-none d-sm-block">
                        <a class="nav-notification btn btn-light mb-0 p-0" href="#" id="searchDropdown" role="button"
                            data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-search"> </i>
                        </a>
                        <div class="dropdown-menu dropdown-animation dropdown-menu-end p-2"
                            aria-labelledby="searchDropdown">
                            <div class="nav flex-nowrap align-items-center">
                                <div class="nav-item w-100">
                                    <form class="input-group">
                                        <input class="form-control border-primary" type="search" placeholder="Search..."
                                            aria-label="Search" />
                                        <button class="btn btn-primary m-0" type="submit">
                                            Search
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>


                    <!-- Profile dropdown START -->
                    <li class="nav-item dropdown">
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
                                        <img class="avatar-img rounded-circle shadow" src="/assets/images/user.png"
                                            alt="avatar" />
                                    </div>
                                    <div v-if="$page.props.auth.user">
                                        <a class="h6 mt-2 mt-sm-0" href="#">{{$page.props?.auth?.user.name}}</a>
                                        <p class="small m-0">{{$page?.props?.auth?.user.email}}</p>
                                    </div>
                                </div>
                            </li>

                            <!-- Links -->
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="/register" v-if="!$page.props.auth.user"><i class="bi bi-person fa-tw me-2"></i>Register</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="/login" v-if="!$page.props.auth.user"><i class="bi bi-person fa-tw me-2"></i>Login</a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="#"><i class="bi bi-info-circle fa-fw me-2"></i>Customer Support</a>
                            </li>
                            <li v-if="$page.props.auth.user">
                                <a class="dropdown-item bg-danger-soft-hover" href="#" @click="logout"><i
                                        class="bi bi-power fa-fw me-2"></i>Sign Out</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                        </ul>
                    </li>
                    <!-- Profile dropdown END -->
                </ul>
                <!-- Profile and Notification START -->
            </div>
        </nav>
        <!-- Logo Nav END -->
    </header>
</template>
