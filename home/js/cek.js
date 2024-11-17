document.addEventListener('DOMContentLoaded', function () {
    const toggles = document.querySelectorAll('.toggle-active');
    toggles.forEach(function (toggle) {
        toggle.addEventListener('change', function () {
            const id = this.dataset.id;
            const active = this.checked ? 1 : 0;

            fetch('../../update_active.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: id, active: active }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Status berhasil diperbarui');
                        // Hapus elemen jika status diubah menjadi off
                        if (active === 0) {
                            const announcementElement = document.getElementById(`announcement-${id}`);
                            if (announcementElement) {
                                announcementElement.remove();
                            }
                        }
                    } else {
                        alert('Gagal memperbarui status');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
});