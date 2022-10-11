import 'bootstrap';
import axios from 'axios';
import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const swiper = new Swiper('.swiper', {
    navigation: {
        nextEl: ".swiper-button-next",
    },
});
console.log(swiper);