@extends('view_tool::web.layout.default')

@section('content')
    <div class="row container">
        <div class="col s12 l12">
            @include('view_tool::web.ads.gg_horizontal')
            <form class="col l12 s12" method="post" enctype="multipart/form-data" action="{{ base_url('tool/facebook-avatar') }}">
                @csrf
                <div id="font-line" class="section scrollspy">
                    <h1 class="h1-title">🪄 Tạo ảnh facebook tích xanh</h1>

                    <blockquote class="teal lighten-5" style="padding: 10px">
                        Hướng dẫn: <br/>
                        - Nhấn nút chọn ảnh bạn cần làm avatar tích xanh. <br/>
                        - Nhấn nút Tạo ảnh <br/>
                        - Nhấn nút Tải ảnh về hoặc giữ vào ảnh 3 giây để lưu ảnh. <br/>
                        - Đặt ảnh vừa tải làm ảnh đại diện facebook của bạn. <br/>
                    </blockquote>

                    <img src="{{ asset('site/img/tich-xanh-iframe.png') }}" alt="demo tich xanh" style="width: 100px; border: 1px solid #ccc">

                    <div style="margin-bottom: 20px">
                        <label class="text-center font-line-result-text" for="font-line-result-text">
                            Chọn hình ảnh
                        </label>
                        <input class="" type="file" name="avatar">
                    </div>

                    <hr/>
                    <button type="submit" class="waves-effect waves-light btn btn-small">
                        🪄 Tạo ảnh
                    </button>

                </div>
            </form>
        </div>
    </div

@endsection
