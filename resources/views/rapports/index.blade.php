@extends('layouts.app')

@section('title', 'Rapports médicaux')
@section('breadcrumb', 'Rapports médicaux')

@section('content')

	<div class="content-header">
		<div>
			<p class="eyebrow">Suivi documentaire</p>
			<h1>Rapports médicaux</h1>
			<p class="content-subtitle">Consultez et gérez les rapports de votre laboratoire.</p>
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

		<select class="select-control">
			<option>Tous les statuts</option>
			<option>Disponible</option>
			<option>En attente</option>
			<option>Envoyé</option>
		</select>

		<select class="select-control">
			<option>Toutes les dates</option>
			<option>Cette semaine</option>
			<option>Ce mois</option>
		</select>
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
						<tr data-search="">
							<td><strong>{{ $rapport->id }}</strong></td>
							<td>{{ $rapport->title }}</td>
							<td>{{ $rapport->patient->user->name }}</td>
							<td>{{ $rapport->doctor->user->name }}</td>
							<td>{{ $rapport->created_at->format('d M. Y, h:i:') }}</td>
							<td><span class="badge" style="background-color: #fef3c7; color: #92400e;">{{ $rapport->status }}</span></td>
							<td>
								<a class="icon-btn" href="{{ route('rapports.show', ['rapport' => $rapport->id]) }}" title="Voir les détails">↗</a>
								<button class="icon-btn action-download" data-demo-action="Téléchargement simulé du PDF." title="Télécharger" aria-label="Télécharger">
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3v12"/><path d="m7 10 5 5 5-5"/><path d="M5 21h14"/></svg>
								</button>
								<button class="icon-btn action-send" data-demo-action="Envoi simulé au patient et au médecin." title="Envoyer le rapport" aria-label="Envoyer le rapport">
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
								</button>
								<button class="icon-btn action-delete" data-demo-action="Suppression simulée — aucune donnée n’a été modifiée." title="Supprimer" aria-label="Supprimer">
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 6h18"/><path d="M8 6V4h8v2"/><path d="m19 6-1 15H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
								</button>
								<button class="icon-btn action-edit" data-demo-action="Modification simulée — aucune donnée n’a été modifiée." title="Modifier" aria-label="Modifier">
									<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L7 20l-4+4 4-4Z"/></svg>
								</button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>


	</section>
@endsection
