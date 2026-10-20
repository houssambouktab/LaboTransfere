@extends('layouts.app')

@section('title', 'Rapports médicaux')
@section('breadcrumb', 'Rapports médicaux')

@section('content')

	<div class="content-header">
		<div>
			<p class="eyebrow">Suivi documentaire</p>
			<h1>Rapports médicaux</h1>
			<p class="content-subtitle">Consultez et gérez les rapports de votre laboratoire.</p>
			@if (session('success'))
			<div class="alert alert-success" role="alert">
				{{ session('success') }}
			</div>
			@elseif (session('error'))
				<div class="alert alert-danger" role="alert">
					{{ session('error') }}
				</div>
			@endif
		</div>
		<a class="button button-primary" href="{{ route('rapports.create') }}">＋ Téléverser un rapport</a>

	</div>

	<div class="filter-bar">
		<label class="search-box">
			<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
				<circle cx="11" cy="11" r="8" />
				<path d="m21 21-4.3-4.3" />
			</svg>
			<input data-filter-table="#reports-table" type="search" placeholder="Rechercher un rapport, patient…">
		</label>

		<!-- <select class="select-control">
			<option>Tous les statuts</option>
			<option>Disponible</option>
			<option>En attente</option>
			<option>Envoyé</option>
		</select>

		<select class="select-control">
			<option>Toutes les dates</option>
			<option>Cette semaine</option>
			<option>Ce mois</option>
		</select> -->
	</div>

	<section class="panel">
		<div class="table-wrap">
			<table class="data-table" id="reports-table">
				<thead>
					<tr>
						<th>Référence</th>
						<th>Titre du rapport</th>
						<th>Patient</th>
						<th>Médecin</th>
						<th>Date d’ajout</th>
						<th>Statut</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($rapports as $rapport)
						<tr data-search="{{ $rapport->id }} {{ $rapport->title }} {{ $rapport->patient->user->name }} {{ $rapport->doctor->user->name }}">
							<td><strong>{{ $rapport->id }}</strong></td>
							<td>{{ $rapport->title }}</td>
							<td>{{ $rapport->patient->user->name }}</td>
							<td>{{ $rapport->doctor->user->name }}</td>
							<td>{{ $rapport->created_at->format('d M. Y, h:i') }}</td>
							<td><span class="badge" style="background-color: {{ strtolower($rapport->status) === 'failure' ? '#fee2e2' : (strtolower($rapport->status) === 'sent' ? '#dcfce7' : '#fef3c7') }}; color: {{ strtolower($rapport->status) === 'failure' ? '#b91c1c' : (strtolower($rapport->status) === 'sent' ? '#15803d' : '#92400e') }};">{{ $rapport->status }}</span></td>
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
									<button class="icon-btn action-download" type="submit" title="Télécharger" aria-label="Télécharger le rapport {{ $rapport->id }}" style="background:#f0fdf4 !important; color:#16a34a !important; border:1px solid #bbf7d0 !important;">
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3v12"/><path d="m7 10 5 5 5-5"/><path d="M5 21h14"/></svg>
									</button>
								</form>
								<form action="{{ route('rapports.sent', $rapport->id) }}" method="get" style="display:inline-flex;">
									@csrf
									<button class="icon-btn action-send" type="submit" title="Envoyer le rapport" aria-label="Envoyer le rapport {{ $rapport->id }}" style="background:#f5f3ff !important; color:#7c3aed !important; border:1px solid #ddd6fe !important;">
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
									</button>
								</form>
								<form action="{{ route('rapports.delete', $rapport->id) }}" method="POST" style="display:inline-flex;">
										@csrf
										@method('DELETE')
										<button class="icon-btn icon-btn-danger" type="submit" onclick="return confirm('Voulez-vous supprimer ce rapport ?')" title="Supprimer le rapport" aria-label="Supprimer {{ $rapport->id }}" style="display:inline-flex; align-items:center; justify-content:center; background:#fef2f2 !important; color:#dc2626 !important; border:1px solid #fecaca !important;">×</button>
								</form>
								<form action="{{ route('rapports.edit', $rapport->id) }}" method="GET" style="display:inline-flex;">
									@csrf
									@method('GET')
										<button class="icon-btn action-edit" type="submit"  title="Modifier"  style="background:#fefce8 !important; color:#ca8a04 !important; border:1px solid #fde68a !important;">
											<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L7 20l-4+4 4-4Z"/></svg>
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
@endsection
