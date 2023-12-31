@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>
        </div>

        <div class="section-body">

            @can('sliders.create')
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-laptop"></i> Upload Slider</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('slider.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>GAMBAR</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">

                                @error('image')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>CAPTION</label>
                                <input type="text" name="title" placeholder="Masukkan caption" class="form-control @error('title') is-invalid @enderror">

                                @error('title')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>KETERANGAN (Opsional)</label>
                                <input type="text" name="keterangan" placeholder="Masukkan Keterangan" class="form-control @error('keterangan') is-invalid @enderror">

                                @error('keterangan')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-upload"></i> UPLOAD</button>
                            <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                        </form>

                    </div>
                </div>
            @endcan

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-laptop"></i> Slider</h4>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">FOTO</th>
                                <th scope="col">CAPTION</th>
                                <th scope="col">KETERANGAN</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($sliders as $no => $slider)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($sliders->currentPage()-1) * $sliders->perPage() }}</th>
                                    <td><img src="{{ $slider->image }}" style="width: 200px"></td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->keterangan }}</td>
                                    <td class="text-center">
                                        @can('sliders.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $slider->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="4">Empty</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$sliders->links("vendor.pagination.bootstrap-4")}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<script>
    //ajax delete
    function Delete(id)
        {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGHAPUS DATA INI!",
                icon: "warning",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {

                    //ajax delete
                    jQuery.ajax({
                        url: "{{ route("slider.index") }}/"+id,
                        data:     {
                            "id": id,
                            "_token": token
                        },
                        type: 'DELETE',
                        success: function (response) {
                            if (response.status == "success") {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIHAPUS!',
                                    icon: 'success',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }else{
                                swal({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIHAPUS!',
                                    icon: 'error',
                                    timer: 1000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
</script>
@stop
