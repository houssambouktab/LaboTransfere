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
						<th>patient</th>
						<th>Date d’ajout</th>
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
								<div class="table-actions" role="group" aria-label="Actions du dossier médecin" style="display:flex; gap:8px; align-items:center;">
									<button class="icon-btn" type="button" data-demo-action="Téléchargement du rapport." title="Télécharger le rapport" aria-label="Télécharger le rapport" style="background:#f0fdf4 !important; color:#16a34a !important; border:1px solid #bbf7d0 !important;">
										<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
											<path d="M12 3v12"/>
											<path d="m7 10 5 5 5-5"/>
											<path d="M5 21h14"/>
										</svg>
									</button>
								</div>
							</td>
						</tr>
				</tbody>
			</table>
		</div>
	</section>
@endsection
