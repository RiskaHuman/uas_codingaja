<?php
include('header.php');

include('check_session.php');
?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <div class="row">

        <div class="col-md-6 offset-md-3 text-center">
            <!-- Card untuk Akumulasi Berita -->
            <div class="card bg-success my-4">
            <div class="container mt-5">
        <h2 id="welcomeMessage">Berita CodinginAJA</h2>
    </div>
                <div class="card-header">
                    Akumulasi Berita
                </div>
                <div class="card-body">
                    <h3 id="jumlahBerita" class="text-dark">
                        <i class="fas fa-newspaper"></i> Loading...
                    </h3>
                </div>
            </div>

            <!-- Form untuk memilih tahun -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="tahunSelect">Pilih Tahun</label>
                    <select class="form-control" id="tahunSelect"></select>
                </div>
            </div>

            <hr>

            <!-- Grafik Jumlah Berita dalam 1 Tahun -->
            <h2 class="text-center">GRAFIK JUMLAH BERITA DALAM 1 TAHUN</h2>
            <div class="row">
            <div class="row">
             </div>
                <div class="col-md-12">
                    <canvas id="newsChart" width="400" height="200"></canvas>
                    <div class="col-md-12">
            <button onclick="downloadExcel()" class="btn btn-success mr-2">
                <i class="fas fa-download"></i> Unduh Excel
            </button>
            <button onclick="downloadPDF()" class="btn btn-danger">
                <i class="fas fa-download"></i> Unduh PDF
            </button>
        </div>
                </div>
            </div>
        </div>
<div class="container mt-5">
    <h2 class="mb-4">List News</h2>
    <table id="newsTable" class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
<!--axiosjavaScrpt-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    $(document).ready(function() {
        // initialize datatable
        var table = $('#newsTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": function(data, callback, settings) {
                // Membuat permintaan HTTP ke API berita
                axios.get('https://client-server-wifal.000webhostapp.com/listnews.php', {
                        params: {
                            // Parameter pencarian
                            key: data.search.value
                        }
                    })
                    .then(function(response) {
                        response.data.forEach(function(row, index) {
                            row.no = index + 1;
                        });
                        callback({
                            draw: data.draw,
                            recordsTotal: response.data.length,
                            recordsFiltered: response.data.length,
                            data: response.data
                        });
                    })
                    .catch(function(error) {
                        console.error(error);
                        alert('Error fetching news data.');
                    });
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "judul"
                },
                {
                    "data": "deskripsi"
                },
                {
                    "data": "url_image",
                    "render": function(data, type, row) {
                        return '<img src="' + data + '" alt="image" style="max-width:100px; max-height:100px;">';
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return '<button class="btn btn-danger btn-sm" onclick="deleteNews(' + row.id + ')">Delete</button>' +
                            '<form action="edit.php" method="post">' +
                            '<input type="hidden" name="id" value="' + row.id + '">' +
                            '<button type="submit" class="btn btn-primary btn-sm">Edit</button>' +
                            '</form>';
                    }
                }
            ]
        });
    });

    function deleteNews(id) {
        var formData = new FormData();
        formData.append('idnews', id);

        if (confirm("Are you sure want to delete this news?")) {
            axios.post('https://client-server-wifal.000webhostapp.com/deletenews.php', formData)
                .then(function(response) {
                    alert(response.data);
                    // Refresh the DataTable after deletion
                    $('#newsTable').DataTable().ajax.reload();
                })
                .catch(function(error) {
                    console.error(error);
                    alert('Error deleting news.');
                });
        }
    }
