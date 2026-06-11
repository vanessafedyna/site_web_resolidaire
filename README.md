# Resolidaire

Site web public et espace d'administration en PHP natif pour l'organisme communautaire Resolidaire.

## Stack

- PHP natif
- HTML
- CSS
- JavaScript vanilla
- MySQL
- PDO

## Structure

- `public/` : pages publiques
- `admin/` : interface d'administration
- `app/` : configuration, helpers et modeles
- `includes/` : gabarits communs
- `assets/` : CSS, JavaScript, images et uploads
- `database/` : schema SQL et donnees de depart

## Installation locale avec XAMPP

1. Placer le projet dans `htdocs`.
2. Demarrer Apache et MySQL dans XAMPP.
3. Creer la base et les tables en important `database/resolidaire.sql` dans phpMyAdmin.
4. Importer ensuite `database/seed.sql`.
5. Verifier la configuration de connexion dans [app/config/database.php](/c:/xampp/xampp-renew/htdocs/site_web_resolidaire/app/config/database.php:1).
6. Ouvrir le site public via `http://localhost/site_web_resolidaire/public/`.
7. Ouvrir l'admin via `http://localhost/site_web_resolidaire/admin/login.php`.

## Configuration PDO

Le fichier [app/config/database.php](/c:/xampp/xampp-renew/htdocs/site_web_resolidaire/app/config/database.php:1) contient par defaut :

- hote : `127.0.0.1`
- port : `3306`
- base : `resolidaire`
- utilisateur : `root`
- mot de passe : vide

Adaptez ces valeurs selon votre environnement.

## Identifiants admin de depart

- Courriel : `admin@resolidaire.local`
- Mot de passe : `ChangeMe123!`

Changez ce mot de passe des la premiere connexion. Ne versionnez jamais de vrais mots de passe dans le projet.

## Deploiement WHC ou cPanel

1. Uploadez tous les fichiers du projet sur l'hebergement.
2. Creer une base MySQL et un utilisateur dedie.
3. Importez `database/resolidaire.sql`, puis `database/seed.sql`.
4. Mettez a jour la connexion dans `app/config/database.php`.
5. Si possible, configurez `public/` comme racine web du site public.
6. Assurez-vous que `assets/uploads/` est accessible en ecriture et que son `.htaccess` est conserve.
7. Testez le formulaire de contact, la connexion admin et les CRUD avant mise en ligne.

## Notes

- Les formulaires admin utilisent un token CSRF simple.
- Les mots de passe admin sont verifies avec `password_verify()`.
- Les images televersees sont renommees et limitees aux formats `jpg`, `jpeg`, `png` et `webp`.
- Les sorties HTML sont echappees avec la fonction `e()`.
