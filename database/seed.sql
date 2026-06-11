USE resolidaire;

INSERT INTO admins (name, email, password_hash, role) VALUES
('Administratrice Resolidaire', 'admin@resolidaire.local', '$2y$12$kmWkFKXsv/gws8KUlyd30elMBkHoKRLB4ZPsi0PkEq2F5YpJEiDwu', 'admin');

INSERT INTO services (title, slug, short_description, full_description, eligibility, price_info, contact_info, image, display_order, is_active) VALUES
('Accueil et orientation', 'accueil-orientation', 'Un premier point de contact pour comprendre les besoins et orienter vers les bonnes ressources.', 'Ce service permet d accueillir les personnes, de clarifier leur situation et de proposer une orientation rassurante vers les services internes ou partenaires.', 'Ouvert aux aines, proches aidants et membres de la communaute.', 'Sans frais.', 'Communiquez avec l equipe d accueil au numero general.', NULL, 1, 1),
('Soutien aux proches aidants', 'soutien-proches-aidants', 'Un accompagnement pour mieux traverser les responsabilites du quotidien.', 'Des rencontres, de l information et du soutien humain pour aider les proches aidants a souffler, comprendre leurs options et se sentir moins seuls.', 'Pour les personnes qui accompagnent un proche au quotidien.', 'Selon l activite ou sans frais selon le cas.', 'Ecrivez a l equipe pour connaitre les disponibilites.', NULL, 2, 1),
('Intervention de quartier', 'intervention-quartier', 'Une presence de proximite pour rejoindre les personnes isolees.', 'Ce service mise sur des liens de confiance, de l ecoute active et une coordination avec les ressources du quartier.', 'Pour les personnes vivant de l isolement ou un besoin d accompagnement.', 'Sans frais.', 'Disponible sur reference ou prise de contact directe.', NULL, 3, 1);

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
