<?php
// include('header.php');
// include('check_session.php');

//Ambil ID dari $_POST
$id = isset($_POST['id']) ? $_POST['id'] : null;
//$id = 4;
?>

<div class="container mt-5">
    <h2 class="mb-4">Add Books From</h2>

    <!-- <form id="addBooksAddFrom"> -->
    <form>
    <input type="hidden" value="<?php echo $id ?>" id="booksId">

        <div class="form-group">
            <label for="judul">Title:</label>
            <input type="text" class="from-control" maxlength="50" id="judul" name="judul" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Content:</label>
            <!-- <input type="text" class="from-control" id="deskripsi" name="judul" required> -->
            <textarea class="from-control" id="deskripsi" name="deskripsi" required></textarea>
        </div>

        <div class="form-group">
            <label for="url_image">Image:</label>
            <input type="file" class="from-control" id="url_image" name="url_image"  accept="image/*" required>
        </div>


        <button type="button" class="btn btn-primary" onclick="editBooks()">Edit Books</button>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function getData() {
        const booksId = document.getElementById('booksId').value;
        console.log(":IDDD"+ booksId);
        var formData =new FormData();
        formData.append('booksid', booksId);
        //Lakukan permintaan AJAX untuk mendapatkan data berita berdasarkan ID
        axios.post('https://client-server-wipal.000webhostapp.com/selectdata.php', formData).then(function(response) {
            //Isi nilai input dengan data yang diterima 
            console.log("Data "+ response.data);
            document.getElementById('judul').value = response.data.data.title;
            document.getElementById('deskripsi').value = response.data.data.desc;
        })
        .catch(function(error) {
            console.error(error);
            alert('Error fetching books data', error);  
        });
    }

    function editBooks() {
        const booksId = document.getElementById('booksId').value;
        const judul  = document.getElementById('judul').value;
        const deskripsi = document.getElementById('deskripsi').value;
        const urlImageInput = document.getElementById('url_image');
        const url_image = urlImageInput.files[0];
        const tanggal = new Date().toISOstring().split('T')[0];
        //Get from data
        var formData = new formData();
        formData.append('booksid', booksId);
        formData.append('judul', judul);
        formData.append('deskripsi', deskripsi);
        formData.append('tanggal', tanggal);

        if (urlImageInput.files.length > 0) {
            formData.append('url_image', url_image);
        }else{
            formData.append('url_image', null);
            //Tidak perlu menambahkan 'url_image' karna tidak ada file yang dipilih 
        }
        //Lakukan permintaan AJAX untuk mengedit berita
        axios.post('https://server-silvia.000webhostapp.com/editbooks.php', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        }) 
        .then(function(response){
            console.log(response.data);
            alert(response.data); //Tampilkan pesan berhasil atau tanggapan yang sesuai  
            window.location.href = 'kelola.php';
        })
        .catch(function(error) {
            console.error(error);
            alert('Error editing books.');
        });
    }
    window.onload = getData;
</script>