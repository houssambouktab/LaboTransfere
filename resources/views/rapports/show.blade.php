@extends('layouts.app')

@section('title', 'Détails du rapport')
@section('breadcrumb', 'Rapports / Détails')

@section('content')
	<div class="content-header">
		<div>
			<p class="eyebrow">{{ $rapport->id }}</p>
			<h1>{{$rapport->title}}</h1>
			<p class="content-subtitle">
				Ajouté le {{ $rapport->created_at->format('d M. Y, h:i') }}
				<span class="badge badge-green" style="margin-left: 8px">{{ $rapport->status }}</span>
			</p>
		</div>

		<button class="button button-primary" data-demo-action="Téléchargement simulé du PDF.">
			↓ Télécharger le PDF
		</button>
	</div>

	<div class="dashboard-grid">
		<section class="panel" style="padding: 24px">
			<h2 class="panel-title" style="margin-bottom: 20px">Aperçu du document</h2>

			<div
				style="align-items: center; background: #f8fafc; border: 1px solid var(--line); border-radius: 10px; display: flex; flex-direction: column; height: 350px; justify-content: center; text-align: center"
			>
				<svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="1.5">
					<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
					<path d="M14 2v6h6" />
				</svg>
				<strong style="margin-top: 13px">Aperçu PDF indisponible</strong>
				<span class="form-help">
					Le document médical est protégé et accessible uniquement par téléchargement.
				</span>
			</div>
		</section>

		<div style="align-content: start; display: grid; gap: 24px">
			<section class="panel" style="padding: 22px">
				<h2 class="panel-title" style="margin-bottom: 18px">{{ $rapport->patient->user->role }}</h2>
				<div class="person-cell">
					<span class="avatar">{{ $rapport->patient->user->name[0] }}</span>
					<span>
						<strong>{{ $rapport->patient->user->name }}</strong>
						<small>{{ $rapport->patient->user->email }}</small>
					</span>
				</div>
			</section>

			<section class="panel" style="padding: 22px">
				<h2 class="panel-title" style="margin-bottom: 18px">{{ $rapport->doctor->user->role }}</h2>
				<div class="person-cell">
					<span class="avatar">{{ $rapport->doctor->user->name[0] }}</span>
					<span>
						<strong>{{ $rapport->doctor->user->name }}</strong>
						<small>{{ $rapport->doctor->user->email }}</small>
					</span>
				</div>
			</section>


		</div>
	</div>
@endsection
