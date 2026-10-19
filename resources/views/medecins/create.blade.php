@extends('layouts.app')
@section('title', 'Ajouter un médecin')
@section('breadcrumb', 'Médecins / Ajouter')
@section('content')
<div class="content-header"><div><p class="eyebrow">Nouveau praticien</p><h1>Ajouter un médecin</h1><p class="content-subtitle">Ajoutez un praticien au réseau de votre laboratoire.</p></div></div>
<form class="panel form-card"  action="{{ route('medecins.store') }}" method="POST" >
    @csrf
    <div class="form-grid"><label class="form-group"><span class="form-label">Nom complet *</span>
        <input class="form-control" name="name" required placeholder="Ex. Dr. Claire Martin"></label>
        <label class="form-group"><span class="form-label">Adresse e-mail *</span>
        <input class="form-control" type="email" name="email" required placeholder="medecin@cabinet.fr"></label>
        <label class="form-group"><span class="form-label">Mot de passe</span>
        <input class="form-control" type="password" name="password" placeholder="Mot de passe temporaire"></label>
        <label class="form-group"><span class="form-label">Spécialité *</span>
        <input class="form-control" name="specialty" required placeholder="Ex. Hématologie"></label>
        <label class="form-group"><span class="form-label">Téléphone *</span>
        <input class="form-control" type="tel" name="phone" required placeholder="06 00 00 00 00"></label>
    </div>
<div class="form-actions"><button type="button" class="button button-secondary" data-demo-action="Annulation du formulaire.">Annuler</button><button class="button button-primary" type="submit">Enregistrer le médecin</button></div></form>
@endsection
    