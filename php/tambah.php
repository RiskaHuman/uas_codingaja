<?php
// Tambah.php
include('header.php');
include('check_session.php');
?>

<div class="container mt-5">

  <!-- <form id="addNewsForm">
    <div class="form-group">
      <label for="judul">Title:</label>
      <input type="text" class="form-control" maxlength="50" id="judul" name="judul" required>
    </div>

    <div class="form-group">
      <label for="deskripsi">Content:</label>
      <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
    </div>

    <div class="form-group">
      <label for="url_image">Image:</label>
      <input type="file" class="form-control-file" id="url_image" name="url_image" accept="image/*" required>
    </div>

    <button type="button" class="btn btn-primary" onclick="addNews()">Add News</button>
  </form>
</div> -->
<div class="container mt-5">
  <h2 class="mb-4">Add News from</h2>
  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Tambah Katalog</h3>
</div>
  <form id="addNewsForm">
  <div class="card-body">
    <div class="form-group">
      <label for="judul">Title:</label>
      <input type="text" class="form-control" maxlength="50" id="judul" name="judul" required>
    </div>
  </div>

  <div class="card-body">
    <div class="form-group">
      <label for="deskripsi">Content:</label>
      <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
    </div>
  </div>

    <div class="card-body">  
    <div class="form-group">
        <label for="url_image">Image:</label>
        <input type="file" class="form-control-file" id="url_image" name="url_image" accept="image/*" required>
      </div>
    </div>
  </form>
  <div></div>
  <div class="col-12">
  <div class="card-body"> 
  <div class="form-group">
          <button type="button" class="btn btn-primary" onclick="addNews()">Add News</button>
  </div>
  </div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
function addNews() {
  const judul = document.getElementById('judul').value;
  const deskripsi = document.getElementById('deskripsi').value;
  const urlImageInput = document.getElementById('url_image');
  const url_image = urlImageInput.files[0];
  const tanggal = new Date().toISOString().split('T')[0];

  // Get form data
  var formData = new FormData();

  formData.append('judul', judul);
  formData.append('deskripsi', deskripsi);
  formData.append('url_image', url_image);
  formData.append('tanggal', tanggal);

  // Make POST request using Axios
  axios.post('https://client-server-wifal.000webhostapp.com/addnews.php', formData, {
    headers: {
      'Content-Type': 'multipart/form-data',
    },
  })
    .then(function(response) {
      console.log(response.data);
      alert(response.data); // You can handle the response as needed

      document.getElementById('addNewsForm').reset();
    })
    .catch(function(error) {
      alert('Error adding news.'); // Handle error appropriately
    });
}
</script>
