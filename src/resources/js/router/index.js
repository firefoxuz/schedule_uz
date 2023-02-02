import Vue from "vue";
import VueRouter from "vue-router";
import store from "../store";
import Rooms from "../views/Rooms.vue";
import Schedule from "../views/Schedule.vue";
import Subject from "../views/Subject.vue";
import Teachers from "../views/Teachers.vue";
import Groups from "../views/Groups.vue";
import Login from "../components/Login.vue";
import DahboardLayout from "../components/Layouts/Dashboard.vue";
import Dashboard from "../components/Dashboard.vue";
import Register from "../components/Register.vue";

Vue.use(VueRouter);

const Routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`,
        },
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`,
        },
    },
    {
        path: "/",
        name: "dashboard",
        component: DahboardLayout,
        meta: {
            middleware: "auth",
        },
        children: [
            {
                path: "/rooms",
                name: "Rooms",
                component: Rooms,
            },
            {
                path: "/groups",
                name: "Groups",
                component: Groups,
            },
            {
                path: "/schedule",
                name: "Schedule",
                component: Schedule,
                props: true,
            },
            {
                path: "/teachers",
                name: "Teachers",
                component: Teachers,
                props: true,
            },
            {
                path: "/subjects",
                name: "Subject",
                component: Subject,
                props: true,
            },
        ],
    },
];

var router = new VueRouter({
    mode: "history",
    routes: Routes,
});

router.beforeEach((to, from, next) => {
    document.title = `${to.name}`;
    if (to.meta.middleware == "guest") {
        if (store.state.auth.authenticated) {
            next({ name: "dashboard" });
        }
        next();
    } else {
        if (store.state.auth.authenticated) {
            next();
        } else {
            next({ name: "login" });
        }
    }
});

export default router;
