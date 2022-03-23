// Functions that fire sweetalert window depending on the message type
function success_alert() {
    Swal.fire({
        icon: 'success',
        title: 'Success'
    })
}

function error_alert() {
    Swal.fire({
        icon: 'error',
        title: 'Something went wrong please try again.'
    })
}

function file_info_alert() {
    Swal.fire({
        icon: 'info',
        title: 'Your file extension must be .jpeg, .jpg, or .png'
    })
}