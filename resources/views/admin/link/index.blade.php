@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Link Terkait</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-link"></i> Link Terkait</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('link.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('link.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('link.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan nama">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" style="text-align: center;width: 6%">NO.</th>
                                <th scope="col">NAMA</th>
                                <th scope="col">URL</th>
                                <th scope="col">IMAGE</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($links as $no => $link)
                                <tr>
                                    <th scope="row" style="text-align: center">{{ ++$no + ($links->currentPage()-1) * $links->perPage() }}</th>
                                    <td>{{ $link->name }}</td>
                                    <td><a href="{{ $link->url }}">{{ $link->url }}</a></td>
                                    <td>
                                        @if(Storage::disk('public')->exists($link->image ?? null))

                                        <img src="{{ Storage::url($link->image ?? null) }}" width="100px" alt="image-link" />
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @can('link.edit')
                                            <a href="{{ route('link.edit', $link->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endcan

                                        @can('link.delete')
                                            <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $link->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="5">Empty</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{$links->links("vendor.pagination.bootstrap-4")}}
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
                        url: "{{ route("link.index") }}/"+id,
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
