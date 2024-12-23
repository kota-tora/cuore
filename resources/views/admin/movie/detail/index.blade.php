@extends('admin.common.master')

@section('title', 'Dashboard')

@section('content_header')
    <h1>FCクオーレ管理画面</h1>
@stop

@section('plugins.Sweetalert2', true);

@section('content')

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">追加</h3>
                        <div class="right">
                            <a href="{{ url('admin/movie') }}">一覧へ</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                            <tr>
                                <td class="col-md-3">タイトル</td>
                                <td class="col-md-9">{{ $row->title }}</td>
                            </tr>
                            <tr>
                                <td>公開状態</td>
                                <td>{{ $row->up_flg ? '公開' : '非公開' }}</td>
                            </tr>
                            <tr>
                                <td>撮影日</td>
                                <td>{{ $row->photo_date ? \Carbon\Carbon::parse($row->photo_date)->format('Y年m月d日') : '' }}</td>
                            </tr>
                            <tr>
                                <td>ファイル名</td>
                                <td>{{ $row->name }}</td>
                            </tr>
                            <tr>
                                <td>動画</td>
                                <td class="">
                                    <video
                                        ref="video" src="{{ asset('storage/images/gallery/movies/' . $row->name ) }}"
                                        controls controlslist="nodownload playbackRate"
                                        style="width: 100%"
                                    >
                                    </video>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
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
@endpush