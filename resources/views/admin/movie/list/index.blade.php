
@extends('admin.common.master')

@section('title', 'Dashboard')

@section('content_header')
    <h1>FCクオーレ管理画面</h1>
@stop

@section('plugins.Sweetalert2', true)

@section('content')

    <p>ギャラリー動画一覧</p>

    <div class="card card-gray">
        <div class="card-header">
            <h3 class="card-title">一覧</h3>
            <!-- /.card-tools -->
{{--            <ul class="nav nav-tabs justify-content-end" data-tabs="tabs">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="{{ url('admin/gallery/create') }}">--}}
{{--                        <i class="bi bi-database-add">追加</i>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="" style="width: 10px">ID</th>
                    <th class="col-md-2">タイトル</th>
                    <th class="col-md-6">動画</th>
                    <th class="">撮影日</th>
                    <th class="">公開ステータス</th>
                    <th class="" style="width: 40px">詳細</th>
{{--                    <th style="width: 40px">編集</th>--}}
                    <th class="" style="width: 40px">削除</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lists as $list)
                    <tr>
                        <td>{{ $list->gallery_id }}</td>
                        <td>{{ $list->title }}</td>
                        <td class="">
                            <video
                                ref="video" src="{{ asset('storage/images/gallery/movies/' . $list->name ) }}"
                                controls controlslist="nodownload playbackRate"
                                class="list-image"
                            >
                            </video>
                        </td>

{{--                        <td class=""><img class="list-image" src="{{ asset('images_bk/gallery/' . $list->name ) }}" alt="{{ $list->title }}"></td>--}}
                        <td>{{ $list->photo_date }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input up-flg" data-id="{{ $list->gallery_id }}" value="{{ $list->up_flg ? 0 : 1 }}" type="checkbox" @if($list->up_flg) {{ 'checked' }}@endif role="switch" >
                                <label class="form-check-label up-flg-label" for="flexSwitchCheckDefault">{{ $list->up_flg ? '公開中' : '非公開中' }}</label>
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('admin.movie.show', ['movie_id' => $list->gallery_id]) }}"><span class="badge bg-primary">詳細</span></a>
                        </td>
                        <td>
                            <form action="{{ route('admin.movie.destroy', ['movie_id' => $list->gallery_id]) }}" method="post">
                                @csrf
                                <button onclick="swalert(event, '本当に削除しますか?')" type="button" class="badge bg-danger swa-delete" id="">削除</button>
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            The footer of the card
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/admin/common.css">
@stop


@push('js')
    <script>
        $('.up-flg').click(function() {
          const galleryId = $(this).data('id');
          const upFlg = $(this).val()
          const toggle_btn = $(this);

          const postData = {
            gallery_id : galleryId,
            up_flg : upFlg
          }


          const changeLabel = upFlg === '1' ? '公開中' : '非公開中';

            $.ajax({
            url:'/admin/gallery/',
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content")
            },
            type:'PUT',
            data:postData
          }).done(function(data) {
            console.log(data)
            toggle_btn.next('.up-flg-label').text(changeLabel)
            toggle_btn.val(changeLabel === '公開中' ? 0 : 1);
          }).fail(function(data) {
            console.log(data)
          })
        })
    </script>
@endpush

