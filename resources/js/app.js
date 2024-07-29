import './bootstrap';

import Swal from "sweetalert2";

window.showToast = function (status) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
        didOpen(toast) {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: status
    })
}


