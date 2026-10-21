<aside class="sidebar" data-sidebar>
    <a href="/" class="brand"><span class="brand-mark"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></span><span><strong>Labo Santé</strong><small>Gestion médicale</small></span></a>
    <p class="nav-label">Menu principal</p>
    <nav>
        @if(auth()->user()->Role === 'admin')
        <a class="nav-link {{ request()->routeIs('index')  ? 'active' : '' }}" href="{{ route('index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>Tableau de bord</a>
        <a class="nav-link {{ request()->routeIs('rapports.*') ? 'active' : '' }}" href="{{ route('rapports.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h5"/></svg>Rapports médicaux</a>
        <a class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}" href="{{ route('patients.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4_4v2M9_11a4_4_0_1_0-8_0_4_4_0_0_0_0_8M22_21v-2a4_4_0_0_0-3-3.87M16_3.13a4_4_0_0_1_0_7.75"/></svg>Patients</a>
        <a class="nav-link {{ request()->routeIs('medecins.*') ? 'active' : '' }}" href="{{ route('medecins.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2.69l5.66 5.66a4 4 0 0 1 0 5.66l-5.66 5.66a4 4 0 0 1-5.66 0l-5.66-5.66a4 4 0 0 1 0-5.66l5.66-5.66a4 4 0 0 1 5.66 0z"/></svg>Medecins</a>
            <a class="nav-link {{ request()->routeIs('admin')  ? 'active' : '' }}" href="{{ route('admin') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>admin</a>

        @endif

        @if(auth()->user()->Role === 'doctor')
        <a class="nav-link {{ request()->routeIs('medecins.dashboard') ? 'active' : '' }}" href="{{ route('medecins.dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2.69l5.66 5.66a4 4 0 0 1 0 5.66l-5.66 5.66a4 4 0 0 1-5.66 0l-5.66-5.66a4 4 0 0 1 0-5.66l5.66-5.66a4 4 0 0 1 5.66 0z"/></svg>Tableau de bord</a>
        @endif

        @if(auth()->user()->Role === 'patient')
        <a class="nav-link {{ request()->routeIs('patients.dashboard') ? 'active' : '' }}" href="{{ route('patients.dashboard') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2.69l5.66 5.66a4 4 0 0 1 0 5.66l-5.66 5.66a4 4 0 0 1-5.66 0l-5.66-5.66a4 4 0 0 1 0-5.66l5.66-5.66a4 4 0 0 1 5.66 0z"/></svg>Tableau de bord</a>
        @endif
    </nav>
    <div class="sidebar-user"><span><strong>{{ $name }}</strong><span></span></span></div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        @method('POST')
        <button class="nav-link" type="submit">Déconnexion</button>
    </form>
</aside>
