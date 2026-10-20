@extends('layouts.app')

@section('title', 'Tableau de bord')
@section('breadcrumb', 'Vue d’ensemble')

@section('content')
<div class="content-header">
    <div>
        <p class="eyebrow">{{ \Carbon\Carbon::now()->format('l j F Y') }}</p>
        <h1>Bonjour, {{$name}} - {{$Role}}</h1>
        <p class="content-subtitle">Voici un aperçu de l’activité de votre laboratoire aujourd’hui.</p>
    </div>
    <a class="button button-primary" href="{{ route('rapports.create') }}">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
        Téléverser un rapport
    </a>
</div>

<div class="stats-grid">
    @include('components.stat-card', ['label' => 'Nombre total de patients', 'value' => $patientcount, 'icon' => 'users'])
    @include('components.stat-card', ['label' => 'Nombre total de médecins', 'value' => $doctorcount, 'icon' => 'doctor'])
    @include('components.stat-card', ['label' => 'Nombre total de rapports', 'value' => $rapportscount , 'icon' => 'file'])
    @include('components.stat-card', ['label' => 'Rapports en attente', 'value' => $rapportspendingcount,  'icon' => 'clock', 'muted' => true])
</div>

<div class="dashboard-full-card">
    <section class="panel dashboard-full-card">
        <div class="panel-header"><h2 class="panel-title">Rapports récents</h2><a class="panel-link" href="{{ route('rapports.index') }}">Voir tous les rapports →</a></div>
        <div class="table-wrap">
            <table class="data-table" data-table>
                <thead>
                    <tr>
                        <th>Rapport</th>
                        <th>Patient</th>
                        <th>Médecin</th>
                        <th>Date d’ajout</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rapports as $rapport)
                        <tr>
                            <td>
                                <strong>{{ $rapport->title }}</strong>
                                <small class="form-help">#{{ $rapport->id }}</small>
                            </td>
                            <td>{{ $rapport->patient->user->name }}</td>
                            <td>{{ $rapport->doctor->user->name }}</td>
                            <td>{{ $rapport->created_at->format('d M. Y, h:i') }}</td>
                            <td>
                                @php
                                    $status = strtolower($rapport->status);
                                    $statusClass = match ($status) {
                                        'sent' => 'badge-green',
                                        'failure' => 'badge-red',
                                        default => 'badge-amber',
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $rapport->status }}</span>
                            </td>
                            <td>
                                <div class="table-actions" role="group" aria-label="Actions pour le rapport {{ $rapport->id }}" style="display:flex; gap:8px; align-items:center;">
                                    <a
                                        class="icon-btn"
                                        href="{{ route('rapports.show', $rapport->id) }}"
                                        title="Voir les détails"
                                        aria-label="Voir les détails du rapport {{ $rapport->id }}"
                                        style="background:#eff6ff !important; color:#2563eb !important; border:1px solid #bfdbfe !important;"
                                    >
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6-10-6-10-6Z"/>
                                            <circle cx="12" cy="12" r="2.5"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('rapports.download', $rapport->id) }}" method="GET" style="display:inline-flex;">
                                        <button
                                            class="icon-btn"
                                            type="submit"
                                            title="Télécharger"
                                            aria-label="Télécharger le rapport {{ $rapport->id }}"
                                            style="background:#f0fdf4 !important; color:#16a34a !important; border:1px solid #bbf7d0 !important;"
                                        >
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="M12 3v12"/>
                                                <path d="m7 10 5 5 5-5"/>
                                                <path d="M5 21h14"/>
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('rapports.sent', $rapport->id) }}" method="GET" style="display:inline-flex;">
                                        <button
                                            class="icon-btn"
                                            type="submit"
                                            title="Envoyer"
                                            aria-label="Envoyer le rapport {{ $rapport->id }}"
                                            style="background:#f5f3ff !important; color:#7c3aed !important; border:1px solid #ddd6fe !important;"
                                        >
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                <path d="m22 2-7 20-4-9-9-4Z"/>
                                                <path d="M22 2 11 13"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>

<div class="quick-actions">
    <a class="quick-action" href="{{ route('patients.create') }}"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0-0 0 4 4 0 0 0 0 8M19 8v6M22 11h-6"/></svg>Ajouter un patient</a>
    <a class="quick-action" href="{{ route('medecins.create') }}"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M5 9h14M5 15h14"/></svg>Ajouter un médecin</a>
    <a class="quick-action" href="{{ route('rapports.create') }}"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14"/></svg>Téléverser un rapport</a>
</div>
@endsection
