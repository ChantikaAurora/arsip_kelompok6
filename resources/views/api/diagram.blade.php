<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('sales-chart').getContext('2d');

// Siapkan chart kosong
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            'Laporan Keuangan Penelitian', 'Laporan Keuangan Pengabdian',
            'Laporan Akhir Penelitian', 'Laporan Akhir Pengabdian',
            'Laporan Kemajuan Penelitian', 'Laporan Kemajuan Pengabdian',
            'Proposal DIPA Penelitian', 'Proposal DIPA Pengabdian',
            'Proposal Mandiri Penelitian', 'Proposal Mandiri Pengabdian',
            'Proposal Pusat Penelitian', 'Proposal Pusat Pengabdian'
        ],
        datasets: [{
            label: 'Jumlah',
            data: [],
            backgroundColor: '#4e73df'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Fungsi untuk ambil data API
function loadChartData() {
    fetch('/api/dashboard-summary')
        .then(response => response.json())
        .then(data => {
            chart.data.datasets[0].data = [
                data.total_anggaran_penelitian,
                data.total_anggaran_pengabdian,
                data.total_laporan_akhir_penelitian,
                data.total_laporan_akhir_pengabdian,
                data.total_laporan_kemajuan_penelitian,
                data.total_laporan_kemajuan_pengabdian,
                data.total_proposal_dipa_penelitian,
                data.total_proposal_dipa_pengabdian,
                data.total_proposal_mandiri_penelitian,
                data.total_proposal_mandiri_pengabdian,
                data.total_proposal_pusat_penelitian,
                data.total_proposal_pusat_pengabdian
            ];
            chart.update();
        })
        .catch(err => {
            console.error('Gagal ambil data API', err);
        });
}

// Panggil pertama kali
loadChartData();

// Bisa auto refresh setiap X detik kalau mau (misal 10 detik)
setInterval(loadChartData, 10000);
</script>



