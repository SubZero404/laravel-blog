import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../../vendor/jquery-3.6.0';
import '../../vendor/summernote/summernote-lite'


import Swal from "sweetalert2";


window.showToast = function (status,status_icon = 'success') {
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
        icon: status_icon,
        title: status
    })
}


