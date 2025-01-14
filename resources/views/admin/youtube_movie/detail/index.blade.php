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
                            <a href="{{ url('admin/youtube_movie') }}">一覧へ</a>
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
                                <td>{{ $row->filming_date ? \Carbon\Carbon::parse($row->filming_date)->format('Y年m月d日') : '' }}</td>
                            </tr>
                            <tr>
                                <td>URL</td>
                                <td><a target="_blank" href="https://www.youtube.com/watch?v={{ $row->url }}">{{ $row->url }}</a></td>
                            </tr>
                            <tr>
                                <td>動画</td>
                                <td class="">
                                    <iframe
                                        class="youtube"
                                        src="https://www.youtube.com/embed/{{ $row->url }}&quality=hd1080"
                                        title="YouTube video player"
                                        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
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