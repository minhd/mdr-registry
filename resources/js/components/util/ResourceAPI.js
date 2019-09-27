import axios from 'axios'

// Laravel csrf tokens
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

let baseURL = '/api/registry/resources/'
export default axios.create({
    baseURL
})
