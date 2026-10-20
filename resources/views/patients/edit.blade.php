@extends('layouts.app')
@section('title', 'Modifier un patient')
@section('breadcrumb', 'Patients / Modifier')
@section('content')
<div class="content-header"><div><p class="eyebrow">Dossier patient</p>
<h1>Modifier le patient</h1>
<p class="content-subtitle">Mettez à jour les informations du patient.</p></div></div>
<form class="panel form-card" action="{{ route('patients.update', $patient) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-grid"><label class="form-group">
        <span class="form-label">Nom complet *</span>
        <input class="form-control" value="{{ old('name', $patient->user->name) }}" name="name" required placeholder="Ex. Marie Dupont"></label>
        <label class="form-group"><span class="form-label">Adresse e-mail *</span>
        <input class="form-control" value="{{ old('email', $patient->user->email) }}" name="email" required placeholder="patient@email.fr"></label>
        <label class="form-group"><span class="form-label">Mot de passe</span>
        <input class="form-control" type="password" name="password" minlength="8" placeholder="Laisser vide pour conserver le mot de passe"></label>
        <label class="form-group"><span class="form-label">Date de naissance *</span>
        <input class="form-control" value="{{ old('birth_date', $patient->date_of_birth) }}" type="date" name="birth_date" required></label><label class="form-group">
            <span class="form-label">Téléphone *</span><input class="form-control" value="{{ old('phone', $patient->phone) }}" type="tel" name="phone" required placeholder="06 00 00 00 00"></label>
            <label class="form-group full"><span class="form-label">Adresse</span><textarea class="form-control" name="address" rows="3" placeholder="Adresse complète">{{ old('address', $patient->address) }}</textarea></label>
        </div><div class="form-actions"><button type="button" class="button button-secondary" data-demo-action="Annulation du formulaire.">Annuler</button><button class="button button-primary" type="submit">sauvgarder le patient</button>
    </div>
    </form>
@endsection
