@extends('layouts.app')

@section('title', 'Patients')
@section('breadcrumb', 'Patients')

@section('content')


<div class="content-header">
	<div>
		<p class="eyebrow">Dossier patient</p>
		<h1>Patients</h1>
		<p class="content-subtitle">Retrouvez les patients et l’historique de leurs rapports.</p>
		@if (session('success'))
			<div class="alert alert-success" role="alert">
				{{ session('success') }}
			</div>
		@endif
	</div>
	<a class="button button-primary" href="{{ route('patients.create') }}">＋ Ajouter un patient</a>
</div>

<div class="filter-bar">
	<label class="search-box">
		<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" aria-hidden="true">
			<circle cx="11" cy="11" r="8" />
			<path d="m21 21-4.3-4.3" />
		</svg>
		<input data-filter-table="#patients-table" id="search" name="search" type="search" placeholder="Rechercher un patient…">
         
	</label>
</div>

<section class="panel">
	<div class="table-wrap">
		<table class="data-table" id="patients-table">
			<thead>
				<tr>
					<th>Nom complet</th>
					<th>Email</th>
					<th>Téléphone</th>
					<th>Date de naissance</th>
					<th>Rapports</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($patients as $patient)
					<tr data-search="">
						<td>
							<div class="person-cell">
								<span class="mini-avatar">{{ substr($patient->user->name, 0, 2) }}</span>
								<strong>{{ $patient->user->name  }}</strong>
							</div>
						</td>
                        <td>{{ $patient->user->email }}</td>
						<td>{{ $patient->phone }}</td>
						<td>{{ $patient->date_of_birth }}</td>
                        
						<td><span class="badge badge-green"> $patient->rapports->count() </span></td>
						<td>
							<button class="icon-btn" data-demo-action="Consultation de la fiche patient.">↗</button>
							<button class="icon-btn" data-demo-action="Modification simulée.">✎</button>
							<button class="icon-btn" data-demo-action="Suppression simulée — aucune donnée n’a été modifiée.">×</button>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>


</section>
@endsection
