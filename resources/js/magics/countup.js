import {CountUp} from 'countup.js';

export default ($el) => {
    // if (!userOptions.hasOwnProperty('duration')) userOptions.duration = 2000;

    window.onload = function () {
        const countUp = new CountUp($el, $el.innerHTML);
        countUp.start();
    }
};
