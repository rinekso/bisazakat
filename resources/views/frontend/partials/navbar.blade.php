<nav class="navbar navbar-default navbar-fixed-top {{ @$nav }}">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top-navbar">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>
            <a href="/">
                <span class="navbar-brand"><img src="/frontend/assets/images/logo_white.png"></span>
                <span class="navbar-brand-mobile"><img src="/frontend/assets/images/logo_white_text.png"></span>
            </a>
            <div class="lineH"></div>
            <div class="search">
                <form>
                    <button type="submit"><i class="fa fa-search"></i></button>
                    <input type="text" name="" placeholder="Cari campaign, judul, atau nama">
                </form>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="top-navbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="menu-top"><a href="/">Beranda</a></li>
                <li class="menu-top"><a href="#">Program</a>
                    <ul>
                        <li><a href="/zakat">Zakat</a></li>
                        <li><a href="{{ route('programs.donasi') }}">Donasi</a></li>
                    </ul>
                </li>
                <li class="menu-top"><a href="/zakat">Zakat Now</a></li>

                @if(auth()->check())
                    <li class="menu-top"><a href="{{ route('profile.show', auth()->user()->user_id) }}">Profile</a>
                        <ul>
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </li>
                @else
                <li class="menu-top"><a href="/login">Login</a></li>
                @endif

            </ul>
        </div>
    </div>
</nav>