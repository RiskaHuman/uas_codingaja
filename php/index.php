<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
// Fungsi untuk memeriksa session
function checkSession() {

  // Ambil session_token dari localStorage
  const sessionToken = localStorage.getItem("session_token");

  // Membuat objek FormData
  const formData = new FormData();
  formData.append('session_token', sessionToken);

  // Kirim session_token ke server untuk memeriksanya
  axios.post('https://client-server-wifal.000webhostapp.com/session.php', formData)

    .then(response => {
      // Handle respons dari server
      console.log(response);

      if (response.data.status === 'success') {
        // Jika session masih aktif, arahkan ke halaman dashboard.php
        const nama = (response.data.hasil && response.data.hasil.name) || "Default Name";

        localStorage.setItem("nama", nama);
        window.location.href = 'dashboard.php';
      } else {
        // Session tidak aktif, lakukan yang sesuai (misalnya, tampilkan pesan)
        window.location.href = 'login.php';
      }
    })
    .catch(error => {
      // Handle kesalahan koneksi atau server
      console.error('Error checking session:', error);
    });
}

// Panggil fungsi checkSession saat halaman dimuat
checkSession();
</script>
