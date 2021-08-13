-- MySQL dump 10.13  Distrib 5.7.23, for macos10.13 (x86_64)
--
-- Host: 127.0.0.1    Database: blog-php
-- ------------------------------------------------------
-- Server version	5.7.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publishedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `thumbnailUrl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `trending` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `authorId` (`authorId`) USING BTREE,
  KEY `categoryId` (`categoryId`) USING BTREE,
  CONSTRAINT `authorId_fk_1` FOREIGN KEY (`authorId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `categoryId_fk_1` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (0,'36 morts et 25 blessés graves après que quelqu’un a marché sur le pied de Véronique Rabiot','Un geste inconscient qui a provoqué la fureur de la mère de l’international Français.','Ce matin, en région parisienne, un homme a malheureusement marché sur le pied de Véronique Rabiot alors qu’elle faisait la queue devant un guichet de la Poste. Une maladresse impardonnable qui a entraîné la mort du fautif et des 35 personnes présentes, jugées “complices” par la célèbre mère de footballeur.\n\nLa forcenée a finalement été immobilisée après 3 heures de lutte. L’opération a nécessité 400 tirs de LBD, 50 tasers et 20 colonnes de CRS. 35 membres des forces de l’ordre et 3 malinois ont été grièvement blessés lors de l’intervention. Le pronostic vital est engagé pour 5 d’entre eux.\n\nCe n’est pas la première fois que la maman d’Adrien est sous le feu des projecteurs pour des affaires de ce type. Rappelons qu’en mai 2019, à Marseille, elle a démoli le McDonald de la canebière après qu’un employé du fast-food a oublié sa sauce pommes frites dans sa commande à emporter.','36-morts-et-25-blesses-graves-apres-que-quelquun-a-marche-sur-le-pied-de-veronique-rabiot','2021-05-27 17:07:43','2021-05-27 17:07:43','/images/article-0.jpg',3,3,1),(1,'Fin des restrictions COVID – Les Parisiens autorisés à nouveau à lécher les barres de métro','C’est dans la joie et la bonne humeur que les usagers des transports en commun parisien ont accueilli la nouvelle de la fin des restrictions.','En effet, dès demain, et avec la recommandation express de Jean Castex il sera de nouveau possible pour les usagers de la RATP de lécher les barres de métro, comme au bon vieux temps. « C’est le retour à la vie d’avant avec tous ces petits bonheurs » a commenté le Premier ministre en léchant une barre de métro à une heure de pointe devant plusieurs journalistes. « C’est incroyable, quel soulagement, près d’un an et demi sans pouvoir lécher une barre de métro, je n’en pouvais plus » raconte Amanda en léchant une rampe d’escalator. Plus loin, c’est Eric qui savoure enfin un plaisir retrouvé même s’il confesse avoir continué de lécher quelques barres de métro même au pire de l’épidémie. « Cela fait partie de nos coutumes, je n’allais pas m’arrêter pour un simple virus » ajoute-t-il sans savoir qu’il vient de créer huit nouveaux variants du COVID dont deux seront à l’origine de nouvelles restrictions sanitaires en 2022, 2026 et du Grand Confinement de 2030-2050.','fin-des-restrictions-covid-les-parisiens-autorises-a-nouveau-a-lecher-les-barres-de-metro','2021-05-28 15:18:40','2021-05-28 15:18:40','/images/article-1.jpg',3,2,0),(2,'Un élève de CM1 découvre qu’il a 22 ans en regardant au fond d’un verre Duralex','Depuis midi, les journalistes affluent autour de la modeste école primaire située dans la banlieue Nantaise. La raison de cette agitation : un élève affirmant avoir découvert être âgé de 22 ans après avoir regardé dans le fond d’un verre Duralex.','C’était pourtant un repas comme les autres pour tous les élèves demi-pensionnaires. Réunis autour d’un plat de saucisses aux lentilles, Augustin et ses camarades prennent alors la décision de regarder au fond de leur verre Duralex pour découvrir leur âge réel. Pour le petit Augustin, tout bascule alors qu’il découvre que son verre porte le numéro 22. Un véritable choc pour l’élève scolarisé dans l’établissement depuis la maternelle.\n\nPour celui qui est devenu en un instant le plus âgé des élèves français fréquentant une classe de CM1, les questions se bousculent. « Depuis ce midi, je doute de tout », explique t-il. L’enfant ne cesse depuis de s’interroger autour d’autres éventuels mensonges au sujet de son identité ou du monde qui l’entoure. « Suis-je vraiment le fils de mes parents ? », « vais-je perdre mes supers pouvoirs ? », « Macron est-il vraiment ni de droite, ni de gauche ».\n\nDe leur côté, les parents du petit Augustin, eux-aussi sous le choc, cherchent toujours une explication. « Notre petit est pourtant né en 2012, nous avons des papiers qui peuvent le prouver » déclarent-ils tout en évoquant la possibilité d’un échange malveillant avec un enfant de 13 ans au sein de son club de loisir. Suite à cette découverte, l’enfant envisagerait de quitter le domicile parental pour profiter de sa majorité et réaliser son rêve de découvrir internet sans code de contrôle parental.','coronavirus-le monde-bascule-dans-le-chaos-apres-lannonce-dun-possible-report-de-la-playstation-5','2021-05-27 17:07:43','2021-05-27 17:07:43','/images/article-2.jpg',3,2,1),(3,'Récréation : un CM1 échange un variant indien contre deux variants brésiliens et 5 variants anglais','Le variant indien a bel et bien le vent en poupe dans les écoles primaires.','Mani, 9 ans, a réalisé une belle opération ce matin. Positif asymptomatique au variant indien, il a échangé son virus contre un joli florilège de virus internationaux  “Un variant indien c’est comme si j’avais une carte brillante rare ou un mammouth aux billes.” confie-t-il \n\nPour Jordan, qui a réussi à récupérer le précieux variant indien, c’est une opération coûteuse mais qui en valait la peine “ J’ai dû donner tout ce que j’avais pour le récupérer mais il est trop chouette. J’ai hâte de le montrer à ma sœur, elle va être trop deg.” lâche-t-il.\n\nMani a donc préféré la quantité au prestige, et pour Adèle, en CM1 également, c’est une décision tout sauf idiote “ Au début, tout le monde voulait avoir le variant anglais à la récré. Une semaine plus tard tout le monde l’avait, c’était devenu naze. À mon avis l’indien, ça va être la même, alors autant faire un bel échange tout de suite. » témoigne cette analyste en culotte courte.','recreation-un-cm1-echange-un-variant-indien-contre-deux-variants-bresiliens-et-5-variants-anglais','2021-05-27 17:07:43','2021-05-27 17:07:43','/images/article-3.jpg',3,2,1),(4,'Euro 2021 : Après le coca de Ronaldo, Paul Pogba retire des fûts de bière en pleine conférence de presse','Paul Pogba était visiblement irrité par la présence de fûts de bière durant sa dernière conférence de presse.','L’international tricolore a mis quelques minutes pour déplacer les fûts de bière qui masquaient sa vue et celle des journalistes avant de pouvoir reprendre sa conférence de presse. Quelques minutes plus tard, un assistant est venu lui mettre un béret basque aux couleurs de Cacolac ainsi qu’une perruque bleu blanc rouge Renault et des lunettes Ricard. Alors qu’il concluait sa conférence, cette fois c’est un camion de livraison Heineken qui a traversé la salle de presse et est venu se garer ostensiblement devant lui. ','euro-2021-apres-le-coca-de-ronaldo-paul-pogba-retire-des-futs-de-bieres-en-pleine-conference-de-presse','2021-05-27 17:07:43','2021-05-27 17:07:43','/images/article-4.jpg',3,3,0),(5,'Jugé inutile, le centre d’entraînement de l’OM bientôt transformé en centre de vaccination','Pour accélérer la campagne vaccinale, le gouvernement est toujours à la recherche de centres dédiés à la vaccination. Dans ce cadre, la Commanderie, le centre d’entraînement de l’OM, qui ne sert plus à jouer au football depuis bien longtemps, semble tout à fait approprié.','Début janvier, le porte-parole du gouvernement, Gabriel Attal, avait promis l’ouverture de 500 centres dédiés à la vaccination hors hôpitaux. Afin de tenir parole, le gouvernement étudie de près la possibilité de réquisitionner la Commanderie, le centre d’entraînement de l’OM. « Cet établissement comporte toutes les caractéristiques recherchées : il y a de l’espace, peu de choses de valeur depuis l’intrusion des supporters marseillais et surtout il est inutilisé depuis des mois » plaide Olivier Véran, le ministre des Solidarités et de la Santé. Le capitaine de L’OM, Steve Mandanda, a tenté de dissuader les autorités de s’accaparer les lieux, mais ses explications n’ont pas convaincu : « C’est faux de dire qu’il n’y a plus de football ici, il nous arrive parfois de faire des choses qui y ressemblent ! Il y a moins d’un mois, je crois me souvenir d’une séquence de trois passes ponctuée d’un tir hors cadre, c’est pas mal pour nous ! ».\n\nUn projet en bonne voie\n\nLe Premier ministre Jean Castex ne voit que des avantages à une telle décision : « cela permettra de calmer les supporters et éviter de nouveaux débordements ». Pour le journaliste sportif Pierre Ménès, c’est même une solution gagnant-gagnant. « Les joueurs de l’OM ont besoin de repos s’ils veulent lutter avec leurs armes : le physique. Y a pas besoin d’un centre d’entraînement pour courir ou faire de la muscu. Travailler la technique, ça ne sert plus à rien, il faut qu’ils laissent ça aux joueurs de ballon », explique-t-il. Interrogé, le numéro 10 de l’OM, Dimitri Payet, ne s’est pas montré hostile à l’installation d’un centre vaccinal « à condition qu’on laisse un peu de place pour un KFC » a-t-il toutefois ajouté.','juge-inutile-le-centre-dentrainement-de-lom-bientot-transforme-en-centre-de-vaccination','2021-05-27 17:07:43','2021-05-27 17:07:43','/images/article-5.jpg',3,3,0),(6,'7 détergents à éviter au petit déjeuner','Repas le plus important de la journée, le petit déjeuner est le moment privilégié pour s’occuper de soi et procéder à un nettoyage de l’organisme. Mais gare à ne pas faire n’importe quoi. Voici sept produits ménagers à proscrire de vos menus.','Le pastis au savon de Marseille\n\nL’huile d’olive utilisée pour la fabrication du savon de Marseille est riche oméga-3. Cependant ce produit reste déconseillé, même pour réaliser le fameux « pastis au savon de Marseille ».\n\nLe shot d’eau de Javel®\n\nMême en très petite quantité, l’eau de Javel peut provoquer de graves brûlures de votre système digestif, qui ne pourront être soulagées que par l’ingestion de huit tubes de Biafine.\n\nLe rail de lessive en poudre\n\nBien qu’elles soient de plus en plus à se prétendre « écologiques », les lessives sont bourrées de produits nocifs pour l’environnement. Avec pour conséquence un risque accru de provoquer un saignement de nez qui générera une pollution majeure autour de vous.\n\nLe thé au Paic Citron®\n\nMême si les marques redoublent d’ingéniosité pour inventer des parfums toujours plus appétissants, les besoins journaliers de votre corps en produit vaisselle sont nuls.\n\nLe confit de Canard WC®\n\nBeaucoup trop riche en produits toxiques, ce plat est à éviter au petit déjeuner. Par contre, c’est le menu parfait pour un premier date avec un employé du centre antipoison le plus proche de chez vous.\n\nLe bol de Destop®\n\nN’écoutez pas les régimes miracles qui vous promettent de perdre quinze kilos en moins de quarante minutes avec ce plat.\n\nLa galette-saucisse-Calgon®\n\nLa spécialité bretonne se marie très mal avec les produits anti-calcaire. À éviter sauf si vous avez mangé un lave-linge la veille.','7-detergents-a-eviter-au-petit-dejeuner','2021-05-27 17:07:43','2021-05-27 17:07:43','/images/article-6.jpg',3,4,0),(8,'Après deux semaines de foie gras, il devient mi-homme mi-canard','La surconsommation de foie gras peut-elle avoir des conséquences graves sur l’organisme ? A cette question, Julien, 28 ans, répondrait certainement par l’affirmative. Récit.','Nevers. Il est 8h ce lundi 4 janvier, Julien se lève pour partir au travail après deux semaines de vacances bien méritées. Mais alors qu’il se dirige vers la salle de bains, un détail retient son attention : il semble que ses pieds n’ont pas le même aspect qu’à l’ordinaire. Il se penche pour en avoir le cœur net et découvre que l’espace entre ses orteils est comblé par l’apparition de bouts de peau. Inquiet, il prend rendez-vous chez son médecin traitant, convaincu qu’il a attrapé des champignons. Le soir même, le diagnostic tombe : Julien a les pieds palmés ! Confronté à des quantités inhabituelles de foie gras à digérer, son corps aurait peu à peu intégré l’idée qu’il n’était pas humain. Le lendemain, les premières plumes apparaissaient. Et depuis hier, Julien éprouve les pires difficultés à parler sans cancaner.\n\nQuel destin pour Julien ?\n\nJusqu’où le phénomène peut-il se poursuivre ? Existe-t-il un moyen de l’arrêter ou d’atténuer sa progression ? Autant de questions qui hantent Julien mais qui sont pour l’instant sans réponse, les précédents étant rares et peu rassurants. On se souvient de cette femme qui, en 2006, avait développé des nageoires à force de manger du poisson ou de cet homme qui avait vu son sang être remplacé par de la bière brune après sa 25e pinte, en 2015. La première était morte étouffée trois jours plus tard, ne parvenant plus à respirer hors de l’eau. Le second avait succombé le lendemain à un coma éthylique après avoir bu un grand verre d’eau.','apres-deux-semaines-de-foie-gras-il-devient-mi-homme-mi-canard','2021-07-02 13:13:44','2021-07-02 13:13:44','/images/article-8.jpg',3,4,0),(9,'Pour mieux gagner sa vie, un agriculteur décide de faire un stage en entreprise non-rémunéré','Sponso – Producteur de pommes de terre en Normandie, Philippe a décidé d’abandonner son activité quelque temps afin de gagner un peu mieux sa vie. Pour ce faire, il a choisi un stage en entreprise non-rémunéré.','« J’en avais marre de gagner autant qu’un ouvrier du Bangladesh à mi-temps » explique Philippe, avant d’ajouter « j’ai donc décidé de vivre comme tout le monde et de me faire exploiter à Paris plutôt qu’en province ». Après avoir passé quatre entretiens, un test de personnalité, une épreuve de survie en milieu aquatique hostile, une épreuve de Trivial Pursuit et un défi de chaises musicales remporté haut la main, il a réussi à décrocher un stage comme « co-responsable technique de l’entretien des sols » au MacDonalds de Marx Dormoy. « Ici, les gens me disent bonjour, parfois même merci, j’ai enfin l’impression d’exister ! » s’enthousiasme-t-il. Puis de déclarer : « Mais surtout, entre la prise en charge de la moitié des transports et les tickets restaurants, je peux enfin faire quelques folies ».\n\nUn avenir radieux ?\n\n« Mon moment préféré, c’est d’entendre un des employés annoncer le prix des frites à un client. Je pense alors au prix auquel les grandes surfaces m’achetaient mes pommes de terre, je ferme les yeux, et je savoure d’être du côté de ceux qui exploitent », confie Philippe. Son espoir secret ? Décrocher à l’issue de ce stage, un autre stage, mais rémunéré cette fois-ci 540 euros. « Je m’accroche à ce rêve, je sais que c’est un peu fou mais j’y crois. J’aimerais bien savoir ce que ça fait de gagner 3 fois mon salaire habituel ». Cet espoir est toutefois associé à une crainte, celle de ne pas être compris de ses collègues agriculteurs : « J’ai un peu peur d’être considéré comme un nanti », avoue-t-il. Revigoré par cette nouvelle vie, Philippe envisagerait de prendre sa retraite un peu plus tôt que prévu afin de profiter pleinement de son cancer lié à l’exposition aux pesticides.\nCette histoire n’est pas sans rappeler celle de ce professeur qui avait choisi de devenir caissier de supermarché afin d’obtenir enfin un peu de reconnaissance de la société.\n\n« choisir ce que l’on mange, c’est choisir le monde dans lequel on vit »','pour-mieux-gagner-sa-vie-un-agriculteur-decide-de-faire-un-stage-en-entreprise-non-remunere','2021-07-02 13:27:12','2021-07-02 13:27:12','/images/article-9.jpg',3,4,0),(19,'Francis Lalanne épuisé après avoir essayé pendant plus d’une heure d’attraper sa queue de cheval','																																																															On arrête plus Francis Lalanne. Une vidéo montrant le chanteur en train de tourner sur lui-même pour tenter d’attraper sa queue de cheval circule depuis ce matin sur les réseaux sociaux.\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						','																																																															Plusieurs spectateurs rapportent un comportement des plus étranges de la part de l’artiste qui se produit actuellement en « off » au festival d’Avignon. Selon plusieurs témoignages, Francis Lalanne qui sortait de scène a été visiblement dérangé par sa propre queue de cheval contre laquelle il aurait tenu des propos virulents, avant de s’en prendre à elle en tentant de s’en saisir pendant plus d’une heure.\r\n\r\nPrésent au moment des faits, un membre de l’équipe technique relate la scène. « Sans prévenir, il s’est mis à tourner sur lui-même comme une toupie. Il était comme possédé et répétait en boucle  »je vais t’attraper, je vais t’attraper, je vais t »attraper » » raconte le technicien qui précise que l’intervention de plusieurs personnes a été nécessaire afin de ramener le chanteur à la raison.\r\n\r\nD’autres personnes qui ont assisté à la scène rapportent également que, quelques minutes après avoir retrouvé son calme, le chanteur se serait soudainement mis à courir en hurlant, visiblement effrayé par une de ses propres flatulences.\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						','francis-lalanne-épuisé-après-avoir-essayé-pendant-plus-d’une-heure-d’attraper-sa-queue-de-cheval-ce-con','2021-07-16 14:59:35','2021-07-16 14:59:35','/images/1627030018-francis-lalanne.jpg',3,2,1);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorySlug` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (2,'Actualité','actualite'),(3,'Sport','sport'),(4,'Food','food');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `publishedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isValidated` int(11) NOT NULL DEFAULT '0',
  `authorId` int(11) NOT NULL,
  `articleId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `authorId` (`authorId`),
  KEY `articleId` (`articleId`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`authorId`) REFERENCES `user` (`id`),
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`articleId`) REFERENCES `article` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (50,'Commentaire de test','2021-07-07 20:14:14',1,3,0),(51,'Nouveau commentaire de test','2021-07-07 21:49:13',1,3,9),(52,'Commentaire de test','2021-07-08 18:46:14',1,4,9),(53,'Bravo Francis !','2021-08-09 19:35:57',1,6,19),(54,'Commentaire de test','2021-08-13 10:59:14',0,4,2),(55,'Test','2021-08-13 11:00:51',0,4,2);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmationToken` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmedAt` datetime DEFAULT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageUrl` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (3,'Pierre','Thiollent','pierre.thiollent76@gmail.com','$2y$10$kIgbEW.XFD9qxrLAEbsONOyAiQAeff3TxmF4cB.bfjGNlrIoWRDd.',NULL,'2021-06-04 16:22:48','admin','images/user-3.jpg'),(4,'John','Doe','test@test.fr','$2y$10$6k2APjjgk6Eh5Lc8UfaeaOvKA4yXmcflhJny6DyC9nrcF7bKj4u/e',NULL,'2021-07-08 14:57:04','user','images/user-placeholder.jpg'),(6,'Pierre','Thiollent','pierre.thiollent@viacesi.fr','$2y$10$av5ZjFaav22mIe4f49mh6OdvslOXFNWoSxpqVkmIm4XZBLpqIkcGG',NULL,'2021-08-09 19:35:30','user','images/user-placeholder.jpg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'blog-php'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-08-13 11:23:17
