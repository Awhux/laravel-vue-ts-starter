import { defineComponent, mergeProps, unref, useSSRContext, withCtx, createTextVNode, createSSRApp, h } from "vue";
import { ssrRenderAttrs, ssrRenderComponent, ssrRenderList, ssrInterpolate, ssrRenderAttr, ssrIncludeBooleanAttr, ssrLooseContain } from "vue/server-renderer";
import { useForm, Head, Link, createInertiaApp } from "@inertiajs/vue3";
import createServer from "@inertiajs/vue3/server";
import { renderToString } from "@vue/server-renderer";
const _sfc_main$2 = /* @__PURE__ */ defineComponent({
  __name: "Login",
  __ssrInlineRender: true,
  setup(__props) {
    const form = useForm({
      email: "",
      password: "",
      remember: false
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "flex flex-col" }, _attrs))}>`);
      _push(ssrRenderComponent(unref(Head), { title: "Log me in!" }, null, _parent));
      if (unref(form).errors) {
        _push(`<div role="alert"><!--[-->`);
        ssrRenderList(unref(form).errors.email, (error) => {
          _push(`<div>${ssrInterpolate(error)}</div>`);
        });
        _push(`<!--]--></div>`);
      } else {
        _push(`<!---->`);
      }
      _push(`<form><input type="text"${ssrRenderAttr("value", unref(form).email)}><input type="password"${ssrRenderAttr("value", unref(form).password)}><input type="checkbox"${ssrIncludeBooleanAttr(Array.isArray(unref(form).remember) ? ssrLooseContain(unref(form).remember, null) : unref(form).remember) ? " checked" : ""} id="remember" name="remember"><label for="remember">Remember me</label><button${ssrIncludeBooleanAttr(unref(form).processing) ? " disabled" : ""}>${ssrInterpolate(unref(form).processing ? "Carregando..." : "Login")}</button></form></div>`);
    };
  }
});
const _sfc_setup$2 = _sfc_main$2.setup;
_sfc_main$2.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Auth/Login.vue");
  return _sfc_setup$2 ? _sfc_setup$2(props, ctx) : void 0;
};
const __vite_glob_0_0 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: _sfc_main$2
}, Symbol.toStringTag, { value: "Module" }));
const _sfc_main$1 = /* @__PURE__ */ defineComponent({
  __name: "Register",
  __ssrInlineRender: true,
  setup(__props) {
    const form = useForm({
      name: "",
      email: "",
      password: "",
      password_confirmation: ""
    });
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "flex flex-col" }, _attrs))}>`);
      _push(ssrRenderComponent(unref(Head), { title: "Create an account!" }, null, _parent));
      _push(`<form><input type="text"${ssrRenderAttr("value", unref(form).name)} placeholder="Nome"><input type="text"${ssrRenderAttr("value", unref(form).email)} placeholder="Email"><input type="password"${ssrRenderAttr("value", unref(form).password)} placeholder="Senha"><input type="password"${ssrRenderAttr("value", unref(form).password_confirmation)} placeholder="Confirmar a senha"><button${ssrIncludeBooleanAttr(unref(form).processing) ? " disabled" : ""}>${ssrInterpolate(unref(form).processing ? "Carregando..." : "Registrar")}</button></form></div>`);
    };
  }
});
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Auth/Register.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const __vite_glob_0_1 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: _sfc_main$1
}, Symbol.toStringTag, { value: "Module" }));
const _sfc_main = /* @__PURE__ */ defineComponent({
  __name: "Home",
  __ssrInlineRender: true,
  props: {
    isAuthenticated: { type: Boolean },
    auth: {}
  },
  setup(__props) {
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<main${ssrRenderAttrs(mergeProps({ class: "flex h-screen flex-col items-center justify-center px-2 pt-2" }, _attrs))}>`);
      _push(ssrRenderComponent(unref(Head), { title: "Bem vindo!" }, null, _parent));
      _push(`<div class="mb-5 flex h-40 w-full max-w-md flex-col rounded-lg border border-gray-600/20 bg-gray-100 p-4 text-center"><h1 class="text-2xl text-black/80">Seu melhor gestor de tarefas!</h1><h3 class="mb-auto mt-2 text-black/80">Entre no dashboard usando o link abaixo!</h3><div class="flex w-full flex-row justify-center">`);
      _push(ssrRenderComponent(unref(Link), {
        href: "/tasks",
        class: "p-2 transition-all duration-300 hover:font-bold"
      }, {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`Dashboard`);
          } else {
            return [
              createTextVNode("Dashboard")
            ];
          }
        }),
        _: 1
      }, _parent));
      _push(`</div></div></main>`);
    };
  }
});
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("resources/js/Pages/Home.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const __vite_glob_0_2 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: _sfc_main
}, Symbol.toStringTag, { value: "Module" }));
createServer(
  (page) => createInertiaApp({
    page,
    render: renderToString,
    resolve: (name) => {
      const pages = /* @__PURE__ */ Object.assign({ "./Pages/Auth/Login.vue": __vite_glob_0_0, "./Pages/Auth/Register.vue": __vite_glob_0_1, "./Pages/Home.vue": __vite_glob_0_2 });
      return pages[`./Pages/${name}.vue`];
    },
    setup({ App, props, plugin }) {
      return createSSRApp({
        render: () => h(App, props)
      }).use(plugin);
    }
  })
);
