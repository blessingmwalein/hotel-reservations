<script >
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


export default {
    components: {
        Head,
        Link,
        AuthenticationCard,
        AuthenticationCardLogo,
        Checkbox,
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
    },

    props: {
        status: String,
        canResetPassword: Boolean,
        canRegister: Boolean,
    },
    data() {
        return {
            isShowPassword: false,
            form: useForm({
                email: '',
                password: '',
                remember: false,
            }),
        }
    },
    methods: {
        submit() {
            this.form.transform(data => ({
                ...data,
                remember: this.form.remember ? 'on' : '',
            })).post(route('login'), {
                onFinish: () => this.form.reset('password'),
            });
        },
        toogleShowPassword() {
            this.isShowPassword = !this.isShowPassword;
            if (this.isShowPassword) {
                document.getElementById("psw-input").type = "text";
                document.querySelector(".fakepasswordicon").classList.remove("fa-eye-slash");
                document.querySelector(".fakepasswordicon").classList.add("fa-eye");
            } else {
                document.getElementById("psw-input").type = "password";
                document.querySelector(".fakepasswordicon").classList.remove("fa-eye");
                document.querySelector(".fakepasswordicon").classList.add("fa-eye-slash");
            }
        }
    }


}


</script>

<template>
    <section class="vh-xxl-100">
        <div class="container h-100 d-flex px-0 px-sm-4">
            <div class="row justify-content-center align-items-center m-auto">
                <div class="col-12">
                    <div class="bg-mode shadow rounded-3 overflow-hidden">
                        <div class="row g-0">
                            <!-- Vector Image -->
                            <div class="col-lg-6 d-flex align-items-center order-2 order-lg-1">
                                <div class="p-3 p-lg-5">
                                    <img src="/assets/images/element/signin.svg" alt="">
                                </div>
                                <!-- Divider -->
                                <div class="vr opacity-1 d-none d-lg-block"></div>
                            </div>

                            <!-- Information -->
                            <div class="col-lg-6 order-1">
                                <div class="p-4 p-sm-7">
                                    <!-- Logo -->
                                    <a href="/">
                                        <img class="h-50px mb-4" src="/assets/images/logo-icon.svg" alt="logo">
                                    </a>
                                    <!-- Title -->
                                    <h1 class="mb-2 h3">Welcome back</h1>
                                    <p class="mb-0">New here?<a href="/register"> Create an account</a></p>

                                    <!-- Form START -->
                                    <form class="mt-4 text-start" @submit.prevent="submit">
                                        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                                            {{ status }}
                                        </div>
                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label class="form-label">Enter email id</label>
                                            <input v-model="form.email" type="email" class="form-control">
                                            <InputError class="mt-2" :message="form.errors.email" />

                                        </div>
                                        <!-- Password -->
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Enter password</label>
                                            <input v-model="form.password" class="form-control fakepassword" type="password"
                                                id="psw-input">
                                            <span @click="toogleShowPassword()"
                                                class="position-absolute top-50 end-0 translate-middle-y p-0 mt-3">
                                                <i class="fakepasswordicon fas fa-eye-slash cursor-pointer p-2"></i>
                                            </span>
                                            <InputError class="mt-2" :message="form.errors.password" />

                                        </div>
                                        <!-- Remember me -->
                                        <div class="mb-3 d-sm-flex justify-content-between">
                                            <div>
                                                <Checkbox v-model:checked="form.remember" name="remember" />
                                                <label class="form-check-label" for="rememberCheck">Remember me?</label>
                                            </div>
                                            <Link v-if="canResetPassword" :href="route('password.request')">Forgot password?
                                            </Link>
                                        </div>
                                        <!-- Button -->
                                        <div><button type="submit" :class="{ 'opacity-25': form.processing }"
                                                :disabled="form.processing"
                                                class="btn btn-primary w-100 mb-0">Login</button></div>

                                        >

                                        <!-- Copyright -->
                                        <div class="text-primary-hover mt-3 text-center"> Copyrights ©2023 Booking. Build by
                                            <a href="#">Our Group</a>.
                                        </div>
                                    </form>
                                    <!-- Form END -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
