SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;

CREATE DATABASE IF NOT EXISTS `projetminari` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `projetminari`;

DROP TABLE IF EXISTS `abonnement`;
CREATE TABLE `abonnement` (
  `id_following` int(11) NOT NULL,
  `follow` varchar(255) NOT NULL COMMENT 'Personne qui follow',
  `followed` varchar(255) NOT NULL COMMENT 'Personne qui se fait follow'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `abonnement` (`id_following`, `follow`, `followed`) VALUES
(4, 'nayeonnyny', '_zyozyo'),
(5, 'nayeonnyny', 'jy_piece'),
(6, 'nayeonnyny', 'mina_sr_my'),
(7, 'nayeonnyny', 'thinkaboutzu'),
(8, 'nayeonnyny', 'chaeyo.0'),
(9, 'nayeonnyny', 'dahhyunnee'),
(10, 'nayeonnyny', 'm.by__sana'),
(11, 'nayeonnyny', 'momo'),
(12, '_zyozyo', 'nayeonnyny'),
(13, 'mina_sr_my', 'nayeonnyny'),
(14, 'mina_sr_my', 'minari');

DROP TABLE IF EXISTS `demande_abonnement`;
CREATE TABLE `demande_abonnement` (
  `id_demande` int(11) NOT NULL,
  `follow` varchar(255) NOT NULL COMMENT 'Personne qui follow',
  `followed` varchar(255) NOT NULL COMMENT 'Personne qui se fait follow'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `demande_abonnement` (`id_demande`, `follow`, `followed`) VALUES
(2, 'nayeonnyny', 'minari');

DROP TABLE IF EXISTS `likes`;
CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL,
  `postliked` int(11) NOT NULL,
  `likedby` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `likes` (`id_like`, `postliked`, `likedby`) VALUES
(1, 1, 'nayeonnyny'),
(2, 4, 'mina_sr_my'),
(3, 2, 'mina_sr_my'),
(4, 5, 'mina_sr_my'),
(5, 6, 'mina_sr_my'),
(6, 7, 'mina_sr_my'),
(7, 8, 'mina_sr_my'),
(8, 9, 'mina_sr_my'),
(9, 10, 'mina_sr_my'),
(10, 11, 'mina_sr_my'),
(11, 12, 'mina_sr_my'),
(12, 13, 'mina_sr_my'),
(13, 14, 'mina_sr_my'),
(14, 15, 'mina_sr_my'),
(15, 16, 'mina_sr_my'),
(16, 17, 'mina_sr_my'),
(17, 18, 'mina_sr_my'),
(18, 19, 'mina_sr_my'),
(19, 1, 'mina_sr_my');

DROP TABLE IF EXISTS `messageprivecontenu`;
CREATE TABLE `messageprivecontenu` (
  `id_salon` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `date_msg` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `messageprivecontenu` (`id_salon`, `user`, `contenu`, `date_msg`) VALUES
(3, 'nayeonnyny', '&lt;3', '2023-05-07 22:16:16'),
(2, '_zyozyo', '&lt;3', '2023-05-07 22:51:08'),
(4, 'mina_sr_my', '&lt;3', '2023-05-07 23:20:26');

DROP TABLE IF EXISTS `messageprivesalon`;
CREATE TABLE `messageprivesalon` (
  `id_salon` int(11) NOT NULL,
  `user1` varchar(255) NOT NULL,
  `user2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `messageprivesalon` (`id_salon`, `user1`, `user2`) VALUES
(1, 'nayeonnyny', 'minari'),
(2, '_zyozyo', 'nayeonnyny'),
(3, 'jy_piece', 'nayeonnyny'),
(4, 'nayeonnyny', 'mina_sr_my');

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `contenu_txt` varchar(300) NOT NULL,
  `contenu_img` varchar(255) NOT NULL,
  `date_publi` datetime NOT NULL,
  `nbr_like` int(11) NOT NULL DEFAULT 0,
  `ephemere` int(1) NOT NULL COMMENT 'Si éphémère ou non'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `post` (`id_post`, `user`, `contenu_txt`, `contenu_img`, `date_publi`, `nbr_like`, `ephemere`) VALUES
(1, 'minari', 'Hello World !', '', '2023-03-07 00:37:37', 2, 0),
(2, 'nayeonnyny', 'Pop, pop, pop (Uh-uh) Pop, pop, pop (Uh-uh) (You gotta pop it) Pop, pop, pop (Uh-uh) (I can&#039;t stop it) Pop, pop, pop', '', '2023-05-07 22:19:37', 1, 0),
(4, 'nayeonnyny', 'Gaseumi ttwineun i neukkim (I neukkim, neukkim, yeah, hey) I wanna make it Pop, pop, pop, you want it Pop, pop, pop, neol gatgil wonhae (I know you want it, babe)', '', '2023-05-07 22:20:35', 1, 0),
(5, 'nayeonnyny', 'Seollemi meotgi jeone (Seollemi meotgi jeone) I wanna make it Pop, pop, pop, you want it (Pop, pop) Pop, pop, pop, teojigil wonhae (Teojigil wonhae)', '', '2023-05-07 22:20:44', 1, 0),
(6, 'nayeonnyny', 'Five Ja ttaega dwaesseo, four Ttak sumeul meomchwo, three Nan neoreul gyeonwo, two, one Here we go!', '', '2023-05-07 22:20:51', 1, 0),
(7, 'nayeonnyny', 'Pop, pop, beobeulgachi teojyeo beorilji molla Kkeutdo eopsi jeomjeom bupureo ga Naege puk ppajin neoreul aesseo chamjin ma Baby, eyes on me now, naega teotteuryeo jul teni', '', '2023-05-07 22:21:30', 1, 0),
(8, 'nayeonnyny', 'Pop, pop, pop (Uh-uh) (Hey, hey, hey, hey) Pop, pop, pop (Uh-uh) (Hey, hey, hey, hey) Pop, pop, pop (Uh-uh) (Hey, hey, hey, hey) Pop, pop, pop (Hey, hey, hey, hey)', '', '2023-05-07 22:21:40', 1, 0),
(9, 'nayeonnyny', 'Gaseumi ttwineun i neukkim I wanna make it Pop, pop, pop, you want it Pop, pop, pop, neol gatgil wonhae', '', '2023-05-07 22:21:49', 1, 0),
(10, 'nayeonnyny', 'Seollemi meotgi jeone I wanna make it Pop, pop, pop, you want it Pop, pop, pop, teojigil wonhae', '', '2023-05-07 22:21:55', 1, 0),
(11, 'nayeonnyny', 'Yeoyuropge check it (Check it) Boran deusi, take it Baby, baby, you&#039;re out of control So you&#039;re under my control', '', '2023-05-07 22:22:06', 1, 0),
(12, 'nayeonnyny', 'Neomu jal boyeo Amuri sumgyeodo Imi deulkin geol Jakku dungdung tteodanijana (Yeah, yeah)', '', '2023-05-07 22:22:37', 1, 0),
(13, 'nayeonnyny', 'Pop, pop, pop (Uh-uh) Pop, pop, pop (Uh-uh) Pop, pop, pop (Uh-uh) Pop, pop, pop', '', '2023-05-07 22:22:42', 1, 0),
(14, 'nayeonnyny', 'Gasеumi ttwineun i neukkim I wanna make it Pop, pop, pop, you want it Pop, pop, pop, neol gatgil wonhae', '', '2023-05-07 22:22:48', 1, 0),
(15, 'nayeonnyny', 'Seollemi meotgi jeonе I wanna make it Pop, pop, pop, you want it Pop, pop, pop, teojigil wonhae', '', '2023-05-07 22:22:52', 1, 0),
(16, 'nayeonnyny', 'Imi neon nareul Beoseonal suga eopseo Tteollin geu nunbit, ti naneun momjit, baby Teotteurigo sipeun neo', '', '2023-05-07 22:22:56', 1, 0),
(17, 'nayeonnyny', '(Let&#039;s start) nae mamdaero play it (Won&#039;t stop) geochimeopsi shake it You know? neon naege Dallyeoitdan geonman aradwo (Yeah, yeah)', '', '2023-05-07 22:23:01', 1, 0),
(18, 'nayeonnyny', 'What&#039;s wrong? Hollil deusi nan neoreul jageukae (Pop, pop, pop) Watch out, seollen deusi Ne bupun mami teojil deuthae (Pop, pop, pop)', '', '2023-05-07 22:23:05', 1, 0),
(19, 'nayeonnyny', 'Nayeon - POP! (romanized)', 'posts/nayeonnyny20230507222337.png', '2023-05-07 22:23:37', 1, 0);

DROP TABLE IF EXISTS `postsignale`;
CREATE TABLE `postsignale` (
  `id_signalement` int(11) NOT NULL,
  `idpost` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `raison` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `postsignale` (`id_signalement`, `idpost`, `user`, `raison`) VALUES
(2, 19, 'mina_sr_my', 'Fausses informations');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `identifiant` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `surnom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `anniversaire` date NOT NULL,
  `prive` int(1) NOT NULL DEFAULT 0 COMMENT '1 si privé, 0 public',
  `pdp` varchar(255) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT 0 COMMENT '1 si admin, 0 sinon',
  `creation` date NOT NULL,
  `banniere` varchar(255) NOT NULL DEFAULT 'bannieres/sansbanniere.jpg',
  `biographie` varchar(300) NOT NULL DEFAULT 'A compléter...',
  `follower` int(11) NOT NULL DEFAULT 0,
  `follow` int(11) NOT NULL DEFAULT 0,
  `nbr_post` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `user` (`identifiant`, `mdp`, `surnom`, `email`, `anniversaire`, `prive`, `pdp`, `admin`, `creation`, `banniere`, `biographie`, `follower`, `follow`, `nbr_post`) VALUES
('chaeryeong', '$argon2id$v=19$m=65536,t=4,p=1$cFV6YjM2OUU3UzhROVR0NQ$aVFFO4wb7RMioeCaccv6YjdOVTlREGdj+ST6L+oYRh8', 'Chaeryeong', 'chaeryeong@itzy.kr', '2001-06-05', 0, 'profils/chaeryeong.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 0, 0, 0),
('chaeyo.0', '$argon2id$v=19$m=65536,t=4,p=1$VFhnSkU4ZEluMXFYVGhYMw$XsCfFsdLOLnZ5EHWuwPcxqdEE2BS4ntUKNq21MzrEFc', '채영 (CHAEYOUNG)', 'chaeyoung@twice.kr', '1999-04-23', 0, 'profils/chaeyo.0.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 1, 0, 0),
('dahhyunnee', '$argon2id$v=19$m=65536,t=4,p=1$MS9wVEhidXN1VVY3dFJESQ$z0ta1Tp+4Y3n3zippjsjhK7YwLrn5q/3MBaWASu+404', '다현 (DAHYUN)', 'dahyun@twice.kr', '1998-05-28', 0, 'profils/dahhyunnee.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 1, 0, 0),
('dilucsama', '$argon2id$v=19$m=65536,t=4,p=1$dkouSjN3TmFzNjB0emh4Uw$sJbBy3HSRVjpvSIeGz5SokwD0a7ZD9yg78Je3ifrnjU', 'Mondstadt&#039;s Batman', 'diluc@genshin.impct', '2000-04-30', 0, 'profils/dilucsama.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 0, 0, 0),
('jy_piece', '$argon2id$v=19$m=65536,t=4,p=1$azRWV2pqNTVhUGhSREloSw$g73ohX9Qmb7OzDLtCVaAhxLUhQQf2yMbuGYs5gEKays', '경완 (JEONGYEON)', 'jeongyeon@twice.kr', '1996-11-01', 0, 'profils/jy_piece.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 1, 0, 0),
('lia', '$argon2id$v=19$m=65536,t=4,p=1$empLcnV2WjQ1YWt5TUg1cQ$wYncQ/IBSJJa9wx3E0EuPfyXrAelJR77Dj4UijdtxcE', 'Lia', 'lia@itzy.kr', '2000-07-21', 0, 'profils/lia.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 0, 0, 0),
('m.by__sana', '$argon2id$v=19$m=65536,t=4,p=1$cGsvZXU1ZVVueG5XT1d5Vw$ibcQLmGPD4QFll/M0gfj/tl3OXWDDqvG0H3lbpbrNRg', '사나 SANA', 'sana@twice.kr', '1996-12-29', 0, 'profils/m.by__sana.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 1, 0, 0),
('mecdealhaitham', '$argon2id$v=19$m=65536,t=4,p=1$dk1Ua0FoVEdZbXN0ZGpENg$+u70VCqUxnT0t+rfCWmpaTS1T2ktc0g1ABErADA8eXE', 'Rentre pas Maison', 'kaveh@genshin.impct', '2000-07-09', 0, 'profils/mecdealhaitham.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 0, 0, 0),
('minari', '$argon2id$v=19$m=65536,t=4,p=1$ZzhlTW1MU1lrQTJxUmpHbA$+N70+KiIKSK0Jb7vhgqGTlkZcQ0zcxBRcUnqK7Di5jc', 'Minari', 'minari@exemple.com', '1997-03-24', 1, 'profils/sanspdp.png', 1, '2023-03-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 1, 0, 1),
('mina_sr_my', '$argon2id$v=19$m=65536,t=4,p=1$cGRqN1poQkdtTWVsTC9OeQ$Q4d49xSrHH4Wxc43pOiK54pMpHxaHeBQabTEuFmPB10', '미나 (MINA)', 'mina@twice.kr', '1997-03-24', 0, 'profils/mina_sr_my.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 1, 2, 0),
('minnie', '$argon2id$v=19$m=65536,t=4,p=1$cTFCaGNqZjkuT3JzMXpHTA$oI5avlabQr4/j+U5ce0RACrn8LbjIGPEmkFSIjrR+DI', 'Minnie', 'minnie@gidle.kr', '1997-10-23', 0, 'profils/minnie.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 0, 0, 0),
('miyeon', '$argon2id$v=19$m=65536,t=4,p=1$NkRSdzlrVldJaFN3djFYaA$Zmg+gNx1QruCCjinQEQQX7nGX5+3e90J+hMEo0fcfc8', 'Miyeon', 'miyeon@gidle.kr', '1997-01-31', 0, 'profils/miyeon.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 0, 0, 0),
('momo', '$argon2id$v=19$m=65536,t=4,p=1$ajVDME5ZTkloODF3MGZuQw$xZR13xyt1e5SMjJRL1Sf6mjnPVQJedUfYs4eVk8Ll5w', '모모 (MOMO)', 'momo@twice.kr', '1996-11-09', 0, 'profils/momo.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 1, 0, 0),
('nayeonnyny', '$argon2id$v=19$m=65536,t=4,p=1$QWM1clFFTmJBcno2b0d6dw$rCfW8QzHUY+NJo0kvsVo+isomY4HYBOk8cp0nD/HYNc', '나연 (NAYEON)', 'nayeon@twice.kr', '1995-09-22', 0, 'profils/nayeonnyny.png', 0, '2023-05-07', 'bannieres/nayeonnyny.png', 'member of the South Korean girl group Twice', 2, 8, 17),
('ryujin', '$argon2id$v=19$m=65536,t=4,p=1$Ung0ejFnNmd4aTU3WGk2Qw$9C6eo3dyvMQ5/CXd+y760RfOL9slJS1CMSKx6+Wy0e0', 'Ryujin', 'ryujin@itzy.kr', '2001-04-17', 0, 'profils/ryujin.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 0, 0, 0),
('shuhua', '$argon2id$v=19$m=65536,t=4,p=1$L25TV3hGWFNsOC94UkhTYg$WJR9t6avhPxF2QhWaMDc7V+NwDnvQFw0pz5ZBRyYMT0', 'Shuhua', 'shuhua@gidle.kr', '2000-01-06', 0, 'profils/shuhua.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 0, 0, 0),
('soyeon', '$argon2id$v=19$m=65536,t=4,p=1$SnlwSUlmVE5CQi5iVlhtTg$h9Pg6uJV/QuZBqMYChSG0JVge7xUNTCFz3Am3eOQPNI', 'Soyeon', 'soyeon@gidle.kr', '1998-08-26', 0, 'profils/soyeon.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 0, 0, 0),
('thinkaboutzu', '$argon2id$v=19$m=65536,t=4,p=1$MHl5QktRNEZDMTdwc3NnVw$XcMWYPpxe8GJteGV9w9rBx8e+ME7WYLe2HOR2X5rPpI', '쯔위 (TZUYU)', 'tzuyu@twice.kr', '1999-06-14', 0, 'profils/thinkaboutzu.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 1, 0, 0),
('yeji', '$argon2id$v=19$m=65536,t=4,p=1$Qm5aZ0JKU1M5NXp3V05Fcg$TNjedIQ4FDtixYuUtcgvk7vcWvNBAUIO7mwpvBnshqQ', 'Yeji', 'yeji@itzy.kr', '2000-05-26', 0, 'profils/yeji.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 0, 0, 0),
('yuna', '$argon2id$v=19$m=65536,t=4,p=1$ZkZjbDBPRW5GeDlhak54WA$ImAFbHODZkosfZHuS/psPDRrvZWAbjoXGcQMeYlvPJY', 'Yuna', 'yuna@itzy.kr', '2003-12-09', 0, 'profils/yuna.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 0, 0, 0),
('yuqi', '$argon2id$v=19$m=65536,t=4,p=1$TEc3Q2hTcldpNkRLOGM2Ng$n5Qh0kJkFUeayonlA7v3kCcbo2HvsQfFI/eRajdf7rU', 'Yuqi', 'yuqi@gidle.kr', '1999-09-23', 0, 'profils/yuqi.png', 0, '2023-05-07', 'bannieres/sansbanniere.jpg', 'A compléter...', 0, 0, 0),
('_zyozyo', '$argon2id$v=19$m=65536,t=4,p=1$djAwZ2lQc2lnU2w3SkRFeg$cllvQlAimSn++XyCF+O4Rr/ST4OBpHvhp9AFc3E9yyk', 'JIHYO', 'jihyo@twice.kr', '1997-02-01', 0, 'profils/_zyozyo.png', 0, '2023-05-07', 'bannieres/_zyozyo.png', 'member of the South Korean girl group Twice', 1, 1, 0);


ALTER TABLE `abonnement`
  ADD PRIMARY KEY (`id_following`),
  ADD KEY `following` (`follow`),
  ADD KEY `followed` (`followed`);

ALTER TABLE `demande_abonnement`
  ADD PRIMARY KEY (`id_demande`),
  ADD KEY `follow` (`follow`),
  ADD KEY `followed` (`followed`);

ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `likedby` (`likedby`),
  ADD KEY `postliked` (`postliked`);

ALTER TABLE `messageprivecontenu`
  ADD KEY `id_salon` (`id_salon`),
  ADD KEY `user` (`user`);

ALTER TABLE `messageprivesalon`
  ADD PRIMARY KEY (`id_salon`),
  ADD KEY `user1` (`user1`),
  ADD KEY `user2` (`user2`);

ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `user` (`user`);

ALTER TABLE `postsignale`
  ADD PRIMARY KEY (`id_signalement`),
  ADD KEY `idpost` (`idpost`),
  ADD KEY `user` (`user`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`identifiant`,`email`);


ALTER TABLE `abonnement`
  MODIFY `id_following` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `demande_abonnement`
  MODIFY `id_demande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

ALTER TABLE `messageprivesalon`
  MODIFY `id_salon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

ALTER TABLE `postsignale`
  MODIFY `id_signalement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `abonnement`
  ADD CONSTRAINT `abonnement_ibfk_1` FOREIGN KEY (`follow`) REFERENCES `user` (`identifiant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `abonnement_ibfk_2` FOREIGN KEY (`followed`) REFERENCES `user` (`identifiant`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `demande_abonnement`
  ADD CONSTRAINT `demande_abonnement_ibfk_1` FOREIGN KEY (`follow`) REFERENCES `user` (`identifiant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `demande_abonnement_ibfk_2` FOREIGN KEY (`followed`) REFERENCES `user` (`identifiant`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`likedby`) REFERENCES `user` (`identifiant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`postliked`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `messageprivecontenu`
  ADD CONSTRAINT `messageprivecontenu_ibfk_1` FOREIGN KEY (`id_salon`) REFERENCES `messageprivesalon` (`id_salon`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messageprivecontenu_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`identifiant`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `messageprivesalon`
  ADD CONSTRAINT `messageprivesalon_ibfk_1` FOREIGN KEY (`user1`) REFERENCES `user` (`identifiant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messageprivesalon_ibfk_2` FOREIGN KEY (`user2`) REFERENCES `user` (`identifiant`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`identifiant`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `postsignale`
  ADD CONSTRAINT `postsignale_ibfk_1` FOREIGN KEY (`idpost`) REFERENCES `post` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postsignale_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`identifiant`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
