import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Swiper from 'swiper/bundle';
import 'swiper/css/bundle';
window.Swiper = Swiper;

import Swal from 'sweetalert2';
window.Swal = Swal;

