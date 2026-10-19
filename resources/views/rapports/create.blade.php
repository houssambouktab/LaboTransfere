@extends('layouts.app')

@section('title', 'Téléverser un rapport')
@section('breadcrumb', 'Rapports / Téléverser')

@section('content')
	<div class="content-header">
		<div>
			<p class="eyebrow">Nouveau document</p>
			<h1>Téléverser un rapport médical</h1>
			<p class="content-subtitle">
				Associez un document PDF à un patient et à son médecin.
			</p>
		</div>
	</div>

	<form class="panel form-card" action="{{ route('rapports.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<div class="form-grid">
			<label class="form-group">
				<span class="form-label">Patient *</span>
				<select class="form-control" name="patient_id" required>
					<option value="">Sélectionner un patient</option>
					@foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->user->name }}</option>
                    @endforeach
				</select>
			</label>

			<label class="form-group">
				<span class="form-label">Médecin *</span>
				<select  class="form-control" name="doctor_id" required>
					<option value="">Sélectionner un médecin</option>
                    @foreach($doctors as $doctor)
                        <option  value="{{ $doctor->id }}">{{ $doctor->user->name }}</option>
                    @endforeach
				</select>
			</label>

			<label class="form-group full">
				<span class="form-label">Titre du rapport *</span>
				<input class="form-control" name="title" required placeholder="Ex. Hématologie complète">
				<span class="form-help">Donnez un titre explicite au document.</span>
			</label>

			<div class="form-group full">
				<span class="form-label">Document PDF *</span>

				<label class="dropzone" data-dropzone for="pdf-file">
					<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
						<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
						<path d="M14 2v6h6M12 18v-6m0 0-3 3m3-3 3 3" />
					</svg>
					<strong>Glissez-déposez votre PDF ici</strong>
					<span>ou cliquez pour parcourir · 10 Mo maximum</span>
					<input name="pdf_file" id="pdf-file" data-file-input type="file" accept="application/pdf" hidden>
				</label>

				<div class="file-preview hidden" data-file-preview>
					<div class="file-details">
						<span style="color: #ef4444; font-weight: 700">PDF</span>
						<span>
							<strong data-file-name></strong>
							<span class="file-size" data-file-size></span>
						</span>
					</div>
					<button type="button" class="icon-btn" data-remove-file>×</button>
				</div>
			</div>
		</div>

		<div class="form-actions">
			<button type="button" class="button button-secondary" data-demo-action="Annulation du formulaire.">
				Annuler
			</button>
			<button class="button button-primary" type="submit">
				Enregistrer le rapport
			</button>
		</div>
	</form>
@endsection
