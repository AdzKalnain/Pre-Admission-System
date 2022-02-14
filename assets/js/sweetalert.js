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