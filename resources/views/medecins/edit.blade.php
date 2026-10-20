@extends('layouts.app')
@section('title', 'Modifier un médecin')
@section('breadcrumb', 'Médecins / Modifier')
@section('content')
<div class="content-header"><div><p class="eyebrow">Modifier le praticien</p><h1>Modifier un médecin</h1><p class="content-subtitle">Mettez à jour les informations de ce praticien.</p></div></div>
<form class="panel form-card" action="{{ route('medecins.update', $doctor) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-grid"><label class="form-group"><span class="form-label">Nom complet *</span>
        <input class="form-control" name="name" value="{{ old('name', $doctor->user->name) }}" required placeholder="Ex. Dr. Claire Martin"></label>
        <label class="form-group"><span class="form-label">Adresse e-mail *</span>
        <input class="form-control" type="email" name="email" value="{{ old('email', $doctor->user->email) }}" required placeholder="medecin@cabinet.fr"></label>
        <label class="form-group"><span class="form-label">Mot de passe</span>
        <input class="form-control" type="password" name="password" placeholder="Laisser vide pour conserver le mot de passe"></label>
        <label class="form-group"><span class="form-label">Spécialité *</span>
        <input class="form-control" name="specialty" value="{{ old('specialty', $doctor->specialty) }}" required placeholder="Ex. Hématologie"></label>
        <label class="form-group"><span class="form-label">Téléphone *</span>
        <input class="form-control" type="tel" name="phone" value="{{ old('phone', $doctor->phone) }}" required placeholder="06 00 00 00 00"></label>
    </div>
<div class="form-actions"><a href="{{ route('medecins.index') }}" class="button button-secondary">Annuler</a><button class="button button-primary" type="submit">Mettre à jour le médecin</button></div></form>
@endsection
    