</script>

 <script>
 function fetchData(tahun) {
            var formData = new FormData();
            formData.append('tahun', tahun);

            return axios({
                method: 'post',
                url: 'https://client-server-wifal.000webhostapp.com/sum_beritatahun.php',
                data: formData,
                header: {
                    'Content-Type': 'multipart/form-data'
                }
            });
        }


        function downloadExcel() {
            var selectedYear = document.getElementById('tahunSelect').value;
            fetchData(selectedYear).then(response => {
                var data = response.data;
                var ws = XLSX.utils.json_to_sheet(data);
                var wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, "Laporan");
                XLSX.writeFile(wb, "laporan_excel_" + selectedYear + ".xlsx");
            }).catch(error => {
                console.error('Error fetching data Excel', error);
            });
        }

        // Fungsi untuk membuat chart dengan data yang diambil
        function createChart(data) {
            var ctx = document.getElementById('newsChart').getContext('2d');

            // Check if there is an existing chart and destroy it
            var existingChart = Chart.getChart(ctx);
            if (existingChart) {
                existingChart.destroy();
            }

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.bulan),
                    datasets: [{
                        label: 'Jumlah Berita',
                        data: data.map(item => item.jumlah_berita),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1 // Menetapkan langkah antar nilai pada sumbu y
                            }
                        }
                    }
                }
            });
        }

        // Fungsi untuk mengisi select option dengan tahun
        function populateSelectOptions(data) {
            var selectElement = document.getElementById('tahunSelect');
            data.forEach(item => {
                var option = document.createElement('option');
                option.value = item.tahun;
                option.text = item.tahun;
                selectElement.add(option);
            });
        }

        // Fetch data and create the initial chart
        axios.get('https://client-server-wifal.000webhostapp.com/select_tahun.php')
            .then(response => {
                var tahunData = response.data;
                populateSelectOptions(tahunData);

                // Set default selected year to the latest year
                var latestYear = tahunData[0].tahun;
                document.getElementById('tahunSelect').value = latestYear;

                // Fetch data and create the initial chart
                fetchData(latestYear)
                    .then(response => {
                        var chartData = response.data;
                        createChart(chartData);
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            })
            .catch(error => {
                console.error('Error fetching tahun data:', error);
            });

        document.getElementById('tahunSelect').addEventListener('change', function() {
            var selectedYear = this.value;
            fetchData(selectedYear)
                .then(response => {
                    var chartData = response.data;
                    createChart(chartData);
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        });


        // Mengambil data jumlah berita dari API menggunakan Axios
        axios.get('https://client-server-wifal.000webhostapp.com/sum_berita.php')
            .then(function(response) {
                // Memproses data yang diterima dari API
                var dataJumlahBerita = response.data;

                // Mengambil elemen untuk menampilkan jumlah berita
                var jumlahBeritaElement = document.getElementById('jumlahBerita');

                // Menampilkan jumlah berita pada dashboard dengan Font Awesome icon
                jumlahBeritaElement.innerHTML = '<i class="fas fa-newspaper"></i> Jumlah Berita: ' + dataJumlahBerita[0].jumlah_berita;
            })
            .catch(function(error) {
                console.error("Error fetching data:", error);
            });
      </script>
      <script>
        function downloadPDF() {
            // Ambil elemen canvas dari chart
            var canvas = document.getElementById('newsChart');
            // Konversi elemen canvas menjadi gambar
            var imgData = canvas.toDataURL('image/png');
            // Ambil tahun terpilih dari dropdown
            var selectedYear = document.getElementById('tahunSelect').value;
            // Definisikan content untuk PDF menggunakan pdfmake
            var docDefinition = {
                content: [{
                        text: 'Laporan Tahun ' + selectedYear,
                        style: 'header'
                    },
                    {
                        image: imgData,
                        width: 500
                    }
                ],
                styles: {
                    header: {
                        fontSize: 18,
                        bold: true,
                        margin: [0, 0, 0, 10],
                    }
                },
            };
            // Buat PDF menggunakan pdfmake
            pdfMake.createPdf(docDefinition).download('laporan_' + selectedYear + '_pdf.pdf');
        }
    </script>

    <footer class="footer position-absolute bottom-2 py-2 w-100">
        <div class="container">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-12 col-md-6 my-auto">
                    <div class="col-12">

                    </div>
                </div>
            </div>
    </footer>
    <div class="text-center">
        <p class="text-dark my-4 text-sm font-weight-normal">
            Copyright © <script>
                document.write(new Date().getFullYear())
            </script> 21552011098_M Wipaldi Nurpadilah_KELOMPOK3_TIFRP-221PA <a href="" target="_blank">UASWEB1</a>.
        </p>
    </div>
ini kelola
