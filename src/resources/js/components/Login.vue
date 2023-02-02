<template>
    <div>
        <h1 class="text-center">Login</h1>
        <hr/>
        <el-row type="flex" justify="center">
            <el-col
                style="background-color: #fff; padding: 30px; margin: 50px"
                :span="12"
            >
                <el-form
                    action="javascript:void(0)"
                    method="post"
                    :label-position="labelPosition"
                    label-width="100px"
                >
                    <el-form-item label="Email">
                        <el-input
                            type="text"
                            v-model="auth.email"
                            name="email"
                            id="email"
                            class="form-control"
                        ></el-input>
                    </el-form-item>
                    <el-form-item label="Password">
                        <el-input
                            type="password"
                            v-model="auth.password"
                            name="password"
                            id="password"
                            class="form-control"
                        ></el-input>
                        <el-form-item>
                            <el-button
                                style="padding: 10px 50px; margin-top: 30px"
                                type="primary"
                                @click="login()"
                            >
                                {{ !processing ? "login" : "Loading" }}
                            </el-button>
                        </el-form-item>
                    </el-form-item>
                </el-form>
            </el-col>
        </el-row>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "login",
    data() {
        return {
            labelPosition: "top",
            auth: {
                email: "",
                password: "",
            },
            processing: false,
        };
    },
    methods: {
        ...mapActions({
            signIn: "auth/login",
        }),
        async login() {
            this.processing = true;
            await window.axios.get("/sanctum/csrf-cookie").then((res) => {
                window.axios
                    .post("login", this.auth)
                    .then((res) => {
                        this.signIn();
                    }).catch((err) => {
                }).finally(() => {
                    this.processing = false
                })
            });


        },
    },
};
</script>
