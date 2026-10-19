@extends('layouts.app')
@section('title', 'Ajouter un patient')
@section('breadcrumb', 'Patients / Ajouter')
@section('content')
<div class="content-header"><div><p class="eyebrow">Nouveau dossier</p>
<h1>Ajouter un patient</h1>
<p class="content-subtitle">Créez une fiche patient pour associer ses futurs rapports.</p></div></div>
<form class="panel form-card" action="{{ route('patients.store') }}" method="POST">
    @csrf
    <div class="form-grid"><label class="form-group">
        <span class="form-label">Nom complet *</span>
        <input class="form-control" name="name" required placeholder="Ex. Marie Dupont"></label>
        <label class="form-group"><span class="form-label">Adresse e-mail *</span>
        <input class="form-control" type="email" name="email" required placeholder="patient@email.fr"></label>
        <label class="form-group"><span class="form-label">Mot de passe</span>
        <input class="form-control" type="password" name="password" required minlength="8" placeholder="Mot de passe temporaire"></label>
        <label class="form-group"><span class="form-label">Date de naissance *</span>
        <input class="form-control" type="date" name="birth_date" required></label><label class="form-group">
            <span class="form-label">Téléphone *</span><input class="form-control" type="tel" name="phone" required placeholder="06 00 00 00 00"></label>
            <label class="form-group full"><span class="form-label">Adresse</span><textarea class="form-control" name="address" rows="3" placeholder="Adresse complète"></textarea></label>
        </div><div class="form-actions"><button type="button" class="button button-secondary" data-demo-action="Annulation du formulaire.">Annuler</button><button class="button button-primary" type="submit">Enregistrer le patient</button>
    </div>
    </form>
@endsection
