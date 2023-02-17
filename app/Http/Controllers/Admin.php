<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\JenisLayanan;
use App\Models\Loundry;
use App\Models\ModelLaptop;
use App\Models\Pelanggan;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Satuan;
use App\Models\Servisan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Admin extends Controller
{

    protected $userModel;
    protected $profileUserModel;
    protected $kritikSaranModel;
    protected $kuisionerModel;
    protected $penilaianModel;


    public function __construct()
    {
        $this->userModel = new User();
    }

    public function pengguna()
    {
        $data['pengguna'] = $this->userModel->getAllUser();
        return view('pages.pengguna.index', $data);
    }

    public function profileUser()
    {
        $data['user'] = User::all();
        $data['profile'] = $this->profileUserModel->getProfileUser();
        return view('pages.rekaptulasi_data.index', $data);
    }


    public function tandaTerima()
    {
        $data['tandaTerima'] = Servisan::all();
        $data['customer'] = Customer::all();
        $data['model'] = ModelLaptop::all();
        return view('pages.tanda_terima.index', $data);
    }


    public function keluarkanServisan($idServisan)
    {
        Servisan::where('id_servisan', $idServisan)->update([
            'tgl_keluar' => Carbon::today()
        ]);
        return redirect()->back()->with('message', 'Pengguna Berhasil di tambahkan');
    }

    public function verifikasiCustomer($whatsapp, $idCustomer)
    {
        $arrIdCustomer = explode("-", $idCustomer);
        $customer = Servisan::where('id_servisan', end($arrIdCustomer))->first();

        if ($whatsapp == $customer->customer->no_hp) {
            return 1;
        } else {
            return 0;
        }
    }


    // fetch data user by admin
    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            if ($request->filter == "") {
                $data['pengguna'] = DB::table('users')
                    ->where('role', '!=', 'Admin')
                    ->Where('name', 'like', '%' . $query . '%')
                    ->Where('email', 'like', '%' . $query . '%')
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(5);
            } else {
                $data['pengguna'] = DB::table('users')
                    ->where('role', '!=', 'Admin')
                    ->Where('role', '=', $request->filter)
                    ->Where('name', 'like', '%' . $query . '%')
                    ->Where('email', 'like', '%' . $query . '%')
                    ->orderBy($sort_by, $sort_type)
                    ->paginate(5);
            }

            return view('pages.pengguna.users_data', $data)->render();
        }
    }

    // fetch data pembelian
    function fetchDataPembelian(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);

            $data['pembelian'] = DB::table('barang')
                ->Where('nama_barang', 'like', '%' . $query . '%')
                ->orWhere('barcode', 'like', '%' . $query . '%')
                ->paginate(10);

            return view('pages.pembelian.data_pembelian', $data)->render();
        }
    }


    // CRUD SATUAN

    public function createTandaTerima(Request $request)
    {
        $box = $request->all();
        $formData =  [];
        parse_str($box['formData'], $formData);

        $idServisan = $formData['id_servisan'];

        if (!$idServisan) {
            $cekCustomer = Customer::where('no_hp', $formData['no_hp']);
            if ($cekCustomer->first()) {
                $customer = $cekCustomer->first()->id_customer;
            } else {
                $customer = Customer::create([
                    'nama_customer' => $formData['nama_customer'],
                    'no_hp' => $formData['no_hp'],
                ])->id;
            }

            $cekBrand = Brand::where('nama_brand', $formData['brand']);
            if ($cekBrand->first()) {
                $brand = $cekBrand->first()->id_brand;
            } else {
                $brand = Brand::create([
                    'nama_brand' => $formData['brand'],
                ])->id;
            }

            $cekModel = ModelLaptop::where('nama_model', $formData['model']);
            if ($cekModel->first()) {
                $model = $cekModel->first()->id_model;
            } else {
                $model = ModelLaptop::create([
                    'id_brand' => $brand,
                    'nama_model' => $formData['model'],
                ])->id;
            }

            $servisan = Servisan::create([
                'id_customer' => $customer,
                'id_brand' => $brand,
                'id_model' => $model,
                'warna' => $formData['warna'],
                'masalah' => $formData['masalah'],
                'catatan' => $formData['catatan'],
                'tgl_masuk' => $formData['tgl_masuk'],
            ]);

            return 1;
        } else {
            $cekCustomer = Customer::where('no_hp', $formData['no_hp']);
            if ($cekCustomer->first()) {
                $customer = $cekCustomer->first()->id_customer;
            } else {
                $customer = Customer::create([
                    'nama_customer' => $formData['nama_customer'],
                    'no_hp' => $formData['no_hp'],
                ])->id;
            }

            $cekBrand = Brand::where('nama_brand', $formData['brand']);
            if ($cekBrand->first()) {
                $brand = $cekBrand->first()->id_brand;
            } else {
                $brand = Brand::create([
                    'nama_brand' => $formData['brand'],
                ])->id;
            }

            $cekModel = ModelLaptop::where('nama_model', $formData['model']);
            if ($cekModel->first()) {
                $model = $cekModel->first()->id_model;
            } else {
                $model = ModelLaptop::create([
                    'id_brand' => $brand,
                    'nama_model' => $formData['model'],
                ])->id;
            }

            Servisan::where('id_servisan', $idServisan)->update([
                'id_customer' => $customer,
                'id_brand' => $brand,
                'id_model' => $model,
                'warna' => $formData['warna'],
                'masalah' => $formData['masalah'],
                'catatan' => $formData['catatan'],
                'tgl_masuk' => $formData['tgl_masuk'],
            ]);

            return 1;
        }
    }


    public function deleteTandaTerima(Request $request)
    {
        Servisan::where([
            ['id_servisan', '=', $request->id_servisan]
        ])->delete();
        return 1;
    }



    // CRUD PENGGUNA

    public function createPengguna(Request $request)
    {
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->email),
            'role' => $request->tipe_pengguna,
        ]);
        return redirect('/admin/pengguna')->with('message', 'Pengguna Berhasil di tambahkan');
    }

    public function updatePengguna(Request $request)
    {
        $user = User::where([
            ['id', '=', $request->id]
        ])->first();
        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
            'role' => $request->tipe_pengguna,
        ]);
        return redirect('/admin/pengguna')->with('message', 'Pengguna Berhasil di update');
    }

    public function deletePengguna(Request $request)
    {
        User::destroy($request->post('user_id'));
        return 1;
    }
}
