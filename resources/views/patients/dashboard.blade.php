@extends('layouts.app')

@section('title', 'Patients')
@section('breadcrumb', 'Patients')

@section('content')

	<div class="content-header">
		<div>
			<p class="eyebrow">Réseau médical</p>
			<h1>Patients</h1>
			<p class="content-subtitle">
				Gérez les patients associés aux rapports du laboratoire.
			</p>
		</div>

	</div>

	<div class="filter-bar">
		<label class="search-box">
			<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
				<circle cx="11" cy="11" r="8" />
				<path d="m21 21-4.3-4.3" />
			</svg>
			<input
				data-filter-table="#patients-table"
				type="search"
				placeholder="Rechercher un rapport…"
			>
		</label>
	</div>

	<section class="panel">
		<div class="table-wrap">
			<table class="data-table" id="patients-table">
				<thead>
					<tr>
						<th>Référence</th>
						<th>Titre du rapport</th>
						<th>Médecin</th>
						<th>Date d’ajout</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($rapports as $rapport)
						<tr>
							<td>
								<div class="person-cell">
									<span class="mini-avatar"><strong>{{ $rapport->id ?? '—' }}</strong></span>
								</div>
							</td>
							<td>{{ $rapport->title }}</td>
							<td>{{ $rapport->doctor?->user?->name ?? '—' }}</td>
							<td>{{ $rapport->created_at }}</td>

							<td>
								<div class="table-actions" role="group" aria-label="Actions du rapport patient" style="display:flex; gap:8px; align-items:center;">
								<form action="{{ route('patients.download', $rapport->id) }}" method="GET" style="display:inline-flex;">
									<button class="icon-btn action-download" type="submit" title="Télécharger" aria-label="Télécharger le rapport {{ $rapport->id }}" style="background:#f0fdf4 !important; color:#16a34a !important; border:1px solid #bbf7d0 !important;">
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3v12"/><path d="m7 10 5 5 5-5"/><path d="M5 21h14"/></svg>
									</button>
								</form>
								</div>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="5">Aucun rapport trouvé.</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</section>
@endsection
