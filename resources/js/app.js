import './bootstrap';
import { KaryawanModal } from "./pages/karyawan";
// Alpine JS setup

import Alpine from 'alpinejs'

document.addEventListener('DOMContentLoaded', function () {    
    window.Alpine = Alpine
    Alpine.start()
    console.log(KaryawanModal);
    Alpine.data('karyawan_modal', () => KaryawanModal);
});


