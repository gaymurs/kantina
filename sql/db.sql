create table meny
(
    id      int      not null
        primary key,
    meny    tinytext not null,
    innhold tinytext null,
    pris    int      not null
);

create table bestillinger
(
    id      int auto_increment
        primary key,
    meny_id int           not null,
    anntall int default 1 not null,
    constraint bestillinger_meny_id_fk
        foreign key (meny_id) references meny (id)
);

INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (1, 'Kaffekanne 1 liter ', null, 90);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (2, 'Kaffekontainer 5 liter ', null, 250);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (3, 'Kaffe halv dag', null, 30);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (4, 'Kaffe hel dag', null, 40);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (5, 'Brus, Pepsi eller solo ', null, 30);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (6, 'Mineralvann med eller uten kullsyre ', null, 25);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (7, 'Liten juice eple eller appelsin ', null, 15);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (8, 'Melk 1 liter hel dagspris ', null, 35);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (9, 'Oksegryte med ris', null, 165);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (10, 'Chili sin carne med rømme og basmatiris ', null, 155);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (11, 'Kyllinggryte med basmatiris', null, 165);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (12, 'Klassisk kaldtallerken ', null, 185);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (13, 'Tapastallerken ', null, 199);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (14, 'Sesongens frukt smakfullt skåret', null, 35);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (15, 'Sesongens frukt skåret med twist', null, 45);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (16, 'Sesongens frukt hel  ', null, 9);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (17, 'Nøttemiks med tørket frukt', null, 29);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (18, 'Kjeks per porsjon ', null, 19);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (19, 'Proteinbar YT', null, 35);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (20, 'Muffins', null, 22);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (21, 'Cookies', null, 20);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (22, 'Donuts', null, 20);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (23, 'Dagens kake (Sjokolade eller gulrot) ', null, 30);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (24, 'Croissant', null, 30);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (25, 'Kanelsnurrknute stor', null, 35);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (26, 'Boller', null, 15);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (27, 'Wienerbrød', null, 30);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (28, 'Lasagne vegetar', null, 99);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (29, 'Pizza hel med halal pepperoni', null, 180);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (30, 'Pizza hel vegetar ', null, 180);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (31, 'Cæsar salat med krutonger og kylling', null, 79);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (32, 'Salat med tunfisk og egg', null, 79);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (33, 'Salat med tunfisk og egg', null, 79);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (34, 'Bagetter, normal', 'Ost, skinke, egg, tomat, kylling, karri eller tunfisk ', 48);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (35, 'Bagetter, luksus', 'Roastbiff & remulade', 69);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (36, 'Bagetter, luksus', 'Laks og eggerøre', 69);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (37, 'Bagetter, luksus', 'Reker, egg og majones', 69);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (38, 'Rundstykker, normal (1/2 rundstykke med pålegg)', 'Ost, skinke, egg, tomat, kylling, karri eller tunfisk', 30);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (39, 'Rundstykker, luksus (1/2 rundstykke med pålegg)', 'Roastbiff & remulade', 42);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (40, 'Rundstykker, luksus (1/2 rundstykke med pålegg)', 'Laks og eggerøre', 42);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (41, 'Rundstykker, luksus (1/2 rundstykke med pålegg)', 'Reker, egg og majones', 42);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (42, 'Ciabatta 2', 'Kylling med karri', 55);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (43, 'Ciabatta 3', 'Tunfisk og egg', 55);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (44, 'Focaccia 1', 'Soltørket tomat, grønn pesto og kylling', 55);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (45, 'Focaccia 2', 'Eggerøre og røkt laks', 55);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (46, 'Wraps 1/1', 'Laks, eggerøre, tomat og kremost.', 48);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (47, 'Wraps 1/1', 'Cæsar salat, tomat, rødløk, krutong, kylling og parmesan.', 48);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (48, 'Kurspakke Storselger', 'Bagett med normalt pålegg, 1 kakebit, 1 mineralvann og kaffe', 109);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (49, 'Kurspakke Liten', 'halvt rundstykker med variert pålegg, 1 croissant og kaffe', 79);
INSERT INTO kantine_kub.meny (id, meny, innhold, pris) VALUES (50, 'Kurspakke Pause', 'Nøttemiks med tørket frukt. Sesongens frukt (oppskåret), kaffe ', 75);
