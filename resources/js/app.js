import './bootstrap';
import { KaryawanModal } from "./pages/karyawan";
// Alpine JS setup

import Alpine from 'alpinejs'

document.addEventListener('DOMContentLoaded', function () {
    window.Alpine = Alpine
    Alpine.start()
    Alpine.data('karyawan_modal', () => KaryawanModal);

    // loader
    setTimeout(() => document.getElementById("loader").style.display = "none", 900);

    // image processor
    Alpine.store('image', {
        showImage
    })
});

/**
 * Show image when input file changed
 *  
 * @return {void}
 */
function showImage() {
    const image = document.getElementById('photo-profile').files[0];
    const imagePath = URL.createObjectURL(image);
    const imageWrapper = document.getElementById('photo-profile-wrapper');

    // remove the shadow
    document.getElementsByClassName('image-wrapper')[0].classList = "image-wrapper absolute w-full h-full flex items-center justify-center top-0 border-4 border-dashed rounded-full";

    imageWrapper.src = imagePath;
}


