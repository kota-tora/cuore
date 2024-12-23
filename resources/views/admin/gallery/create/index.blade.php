
@extends('admin.common.master')

@section('title', 'Dashboard')

@section('content_header')
    <h1>FCクオーレ管理画面</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $subtitle }}</h3>
                        <div class="right">
                            <a href="{{ url('admin/gallery') }}">一覧へ</a>
                        </div>
                    </div>


                    <form action="{{ $subtitle === '追加' ? route('admin.gallery.store') : route('admin.gallery.update') }}" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">タイトル</label>
                                <input type="text" name="title" class="form-control" id="title" value="{{ old('title', !empty($row) ? $row->title : '') }}" placeholder="">
                                {!! $errors->first('title') ? '<b class="text-danger">' . $errors->first('title') . '</b>' : '' !!}
                            </div>
                            <div class="form-group">
                                <label>公開状態</label>
                                <div class="form-check">
                                    <input id="up" class="form-check-input" type="radio" name="up_flg" value="1" {{ old('up_flg', !empty($row) ? $row->up_flg : '') === 1 ? 'checked' : '' }}>
                                    <label for="up" class="form-check-label">公開</label>
                                </div>
                                <div class="form-check">
                                    <input id="close" class="form-check-input" type="radio" name="up_flg" value="0" {{ old('up_flg', !empty($row) ? $row->up_flg : '') === 0 ? 'checked' : '' }}>
                                    <label for="close" class="form-check-label">非公開</label>
                                </div>
                                {!! $errors->first('up_flg') ? '<b class="text-danger">' . $errors->first('up_flg') . '</b>' : '' !!}
                            </div>
                            <div class="form-group">
                                <label for="title">撮影日</label>
                                <input type="text"  name="photo_date" value="{{ old('photo_date', !empty($row) ? $row->photo_date  : '') }}" class="form-control datetimepicker" id="" placeholder="">
                                {!! $errors->first('photo_date') ? '<b class="text-danger">' . $errors->first('photo_date') . '</b>' : '' !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">ファイル</label>
                                <div class="text-center">
                                    <img id="img_prv" class="img-thumbnail h-25 w-25 mb-3"
                                         src="{{ !empty($row->name) ? asset('storage/images/gallery/' . $row->name ) : asset('/images/noimage.jpg') }}"
                                         alt="{{ !empty($row->name) ? $row->title : 'noimage' }}"
                                    >
                                </div>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="image" type="file" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                                {!! $errors->first('image') ? '<b class="text-danger">' . $errors->first('image') . '</b>' : '' !!}
                            </div>
                        </div>
                        <div class="card-footer">
                            @csrf
                            <input type="hidden" name="type" value="image">
                            <button type="submit" class="btn btn-primary">{{ $subtitle }}</button>
                        </div>

                        @if ($subtitle === '編集')
                            <input type="hidden" name="gallery_id" value="{{ $row->gallery_id }}">
                        @endif
                    </form>
                </div>
            </div>
        </div>

    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/admin/common.css">
@stop

@push('js')
    <script>
      // アイコン画像プレビュー処理
      $('#image').on('change', function (ev) {
        // このFileReaderが画像を読み込む上で大切
        const reader = new FileReader();
        // 画像が読み込まれた時の動作を記述
        reader.onload = function (ev) {
          $('#img_prv').attr('src', ev.target.result).css('width', '150px').css('height', '150px');
        }
        reader.readAsDataURL(this.files[0]);
      })
    </script>
@endpush