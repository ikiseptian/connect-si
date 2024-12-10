
function loadTableData() {
    // Mengambil data pengumuman dari server
    fetch('get_pengunguman.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Gagal memuat data: ' + response.status);
            }
            return response.text();
        })
        .then(html => {
            // Menampilkan data ke elemen tabel
            const tableBody = document.querySelector('#announcement-list');
            if (tableBody) {
                tableBody.innerHTML = html;
            } else {
                console.error('Elemen #announcement-list tidak ditemukan.');
            }
        })
        .catch(error => {
            console.error('Error loading data:', error.message);
        });
}

document.addEventListener('DOMContentLoaded', () => {
    // Fungsi untuk menangani perubahan pada toggle switch
    const handleToggleChange = (e) => {
        if (e.target.classList.contains('toggle-active')) {
            const id = e.target.getAttribute('data-id');
            const active = e.target.checked ? 1 : 0; 

            // Mengirim permintaan pembaruan status
            fetch('update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id, active }),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal memperbarui status: ' + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert('Status berhasil diperbarui.');
                        loadTableData(); // Memuat ulang tabel setelah pembaruan
                    } else {
                        alert('Gagal memperbarui status: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error.message);
                    alert('Terjadi kesalahan saat memperbarui status.');
                });
        }
    };

    // Menambahkan event listener untuk toggle switches
    document.addEventListener('change', handleToggleChange);

    // Memuat data saat halaman selesai dimuat
    loadTableData();
});

