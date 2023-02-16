<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\Retur;
use App\Models\Servisan;
use App\Models\User;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;


class General extends Controller
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function dashboard()
    {

        // DATA GRAFIK
        $timezone = 'Asia/Makassar';
        $date = new DateTime('now', new DateTimeZone($timezone));
        $data['tgl_sekarang'] = $date->format('Y-m-d');
        $data['jam_sekarang'] = $date->format('H:i:s');

        return view('pages.dashboard.index', $data);
    }

    public function profile()
    {
        $data['user'] = $this->userModel->getUserProfile(auth()->user()->id);
        return view('pages.profile.index', $data);
    }

    public function bantuan()
    {
        return view('pages.bantuan.index');
    }

    public function ubahRole(Request $request)
    {
        User::where('id', auth()->user()->id)
            ->update(['role' => $request->post('role')]);
        return redirect()->back();
    }

    public function ubahFotoProfile(Request $request)
    {

        $extensions = ['jpg', 'jpeg', 'png'];

        $result = array($request->foto->getClientOriginalExtension());

        if (in_array($result[0], $extensions)) {
            $file = $request->foto;
        } else {
            return redirect()->back()->with('error', 'format file tidak di dukung');
        }

        // $fileName = auth()->user()->email . "." . $request->foto->extension();
        $fileName = uniqid() . "." . $request->foto->extension();
        $request->foto->move(public_path('data/foto_profile/' . $fileName . '/'), $fileName);

        // Storage::disk('uploads')->put($fileName, file_get_contents($request->foto->getRealPath()));

        User::where('id', auth()->user()->id)
            ->update(['foto' => $fileName]);
        return redirect()->back();
    }

    public function customer($_idCustomer)
    {
        $arrIdCustomer = explode("-", $_idCustomer);
        $specialCode = reset($arrIdCustomer);

        if ($specialCode == 'ak') {
            $idCustomer = end($arrIdCustomer);
            $data['servisan'] = Servisan::where('id_servisan', $idCustomer)->first();
            $data['id_customer'] = $_idCustomer;
            return view('pages.customer.index', $data);
        }
    }
}
