@extends('layouts.app')

@section('title', 'Médecins')
@section('breadcrumb', 'Médecins')

@section('content')

	<div class="content-header">
		<div>
			<p class="eyebrow">Réseau médical</p>
			<h1>Médecins</h1>
			<p class="content-subtitle">
				Gérez les médecins associés aux rapports du laboratoire.
			</p>
		</div>

		<a class="button button-primary" href="{{ route('medecins.create') }}">
			＋ Ajouter un médecin
		</a>
	</div>

	<div class="filter-bar">
		<label class="search-box">
			<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2">
				<circle cx="11" cy="11" r="8" />
				<path d="m21 21-4.3-4.3" />
			</svg>
			<input
				data-filter-table="#doctors-table"
				type="search"
				placeholder="Rechercher un médecin…"
			>
		</label>
	</div>

	<section class="panel">
		<div class="table-wrap">
			<table class="data-table" id="doctors-table">
				<thead>
					<tr>
						<th>Nom complet</th>
						<th>Email</th>
						<th>Spécialité</th>
						<th>Téléphone</th>
						<th>Rapports associés</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($doctors as $doctor)
						<tr data-search="">
							<td>
								<div class="person-cell">
									<span class="mini-avatar">{{ substr($doctor->user->name, 0, 2) }}</span>
									<strong>{{ $doctor->user->name }}</strong>
								</div>
							</td>
							<td>{{ $doctor->user->email }}</td>
							<td>{{ $doctor->specialty }}</td>
							<td>{{ $doctor->phone }}</td>
							<td>
								<span class="badge badge-blue">
									<!-- {{ $doctor->reports_count }} rapports -->
								</span>
							</td>
							<td>
								<button
									class="icon-btn"
									data-demo-action="Consultation de la fiche médecin."
								>↗</button>
								<button
									class="icon-btn"
									data-demo-action="Modification simulée."
								>✎</button>
								<button
									class="icon-btn"
									data-demo-action="Suppression simulée — aucune donnée n’a été modifiée."
								>×</button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</section>
@endsection
