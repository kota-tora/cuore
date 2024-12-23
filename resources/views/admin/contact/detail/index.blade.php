
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>問い合わせ詳細画面</h1>
@stop

@section('content')
    {{--    <p>メンバー応募詳細</p>--}}

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><a href="{{ route('admin.contact') }}">一覧へ</a></h3>
            <div class="card-tools">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td class="w-25">ID</td>
                    <td>{{ $contact->contact_id }}</td>
                </tr>
                <tr>
                    <td class="w-25">名前</td>
                    <td>{{ $contact->name }}</td>
                </tr>
                <tr>
                    <td class="w-25">メールアドレス</td>
                    <td>{{ $contact->mail }}</td>
                </tr>
                <tr>
                    <td class="w-25">カテゴリID</td>
                    <td>{{ $contact->category_id }}</td>
                </tr>
                <tr>
                    <td class="w-25">内容</td>
                    <td>{{ $contact->content }}</td>
                </tr>
                <tr>
                    <td class="w-25">応募日時</td>
                    <td>{{ $contact->created_at }}</td>
                </tr>
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
