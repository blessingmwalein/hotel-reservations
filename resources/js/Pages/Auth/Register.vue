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
            form: new useForm({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                phone_number: '',
            }),
        }
    },
    methods:{
        submit(){
            this.form.post(route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            });
        },

        toogleShowPassword(){
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
                            <div class="col-lg-6 d-md-flex align-items-center order-2 order-lg-1">
                                <div class="p-3 p-lg-5">
                                    <img src="/assets/images/element/signin.svg" alt="">
                                </div>
                                <!-- Divider -->
                                <div class="vr opacity-1 d-none d-lg-block"></div>
                            </div>

                            <!-- Information -->
                            <div class="col-lg-6 order-1">
                                <div class="p-4 p-sm-6">
                                    <!-- Logo -->
                                    <a href="/">
                                        <img class="h-50px mb-4" src="/assets/images/logo-icon.svg" alt="logo">
                                    </a>
                                    <!-- Title -->
                                    <h1 class="mb-2 h3">Create new account</h1>
                                    <p class="mb-0">Already a member?<a href="/login"> Log in</a></p>

                                    <!-- Form START -->
                                    <form class="mt-4 text-start" @submit.prevent="submit">
                                        <!-- Email -->
                                        <div class="mb-3">
                                            <label class="form-label">Full name</label>
                                            <input type="text" class="form-control" v-model="form.name">
                                            <InputError class="mt-2" :message="form.errors.name" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Phone number</label>
                                            <input type="text" class="form-control" v-model="form.phone_number">
                                            <InputError class="mt-2" :message="form.errors.phone_number" />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Enter email</label>
                                            <input type="email" class="form-control" v-model="form.email">
                                            <InputError class="mt-2" :message="form.errors.email" />
                                        </div>
                                        <!-- Password -->
                                        <div class="mb-3 position-relative">
                                            <label class="form-label">Enter password</label>
                                            <input class="form-control fakepassword" v-model="form.password" type="password"
                                                id="psw-input">
                                            <span @click="toogleShowPassword()" class="position-absolute top-50 end-0 translate-middle-y p-0 mt-3">
                                                <i class="fakepasswordicon fas fa-eye-slash cursor-pointer p-2"></i>
                                            </span>
                                            <InputError class="mt-2" :message="form.errors.password" />

                                        </div>
                                        <!-- Confirm Password -->
                                        <div class="mb-3">
                                            <label class="form-label">Confirm Password</label>
                                            <input v-model="form.password_confirmation" type="password"
                                                class="form-control">

                                            <InputError class="mt-2" :message="form.errors.password_confirmation" />

                                        </div>

                                        <div><button type="submit" class="btn btn-primary w-100 mb-0"
                                                :disabled="form.processing" :class="{ 'opacity-25': form.processing }">Sign
                                                up</button></div>


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
