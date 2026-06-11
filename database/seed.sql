USE resolidaire;

INSERT INTO admins (name, email, password_hash, role) VALUES
('Administratrice Resolidaire', 'admin@resolidaire.local', '$2y$12$kmWkFKXsv/gws8KUlyd30elMBkHoKRLB4ZPsi0PkEq2F5YpJEiDwu', 'admin');

INSERT INTO services (title, slug, short_description, full_description, eligibility, price_info, contact_info, image, display_order, is_active) VALUES
('Popote roulante', 'popote', 'Livraison de repas chauds a domicile pour soutenir l autonomie et le maintien a domicile.', 'La popote roulante permet de recevoir des repas chauds a domicile. Ce service s adresse aux personnes ainees ou en perte d autonomie, de facon temporaire ou permanente.', 'Service offert selon l admissibilite.', 'Cout indicatif : 6 $ par repas, incluant soupe et dessert.', 'Communiquez avec Resolidaire pour faire une demande de service.', 'services/popote-roulante.png', 1, 1),
('Accompagnement et transport medical', 'transport-medical', 'Accompagnement benevole vers les rendez-vous medicaux, selon les disponibilites.', 'Ce service aide les beneficiaires a se rendre a leurs rendez-vous medicaux grace a l accompagnement de benevoles.', 'Service offert selon les disponibilites.', 'Cout du trajet calcule selon la distance.', 'Communiquez avec Resolidaire pour reserver le service.', NULL, 2, 1),
('Transport vers l epicerie', 'epicerie', 'Transport organise vers certains points d alimentation du quartier.', 'Ce service permet a des personnes accompagnees de se rendre a l epicerie a certains moments determines.', 'Reservation requise.', 'Horaire selon les disponibilites.', 'Communiquez avec Resolidaire pour connaitre les prochains deplacements.', NULL, 3, 1),
('Intervention de milieu', 'intervention', 'Ecoute, orientation, accompagnement et presence de proximite dans le quartier.', 'L intervention de milieu permet d offrir une presence de proximite, de l ecoute, de l orientation et du soutien aux personnes du quartier.', 'Soutien aux proches aidants et aux personnes du milieu.', 'Sans frais.', 'Nous contacter pour etre oriente vers le bon service.', NULL, 4, 1);

INSERT INTO activities (title, description, activity_date, start_time, end_time, location, price, image, is_published) VALUES
('Cafe-rencontre du mercredi', 'Un moment convivial pour echanger, briser l isolement et rencontrer d autres personnes du quartier.', '2026-06-17', '10:00:00', '11:30:00', 'Salle communautaire Resolidaire', 'Gratuit', NULL, 1),
('Atelier memoire et numerique', 'Une activite douce pour pratiquer la memoire et mieux utiliser les outils numeriques du quotidien.', '2026-06-24', '13:30:00', '15:00:00', 'Local informatique', '5 $', NULL, 1),
('Marche accompagnee', 'Une sortie de quartier pour bouger a son rythme et profiter d une presence rassurante.', '2026-06-29', '09:30:00', '10:30:00', 'Depart du centre', 'Gratuit', NULL, 1);

INSERT INTO partners (name, description, logo, website_url, display_order, is_active) VALUES
('Clinique communautaire du secteur', 'Collaboration pour favoriser l acces aux services de proximite et au soutien psychosocial.', NULL, 'https://example.com', 1, 1),
('Table de quartier', 'Concertation locale autour de l inclusion sociale, de l entraide et du mieux-etre collectif.', NULL, 'https://example.com', 2, 1),
('Bibliotheque municipale', 'Partenaire pour des activites culturelles, intergenerationnelles et educatives.', NULL, 'https://example.com', 3, 1);

INSERT INTO donation_calls (title, description, button_text, button_url, image, is_active) VALUES
('Soutenir la programmation estivale', 'Aidez-nous a maintenir des activites accessibles, rassembleuses et chaleureuses pour les aines du quartier.', 'Faire un don', 'https://example.com/don', NULL, 1);

INSERT INTO site_settings (setting_key, setting_value) VALUES
('phone', '514-555-2030'),
('email', 'info@resolidaire.org'),
('address', '1234, rue du Quartier, Montreal, QC'),
('opening_hours', 'Lundi au vendredi, 9 h a 16 h'),
('facebook_url', 'https://facebook.com'),
('donation_url', 'https://example.com/don'),
('footer_intro', 'Resolidaire cree des liens de confiance, soutient l entraide et facilite l acces a des ressources humaines et accessibles.');
