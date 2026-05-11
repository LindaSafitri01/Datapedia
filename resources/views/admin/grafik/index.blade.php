{{-- resources/views/dashboard/consultation-chart.blade.php --}}
@extends('admin.layout')
@section('content')

{{-- CSS Styles --}}
<style>
    .chart-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 2rem;
        position: relative;
        overflow: hidden;
        animation: fadeInUp 0.8s ease forwards;
    }

    .chart-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #f5576c);
        background-size: 400% 400%;
        animation: gradientShift 3s ease infinite;
    }

    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .chart-title {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #2d3748;
        font-size: 1.5rem;
        font-weight: 700;
        letter-spacing: -0.025em;
    }

    .title-icon {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .year-filter {
        position: relative;
    }

    .filter-label {
        color: #718096;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
    }

    .year-select {
        appearance: none;
        background: linear-gradient(135deg, #f7fafc, #edf2f7);
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 40px 12px 16px;
        font-size: 0.875rem;
        font-weight: 500;
        color: #2d3748;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        min-width: 120px;
    }

    .year-select:hover {
        border-color: #667eea;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
        transform: translateY(-1px);
    }

    .year-select:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .select-arrow {
        position: absolute;
        right: 12px;
        top: 70%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #718096;
        transition: transform 0.3s ease;
    }

    .year-filter:hover .select-arrow {
        transform: translateY(-50%) rotate(180deg);
    }

    .chart-container {
        position: relative;
        margin: 0 auto;
        padding: 1rem;
    }

    .chart-wrapper {
        position: relative;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .no-data-message {
        text-align: center;
        padding: 3rem 2rem;
        color: #718096;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .no-data-icon {
        font-size: 4rem;
        color: #cbd5e0;
        margin-bottom: 1rem;
        opacity: 0.7;
    }

    .stats-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 2rem;
        opacity: 0;
        animation: fadeInUp 0.8s ease forwards 0.5s;
    }

    .stat-card {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        padding: 1.5rem;
        border-radius: 16px;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.5);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #718096;
        font-size: 0.875rem;
        font-weight: 500;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .chart-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .chart-title {
            font-size: 1.25rem;
        }

        .title-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .chart-card {
            padding: 1.5rem;
        }
    }
</style>

{{-- Main Chart Section --}}
<div class="mt-10 w-full" data-aos="fade-up" data-aos-duration="1500">
    <div class="chart-card">
        {{-- Header dengan Judul, Filter, dan Tombol Download --}}
        <div class="chart-header">
            <div class="chart-title">
                <div class="title-icon">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <span>Komposisi Konsultasi Bulanan Berdasarkan Posisi</span>
            </div>

            <div class="chart-actions">
                {{-- Form Filter Tahun --}}
                <div class="year-filter">
                    <label for="tahun" class="filter-label">Filter Tahun</label>
                    <form action="" method="GET" style="position: relative;">
                        <select name="tahun" id="tahun" class="year-select" onchange="this.form.submit()">
                            @forelse ($availableYears as $year)
                                <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @empty
                                <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                            @endforelse
                        </select>
                        <i class="fas fa-chevron-down select-arrow"></i>
                    </form>
                </div>

                {{-- Tombol Download --}}
                <div class="download-buttons mt-4 flex gap-4">
                    <button id="downloadPdfBtn" class="btn btn-primary" title="Unduh sebagai PDF">
                        <i class="fas fa-file-pdf"></i>
                    </button>
                    <button id="downloadPngBtn" class="btn btn-primary" title="Unduh sebagai PNG">
                        <i class="fas fa-image"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Area Chart --}}
        <div class="chart-container">
            <div class="chart-wrapper">
                {{-- Container untuk pesan "Tidak ada data" --}}
                <div id="no-data-message" class="no-data-message" style="display: none;">
                    <div class="no-data-icon"><i class="fas fa-chart-bar"></i></div>
                    <div>Tidak ada data konsultasi untuk tahun {{ $selectedYear }}.</div>
                </div>
                {{-- Elemen Canvas untuk grafik --}}
                <canvas id="grafikBarKonsultasi"></canvas>
            </div>
        </div>

        {{-- Statistics Summary --}}
        <div class="stats-summary" id="statsSummary">
            <div class="stat-card">
                <div class="stat-value" id="totalKonsultasi">--</div>
                <div class="stat-label">Total Konsultasi Tahun {{ $selectedYear }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-value" id="bulanTertinggi">--</div>
                <div class="stat-label">Bulan Tertinggi</div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- Library jsPDF untuk konversi ke PDF --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
{{-- Library html2canvas untuk konversi HTML ke gambar --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dataKonsultasiBulanan = @json($dataKonsultasiBulanan);
        const allData = dataKonsultasiBulanan.datasets.flatMap(d => d.data);
        const totalKonsultasi = allData.reduce((a, b) => a + b, 0);

        const chartCanvas = document.getElementById('grafikBarKonsultasi');
        const noDataMessage = document.getElementById('no-data-message');
        const downloadPdfBtn = document.getElementById('downloadPdfBtn');
        const downloadPngBtn = document.getElementById('downloadPngBtn');
        let myChart; // Deklarasikan variabel untuk instance Chart.js

        if (!chartCanvas || !noDataMessage) {
            console.error('Elemen grafik atau pesan tidak ditemukan.');
            return;
        }

        if (totalKonsultasi === 0) {
            chartCanvas.style.display = 'none';
            noDataMessage.style.display = 'block';
            document.getElementById('statsSummary').style.display = 'none';
            // Sembunyikan tombol download jika tidak ada data
            downloadPdfBtn.style.display = 'none';
            downloadPngBtn.style.display = 'none';
        } else {
            chartCanvas.style.display = 'block';
            noDataMessage.style.display = 'none';
            document.getElementById('statsSummary').style.display = 'flex';
            // Tampilkan tombol download
            downloadPdfBtn.style.display = 'inline-block';
            downloadPngBtn.style.display = 'inline-block';

            const canvasContext = chartCanvas.getContext('2d');

            myChart = new Chart(canvasContext, { // Simpan instance chart ke variabel myChart
                type: 'bar',
                data: {
                    labels: dataKonsultasiBulanan.labels,
                    datasets: dataKonsultasiBulanan.datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { stacked: true, title: { display: true, text: 'Bulan' } },
                        y: { stacked: true, beginAtZero: true, title: { display: true, text: 'Jumlah Konsultasi' } }
                    },
                    plugins: {
                        legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true, pointStyle: 'circle', font: { size: 12, weight: '500' }, color: '#4a5568' } },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)', titleColor: '#ffffff', bodyColor: '#ffffff', cornerRadius: 8, displayColors: true,
                            callbacks: {
                                title: function(context) { return context[0].label; },
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    let value = context.raw;
                                    return `${label}: ${value} konsultasi`;
                                },
                                afterBody: function(context) {
                                    const bulanIndex = context[0].dataIndex;
                                    const totalBulanIni = dataKonsultasiBulanan.totalBulanan[bulanIndex];
                                    let rincian = ['--- Rincian Posisi ---'];
                                    context.forEach(item => {
                                        rincian.push(`${item.dataset.label}: ${item.raw}`);
                                    });
                                    rincian.push('---------------------');
                                    rincian.push(`Total Konsultasi Bulan Ini: ${totalBulanIni}`);
                                    return rincian.join('\n');
                                }
                            }
                        }
                    },
                    elements: { bar: { borderJoinStyle: 'round' } }
                }
            });

            // Update statistics
            updateStats(dataKonsultasiBulanan);
        }

        // --- Event Listeners untuk Tombol Download ---
        if (downloadPngBtn) {
            downloadPngBtn.addEventListener('click', function() {
                if (myChart) {
                    const image = myChart.toBase64Image('image/png', 1);
                    const link = document.createElement('a');
                    link.href = image;
                    link.download = 'grafik_konsultasi_bulanan_{{ $selectedYear }}.png';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            });
        }

        if (downloadPdfBtn) {
            downloadPdfBtn.addEventListener('click', function() {
                if (myChart) {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF('landscape'); // Menggunakan orientasi landscape

                    // Buat gambar dari canvas Chart.js
                    const imgData = myChart.toBase64Image('image/png', 1);
                    const imgWidth = 280; // Lebar gambar dalam PDF (sesuaikan)
                    const imgHeight = (myChart.height * imgWidth) / myChart.width;

                    // Tambahkan judul
                    doc.setFontSize(18);
                    doc.text('Grafik Konsultasi Bulanan Berdasarkan Posisi', 14, 20);
                    doc.setFontSize(12);
                    doc.text(`Tahun: {{ $selectedYear }}`, 14, 28);

                    // Tambahkan gambar ke PDF
                    doc.addImage(imgData, 'PNG', 14, 40, imgWidth, imgHeight);

                    // Unduh file PDF
                    doc.save('grafik_konsultasi_bulanan_{{ $selectedYear }}.pdf');
                }
            });
        }

    });

    // ... Fungsi updateStats tetap sama ...
    function updateStats(dataKonsultasiBulanan) {
        const totalBulanan = dataKonsultasiBulanan.totalBulanan;
        const totalKeseluruhan = totalBulanan.reduce((a, b) => a + b, 0);

        const totalElement = document.getElementById('totalKonsultasi');
        const bulanTertinggiElement = document.getElementById('bulanTertinggi');

        const maxTotal = Math.max(...totalBulanan);
        const maxIndex = totalBulanan.indexOf(maxTotal);
        const months = dataKonsultasiBulanan.labels;

        if (totalElement) {
            totalElement.textContent = totalKeseluruhan;
        }

        if (bulanTertinggiElement && maxIndex !== -1) {
            bulanTertinggiElement.textContent = `${months[maxIndex]} (${maxTotal})`;
        } else if (bulanTertinggiElement) {
            bulanTertinggiElement.textContent = 'Tidak Ada Data';
        }
    }

    if (downloadPngBtn) {
    downloadPngBtn.addEventListener('click', function() {
        if (myChart) {
            // Buat canvas baru dengan latar belakang putih
            const whiteBgCanvas = document.createElement('canvas');
            whiteBgCanvas.width = myChart.width;
            whiteBgCanvas.height = myChart.height;

            const context = whiteBgCanvas.getContext('2d');

            // Mengisi latar belakang dengan warna putih
            context.fillStyle = '#FFFFFF';
            context.fillRect(0, 0, whiteBgCanvas.width, whiteBgCanvas.height);

            // Menggambar grafik di atas latar belakang putih
            context.drawImage(myChart.canvas, 0, 0);

            // Menggunakan canvas baru untuk mengunduh gambar
            const image = whiteBgCanvas.toDataURL('image/png');
            const link = document.createElement('a');
            link.href = image;
            link.download = 'grafik_konsultasi_bulanan_{{ $selectedYear }}.png';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    });
}

if (downloadPdfBtn) {
    downloadPdfBtn.addEventListener('click', function() {
        if (myChart) {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('landscape');

            // Sama seperti PNG, gunakan canvas dengan latar belakang putih
            const whiteBgCanvas = document.createElement('canvas');
            whiteBgCanvas.width = myChart.width;
            whiteBgCanvas.height = myChart.height;
            const context = whiteBgCanvas.getContext('2d');
            context.fillStyle = '#FFFFFF';
            context.fillRect(0, 0, whiteBgCanvas.width, whiteBgCanvas.height);
            context.drawImage(myChart.canvas, 0, 0);

            // Menggunakan dataURL dari canvas baru
            const imgData = whiteBgCanvas.toDataURL('image/png');
            const imgWidth = 280;
            const imgHeight = (whiteBgCanvas.height * imgWidth) / whiteBgCanvas.width;

            doc.setFontSize(18);
            doc.text('Grafik Konsultasi Bulanan Berdasarkan Posisi', 14, 20);
            doc.setFontSize(12);
            doc.text(`Tahun: {{ $selectedYear }}`, 14, 28);

            doc.addImage(imgData, 'PNG', 14, 40, imgWidth, imgHeight);

            doc.save('grafik_konsultasi_bulanan_{{ $selectedYear }}.pdf');
        }
    });
}

</script>

@endsection
