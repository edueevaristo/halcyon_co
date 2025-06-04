import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

export function showGlittrModal({
                                    icon = 'info',
                                    title,
                                    text,
                                    confirmButtonText = 'Confirmar',
                                    cancelButtonText = 'Cancelar',
                                    routeAfterConfirm = null,
                                    ...restOptions
                                }) {
    return Swal.fire({
        icon,
        title: `<span class="glittr-gradient-text" style="font-size: 20px">${title}</span>`,
        html: `<p style="color: #fff; font-size: 16px">${text}</p>`,
        background: 'linear-gradient(145deg, #1e1e2f, #27293d)',
        customClass: {
            popup: 'glittr-modal',
            confirmButton: 'glittr-confirm',
            cancelButton: 'glittr-cancel',
        },
        showCancelButton: !!cancelButtonText,
        confirmButtonText,
        cancelButtonText,
        showCloseButton: true,
        focusCancel: true,
        ...restOptions
    }).then((result) => {

        if (result.isConfirmed && routeAfterConfirm) {
            window.location.href = routeAfterConfirm;
        }

    });
}
