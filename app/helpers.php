<?php

use App\Models\FavoritModel;
use App\Models\KategoriModel;
use App\Models\LogAktivitasModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\Types\Null_;
use PhpParser\Node\Expr\FuncCall;

use function PHPUnit\Framework\isNull;


function convertNoHp($noHp)
{
    return '62' . substr($noHp, 1);
}

function getBrandLaptops()
{
    return json_encode([
        "Acer",
        "Alienware",
        "Apple",
        "Asus",
        "Dell",
        "HP",
        "Huawei",
        "Lenovo",
        "LG",
        "MSI",
        "Razer",
        "Samsung",
        "Sony",
        "Toshiba"
    ]);
}

function removeSpace($string)
{
    return str_replace(" ", "", $string);
}

function getUserRoleName($userRoleId)
{
    return DB::table('users')
        ->Join('role', 'role.id_role', '=', 'users.id_role')
        ->where('users.id_role', $userRoleId)
        ->select('nama_role')
        ->first()->nama_role;
}


function sweetAlert($pesan, $tipe)
{
    echo '<script>document.addEventListener("DOMContentLoaded", function() {
        Swal.fire(
            "' . $pesan . '",
            "proses berhasil di lakukan",
            "' . $tipe . '",
        );
    })</script>';
}
