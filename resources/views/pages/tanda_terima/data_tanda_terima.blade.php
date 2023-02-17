@foreach ($tandaTerima as $row)
<tr>
    <?php
    $message = "*Halo * %0a";
    $message .= "Berikut link untuk tanda terima anda :%0a%0a";
    $message .= URL::to(Request::root() . '/customer/ak-' . $row->id_servisan) ." %0a%0a";
    $message .= "(Jangan bagikan link ini kepada siapapun, Tanda terima ini digunakan untuk mengambil laptop anda)";
  ?>
    <td>{{ $row->id_servisan }}</td>
    <td>{{ $row->tgl_masuk }}</td>
    <td>{{ $row->customer->nama_customer . '(' . $row->customer->no_hp . ')' }}</td>
    <td>{{ $row->brand->nama_brand . ' / ' . $row->model->nama_model }}</td>
    <td>{{ $row->masalah }}</td>
    <td>{{ $row->catatan }}</td>
    <td>
        <span class="btn" style="background:{{ $row->warna }}">
            .
        </span>
    </td>
    <td>
        @if(!$row->tgl_keluar)
        <a onclick="return confirm('yakin')" href="{{ URL::to('/admin/keluarkan/' . $row->id_servisan) }}" class="badge badge-danger"><i class="fas fa-sign-out"></i></a>
        @else 
        {{ $row->tgl_keluar  }}
        @endif
    </td>
    <td>
        <a href="{{ URL::to('/customer/ak-'. $row->id_servisan) }}" class="btn btn-info">
            <i class="fas fa-print"></i>
        </a>
        @desktop
        <a target="_blank" href="https://web.whatsapp.com/send?phone={{ convertNoHp($row->customer->no_hp) }}&text={{ $message }}" class="btn btn-success text-white">
            <i class="fab fa-whatsapp"></i>
        </a>
        @enddesktop
        @mobile
        <a target="_blank" href="https://api.whatsapp.com/send?phone={{ convertNoHp($row->customer->no_hp) }}&text={{ $message }}" class="btn btn-success text-white">
            <i class="fab fa-whatsapp"></i>
        </a>
        @endmobile
    </td>
    <td class="option">
        <div class="btn-group dropleft btn-option">
            <i type="button" class="dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </i>
            <div class="dropdown-menu">
                {{-- <a data-pengguna='@json($p)' data-toggle="modal"
                    data-target="#modalLayanan" class="dropdown-item kaitkan" href="#"><i
                        class="fas fa-link"> Kaitkan data</i></a> --}}
                <a data-tanda_terima='@json($row)' data-toggle="modal"
                    data-target="#modalLayanan" class="dropdown-item edit" href="#"><i
                        class="fas fa-pen"> </i> Edit</a>
                <a data-id_servisan="{{ $row->id_servisan }}"
                    class="dropdown-item hapus" href="#"><i class="fas fa-trash"> </i>
                    Hapus</a>
            </div>
        </div>
    </td>
</tr>
@endforeach

