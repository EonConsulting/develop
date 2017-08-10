deve
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('vue-resource');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('todo', require('./components/ToDo.vue'));
Vue.component('page-builder', require('./components/PageBuilder.vue'));
Vue.component('storyline-builder', require('./components/builders/storyline/storyline.vue'));

Vue.component('groups', require('./components/builders/storyline/partials/groups.vue'));
Vue.component('group', require('./components/builders/storyline/partials/group.vue'));
Vue.component('ckfinder', require('./components/builders/storyline/partials/ckfinder.vue'));

Vue.component('create-course', require('./components/lecturer/courses/CreateCourse.vue'));
Vue.component('courses', require('./components/lecturer/courses/Courses.vue'));
Vue.component('course-notify-users', require('./components/lecturer/courses/Notify.vue'));

// Vue.component('upload-form', require('./components/partials/uploads/UploadForm.vue'));
// Vue.component('uploads', require('./components/partials/uploads/Uploads.vue'));
// Vue.component('file', require('./components/partials/uploads/File.vue'));

const app = new Vue({
    el: '#app'
});
