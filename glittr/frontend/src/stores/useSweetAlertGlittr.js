import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

export function showGlittrModal({ title, text, confirmText = 'Confirmar', cancelText = 'Cancelar', icon = 'info' }) {
    return Swal.fire({
        icon: icon,
        title: `<span class="glittr-gradient-text" style="font-size: 20px">${title}</span>`,
        html: `<p style="color: #fff; font-size: 16px">${text}</p>`,
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
        background: 'linear-gradient(145deg, #1e1e2f, #27293d)',
        customClass: {
            popup: 'glittr-modal',
            confirmButton: 'glittr-confirm',
            cancelButton: 'glittr-cancel',
        },
        showCloseButton: true,
        focusCancel: true
    });
}
