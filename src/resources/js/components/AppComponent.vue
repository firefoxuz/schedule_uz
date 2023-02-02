<template>
    <router-view />
</template>

<script>
import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);
export default {
    mounted() {},
};
</script>

<style>
* {
    margin: 0;
    padding: 0;
    text-decoration: none;
    list-style: none;
}

body {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
}

#app nav {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.12), 0 0 6px rgba(0, 0, 0, 0.04);
    height: 100vh;
    padding-top: 70px;
}
#app nav h4 {
    padding: 0 20px;
    text-align: left;
}

#app nav li {
    display: flex;
    align-items: center;
    justify-content: start;
}
.el-menu {
    border: none;
}
.el-header {
    background-color: rgb(255, 255, 255);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
    border-bottom: 1px solid #eee;
}
.content {
    padding: 30px 25px;
    background-color: #f3f3f9;
    min-height: calc(100vh - 60px);
}
</style>
