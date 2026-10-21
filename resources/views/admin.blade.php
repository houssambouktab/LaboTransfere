@extends('layouts.app')

@section('title', 'Tableau de bord')
@section('breadcrumb', 'Vue d’ensemble')

@section('content')
    <div class="content-header">
        <div>
            <p class="eyebrow">Administration & Surveillance</p>
            <h1>Tableau de bord</h1>
            <p class="content-subtitle">
                Accédez aux outils de diagnostic et de surveillance des performances du système.
            </p>
        </div>
    </div>

    <div class="dashboard-grid">
        <!-- Carte Laravel Telescope -->
        <section class="panel">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title" style="font-size: 16px; font-weight: 700;">Laravel Telescope</h2>
                    <p class="content-subtitle" style="margin-top: 4px;">Débogage approfondi et inspection des requêtes</p>
                </div>
                <span class="badge badge-blue">Debug & Logs</span>
            </div>
            <div style="padding: 0 20px 20px;">
                <p style="color: var(--muted); font-size: 13px; line-height: 1.5; margin-bottom: 20px;">
                    Surveillez les requêtes HTTP, exceptions, requêtes SQL, jobs en file d'attente, logs et emails en temps réel.
                </p>
                <a href="{{ url('/telescope') }}" target="_blank" class="button button-primary" style="width: 100%;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"/>
                        <circle cx="12" cy="12" r="4"/>
                        <line x1="21.17" y1="8" x2="12" y2="8"/>
                        <line x1="3.95" y1="6.06" x2="8.54" y2="14"/>
                        <line x1="10.88" y1="21.94" x2="15.46" y2="14"/>
                    </svg>
                    <span>Ouvrir Telescope</span>
                </a>
            </div>
        </section>

        <!-- Carte Laravel Pulse -->
        <section class="panel">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title" style="font-size: 16px; font-weight: 700;">Laravel Pulse</h2>
                    <p class="content-subtitle" style="margin-top: 4px;">Métriques de performance et charge serveur</p>
                </div>
                <span class="badge badge-green">Performance</span>
            </div>
            <div style="padding: 0 20px 20px;">
                <p style="color: var(--muted); font-size: 13px; line-height: 1.5; margin-bottom: 20px;">
                    Analysez l'utilisation CPU/mémoire, les requêtes lentes, les tâches longues et le débit global de l'application.
                </p>
                <a href="{{ url('/pulse') }}" target="_blank" class="button button-primary" style="width: 100%;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                    </svg>
                    <span>Ouvrir Pulse</span>
                </a>
            </div>
        </section>
    </div>
@endsection
