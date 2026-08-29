import Swal from 'sweetalert2'
 
export function confirmDelete(event, name, formId) {
    event.preventDefault();

    let form = document.getElementById(formId);
    if (!form) {
        const deleteButton = event.currentTarget;
        form = deleteButton.closest('form');
    }
 
    const t = window.translation;
    Swal.fire({
        title: t.question,
        html: `
            <div">
                ${t.text.replace(':name', name)}
            </div>
        `,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#4f46e5",
        cancelButtonColor: "#e54646",
        confirmButtonText: t.confirm,
        cancelButtonText: t.cancel,
        customClass: {
            popup: 'swal2-popup',
            title: 'swal2-title',
            htmlContainer: 'swal2-html-container'
        },
        didOpen: () => {
            const style = document.createElement('style');
            style.textContent = `
                .swal2-popup {
                    @apply: text-sm text-center;
                    background: #e0e7ff;
                }

                .swal2-title {
                    @apply text-xl font-bold text-gray-800 mb-4;
                }

                .swal2-html-container {
                    @apply text-gray-600 leading-relaxed;
                }

                .swal2-confirm {
                    @apply text-sm text-center font-semibold;
                    color: white;
                    border-radius: 8px;
                    hover {
                        background-color: #4338ca;
                    }
                }

                .swal2-cancel {
                    @apply text-sm text-center font-semibold;
                    color: white;
                    border-radius: 8px;
                    hover {
                        background-color: #ca3838;
                    }
                }
            `;
            document.head.appendChild(style);
        },
        willClose: () => {
            const styles = document.querySelectorAll('style[content^="swal2-popup"]');
            styles.forEach(s => s.remove());
        }
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
