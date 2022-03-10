// Sweet Alert Logout on index.php
const btn = document.getElementById('btn-logout');
btn.addEventListener('click', function(){
    Swal.fire({
        title: 'Yakin keluar sekarang?',
        text: "Pastikan pekerjaan Anda telah selesai.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, keluar sekarang.',
        cancelButtonText: "Nanti saja.",
        }).then((result) => {
        if (result.isConfirmed) {
            window.location = 'logout.php';
        }
    })
});