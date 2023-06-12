
<script>
import UserDashboardLayout from '@/Layouts/UserDashboardLayout.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

export default {
    components: {
        UserDashboardLayout,
        InputError
    },

    data() {
        return {
            userForm: useForm({
                name: '',
                phone_number: '',
            }),

            passwordForm: useForm({
                current_password: '',
                password: '',
                password_confirmation: '',
            }),
        };
    },
    props: ['user'],

    mounted() {
        this.userForm.name = this.user.name;
        this.userForm.phone_number = this.user.phone_number;


    },

    methods: {
        updateUser() {
            this.userForm.post(route('user.profile.update'));
        },

        updatePassword() {
            this.passwordForm.post(route('user.password.update'));
        },
    }
}
</script>

<template>
    <UserDashboardLayout>
        <div class="col-lg-8 col-xl-9">
            <!-- Offcanvas menu button -->
            <div class="d-grid mb-0 d-lg-none w-100">
                <button class="btn btn-primary mb-4" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                    <i class="fas fa-sliders-h"></i> Menu
                </button>
            </div>

            <div class="vstack gap-4">
                <!-- Verified message -->


                <!-- Personal info START -->
                <div class="card border">
                    <!-- Card header -->
                    <div class="card-header border-bottom">
                        <h4 class="card-header-title">Personal Information</h4>
                    </div>

                    <!-- Card body START -->
                    <div class="card-body">
                        <!-- Form START -->
                        <form class="row g-3">
                            <!-- Profile photo -->
                            <div class="col-12">
                                <label class="form-label">Upload your profile photo<span
                                        class="text-danger">*</span></label>
                                <div class="d-flex align-items-center">
                                    <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                                        <!-- Avatar place holder -->
                                        <span class="avatar avatar-xl">
                                            <img id="uploadfile-1-preview"
                                                class="avatar-img rounded-circle border border-white border-3 shadow"
                                                src="/assets/images/user.png" alt="" />
                                        </span>
                                    </label>
                                    <!-- Upload button -->
                                    <label class="btn btn-sm btn-primary-soft mb-0" for="uploadfile-1">Change</label>
                                    <input id="uploadfile-1" class="form-control d-none" type="file" />
                                </div>
                            </div>

                            <!-- Name -->
                            <div class="col-md-6">
                                <label class="form-label">Full Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="userForm.name"
                                    placeholder="Enter your full name" />
                                <InputError class="mt-2" :message="userForm.errors.name" />
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label">Email address<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" v-model="user.email" disabled
                                    placeholder="Enter your email id" />
                            </div>

                            <!-- Mobile -->
                            <div class="col-md-6">
                                <label class="form-label">Mobile number<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="userForm.phone_number"
                                    placeholder="Enter your mobile number" />
                                <InputError class="mt-2" :message="userForm.errors.phone_number" />
                            </div>




                            <!-- Button -->
                            <div class="col-12 text-end">
                                <a href="#" @click="updateUser()" class="btn btn-primary mb-0">Save Changes</a>
                            </div>
                        </form>
                        <!-- Form END -->
                    </div>
                    <!-- Card body END -->
                </div>
                <!-- Personal info END -->


                <!-- Update Password START -->
                <div class="card border">
                    <!-- Card header -->
                    <div class="card-header border-bottom">
                        <h4 class="card-header-title">Update Password</h4>
                        <p class="mb-0">
                            Your current email address is
                            <span class="text-primary">{{ user.email }}</span>
                        </p>
                    </div>

                    <!-- Card body START -->
                    <form class="card-body">
                        <!-- Current password -->
                        <div class="mb-3">
                            <label class="form-label">Current password</label>
                            <input class="form-control" type="password" v-model="passwordForm.currentPassword"
                                placeholder="Enter current password" />
                        </div>
                        <!-- New password -->
                        <div class="mb-3">
                            <label class="form-label"> Enter new password</label>
                            <div class="input-group">
                                <input class="form-control fakepassword" v-model="passwordForm.password"
                                    placeholder="Enter new password" type="password" id="psw-input" />
                                <span class="input-group-text p-0 bg-transparent">
                                    <i class="fakepasswordicon fas fa-eye-slash cursor-pointer p-2"></i>
                                </span>

                            </div>
                            <InputError class="mt-2" :message="passwordForm.errors.password" />

                        </div>
                        <!-- Confirm -->
                        <div class="mb-3">
                            <label class="form-label">Confirm new password</label>
                            <input class="form-control" type="password" v-model="passwordForm.password_confirmation"
                                placeholder="Confirm new password" />
                            <InputError class="mt-2" :message="passwordForm.errors.password_confirmation" />
                        </div>

                        <div class="text-end">
                            <a href="#" @click="updatePassword()" class="btn btn-primary mb-0">Change Password</a>
                        </div>
                    </form>
                    <!-- Card body END -->
                </div>
                <!-- Update Password END -->
            </div>
        </div>
    </UserDashboardLayout>
</template>
