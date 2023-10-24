<header>
    <div id="sticky-header" class="menu__area transparent-header">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="mobile__nav__toggler"><i class="fas fa-bars"></i></div>
                    <div class="menu__wrap">
                        <nav class="menu__nav">
                            <div class="logo">
                                <a href="/" class="logo__black">
                                    {{-- <img src="{{ asset('templates/frontend/img/logo/logo-bolmong.png') }}" alt="logo" width="50"> --}}
                                    <div class="logo-brand" style="display: inline-block;">
                                        <h4>Dinas Perkebunan <br>Kab. Bolaang Mongondow</h4>
                                    </div>
                                </a>
                            </div>
                            <div class="navbar__wrap main__menu d-none d-xl-flex">
                                <ul class="navigation">
                                    <li class="{{ setActive('/') }}"><a href="/">Beranda</a></li>
                                    <li class="{{ setActive('profil-dinas') }}"><a href="{{ route('profil_dinas') }}">Profil Dinas</a></li>
                                    <li class="menu-item-has-children {{ setActive('klinik/komoditas') }} {{ setActive('klinik/artikel-perkebunan') }} {{ setActive('klinik/konsultasi-online') }}"><a href="#">Klinik AP</a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ route('komoditas') }}">Komoditas</a></li>
                                            <li><a href="{{ route('artikel') }}">Artikel Perkebunan</a></li>
                                            <li><a href="{{ route('konsultasi') }}">Konsultasi Online</a></li>
                                        </ul>
                                    </li>
                                    <li class="{{ setActive('dokumentasi-kegiatan') }}"><a href="{{ route('dokumentasi-kegiatan') }}">Dokumentasi Kegiatan</a></li>
                                    <li class="{{ setActive('kontak') }}"><a href="{{ route('kontak') }}">Kontak</a></li>
                                </ul>
                            </div>
                            <div class="header__btn d-none d-md-block">
                                <a href="{{ route('konsultasi') }}" class="btn"><i class="fab fa-whatsapp"></i> Konsultasi Online</a>
                            </div>
                        </nav>
                    </div>
                    <!-- Mobile Menu  -->
                    <div class="mobile__menu">
                        <nav class="menu__box">
                            <div class="close__btn"><i class="fal fa-times"></i></div>
                            <div class="nav-logo">
                                {{-- <a href="index.html" class="logo__black"><img src="assets/img/logo/logo_black.png" alt=""></a>
                                <a href="index.html" class="logo__white"><img src="assets/img/logo/logo_white.png" alt=""></a> --}}
                            </div>
                            <div class="menu__outer">
                                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                            </div>
                            <div class="social-links">
                                <ul class="clearfix">
                                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="menu__backdrop"></div>
                    <!-- End Mobile Menu -->
                </div>
            </div>
        </div>
    </div>
</header>
