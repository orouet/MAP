--
-- NETTOYAGE
--
DROP TABLE `gep__comptes`;
DROP TABLE `gep__photos`;
DROP TABLE `gep__albums`;
DROP TABLE `ged__documents`;
DROP TABLE `ged__lots`;
DROP TABLE `panier_utilisateurs`;


--
-- STRUCTURES
--

--
-- `ged__lots`
--
CREATE TABLE IF NOT EXISTS `ged__lots` (
	`id` int(11) NOT NULL,
	`ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`nom` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1
;


--
-- `ged__documents`
--
CREATE TABLE IF NOT EXISTS `ged__documents` (
	`id` int(11) NOT NULL,
	`ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`lots_id` int(11) NOT NULL,
	`nom` varchar(255) NOT NULL,
	`empreinte` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1
;


--
-- `gep__albums`
--
CREATE TABLE IF NOT EXISTS `gep__albums` (
	`id` int(11) NOT NULL,
	`ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`nom` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1
;


--
-- `gep__photos`
--
CREATE TABLE IF NOT EXISTS `gep__photos` (
	`id` int(11) NOT NULL,
	`ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`albums_id` int(11) NOT NULL,
	`documents_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1
;


--
-- `gep__comptes`
--
CREATE TABLE IF NOT EXISTS `gep__comptes` (
	`id` int(11) NOT NULL,
	`ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`albums_id` int(11) NOT NULL,
	`identifiant` varchar(255) NOT NULL,
	`motdepasse` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1
;


--
-- `panier_utilisateurs`
--
CREATE TABLE IF NOT EXISTS `panier_utilisateurs` (
	`id` int(11) NOT NULL,
	`ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`identifiant` varchar(255) NOT NULL,
	`motdepasse` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1
;



--
-- INDEX
--

--
-- `ged__lots`
--
ALTER TABLE `ged__lots`
	ADD PRIMARY KEY (`id`)
;


--
-- `ged__documents`
--
ALTER TABLE `ged__documents`
	ADD PRIMARY KEY (`id`),
	ADD UNIQUE KEY `empreinte` (`empreinte`),
	ADD KEY `lots_id` (`lots_id`)
;


--
-- `gep__albums`
--
ALTER TABLE `gep__albums`
	ADD PRIMARY KEY (`id`)
;


--
-- `gep__photos`
--
ALTER TABLE `gep__photos`
	ADD PRIMARY KEY (`id`),
	ADD KEY `albums_id` (`albums_id`),
	ADD KEY `documents_id` (`documents_id`)
;


--
-- `gep__comptes`
--
ALTER TABLE `gep__comptes`
	ADD PRIMARY KEY (`id`),
	ADD UNIQUE KEY `identifiant` (`identifiant`),
	ADD KEY `albums_id` (`albums_id`)
;


--
-- `panier_utilisateurs`
--
ALTER TABLE `panier_utilisateurs`
	ADD PRIMARY KEY (`id`)
;



--
-- AUTO INCREMENT
--

--
-- `ged__lots`
--
ALTER TABLE `ged__lots`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1
;


--
-- `ged__documents`
--
ALTER TABLE `ged__documents`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1
;


--
-- `gep__albums`
--
ALTER TABLE `gep__albums`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1
;


--
-- `gep__photos`
--
ALTER TABLE `gep__photos`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1
;


--
-- `gep__comptes`
--
ALTER TABLE `gep__comptes`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1
;


--
-- `panier_utilisateurs`
--
ALTER TABLE `panier_utilisateurs`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1
;



--
-- INSERTIONS
--

--
-- `gep__albums`
--
INSERT INTO `gep__albums` (`id`, `ts`, `nom`) VALUES
(1, null, '1234567890')
;

--
-- `gep__comptes`
--
INSERT INTO `gep__comptes` (`id`, `ts`, `albums_id`, `identifiant`, `motdepasse`) VALUES
(null, null, 1, '1234567890', 'azertyuiop')
;


--
-- `panier_utilisateurs`
--
INSERT INTO `panier_utilisateurs` (`id`, `identifiant`, `motdepasse`) VALUES
(null, '1234567890', 'azertyuiop')
;
