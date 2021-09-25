<!DOCTYPE html>
<html lang="en">
<head>
    @include('site.element.head')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset("site/css/materialize.min.css") }}" rel="stylesheet" media="screen,projection"/>
    <style>
        nav ul a,
        nav .brand-logo {
            color: #444;
        }

        .nav-wrapper li a.active {
            background: #0a76b7;
            color: #fff;
        }

        p {
            line-height: 2rem;
        }

        .sidenav-trigger {
            color: #26a69a;
        }

        footer.page-footer {
            margin: 0;
        }

        .sidenav-overlay {
            display: none !important;
        }

        nav, nav .nav-wrapper i, nav a.sidenav-trigger, nav a.sidenav-trigger i {
            height: 34px; line-height: 34px
        }
    </style>
    <script src="{{ asset("site/js/jquery-3.2.1.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("site/js/materialize.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("site/js/clipboard.min.js") }}" type="text/javascript"></script>
</head>

<body>
<div class="navbar-fixed">
    <nav class="white" role="navigation">
        <div class="nav-wrapper" style="">
            <ul class="hide-on-med-and-down">
                @foreach($menuMain as $item)
                    <li>
                        <a class="@if($active_menu == $item['active']) active @endif" href="{{ $item['link'] }}">
                            {!! $item['title'] !!}
                        </a>
                    </li>
                @endforeach
            </ul>

            <ul id="nav-mobile" class="sidenav">
                @foreach($menuMain as $item)
                    <li>
                        <a class="@if($active_menu == $item['active']) active @endif" href="{{ $item['link'] }}">
                            {!! $item['title'] !!}
                        </a>
                    </li>
                @endforeach
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger">
                <i class="material-icons">menu</i>
            </a>
        </div>
    </nav>
</div>

<div style="min-height: 400px">
    <div class="section">

        @yield('content')

    </div>
</div>


<footer class="page-footer teal">
   <div class="container">
       <div class="row">
           <div class="col l6 s12">
               <h5 class="white-text">NGUYỄN VĂN TÌNH</h5>
               <p class="grey-text text-lighten-4">Công cụ đổi font chữ Facebook online miễn phí với hơn 80 phông ĐẸP, ĐỘC, LẠ. Hãy tạo điểm nhấn trong từng nét chữ với Facebook Text Generator</p>
           </div>
           <div class="col l3 s12">
               <h5 class="white-text">Category</h5>
               <ul>
                   <li><a class="white-text" href="{{ base_url('tool/facebook-icon') }}"><i class="tiny material-icons">share</i> Facebook icon</a></li>
                   <li><a class="white-text" href="{{ base_url('tool/facebook-text') }}"><i class="tiny material-icons">share</i> Facebook font</a></li>
{{--                   <li><a class="white-text" href="{{ base_url('tool/generate-qrcode') }}"><i class="tiny material-icons">share</i> Qrcode</a></li>--}}
{{--                   <li><a class="white-text" href="{{ base_url('tool/generate-qrcode') }}"><i class="tiny material-icons">share</i> Rút gọn link</a></li>--}}
               </ul>
           </div>
           <div class="col l3 s12">
               <h5 class="white-text">Link</h5>
               <ul>
                   <li><a class="white-text" target="_blank" href="https://tweb.com.vn/collections"><i class="tiny material-icons">share</i> Thiết kế website</a></li>
                   <li><a class="white-text" target="_blank" href="https://chomienphi.com.vn"><i class="tiny material-icons">share</i> Rao vặt</a></li>
                   <li><a class="white-text" target="_blank" href="https://chomienphi.vn"><i class="tiny material-icons">share</i> Mã giảm giá</a></li>
                   <li><a class="white-text" target="_blank" href="https://sanphamtienich.com"><i class="tiny material-icons">share</i> Săn coupon</a></li>
               </ul>
           </div>
       </div>
   </div>
    <div class="footer-copyright">
        <div class="container">
            Made by <a style="color: #ffd655" href="https://tweb.com.vn?utm_content=tool">Tình Nguyễn</a>
            | VPS sử dụng <a style="color: #ffd655" href="http://bit.ly/2kAezij" target="_blank">INET</a>
            | Made with 💞 in Long An
        </div>
    </div>
</footer>


<!--  Scripts-->
<script type="text/javascript">

    $(document).ready(function () {
        $('.collapsible').collapsible();

        $('.sidenav').sidenav();

        $('.scrollspy').scrollSpy();
    });

    /**
     * check all for all list data
     */
    if ($('.clipboard').length > 0) {
        let clipboard = new ClipboardJS('.clipboard');
        clipboard.on('success', function (e) {
            console.info('Action:', e.action);
            console.info('Text:', e.text);
            console.info('Trigger:', e.trigger);

            e.clearSelection();
        });

        clipboard.on('error', function (e) {
            console.error('Action:', e.action);
            console.error('Trigger:', e.trigger);
        });
    }
</script>
</body>
</html>
