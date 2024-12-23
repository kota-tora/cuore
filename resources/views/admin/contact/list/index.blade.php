
@extends('admin.common.master')

@section('title', 'Dashboard')

@section('content_header')
    <h1>FCクオーレ管理画面</h1>
@stop

@section('plugins.Sweetalert2', true)

@section('content')
    <p>問い合わせ一覧</p>

    <div class="card card-gray">
        <div class="card-header">
            <h3 class="card-title">一覧</h3>
{{--            <div class="card-tools">--}}
{{--                <!-- Buttons, labels, and many other things can be placed here! -->--}}
{{--                <!-- Here is a label for example -->--}}
{{--                <span class="badge badge-primary">Label</span>--}}
{{--            </div>--}}
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>名前</th>
                    <th>問い合わせ日時</th>
                    <th style="width: 40px">詳細</th>
                    <th style="width: 40px">削除</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lists as $list)
                    <tr>
                        <td>{{ $list->contact_id }}</td>
                        <td>{{ $list->name }}</td>
                        <td>{{ $list->created_at }}</td>
                        <td>
                            <a href="{{ route('admin.contact.show', ['contact_id' => $list->contact_id]) }}"><span class="badge bg-primary btn-link">詳細</span></a></td>
                        <td>
                            <form action="{{ route('admin.contact.destroy', ['contact_id' => $list->contact_id]) }}" method="post">
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

@section('js')
    <script> console.log('Hi!'); </script>
@stop
