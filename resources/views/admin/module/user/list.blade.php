@extends('admin.master')
@section('title','Tài khoản')
@section('content')
    <table class="list_table">
        <tr class="list_heading">
            <td class="id_col">STT</td>
            <td>Username</td>
            <td>Level</td>
            <td class="action_col">Quản lý?</td>
        </tr>
        @foreach($data as $key=>$item)
            <tr class="list_data">
                <td class="aligncenter">{!! ++$key !!}</td>
                <td class="list_td aligncenter">{!! $item['username'] !!}</td>
                <td class="list_td aligncenter">
                    @if($item['id'] == 2) <span style="color: red; font-weight: bold;">Super Admin</span>
                    @elseif($item['level'] == 1) <span style="color: blue; font-weight: bold;">Admin</span>
                    @else <span style="color: black;">Member</span>
                    @endif
                </td>
                <td class="list_td aligncenter">
                    <a href="{!! route('getUserEdit', ['id' => $item['id']]) !!}"><img
                                src="{!! asset('public/qt64_admin/template/images/edit.png') !!}"/></a>&nbsp;&nbsp;&nbsp;
                    <a href="{!! route('getUserDelete', ['id' => $item['id']]) !!}"
                       onclick="deleteConfirm('Bạn có chắc chắn muốn xóa')"><img
                                src="{!! asset('public/qt64_admin/template/images/delete.png') !!}"/></a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
