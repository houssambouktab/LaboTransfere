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
                                <span class="badge badge-{{ $rapport->status }}">{{ $rapport->status }}</span>
                            </td>
                            <td>
                                <a
                                    class="icon-btn"
                                    href="{{ route('rapports.show', ['rapport' => $rapport->id]) }}"
                                    title="Voir les détails"
                                >↗</a>
                                <button
                                    class="icon-btn"
                                    data-demo-action="Envoi simulé du rapport."
                                    title="Envoyer"
                                >➤</button>
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
