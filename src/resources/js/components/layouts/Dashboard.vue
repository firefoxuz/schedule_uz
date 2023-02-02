<template>
    <div>
        <div id="app">
            <el-row>
                <el-col :span="5">
                    <nav>
                        <h4>Menu</h4>
                        <el-menu>
                            <router-link to="/groups">
                                <el-menu-item index="1">
                                    <i class="el-icon-user"></i>
                                    <span>Groups</span>
                                </el-menu-item>
                            </router-link>

                            <router-link to="/rooms">
                                <el-menu-item index="2">
                                    <i class="el-icon-s-home"></i>
                                    <span>Rooms</span>
                                </el-menu-item>
                            </router-link>
                            <router-link to="/schedule">
                                <el-menu-item index="3">
                                    <i class="el-icon-s-order"></i>
                                    <span>Scheludeles</span>
                                </el-menu-item>
                            </router-link>
                            <router-link to="/subjects">
                                <el-menu-item index="4">
                                    <i class="el-icon-notebook-1"></i>
                                    <span>Subjects</span>
                                </el-menu-item>
                            </router-link>
                            <router-link to="/teachers">
                                <el-menu-item index="5">
                                    <i class="el-icon-service"></i>
                                    <span>Teachers</span>
                                </el-menu-item>
                            </router-link>
                            <el-menu-item index="5"  @click="logout">
                                <i class="el-icon-switch-button"></i>
                                <span>Logout</span>
                            </el-menu-item>
                        </el-menu>
                    </nav>
                </el-col>
                <el-col :span="19">
                    <el-header>Schedule</el-header>
                    <div class="content">
                        <router-view></router-view>
                    </div>
                </el-col>
            </el-row>
        </div>
    </div>
</template>

<script>
import {mapActions} from "vuex";

export default {
    name: "dashboard-layout",
    data() {
        return {
            user: this.$store.state.auth.user,
        };
    },
    methods: {
        ...mapActions({
            signOut: "auth/logout",
        }),
        async logout() {
            await axios.post("/logout").then(({data}) => {
                this.signOut();
                this.$router.push({name: "login"});
            });
        },
    },
};
</script>
