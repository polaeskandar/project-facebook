import { createRouter, createWebHistory } from "vue-router";

import HomeView from "../views/HomeView.vue";
import AuthView from "../views/Auth/AuthView.vue";
import LoginView from "../views/Auth/LoginView.vue";
import RegisterView from "../views/Auth/RegisterView.vue";
import ForgotPasswordView from "../views/Auth/ForgotPasswordView.vue";
import NotFoundView from "../views/NotFoundView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  linkActiveClass: "active",
  routes: [
    { path: "/", name: "home", component: HomeView },
    {
      path: "/auth",
      name: "auth",
      component: AuthView,
      children: [
        { path: "", name: "auth.login", component: LoginView },
        { path: "register", name: "auth.register", component: RegisterView },
        { path: "forgot-password", name: "auth.forgotPassword", component: ForgotPasswordView },
      ],
    },
    { path: "/:notFound(.*)", component: NotFoundView },
  ],
  scrollBehavior(_, __, savedPostion) {
    if (savedPostion) return savedPostion;
    else return { left: 0, top: 0 };
  },
});

router.beforeEach((_, __, next) => next(true));

export default router;
