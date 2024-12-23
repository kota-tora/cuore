
@extends('admin.common.master')

@section('title', 'Dashboard')

@section('content_header')
    <h1>FCクオーレ管理画面</h1>
@stop

@section('plugins.Sweetalert2', true)

@section('content')


    <p>メンバー応募一覧</p>

    <div class="card card-gray">
        <div class="card-header">
            <h3 class="card-title">一覧</h3>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>名前</th>
                    <th>年齢</th>
                    <th>性別</th>
                    <th>応募日時</th>
                    <th style="width: 40px">詳細</th>
                    <th style="width: 40px">削除</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lists as $list)
                    <tr>
                        <td>{{ $list->recruit_id }}</td>
                        <td>{{ $list->name }}</td>
                        <td>{{ $list->age }}</td>
                        <td>{{ $list->gender }}</td>
                        <td>{{ $list->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.recruit.show', ['recruit_id' => $list->recruit_id]) }}"><span class="badge bg-primary">詳細</span></a>
                        </td>
                        <td>
                            <form action="{{ route('admin.recruit.destroy', ['recruit_id' => $list->recruit_id]) }}" method="post">
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
@stop


@push('js')
@endpush
