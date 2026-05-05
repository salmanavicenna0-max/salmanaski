<?php
// 1. Ambil Semua User (Gunakan tb_user dan tb_outlet)
function getAllUser($conn) {
    $query = "SELECT tb_user.*, tb_outlet.nama as nama_outlet 
              FROM tb_user 
              LEFT JOIN tb_outlet ON tb_user.id_outlet = tb_outlet.id";
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Error Query: " . mysqli_error($conn));
    }
    return $result;
}

// 2. Ambil Satu User (Untuk Edit)
function getUserById($conn, $id) {
    $query = "SELECT * FROM tb_user WHERE id = $id";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

// 3. Tambah User
function tambahUser($conn, $data) {
    $nama      = mysqli_real_escape_string($conn, $data['nama']);
    $username  = mysqli_real_escape_string($conn, $data['username']);
    $id_outlet = $data['id_outlet'];
    $role      = $data['role'];
    $password  = password_hash($data['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO tb_user (nama, username, password, id_outlet, role) 
              VALUES ('$nama', '$username', '$password', '$id_outlet', '$role')";
    return mysqli_query($conn, $query);
}

// 4. Update User
function updateUser($conn, $data) {
    $id        = $data['id'];
    $nama      = mysqli_real_escape_string($conn, $data['nama']);
    $username  = mysqli_real_escape_string($conn, $data['username']);
    $id_outlet = $data['id_outlet'];
    $role      = $data['role'];

    if (!empty($data['password'])) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $query = "UPDATE tb_user SET nama='$nama', username='$username', password='$password', id_outlet='$id_outlet', role='$role' WHERE id=$id";
    } else {
        $query = "UPDATE tb_user SET nama='$nama', username='$username', id_outlet='$id_outlet', role='$role' WHERE id=$id";
    }
    return mysqli_query($conn, $query);
}

// 5. Hapus User
function hapusUser($conn, $id) {
    $query = "DELETE FROM tb_user WHERE id = $id";
    return mysqli_query($conn, $query);
}
// ============================================
// FUNGSI CRUD PAKET
// ============================================

// Ambil Semua Paket
function getAllPaket($conn) {
    $query = "SELECT tb_paket.*, tb_outlet.nama as nama_outlet 
              FROM tb_paket 
              LEFT JOIN tb_outlet ON tb_paket.id_outlet = tb_outlet.id";
    $result = mysqli_query($conn, $query);
    if (!$result) die("Error Query getAllPaket: " . mysqli_error($conn));
    return $result;
}

// Ambil Satu Paket
function getPaketById($conn, $id) {
    $query = "SELECT * FROM tb_paket WHERE id = $id";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

// Tambah Paket
function tambahPaket($conn, $data) {
    $id_outlet  = $data['id_outlet'];
    $jenis      = $data['jenis'];
    $nama_paket = mysqli_real_escape_string($conn, $data['nama_paket']);
    $harga      = $data['harga'];

    $query = "INSERT INTO tb_paket (id_outlet, jenis, nama_paket, harga) 
              VALUES ('$id_outlet', '$jenis', '$nama_paket', '$harga')";
    return mysqli_query($conn, $query);
}

// Update Paket
function updatePaket($conn, $data) {
    $id         = $data['id'];
    $id_outlet  = $data['id_outlet'];
    $jenis      = $data['jenis'];
    $nama_paket = mysqli_real_escape_string($conn, $data['nama_paket']);
    $harga      = $data['harga'];

    $query = "UPDATE tb_paket SET id_outlet='$id_outlet', jenis='$jenis', nama_paket='$nama_paket', harga='$harga' WHERE id=$id";
    return mysqli_query($conn, $query);
}

// Hapus Paket
function hapusPaket($conn, $id) {
    $query = "DELETE FROM tb_paket WHERE id = $id";
    return mysqli_query($conn, $query);
}

// ============================================
// FUNGSI CRUD TRANSAKSI
// ============================================

// Ambil Semua Transaksi
function getAllTransaksi($conn) {
    $query = "SELECT tb_transaksi.*, tb_member.nama as nama_member, tb_user.nama as nama_user, tb_outlet.nama as nama_outlet 
              FROM tb_transaksi 
              LEFT JOIN tb_member ON tb_transaksi.id_member = tb_member.id
              LEFT JOIN tb_user ON tb_transaksi.id_user = tb_user.id
              LEFT JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id
              ORDER BY tb_transaksi.id DESC";
    $result = mysqli_query($conn, $query);
    if (!$result) die("Error Query getAllTransaksi: " . mysqli_error($conn));
    return $result;
}

// Ambil Satu Transaksi beserta Detail Transaksi
function getTransaksiById($conn, $id) {
    $query = "SELECT tb_transaksi.*, tb_member.nama as nama_member, tb_member.tlp as tlp_member, tb_member.alamat as alamat_member, tb_user.nama as nama_user, tb_outlet.nama as nama_outlet 
              FROM tb_transaksi 
              LEFT JOIN tb_member ON tb_transaksi.id_member = tb_member.id
              LEFT JOIN tb_user ON tb_transaksi.id_user = tb_user.id
              LEFT JOIN tb_outlet ON tb_transaksi.id_outlet = tb_outlet.id
              WHERE tb_transaksi.id = $id";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function getDetailTransaksi($conn, $id_transaksi) {
    $query = "SELECT tb_detail_transaksi.*, tb_paket.nama_paket, tb_paket.harga, (tb_detail_transaksi.qty * tb_paket.harga) as subtotal
              FROM tb_detail_transaksi 
              LEFT JOIN tb_paket ON tb_detail_transaksi.id_paket = tb_paket.id
              WHERE tb_detail_transaksi.id_transaksi = $id_transaksi";
    return mysqli_query($conn, $query);
}

// Fungsi generate invoice
function generateInvoice($conn) {
    $tgl = date('Ymd');
    $query = "SELECT max(kode_invoice) as max_inv FROM tb_transaksi WHERE kode_invoice LIKE 'INV-$tgl-%'";
    $data = mysqli_fetch_assoc(mysqli_query($conn, $query));
    $max_inv = $data['max_inv'];
    $urutan = 1;
    if($max_inv){
        $urutan = (int) substr($max_inv, 13, 3) + 1;
    }
    return 'INV-' . $tgl . '-' . sprintf("%03s", $urutan);
}

// Tambah Transaksi & Detail
function tambahTransaksi($conn, $data) {
    $id_outlet    = isset($_SESSION['id_outlet']) && $_SESSION['id_outlet'] ? $_SESSION['id_outlet'] : (isset($data['id_outlet']) ? $data['id_outlet'] : 1);
    $id_user      = isset($_SESSION['id']) ? $_SESSION['id'] : 1; // Assuming id_user is session id
    $kode_invoice = generateInvoice($conn);
    $id_member    = $data['id_member'];
    $tgl          = date('Y-m-d H:i:s');
    $batas_waktu  = $data['batas_waktu'] . ' 23:59:59';
    $biaya_tambahan = empty($data['biaya_tambahan']) ? 0 : $data['biaya_tambahan'];
    $diskon       = empty($data['diskon']) ? 0 : $data['diskon'];
    $pajak        = empty($data['pajak']) ? 0 : $data['pajak'];
    $status       = 'baru';
    $dibayar      = 'belum_dibayar';

    mysqli_begin_transaction($conn);
    try {
        $queryTransaksi = "INSERT INTO tb_transaksi (id_outlet, kode_invoice, id_member, tgl, batas_waktu, biaya_tambahan, diskon, pajak, status, dibayar, id_user) 
                           VALUES ('$id_outlet', '$kode_invoice', '$id_member', '$tgl', '$batas_waktu', '$biaya_tambahan', '$diskon', '$pajak', '$status', '$dibayar', '$id_user')";
        if(!mysqli_query($conn, $queryTransaksi)){
             throw new Exception("Error inserting transaksi");
        }
        $id_transaksi = mysqli_insert_id($conn);

        // Insert Detail (we assume single item for simplicity of the form, or array if multiple)
        // Here we assume single item from form
        $id_paket = $data['id_paket'];
        $qty      = $data['qty'];
        $ket      = empty($data['keterangan']) ? '' : mysqli_real_escape_string($conn, $data['keterangan']);
        
        $queryDetail = "INSERT INTO tb_detail_transaksi (id_transaksi, id_paket, qty, keterangan) 
                        VALUES ('$id_transaksi', '$id_paket', '$qty', '$ket')";
        if(!mysqli_query($conn, $queryDetail)){
             throw new Exception("Error inserting detail transaksi");
        }

        mysqli_commit($conn);
        return true;
    } catch (Exception $e) {
        mysqli_rollback($conn);
        return false;
    }
}

// Update Status Transaksi
function updateStatusTransaksi($conn, $id, $status, $dibayar) {
    $tgl_bayar = ($dibayar == 'dibayar') ? date('Y-m-d H:i:s') : 'NULL';
    $query = "UPDATE tb_transaksi SET status='$status', dibayar='$dibayar'";
    if($dibayar == 'dibayar') {
        $query .= ", tgl_bayar='$tgl_bayar'";
    } else {
        $query .= ", tgl_bayar=NULL";
    }
    $query .= " WHERE id=$id";
    return mysqli_query($conn, $query);
}

// Hapus Transaksi
function hapusTransaksi($conn, $id) {
    mysqli_query($conn, "DELETE FROM tb_detail_transaksi WHERE id_transaksi=$id");
    $query = "DELETE FROM tb_transaksi WHERE id = $id";
    return mysqli_query($conn, $query);
}
?>