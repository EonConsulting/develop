/**
 * Created by Peace Ngara on 4/14/2017.
 * A Vue JS Class Created by Peace Ngara to Create Application Storyline Front End and Bind Data to BeckEnd
 */
//Global Config Delimiters wont work
//        Vue.config.delimiters = ['<%', '%>'];
// Capture the Data Here Todo::
//        let data = {
//            message: 'Hello Vue'
//        };

// Vue.component('story', {
//     template: `
//
// `,
//     data: {
//         return: {
//             completionRate:
//
//         }
//     }
// });


new Vue({
    el: '#root',
    delimiters: ['<%', '%>'],
    data: {
        newContent: '',
        message: '',
        names: ['Carolina']
    },
    methods: {
        createContent() {
            this.names.push(this.newContent);
            //this.message.push(this.message);
            this.newContent = '';
        }
    }
});