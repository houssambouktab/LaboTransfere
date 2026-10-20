<header class="topbar">
    <div style="display:flex;align-items:center"><button class="icon-btn mobile-menu" data-menu-toggle aria-label="Ouvrir le menu"><svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"/></svg></button><div><p class="page-title">@yield('title', 'Tableau de bord')</p><p class="breadcrumb">Accueil / @yield('breadcrumb', 'Vue d’ensemble')</p></div></div>
    <div class="top-actions"><label class="search-box"><button class="profile-button" data-demo-action="Le menu profil est une démonstration."><span class="avatar" >{{substr($name, 0, 2)}}</span><span>{{$name}}</span></button></div>
</header>
