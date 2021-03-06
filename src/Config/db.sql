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
INSERT INTO `article` VALUES (0,'36 morts et 25 bless??s graves apr??s que quelqu???un a march?? sur le pied de V??ronique Rabiot','Un geste inconscient qui a provoqu?? la fureur de la m??re de l???international Fran??ais.','Ce matin, en r??gion parisienne, un homme a malheureusement march?? sur le pied de V??ronique Rabiot alors qu???elle faisait la queue devant un guichet de la Poste. Une maladresse impardonnable qui a entra??n?? la mort du fautif et des 35 personnes pr??sentes, jug??es ???complices??? par la c??l??bre m??re de footballeur.\n\nLa forcen??e a finalement ??t?? immobilis??e apr??s 3 heures de lutte. L???op??ration a n??cessit?? 400 tirs de LBD, 50 tasers et 20 colonnes de CRS. 35 membres des forces de l???ordre et 3 malinois ont ??t?? gri??vement bless??s lors de l???intervention. Le pronostic vital est engag?? pour 5 d???entre eux.\n\nCe n???est pas la premi??re fois que la maman d???Adrien est sous le feu des projecteurs pour des affaires de ce type. Rappelons qu???en mai 2019, ?? Marseille, elle a d??moli le McDonald de la canebi??re apr??s qu???un employ?? du fast-food a oubli?? sa sauce pommes frites dans sa commande ?? emporter.','36-morts-et-25-blesses-graves-apres-que-quelquun-a-marche-sur-le-pied-de-veronique-rabiot','2021-05-27 17:07:43','2021-05-27 17:07:43','/images/article-0.jpg',3,3,1),(1,'Fin des restrictions COVID ??? Les Parisiens autoris??s ?? nouveau ?? l??cher les barres de m??tro','C???est dans la joie et la bonne humeur que les usagers des transports en commun parisien ont accueilli la nouvelle de la fin des restrictions.','En effet, d??s demain, et avec la recommandation express de Jean Castex il sera de nouveau possible pour les usagers de la RATP de l??cher les barres de m??tro, comme au bon vieux temps. ?? C???est le retour ?? la vie d???avant avec tous ces petits bonheurs ?? a comment?? le Premier ministre en l??chant une barre de m??tro ?? une heure de pointe devant plusieurs journalistes. ?? C???est incroyable, quel soulagement, pr??s d???un an et demi sans pouvoir l??cher une barre de m??tro, je n???en pouvais plus ?? raconte Amanda en l??chant une rampe d???escalator. Plus loin, c???est Eric qui savoure enfin un plaisir retrouv?? m??me s???il confesse avoir continu?? de l??cher quelques barres de m??tro m??me au pire de l?????pid??mie. ?? Cela fait partie de nos coutumes, je n???allais pas m???arr??ter pour un simple virus ?? ajoute-t-il sans savoir qu???il vient de cr??er huit nouveaux variants du COVID dont deux seront ?? l???origine de nouvelles restrictions sanitaires en 2022, 2026 et du Grand Confinement de 2030-2050.','fin-des-restrictions-covid-les-parisiens-autorises-a-nouveau-a-lecher-les-barres-de-metro','2021-05-28 15:18:40','2021-05-28 15:18:40','/images/article-1.jpg',3,2,0),(2,'Un ??l??ve de CM1 d??couvre qu???il a 22 ans en regardant au fond d???un verre Duralex','Depuis midi, les journalistes affluent autour de la modeste ??cole primaire situ??e dans la banlieue Nantaise. La raison de cette agitation : un ??l??ve affirmant avoir d??couvert ??tre ??g?? de 22 ans apr??s avoir regard?? dans le fond d???un verre Duralex.','C?????tait pourtant un repas comme les autres pour tous les ??l??ves demi-pensionnaires. R??unis autour d???un plat de saucisses aux lentilles, Augustin et ses camarades prennent alors la d??cision de regarder au fond de leur verre Duralex pour d??couvrir leur ??ge r??el. Pour le petit Augustin, tout bascule alors qu???il d??couvre que son verre porte le num??ro 22. Un v??ritable choc pour l?????l??ve scolaris?? dans l?????tablissement depuis la maternelle.\n\nPour celui qui est devenu en un instant le plus ??g?? des ??l??ves fran??ais fr??quentant une classe de CM1, les questions se bousculent. ?? Depuis ce midi, je doute de tout ??, explique t-il. L???enfant ne cesse depuis de s???interroger autour d???autres ??ventuels mensonges au sujet de son identit?? ou du monde qui l???entoure. ?? Suis-je vraiment le fils de mes parents ? ??, ?? vais-je perdre mes supers pouvoirs ? ??, ?? Macron est-il vraiment ni de droite, ni de gauche ??.\n\nDe leur c??t??, les parents du petit Augustin, eux-aussi sous le choc, cherchent toujours une explication. ?? Notre petit est pourtant n?? en 2012, nous avons des papiers qui peuvent le prouver ?? d??clarent-ils tout en ??voquant la possibilit?? d???un ??change malveillant avec un enfant de 13 ans au sein de son club de loisir. Suite ?? cette d??couverte, l???enfant envisagerait de quitter le domicile parental pour profiter de sa majorit?? et r??aliser son r??ve de d??couvrir internet sans code de contr??le parental.','coronavirus-le monde-bascule-dans-le-chaos-apres-lannonce-dun-possible-report-de-la-playstation-5','2021-05-27 17:07:43','2021-05-27 17:07:43','/images/article-2.jpg',3,2,1),(3,'R??cr??ation : un CM1 ??change un variant indien contre deux variants br??siliens et 5 variants anglais','Le variant indien a bel et bien le vent en poupe dans les ??coles primaires.','Mani, 9 ans, a r??alis?? une belle op??ration ce matin. Positif asymptomatique au variant indien, il a ??chang?? son virus contre un joli floril??ge de virus internationaux  ???Un variant indien c???est comme si j???avais une carte brillante rare ou un mammouth aux billes.??? confie-t-il \n\nPour Jordan, qui a r??ussi ?? r??cup??rer le pr??cieux variant indien, c???est une op??ration co??teuse mais qui en valait la peine ??? J???ai d?? donner tout ce que j???avais pour le r??cup??rer mais il est trop chouette. J???ai h??te de le montrer ?? ma s??ur, elle va ??tre trop deg.??? l??che-t-il.\n\nMani a donc pr??f??r?? la quantit?? au prestige, et pour Ad??le, en CM1 ??galement, c???est une d??cision tout sauf idiote ??? Au d??but, tout le monde voulait avoir le variant anglais ?? la r??cr??. Une semaine plus tard tout le monde l???avait, c?????tait devenu naze. ?? mon avis l???indien, ??a va ??tre la m??me, alors autant faire un bel ??change tout de suite. ?? t??moigne cette analyste en culotte courte.','recreation-un-cm1-echange-un-variant-indien-contre-deux-variants-bresiliens-et-5-variants-anglais','2021-05-27 17:07:43','2021-05-27 17:07:43','/images/article-3.jpg',3,2,1),(4,'Euro 2021 : Apr??s le coca de Ronaldo, Paul Pogba retire des f??ts de bi??re en pleine conf??rence de presse','Paul Pogba ??tait visiblement irrit?? par la pr??sence de f??ts de bi??re durant sa derni??re conf??rence de presse.','L???international tricolore a mis quelques minutes pour d??placer les f??ts de bi??re qui masquaient sa vue et celle des journalistes avant de pouvoir reprendre sa conf??rence de presse. Quelques minutes plus tard, un assistant est venu lui mettre un b??ret basque aux couleurs de Cacolac ainsi qu???une perruque bleu blanc rouge Renault et des lunettes Ricard. Alors qu???il concluait sa conf??rence, cette fois c???est un camion de livraison Heineken qui a travers?? la salle de presse et est venu se garer ostensiblement devant lui. ','euro-2021-apres-le-coca-de-ronaldo-paul-pogba-retire-des-futs-de-bieres-en-pleine-conference-de-presse','2021-05-27 17:07:43','2021-05-27 17:07:43','/images/article-4.jpg',3,3,0),(5,'Jug?? inutile, le centre d???entra??nement de l???OM bient??t transform?? en centre de vaccination','Pour acc??l??rer la campagne vaccinale, le gouvernement est toujours ?? la recherche de centres d??di??s ?? la vaccination. Dans ce cadre, la Commanderie, le centre d???entra??nement de l???OM, qui ne sert plus ?? jouer au football depuis bien longtemps, semble tout ?? fait appropri??.','D??but janvier, le porte-parole du gouvernement, Gabriel Attal, avait promis l???ouverture de 500 centres d??di??s ?? la vaccination hors h??pitaux. Afin de tenir parole, le gouvernement ??tudie de pr??s la possibilit?? de r??quisitionner la Commanderie, le centre d???entra??nement de l???OM. ?? Cet ??tablissement comporte toutes les caract??ristiques recherch??es : il y a de l???espace, peu de choses de valeur depuis l???intrusion des supporters marseillais et surtout il est inutilis?? depuis des mois ?? plaide Olivier V??ran, le ministre des Solidarit??s et de la Sant??. Le capitaine de L???OM, Steve Mandanda, a tent?? de dissuader les autorit??s de s???accaparer les lieux, mais ses explications n???ont pas convaincu : ?? C???est faux de dire qu???il n???y a plus de football ici, il nous arrive parfois de faire des choses qui y ressemblent ! Il y a moins d???un mois, je crois me souvenir d???une s??quence de trois passes ponctu??e d???un tir hors cadre, c???est pas mal pour nous ! ??.\n\nUn projet en bonne voie\n\nLe Premier ministre Jean Castex ne voit que des avantages ?? une telle d??cision : ?? cela permettra de calmer les supporters et ??viter de nouveaux d??bordements ??. Pour le journaliste sportif Pierre M??n??s, c???est m??me une solution gagnant-gagnant. ?? Les joueurs de l???OM ont besoin de repos s???ils veulent lutter avec leurs armes : le physique. Y a pas besoin d???un centre d???entra??nement pour courir ou faire de la muscu. Travailler la technique, ??a ne sert plus ?? rien, il faut qu???ils laissent ??a aux joueurs de ballon ??, explique-t-il. Interrog??, le num??ro 10 de l???OM, Dimitri Payet, ne s???est pas montr?? hostile ?? l???installation d???un centre vaccinal ?? ?? condition qu???on laisse un peu de place pour un KFC ?? a-t-il toutefois ajout??.','juge-inutile-le-centre-dentrainement-de-lom-bientot-transforme-en-centre-de-vaccination','2021-05-27 17:07:43','2021-05-27 17:07:43','/images/article-5.jpg',3,3,0),(6,'7 d??tergents ?? ??viter au petit d??jeuner','Repas le plus important de la journ??e, le petit d??jeuner est le moment privil??gi?? pour s???occuper de soi et proc??der ?? un nettoyage de l???organisme. Mais gare ?? ne pas faire n???importe quoi. Voici sept produits m??nagers ?? proscrire de vos menus.','Le pastis au savon de Marseille\n\nL???huile d???olive utilis??e pour la fabrication du savon de Marseille est riche om??ga-3. Cependant ce produit reste d??conseill??, m??me pour r??aliser le fameux ?? pastis au savon de Marseille ??.\n\nLe shot d???eau de Javel??\n\nM??me en tr??s petite quantit??, l???eau de Javel peut provoquer de graves br??lures de votre syst??me digestif, qui ne pourront ??tre soulag??es que par l???ingestion de huit tubes de Biafine.\n\nLe rail de lessive en poudre\n\nBien qu???elles soient de plus en plus ?? se pr??tendre ?? ??cologiques ??, les lessives sont bourr??es de produits nocifs pour l???environnement. Avec pour cons??quence un risque accru de provoquer un saignement de nez qui g??n??rera une pollution majeure autour de vous.\n\nLe th?? au Paic Citron??\n\nM??me si les marques redoublent d???ing??niosit?? pour inventer des parfums toujours plus app??tissants, les besoins journaliers de votre corps en produit vaisselle sont nuls.\n\nLe confit de Canard WC??\n\nBeaucoup trop riche en produits toxiques, ce plat est ?? ??viter au petit d??jeuner. Par contre, c???est le menu parfait pour un premier date avec un employ?? du centre antipoison le plus proche de chez vous.\n\nLe bol de Destop??\n\nN?????coutez pas les r??gimes miracles qui vous promettent de perdre quinze kilos en moins de quarante minutes avec ce plat.\n\nLa galette-saucisse-Calgon??\n\nLa sp??cialit?? bretonne se marie tr??s mal avec les produits anti-calcaire. ?? ??viter sauf si vous avez mang?? un lave-linge la veille.','7-detergents-a-eviter-au-petit-dejeuner','2021-05-27 17:07:43','2021-05-27 17:07:43','/images/article-6.jpg',3,4,0),(8,'Apr??s deux semaines de foie gras, il devient mi-homme mi-canard','La surconsommation de foie gras peut-elle avoir des cons??quences graves sur l???organisme ? A cette question, Julien, 28 ans, r??pondrait certainement par l???affirmative. R??cit.','Nevers. Il est 8h ce lundi 4 janvier, Julien se l??ve pour partir au travail apr??s deux semaines de vacances bien m??rit??es. Mais alors qu???il se dirige vers la salle de bains, un d??tail retient son attention : il semble que ses pieds n???ont pas le m??me aspect qu????? l???ordinaire. Il se penche pour en avoir le c??ur net et d??couvre que l???espace entre ses orteils est combl?? par l???apparition de bouts de peau. Inquiet, il prend rendez-vous chez son m??decin traitant, convaincu qu???il a attrap?? des champignons. Le soir m??me, le diagnostic tombe : Julien a les pieds palm??s ! Confront?? ?? des quantit??s inhabituelles de foie gras ?? dig??rer, son corps aurait peu ?? peu int??gr?? l???id??e qu???il n?????tait pas humain. Le lendemain, les premi??res plumes apparaissaient. Et depuis hier, Julien ??prouve les pires difficult??s ?? parler sans cancaner.\n\nQuel destin pour Julien ?\n\nJusqu???o?? le ph??nom??ne peut-il se poursuivre ? Existe-t-il un moyen de l???arr??ter ou d???att??nuer sa progression ? Autant de questions qui hantent Julien mais qui sont pour l???instant sans r??ponse, les pr??c??dents ??tant rares et peu rassurants. On se souvient de cette femme qui, en 2006, avait d??velopp?? des nageoires ?? force de manger du poisson ou de cet homme qui avait vu son sang ??tre remplac?? par de la bi??re brune apr??s sa 25e pinte, en 2015. La premi??re ??tait morte ??touff??e trois jours plus tard, ne parvenant plus ?? respirer hors de l???eau. Le second avait succomb?? le lendemain ?? un coma ??thylique apr??s avoir bu un grand verre d???eau.','apres-deux-semaines-de-foie-gras-il-devient-mi-homme-mi-canard','2021-07-02 13:13:44','2021-07-02 13:13:44','/images/article-8.jpg',3,4,0),(9,'Pour mieux gagner sa vie, un agriculteur d??cide de faire un stage en entreprise non-r??mun??r??','Sponso ??? Producteur de pommes de terre en Normandie, Philippe a d??cid?? d???abandonner son activit?? quelque temps afin de gagner un peu mieux sa vie. Pour ce faire, il a choisi un stage en entreprise non-r??mun??r??.','?? J???en avais marre de gagner autant qu???un ouvrier du Bangladesh ?? mi-temps ?? explique Philippe, avant d???ajouter ?? j???ai donc d??cid?? de vivre comme tout le monde et de me faire exploiter ?? Paris plut??t qu???en province ??. Apr??s avoir pass?? quatre entretiens, un test de personnalit??, une ??preuve de survie en milieu aquatique hostile, une ??preuve de Trivial Pursuit et un d??fi de chaises musicales remport?? haut la main, il a r??ussi ?? d??crocher un stage comme ?? co-responsable technique de l???entretien des sols ?? au MacDonalds de Marx Dormoy. ?? Ici, les gens me disent bonjour, parfois m??me merci, j???ai enfin l???impression d???exister ! ?? s???enthousiasme-t-il. Puis de d??clarer : ?? Mais surtout, entre la prise en charge de la moiti?? des transports et les tickets restaurants, je peux enfin faire quelques folies ??.\n\nUn avenir radieux ?\n\n?? Mon moment pr??f??r??, c???est d???entendre un des employ??s annoncer le prix des frites ?? un client. Je pense alors au prix auquel les grandes surfaces m???achetaient mes pommes de terre, je ferme les yeux, et je savoure d?????tre du c??t?? de ceux qui exploitent ??, confie Philippe. Son espoir secret ? D??crocher ?? l???issue de ce stage, un autre stage, mais r??mun??r?? cette fois-ci 540 euros. ?? Je m???accroche ?? ce r??ve, je sais que c???est un peu fou mais j???y crois. J???aimerais bien savoir ce que ??a fait de gagner 3 fois mon salaire habituel ??. Cet espoir est toutefois associ?? ?? une crainte, celle de ne pas ??tre compris de ses coll??gues agriculteurs : ?? J???ai un peu peur d?????tre consid??r?? comme un nanti ??, avoue-t-il. Revigor?? par cette nouvelle vie, Philippe envisagerait de prendre sa retraite un peu plus t??t que pr??vu afin de profiter pleinement de son cancer li?? ?? l???exposition aux pesticides.\nCette histoire n???est pas sans rappeler celle de ce professeur qui avait choisi de devenir caissier de supermarch?? afin d???obtenir enfin un peu de reconnaissance de la soci??t??.\n\n?? choisir ce que l???on mange, c???est choisir le monde dans lequel on vit ??','pour-mieux-gagner-sa-vie-un-agriculteur-decide-de-faire-un-stage-en-entreprise-non-remunere','2021-07-02 13:27:12','2021-07-02 13:27:12','/images/article-9.jpg',3,4,0),(19,'Francis Lalanne ??puis?? apr??s avoir essay?? pendant plus d???une heure d???attraper sa queue de cheval','																																																															On arr??te plus Francis Lalanne. Une vid??o montrant le chanteur en train de tourner sur lui-m??me pour tenter d???attraper sa queue de cheval circule depuis ce matin sur les r??seaux sociaux.\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						','																																																															Plusieurs spectateurs rapportent un comportement des plus ??tranges de la part de l???artiste qui se produit actuellement en ?? off ?? au festival d???Avignon. Selon plusieurs t??moignages, Francis Lalanne qui sortait de sc??ne a ??t?? visiblement d??rang?? par sa propre queue de cheval contre laquelle il aurait tenu des propos virulents, avant de s???en prendre ?? elle en tentant de s???en saisir pendant plus d???une heure.\r\n\r\nPr??sent au moment des faits, un membre de l?????quipe technique relate la sc??ne. ?? Sans pr??venir, il s???est mis ?? tourner sur lui-m??me comme une toupie. Il ??tait comme poss??d?? et r??p??tait en boucle  ??je vais t???attraper, je vais t???attraper, je vais t ??attraper ?? ?? raconte le technicien qui pr??cise que l???intervention de plusieurs personnes a ??t?? n??cessaire afin de ramener le chanteur ?? la raison.\r\n\r\nD???autres personnes qui ont assist?? ?? la sc??ne rapportent ??galement que, quelques minutes apr??s avoir retrouv?? son calme, le chanteur se serait soudainement mis ?? courir en hurlant, visiblement effray?? par une de ses propres flatulences.\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						\r\n						','francis-lalanne-??puis??-apr??s-avoir-essay??-pendant-plus-d???une-heure-d???attraper-sa-queue-de-cheval-ce-con','2021-07-16 14:59:35','2021-07-16 14:59:35','/images/1627030018-francis-lalanne.jpg',3,2,1);
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
INSERT INTO `category` VALUES (2,'Actualit??','actualite'),(3,'Sport','sport'),(4,'Food','food');
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
