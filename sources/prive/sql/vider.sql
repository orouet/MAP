--
-- VIDE LES TABLES
--
TRUNCATE TABLE `gep__comptes`;
TRUNCATE TABLE `gep__photos`;
TRUNCATE TABLE `gep__albums`;
TRUNCATE TABLE `ged__documents`;
TRUNCATE TABLE `ged__lots`;
TRUNCATE TABLE `panier_utilisateurs`;


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