@extends('layouts.v_template')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex  justify-content-between">
                    <h4>Tanda terima</h4>
                    <div class="table-tools d-flex justify-content-around ">
                        <input type="text" class="form-control card-form-header mr-3"
                            placeholder="Cari Data Pengguna ..." id="searchbox">
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" id="addUserBtn"
                            data-target="#modalLayanan"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body ">
                    <table class="table table-striped table-hover table-user table-action-hover" id="table-data">
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Customer</td>
                                <td>Tgl Masuk</td>
                                <td>Brand / Model</td>
                                <td>Masalah </td>
                                <td>Catatan </td>
                                <td>Warna</td>
                                <td>Tgl Keluar</td>
                                <td>Aksi</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @include('pages.tanda_terima.data_tanda_terima')
                        </tbody>
                    </table>
                    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
{{-- MODAL TAMBAH PENGGUNA --}}
<div class="modal fade" id="modalLayanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}


            {{-- MODAL BODY UNTUK TAMBAH USER DAN EDIT USER --}}
            <div class="modal-body" id="main-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <!-- MultiStep Form -->
    <div class="row justify-content-center mt-0">
        <div class="col-lg-12 text-center p-0 mt-3 mb-2">
            <div class="card shadow-none px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Tambah data </strong></h2>
                <p>lengkapi data sebelum lanjutkan kehalaman berikutnya</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="customer"><strong>Customer</strong></li>
                                <li id="servisan"><strong>Servisan</strong></li>
                                <li id="masalah"><strong>Masalah</strong></li>
                                <li id="catatan"><strong>Catatan</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card p-0 shadow-none">
                                    <h2 class="fs-title">Informasi Customer</h2>
                                    <div class="form-group">
                                        <label for="nama_customer">nama_customer</label>
                                        <input type="hidden" class="form-control" name="id_servisan" id="id_servisan" >
                                        <input type="text" class="form-control" name="nama_customer" id="nama_customer" >
                                    </div>
                                    <div class="form-group">
                                        <label for="no_hp">no_hp</label>
                                        <input type="text" class="form-control" name="no_hp" id="no_hp">
                                    </div>
                                    <div class="form-group">
                                        <label for="tgl_masuk">tgl_masuk</label>
                                        <input type="date" class="form-control" name="tgl_masuk" id="tgl_masuk" value="{{ Date('Y-m-d') }}">
                                    </div>
                                </div>
                                <input type="button" name="next" class="next action-button" value="Lanjut"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card shadow-none p-0">
                                    <h2 class="fs-title">Informasi Servisan</h2>
                                    <div class="form-group">
                                        <label for="brand">Brand</label>
                                        <input type="text" class="form-control" name="brand" id="brand">
                                    </div>
                                    <div class="form-group">
                                        <label for="model">Model</label>
                                        <input type="text" class="form-control" name="model" id="model">
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="kembali"/>
                                <input type="button" name="next" class="next action-button" value="Lanjut"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card p-0 shadow-none">
                                    <h2 class="fs-title">Detail Masalah</h2>
                                    <div class="form-group">
                                        <label for="detail_masalah">detail_masalah</label>
                                        <input type="text" class="form-control" name="masalah" id="detail_masalah">
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="kembali"/>
                                <input type="button" name="next" class="next action-button" value="Lanjut"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card p-0 shadow-none">
                                    <h2 class="fs-title">Catatan</h2>
                                    <div class="form-group">
                                        <label for="catatan">catatan</label>
                                        <input type="text" class="form-control" name="catatan" id="catatan_tambahan">
                                    </div>
                                    <div class="form-group">
                                        <label for="warna">warna</label>
                                        <input type="color" class="form-control" name="warna" id="warna">
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="kembali"/>
                                <input type="button" name="make_payment" class="next action-button" value="Confirm" id="btn-confirm"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card shadow-none p-0">
                                    <h2 class="fs-title text-center">Success !</h2>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3">
                                            <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5>Data telah berhasil disimpan !</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="modalBtn">Tambah</button>
            </div> --}}
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {

      


        $('#btn-confirm').on('click',function(){
            let formData = $('#msform').serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , url: '/admin/create_tanda_terima'
                , method: 'post'
                // , dataType: 'json'
                , data: {
                    formData: formData
                }
                , success: function(data) {
                    console.log(data);
                    if (data == 1) {
                        Swal.fire('Berhasil', 'Data berhasil di tambah', 'success').then((result) => {
                            location.reload();
                        });
                    } else if(data == 2){
                        Swal.fire('Berhasil', 'Data berhasil di update', 'success').then((result) => {
                            location.reload();
                        });
                    }
                }
                , error: function(err){
                    console.log(err);
                }
            })
        })


        let jsonLaptop = '{{ getBrandLaptops() }}';
        let fixJsonLaptop = jsonLaptop.replace(/&quot;/g, '"');
        $('#brand').autocomplete({
            source: JSON.parse(fixJsonLaptop)
        });

        let customer = '{{ $customer }}';
        let fixJsonCustomer = customer.replace(/&quot;/g, '"');
        let jsonCustomer = JSON.parse(fixJsonCustomer);
        let customerArr = jsonCustomer.map(obj => obj.nama_customer + " / " + obj.no_hp);
        $('#nama_customer').autocomplete({
            source: customerArr,
            select: function(event, ui) {
               // This code will be executed when the user selects an item
               let selectedItem = ui.item.value;
               let arrSelectedItem = selectedItem.split('/');
               setTimeout(function() {
                    $(event.target).val(arrSelectedItem[0]);
                    $('#no_hp').val(arrSelectedItem[1]);    
                }, 0);
            }
        });


        let model = '{{ $model }}';
        let fixJsonModel = model.replace(/&quot;/g, '"');
        let jsonModel = JSON.parse(fixJsonModel);
        let modelArr = jsonModel.map(obj => obj.nama_model);
        $('#model').autocomplete({
            source: modelArr,
        });

        let servisan = '{{ $tandaTerima }}';
        let fixServisanJson = servisan.replace(/&quot;/g, '"');
        let servisanJson = JSON.parse(fixServisanJson);
        let detailMasalahArr = servisanJson.map(obj => obj.masalah);
        let catatanArr = servisanJson.map(obj => obj.catatan);
        $('#detail_masalah').autocomplete({
            source: detailMasalahArr,
        });

        $('#catatan_tambahan').autocomplete({
            source: catatanArr,
        });


        // TOMBOL EDIT USER
        $('.table-user tbody').on('click', 'tr td a.edit', function() {
            let tanda_terima = $(this).data('tanda_terima');
            $('#tanda_terima').addClass('active');
            $('#id_servisan').val(tanda_terima.id_servisan);
            $('#nama_customer').val(tanda_terima.customer.nama_customer);
            $('#no_hp').val(tanda_terima.customer.no_hp);
            $('#tgl_masuk').val(tanda_terima.tgl_masuk);
            $('#brand').val(tanda_terima.brand.nama_brand);
            $('#model').val(tanda_terima.model.nama_model);
            $('#catatan_tambahan').val(tanda_terima.catatan);
            $('#warna').val(tanda_terima.warna);
            $('#detail_masalah').val(tanda_terima.masalah);
            $('#msform').attr('action', '/admin/update_tanda_terima');
        })

        // TOMBOL TAMBAH USER
        $('#addUserBtn').on('click', function() {
            $('#msform').attr('action', '/admin/create_tanda_terima');
        });


            // TOMBOL HAPUS USER
        $('.table-user tbody').on('click', 'tr td a.hapus', function() {
            let idServisan = $(this).data('id_servisan');
            Swal.fire({
                title: 'Apakah yakin?'
                , text: "Data tidak bisa kembali lagi!"
                , type: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#3085d6'
                , cancelButtonColor: '#d33'
                , confirmButtonText: 'Ya, Konfirmasi'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        , url: '/admin/delete_tanda_terima'
                        , method: 'post'
                        , dataType: 'json'
                        , data: {
                            id_servisan: idServisan
                        }
                        , success: function(data) {
                            if (data == 1) {
                                Swal.fire('Berhasil', 'Data telah terhapus', 'success').then((result) => {
                                    location.reload();
                                });
                            }
                        }
                        , error: function(err){
                            console.log(err);
                        }
                    })
                }
            })
        });





    });

    $('#liPembelian').addClass('active');
    $('#liDataBarang').addClass('active');

</script>
@endsection
