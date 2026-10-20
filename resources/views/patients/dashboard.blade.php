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
						<th>Référence</th>
						<th>Titre du rapport</th>
						<th>Médecin</th>
						<th>Date d’ajout</th>
						<th>Statut</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
						<tr data-search="">
							<td>
								<div class="person-cell">
									<span class="mini-avatar"></span>
									<strong></strong>
								</div>
							</td>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<span class="badge badge-blue">
									 rapports
								</span>
							</td>
							<td>
								<button
									class="icon-btn"
									data-demo-action="Téléchargement du dossier médecin."
								>↓</button>
							</td>
						</tr>
				</tbody>
			</table>
		</div>
	</section>
@endsection
