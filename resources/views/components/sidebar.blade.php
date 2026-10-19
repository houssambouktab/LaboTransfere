<aside class="sidebar" data-sidebar>
    <a href="/" class="brand"><span class="brand-mark"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg></span><span><strong>Labo Santé</strong><small>Gestion médicale</small></span></a>
    <p class="nav-label">Menu principal</p>
    <nav>
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('users.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>Tableau de bord</a>
        <a class="nav-link {{ request()->routeIs('rapports.*') ? 'active' : '' }}" href="{{ route('rapports.index') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h5"/></svg>Rapports médicaux</a>
        <a class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}" href="{{ route('patients.patients') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0-8 0 4 4 0 0 0 0 8M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>Patients</a>
        <a class="nav-link {{ request()->routeIs('medecins.*') ? 'active' : '' }}" href="{{ route('medecins.doctors') }}"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M5 9h14M5 15h14"/><circle cx="12" cy="12" r="9"/></svg>Médecins</a>
    </nav>
    <div class="sidebar-user"><span><strong>{{ $name }}</strong><span>{{ ucfirst($Role) }}</span></span></div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="nav-link" type="submit">Déconnexion</button>
    </form>
</aside>
