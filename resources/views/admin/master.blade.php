<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="QuocTuan.Info"/>
    <link rel="stylesheet" href="{!! asset('public/qt64_admin/template/css/style.css') !!}"/>
    <title>@yield('title')</title>
</head>

<body>
<div id="layout">
    <div id="top">
        Admin Area :: Trang chính
    </div>
    <div id="menu">
        <table width="100%">
            <tr>
                <td>
                    <a href="{!! asset('/admin') !!}">Trang chính</a> | <a href="{!! route('getUserList') !!}">Quản lý user</a> | <a href="">Quản
                        lý danh mục</a> | <a
                            href="">Quản lý tin</a>
                </td>
                <td align="right">
                    Xin chào {!! Auth::user()->username !!} | <a href="{!! url('logout') !!}">Logout</a>
                </td>
            </tr>
        </table>
    </div>
    <div id="main">
        @include('admin.blocks.error')
        @include('admin.blocks.flash')
        @yield("content")
    </div>
    <div id="bottom">
        Copyright © 2016 by QuyetPham
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="{!! asset('public/qt64_admin/template/js/myJs.js') !!}"></script>
</body>
</html>