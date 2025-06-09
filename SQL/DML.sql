# Ezt mindenképpen le kell futtatni az alkalmazás használata előtt
USE `Garamszegi_Tibor_KCS`;
INSERT INTO  `statusz` VALUES (1, "Beérkezett");
INSERT INTO  `statusz` VALUES (2, "Hibafeltárás");
INSERT INTO  `statusz` VALUES (3, "Alkatrész beszerzés alatt");
INSERT INTO  `statusz` VALUES (4, "Javítás");
INSERT INTO  `statusz` VALUES (5, "Kész");



# Ellenőrzések
SELECT * FROM `statusz`;

SELECT * FROM `kapcsolattarto`;

SELECT * FROM `termek`;

SELECT `id` FROM `termek`
WHERE szeriaszam="33333333444444444444" AND statuszid="1"
LIMIT 1;

SELECT `id` FROM `kapcsolattarto`
WHERE vnev="Garamszegi" AND knev="Tibor" AND unev="" AND telefon="+36307097052" AND email="tibor_garamszegi@yahoo.com"
LIMIT 1;

SELECT * FROM termek WHERE id = 4;

SELECT * FROM `termek`;
UPDATE `termek` SET `statuszid` = 2 WHERE `id` = 4;

# Az összes termék adata
SELECT * FROM termek LEFT JOIN kapcsolattarto ON termek.kapcsolattartoid = kapcsolattarto.id LEFT JOIN statusz ON statuszid = statusz.id
ORDER BY statusz.id;

# Minden termék adata, de a "Kész" státuszú termékeknél csak azok, amik ma készültek el
SELECT * FROM termek LEFT JOIN kapcsolattarto ON termek.kapcsolattartoid = kapcsolattarto.id LEFT JOIN statusz ON statuszid = statusz.id
WHERE NOT (termek.statuszid = 5 AND NOT (termek.statuszvaltozas="2025.06.07."))
ORDER BY statusz.id;
