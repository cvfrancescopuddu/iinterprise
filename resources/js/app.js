import './bootstrap';
import 'flowbite';
import './theme-manager';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


//popover for notes
const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))







