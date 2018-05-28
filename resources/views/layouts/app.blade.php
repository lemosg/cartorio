<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cartorio') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <div class="content_wrap clearfix">
            <div class="logo">
                <a href="http://cartorio24horas.net/secure/">
                    <img src="http://cartorio24horas.net/secure/wp-content/uploads/2017/04/logo_www.png" alt="">
                </a>
            </div>
            <nav class="menu_main_nav_area">
                <ul class="menu_main_nav">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class="menu-item"><a href="{{ route('register') }}">Cadastrar</a></li>
                        <li class="menu-item"><a href="{{ route('login') }}">Entrar</a></li>
                    @else
                        <li class="menu-item">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                    <li class="menu-item">
                        <a href="http://cartorio24horas.net/secure/contato/">Contato</a>
                    </li>
                    <li class="menu-item">
                        <a href="http://cartorio24horas.net/secure/blog/">Blog</a>
                    </li>
                    <li class="menu-item">
                        <a href="http://cartorio24horas.net/secure/faq/">Faq</a>
                    </li>
                    <li class="menu-item">
                        <a href="http://cartorio24horas.net/secure/institucional/">Institucional</a>
                    </li>
                    <li class="menu-item">
                        <a href="http://cartorio24horas.net/secure/">Home</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <main id="app">
        @yield('content')
    </main>
    <footer class="footer_wrap widget_area scheme_dark">
        <div class="content_wrap">
            <aside id="themerex_widget_socials-2" class="widget_number_1 column-1_4 widget widget_socials"> 
                <div class="widget_inner">
                    <a href="http://cartorio24horas.net/secure/">
                        <img src="http://cartorio24horas.net/secure/wp-content/uploads/2017/04/logo_c24h3www.png" class="logo_main" alt="">
                    </a>
                    <div class="sc_socials sc_socials_color_ sc_socials_type_icons sc_socials_shape_square sc_socials_size_tiny">
                        <div class="sc_socials_item">
                            <a href="http://www.facebook.com/cartorio24horas.net" target="_blank" class="social_icons social_facebook">
                                <span class="icon-facebook"></span>
                            </a>
                        </div>
                        <div class="sc_socials_item">
                            <a href="#" target="_blank" class="social_icons social_gplus">
                                <span class="icon-gplus"></span>
                            </a>
                        </div>
                        <div class="sc_socials_item">
                            <a href="#" target="_blank" class="social_icons social_twitter">
                                <span class="icon-twitter"></span>
                            </a>
                        </div>
                        <div class="sc_socials_item">
                            <a href="#" target="_blank" class="social_icons social_linkedin">
                                <span class="icon-linkedin"></span>
                            </a>
                        </div>
                    </div>          
                </div>
            </aside>
        </div>
        <div class="copyright_wrap">
            <div class="content_wrap">
                <div class="copyright_text"><p>cartorio24horas © 2017 <a href="http://cartorio24horas.net/secure/institucional/">Institucional</a></p></div>
            </div>
        </div>
    </footer>   <!-- /.footer_wrap -->
             

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('input[type="radio"]').click(function() {
            console.log('entrou');
            $('.tipo_pessoa').each(function() {
                $(this).css('display', 'none');
            });
            $('#'+$(this).val().toLowerCase()).css('display', 'block');
        });
    });
</script>
</body>
</html>
