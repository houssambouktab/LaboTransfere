<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Connexion à LabCare, plateforme de gestion médicale.">
    <title>Connexion — LabCare</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <main class="login-page">
        <section class="brand-panel" aria-labelledby="brand-heading">
            <div class="brand-panel__glow brand-panel__glow--top"></div>
            <div class="brand-panel__glow brand-panel__glow--bottom"></div>
            <div class="brand-panel__content">
                <a class="brand" href="/" aria-label="LabCare, accueil">
                    <span class="brand__mark" aria-hidden="true">
                        <svg viewBox="0 0 32 32" fill="none"><path d="M16 7v18M7 16h18" stroke="currentColor" stroke-width="3" stroke-linecap="round"/><path d="M25.5 11.5a11 11 0 1 1-5-4.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" opacity=".55"/></svg>
                    </span>
                    <span><strong>LaboTransfere</strong><small>PLATEFORME DE GESTION MÉDICALE</small></span>
                </a>

                <div class="brand-copy">
                    <p class="overline">La santé, mieux organisée.</p>
                    <h1 id="brand-heading">La gestion de votre laboratoire,<br><em>en toute simplicité.</em></h1>
                    <p class="brand-copy__text">Centralisez vos rapports médicaux, gérez vos patients et facilitez le partage sécurisé des résultats.</p>
                </div>

                <div class="medical-visual" aria-hidden="true">
                    <div class="visual-orbit visual-orbit--one"></div>
                    <div class="visual-orbit visual-orbit--two"></div>
                    <div class="visual-card visual-card--main">
                        <div class="visual-card__header"><span class="visual-card__icon"><svg viewBox="0 0 24 24" fill="none"><path d="M6 3h8l4 4v14H6V3Z" stroke="currentColor" stroke-width="1.5"/><path d="M14 3v5h4M9 13h6M9 17h4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></span><span><b>Rapport médical</b><small>Mis à jour à l’instant</small></span><i>✓</i></div>
                        <div class="visual-chart"><span style="height:32%"></span><span style="height:47%"></span><span style="height:38%"></span><span class="active" style="height:70%"></span><span style="height:56%"></span><span style="height:82%"></span><span style="height:67%"></span></div>
                        <div class="visual-card__footer"><span>Activité des rapports</span><strong>+18,2 %</strong></div>
                    </div>
                    <div class="visual-card visual-card--float visual-card--patient"><span class="float-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M16 20v-1.8a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 4 18.2V20M10 11a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM16 4v5m2.5-2.5h-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg></span><span><b>Patients</b><small>1 284 dossiers</small></span></div>
                    <div class="visual-card visual-card--float visual-card--secure"><span class="float-icon"><svg viewBox="0 0 24 24" fill="none"><rect x="5" y="10" width="14" height="11" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M8 10V7a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="1.5"/></svg></span><span><b>Données protégées</b><small>Connexion sécurisée</small></span></div>
                    <span class="visual-dot visual-dot--one"></span><span class="visual-dot visual-dot--two"></span>
                </div>

                <ul class="feature-list">
                    <li><span class="feature-icon">✓</span><span>Gestion des patients</span></li>
                    <li><span class="feature-icon">✓</span><span>Rapports médicaux sécurisés</span></li>
                    <li><span class="feature-icon">✓</span><span>Accès simplifié pour les médecins</span></li>
                </ul>
                <p class="brand-footer">Une solution pensée pour les professionnels de santé.</p>
            </div>
        </section>

        <section class="form-panel" aria-labelledby="login-heading">
            <div class="form-panel__inner">
                <a class="mobile-brand brand" href="/" aria-label="LabCare, accueil"><span class="brand__mark" aria-hidden="true"><svg viewBox="0 0 32 32" fill="none"><path d="M16 7v18M7 16h18" stroke="currentColor" stroke-width="3" stroke-linecap="round"/><path d="M25.5 11.5a11 11 0 1 1-5-4.5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" opacity=".55"/></svg></span><strong>LabCare</strong></a>
                <div class="form-intro"><span class="form-intro__badge">Espace professionnel</span><h2 id="login-heading">Bon retour parmi nous</h2><p>Connectez-vous à votre espace laboratoire.</p></div>

                <form class="login-form" action="{{ route('login') }}" method="POST" >
                    @csrf
                    <div class="field-group">
                        <label for="email">Adresse e-mail</label>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none"><rect x="3" y="5" width="18" height="14" rx="2" stroke="currentColor" stroke-width="1.7"/><path d="m4 7 8 6 8-6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                            <input id="email" name="email" type="email" autocomplete="email" placeholder="nom@exemple.com" required>
                        </div>
                        <p class="field-error" data-email-error role="alert"></p>
                    </div>
                    <div class="field-group">
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none"><rect x="5" y="10" width="14" height="11" rx="2" stroke="currentColor" stroke-width="1.7"/><path d="M8 10V7a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="1.7"/></svg>
                            <input id="password" name="password" type="password" autocomplete="current-password" placeholder="Saisissez votre mot de passe" required>
                            <button class="password-toggle" type="button" data-password-toggle aria-label="Afficher le mot de passe">
                                <svg class="eye-open" viewBox="0 0 24 24" fill="none"><path d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="12" r="2.5" stroke="currentColor" stroke-width="1.7"/></svg>
                                <svg class="eye-closed" viewBox="0 0 24 24" fill="none"><path d="m3 3 18 18M10.6 6.2A9.8 9.8 0 0 1 12 6c6.5 0 10 6 10 6a17.5 17.5 0 0 1-3.1 3.8M6.2 6.2C3.5 8 2 12 2 12s3.5 6 10 6c1.7 0 3.2-.4 4.5-1" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="M9.9 9.9a3 3 0 0 0 4.2 4.2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                            </button>
                        </div>
                        <p class="field-error" data-password-error role="alert"></p>
                    </div>
                    <label class="remember-me"><input type="checkbox" name="remember"><span class="checkbox"></span><span>Se souvenir de moi</span></label>
                    <button class="submit-button" type="submit" data-submit-button><span data-button-label>Se connecter</span><span class="button-arrow" aria-hidden="true">→</span><span class="spinner" aria-hidden="true"></span></button>
                    @if (session('status'))
                        <div class="demo-message" role="status" aria-live="polite"><span>i</span><p>{{ session('status') }}</p></div>
                    @endif
                    @if ($errors->any())
                        <div class="demo-message" role="alert"><span>!</span><p>{{ $errors->first() }}</p></div>
                    @endif
                </form>
                <div class="secure-note"><svg viewBox="0 0 24 24" fill="none"><rect x="5" y="10" width="14" height="11" rx="2" stroke="currentColor" stroke-width="1.6"/><path d="M8 10V7a4 4 0 0 1 8 0v3" stroke="currentColor" stroke-width="1.6"/></svg><span>Connexion sécurisée</span></div>
            <!--  <footer class="form-footer"><span>© {{ date('Y') }} LabCare — Tous droits réservés</span><a href="#confidentialite">Confidentialité</a></footer>
           --> </div>
        </section>
    </main>
    <script src="{{ asset('js/login.js') }}" defer></script>
</body>
</html>
