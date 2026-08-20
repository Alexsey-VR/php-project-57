import Swal from 'sweetalert2'

export function confirmDelete(event, name, formId) {
    event.preventDefault();

    let form = document.getElementById(formId);
    if (!form) {
        const deleteButton = event.currentTarget;
        form = deleteButton.closest('form');
    }

    Swal.fire({
        title: "Вы уверены?",
        text: `Это действие нельзя отменить! Удалить статус \"${name}\"?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Да, удалить",
        cancelButtonText: "Отмена"
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
