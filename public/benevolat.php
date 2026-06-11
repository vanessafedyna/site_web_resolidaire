<?php
$page_title = 'Benevolat';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
<main id="main-content">
    <section class="page-hero">
        <div class="container">
            <div class="panel">
                <span class="eyebrow">Benevolat</span>
                <h1>Donner du temps, creer de la confiance, faire une vraie difference.</h1>
                <p>Les benevoles jouent un role essentiel dans l'accueil, les activites et la vie de l'organisme.</p>
                <a class="button" href="<?= e(public_url('contact.php')); ?>">Nous ecrire pour benevoler</a>
            </div>
        </div>
    </section>
    <section>
        <div class="container split-grid">
            <div class="panel">
                <h2>Profils recherches</h2>
                <ul class="list-check">
                    <li>Accueil et soutien aux activites</li>
                    <li>Ecoute et accompagnement bienveillant</li>
                    <li>Appui logistique lors d'evenements</li>
                </ul>
            </div>
            <div class="panel">
                <h2>Pourquoi s'impliquer</h2>
                <p>Le benevolat permet de renforcer les liens de quartier, de partager ses talents et de contribuer directement au mieux-etre collectif.</p>
            </div>
        </div>
    </section>
</main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
