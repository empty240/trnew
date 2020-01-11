console.log("tr/app.js");
const bootstrap = require("../bootstrap");

// import router from "./router";
// import store from "./store";
// import * as types from "./store/mutation-types";
// import { Message } from "element-ui";
// import App from "./pages/App";
// import CKEditor from "@ckeditor/ckeditor5-vue";
// Vue.use(CKEditor);
// import VueClipboard from "vue-clipboard2";
// Vue.use(VueClipboard);
// import mixin from "./mixins/global";
// Vue.mixin(mixin);
// import * as VueGoogleMaps from "vue2-google-maps";
// Vue.use(VueGoogleMaps, {
//     load: {
//         key: "xxxx",
//         libraries: "places"
//     }
// });

// import Geocoder from "@pderas/vue2-geocoder";

// Vue.use(Geocoder, {
//     googleMapsApiKey: "xxx"
// });

// ログイン済みのセッションがあるか判定
// if (bootstrap.fetchToken()) {
//     store.commit(types.ALREADY_LOGIN);
// }

// 遷移時にメッセージを必ず閉じる
// router.beforeEach((to, from, next) => {
//     Message.closeAll();
//     next();
// });

// //状態監視
// store.subscribe((mutation, state) => {
//     // ログイン時処理
//     if (mutation.type === types.LOGIN) {
//         bootstrap.fetchToken();
//         if (state.route.from && String(state.route.from).indexOf("/") === 0) {
//             router.push(state.route.from);
//         } else {
//             router.push("/");
//         }
//     }

//     // ログアウト時
//     if (mutation.type === types.LOGOUT) {
//         bootstrap.removeToken();
//         router.push("/login");
//     }

//     // API通信失敗時にログインしていなかった場合はログイン画面に戻す
//     if (mutation.type === types.API_REQUEST_FAILED && !store.state.isLogin) {
//         router.push("/login");
//     }

//     // エラーメッセージ表示
//     if (mutation.type === types.SHOW_ERROR_MESSAGE) {
//         Message.error({
//             message: store.state.errorMessage,
//             duration: 0,
//             dangerouslyUseHTMLString: true,
//             showClose: true
//         });
//     }

//     // インフォメーションメッセージ表示
//     if (mutation.type === types.SHOW_INFO_MESSAGE) {
//         Message.info({ message: store.state.infoMessage });
//     }
// });

// APIコール時に必ず通信開始の合図を送る
// axios.interceptors.request.use(
//     config => {
//         store.commit(types.API_REQUEST_START, {
//             label: "REQUEST_START",
//             config
//         });
//         return config;
//     },
//     error => {
//         // Do something with request error
//         return Promise.reject(error);
//     }
// );

// // API終了時のイベント注入
// axios.interceptors.response.use(
//     response => {
//         store.commit(types.API_REQUEST_END, { label: "REQUEST_END", response });
//         return Promise.resolve({
//             data: response.data
//         });
//     },
//     error => {
//         const status = error.response.status;
//         let message = "";

//         store.commit(types.API_REQUEST_FAILED, { label: status, error });

//         if (status === 401) {
//             // トークンが切れたりして401のときに ログインへ戻す
//             store.commit(types.LOGOUT);
//         } else if (status === 422) {
//             // バリデーションエラーのとき、自動メッセージ出力
//             if (error.response.data.hasOwnProperty("errors")) {
//                 Object.keys(error.response.data.errors).forEach(idx => {
//                     for (let errorMessage of error.response.data.errors[idx]) {
//                         message += errorMessage + "<br>";
//                     }
//                 });
//             } else {
//                 message = "エラーが発生しました";
//             }
//             store.commit(types.SHOW_ERROR_MESSAGE, message);
//         } else if (status === 500) {
//             // 500の場合はエラー内容を表示させたくないため
//             store.commit(
//                 types.SHOW_ERROR_MESSAGE,
//                 "システムエラーが発生しました<br>システム担当者にお知らせください"
//             );
//         } else {
//             // その他ステータスコード
//             if (error.response.data.message) {
//                 message = error.response.data.message;
//                 store.commit(types.SHOW_ERROR_MESSAGE, message);
//             } else if (error.response.data.errors) {
//                 Object.keys(error.response.data.errors).forEach(idx => {
//                     message += error.response.data.errors[idx][0] + "<br>";
//                 });
//                 store.commit(types.SHOW_ERROR_MESSAGE, message);
//             } else {
//                 store.commit(types.SHOW_ERROR_MESSAGE, "エラーが発生しました");
//             }
//         }
//         store.commit(types.LOADING, false);
//         return Promise.resolve({ error });
//     }
// );

// Vue.component("app", require("./pages/App.vue"));

// Vue.filter("number", function(number) {
//     const formatter = new Intl.NumberFormat("ja-JP");
//     return formatter.format(number);
// });

// new Vue({
//     el: "#app",
//     components: { App },
//     template: "<App />",
//     router,
//     store
// });
