import './bootstrap';
import resize from '@alpinejs/resize'

Alpine.plugin(resize)


import.meta.glob([
    //'../images/**',
]);

// LiveWire 3 už přichází s Alpine.js, takže import, který dodává Breeze je zbytečný
// ve skutečnosti dochází ke konfliktu popsaném na: 
// https://laraveldaily.com/post/livewire-3-laravel-breeze-error-alpine-js-conflict

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();
