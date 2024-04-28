DROP DATABASE IF EXISTS `final`;
CREATE DATABASE `final`;
USE `final`;

CREATE TABLE `utilisateur` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bio` varchar(255) NOT NULL,
  `localisation` varchar(100) NOT NULL,
  `url_site` varchar(255) NULL,
  `nom_utilisateur` varchar(50) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `date_creation` date NOT NULL DEFAULT NOW(),
  `url_avatar` varchar(255) NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_utilisateur_UNIQUE` (`nom_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `shweet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `texte` VARCHAR(255) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT NOW(),
  `auteur_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`auteur_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`parent_id`) REFERENCES `shweet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Le mot de passe a été haché avec password_hash(), il correspond à 'bonjour'
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Je suis un troll. Je connais tout.', 'St-Lin', NULL, 'tremblayj', '$2y$10$HYeLAxdInF2N6tGbYKYqBOpAcnXyPX9.hgHMnjb7PJOUnlqUm7Qqu', 'https://m.media-amazon.com/images/M/MV5BMjI2ODA1MjMzMV5BMl5BanBnXkFtZTcwNTc1NTQ5Mw@@._V1_.jpg', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Je suis un chasseur de troll.', 'Québec', 'http://chasseurdetroll.com', 'turcottej', '$2y$10$BVjmnMgch0a0jqJKbFWmGeel/IlQkNtnwGkJb8dAUvaAJuFo72VnO', NULL, '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Je n''ai plus de cheveux. Je rêve d''en ravoir un jour afin d''avoir la chance de montrer au monde entier la beauté de la coupe Longueuil.', 'Shawingan', 'http://mullet.com', 'monchampf', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://images.8tracks.com/cover/i/002/169/964/794a9f4756dd2758881b3e8c4268753a-9706.jpg?rect=47,0,406,406&q=98&fm=jpg&fit=max', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Je porte du Christian Dior... je suis riche! Bling! Bling!', 'Laval', 'https://dior.com', 'vadeboncoeurn', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://i.pinimg.com/originals/72/96/e6/7296e67b6e50eb018154bc02a098d401.jpg', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Je travaille de minuit à minuit... que des p''tits shitfs!', 'Shawingan', NULL, 'courcya', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://media.istockphoto.com/id/1338079809/vector/bee-cute-character-with-big-eyes-cartoon-happy-bee.jpg?s=612x612&w=0&k=20&c=C9PNLseWKMZPD6KMpQOa3pkOogGUftOTQAtMfYm4GU8=', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'J''ai une question!', 'Alger', NULL, 'addan', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://algerie.football/wp-content/uploads/2024/03/BENZIA3-720x475.jpg', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Des bons flocons d''avoine!', 'Shawinigan', NULL, 'croteaum', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://ventesrudolph.com/wp-content/uploads/2019/09/0366.jpg', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Je n''ai jamais pris une ligne de code sur github!', 'Shawinigan', 'https://github.com/', 'audetj', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://github.githubassets.com/assets/GitHub-Mark-ea2971cee799.png', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'La meilleure du monde à Tetris', 'Shawinigan', 'https://tetris.com/', 'leduca', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://upload.wikimedia.org/wikipedia/fr/d/d4/The_Tetris_Company_Logo.png', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'IA ou pas IA? Telle est la question!', 'Shawinigan', 'https://copilot.microsoft.com/', 'bureauv', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://1000logos.net/wp-content/uploads/2023/11/Copilot-Logo.jpg', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, '&*?&?*&$%&*?(*&?(!', 'Témiscamingue', 'https://gerersesemotions.com/', 'belangermc', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://i.imgflip.com/1owdwf.jpg?a475224', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Restons zen les amis!', 'Shawinigan', NULL, 'godinz', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://m.media-amazon.com/images/I/61EIBBrJYyL._AC_UF1000,1000_QL80_.jpg', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Je suis le plus bavard de la classe!', 'Shawinigan', NULL, 'gueyeb', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://em-content.zobj.net/source/facebook/355/vulcan-salute_1f596.png', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Un c''est bien, mais deux c''est mieux!', 'Shawinigan', NULL, 'lebotl', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://thegadgetflow.com/wp-content/uploads/2019/06/dual-screen-laptop-dd-featured.jpeg', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, '!!!!!!!!!!!!!!!', 'Shawinigan', NULL, 'lecuyerlp', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b6/12in-Vinyl-LP-Record-Angle.jpg/1200px-12in-Vinyl-LP-Record-Angle.jpg', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Vroum vroum vroum', 'Shawinigan', NULL, 'marcouillerf', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://www.mazda.ca/globalassets/mazda-canada/vehicles/2024/mazda3sport/2024-m3-sport-c22-hero-dt.jpg', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Je n''ai jamais de question!', 'Shawinigan', NULL, 'matteauct', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://logowik.com/content/uploads/images/discord-new-20218785.jpg', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Astronome en devenir', 'Shawinigan', NULL, 'naude', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://images.unsplash.com/photo-1529788295308-1eace6f67388?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxleHBsb3JlLWZlZWR8Mnx8fGVufDB8fHx8fA%3D%3D', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Tassez-vous de d''là les chevreuils!', 'Sainte-Thècle', NULL, 'stamandp', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://www.chevreuil.net/photos/imgs/frl1950662406.jpg', '2022-01-01');
INSERT INTO `utilisateur` (id, bio, localisation, url_site, nom_utilisateur, hash, url_avatar, date_creation) VALUES(NULL, 'Meeeeeeeeeeeeeeeeeeeeeeee!', 'Ottawa', NULL, 'trudeauj', '$2y$10$H3qx/AB5A7jHrVug8pNBsOrpBhEJxpscjOMvttyH1M5Zuxm.oHsv6', 'https://media3.giphy.com/media/v1.Y2lkPTc5MGI3NjExNGs3b2Q4Y3JrOThjZzEwNnlrOTJ0d2prZ2xqcm9jczY4eWc4eTVjciZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/Rlwz4m0aHgXH13jyrE/giphy.gif', '2022-01-01');

INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Mon premier shweet!', 1, NULL, '2022-10-14 06:36:19');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Je commente mon propre shweet!', 1, 1, '2022-10-14 06:39:25');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'C''pas toi qui a inventé l''eau chaude...', 2, 1, '2022-10-15 07:36:10');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Pas encore un autre réseau social pour permettre aux deux d''piques d''écrire des niaiseries.', 2, NULL, '2022-10-20 16:55:19');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'J''pense. Mais bon, tsé veut dire. Quand même... vraiment! Lâ lâ! Pffffff. Ouin Ouin. Tu comprends pas ce que je veux dire. Me semble que je suis clair! Relis ce que je viens d''écrire.', 3, NULL, '2023-01-12 01:26:29');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Hishhhh... t''as du manquer d''air à''naissance!', 2, 5, '2023-01-13 11:26:33');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'C''tu moi ou bien le prof de php est un vrai cabochon?', 5, NULL, '2024-01-11 12:16:09');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Oui c''est vrai!', 3, 7, '2024-01-11 12:16:55');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Ce n''est pas très poli comme propos...', 6, 7, '2024-01-11 12:17:19');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Oui c''est vrai!', 3, 7, '2024-01-11 12:17:59');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Le parfum Nautica est bon marché et il sent très bon!', 3, NULL, '2024-01-31 00:00:45');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Pffff, que du Nautica à 30 balles... j''aurais honte à ta place!', 4, 11, '2024-01-31 00:05:55');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Menoum menoum, du bon gruau pomme cannelle!', 7, NULL, '2024-02-02 15:02:49');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'echo ''php sucks!'';', 8, NULL, '2024-02-03 16:12:41');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Je le confirme à tout le monde : MC n''est pas bonne à Tetris! En plus, elle rage tout le temps!', 9, NULL, '2024-02-12 11:12:19');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Oui c''est vrai!', 3, 15, '2024-02-12 11:12:39');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Je le jure sur la tête de Miguel, je n''ai jamais au grand jamais utilisé CoPilot une seule fois de toute ma vie !', 10, NULL, '2024-02-13 17:15:15');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, '0_o', 7, 17, '2024-02-13 17:15:48');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'HEY! D''OÙ ÇA SORT ÇA! &?%$@$*%!!!!!', 11, 15, '2024-02-12 11:13:59');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'CQFD', 9, 15, '2024-02-12 11:14:51');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Tout ça commence à dégénérer!', 12, NULL, '2024-02-15 02:14:54');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Longue vie et prospérité!', 13, NULL, '2024-03-15 09:14:24');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Tous ceux qui n''ont pas deux écrans sur leur portable sont des noobs!', 14, NULL, '2024-03-15 19:19:55');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Ma Mazda part toujours au quart de tour!!!', 16, NULL, '2024-04-01 20:19:20');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'T''as pas besoin de lunette spéciale pour regarder une éclipse... faites moi confiance!', 18, NULL, '2024-04-01 22:49:20');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Je te fais totalement confiance!', 4, 25, '2024-04-01 22:49:59');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Ça chasse bin mieux avec un char qu''un gun!', 19, NULL, '2024-04-01 22:50:54');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'J''aime me prendre en photo!', 4, NULL, '2024-04-01 23:30:59');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Tu devrais coder davantage que de te prendre en photo!', 6, 28, '2024-04-01 23:45:01');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Spam!', 4, NULL, '2024-04-01 23:31:01');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Spam!', 4, NULL, '2024-04-01 23:31:02');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Spam!', 4, NULL, '2024-04-01 23:31:03');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Spam!', 4, NULL, '2024-04-01 23:31:04');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'J''aime la profondeur de tes réflexions!', 3, 33, '2024-04-01 23:35:04');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, 'Marci l''gros! Ça ma pris du temps à écrire ça!', 4, 33, '2024-04-01 23:36:00');
INSERT INTO `shweet` (id, texte, auteur_id, parent_id, date_creation) VALUES(NULL, '...', 20, NULL, '2024-04-02 00:34:10');











