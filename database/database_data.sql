PRAGMA encoding="UTF-8";
PRAGMA foreign_keys=true;

-- all of the passes are 123456
INSERT INTO User VALUES(0, 'diogoabnunes', '$2y$10$uEeJMWu15bRcyvToVYWfE.5o4jmGePc61Lj8vRXaXw4SssdQnXhlu', 'Diogo Nunes', '2000-03-10', 'M', 'Porto');
INSERT INTO User VALUES(1, 'marinuas', '$2y$10$uEeJMWu15bRcyvToVYWfE.5o4jmGePc61Lj8vRXaXw4SssdQnXhlu', 'Marina Dias', '2000-09-15', 'F', 'Ilha do Sal');
INSERT INTO User VALUES(2, 'DiogoF17', '$2y$10$uEeJMWu15bRcyvToVYWfE.5o4jmGePc61Lj8vRXaXw4SssdQnXhlu', 'Diogo Santos', '2000-07-01', 'M', 'Porto');
INSERT INTO User VALUES(3, 'MiNeves00', '$2y$10$uEeJMWu15bRcyvToVYWfE.5o4jmGePc61Lj8vRXaXw4SssdQnXhlu', 'Miguel Neves', '2000-12-31', 'M', 'Porto');

INSERT INTO Species VALUES(0, 'Dog', 'Shiba Inu');
INSERT INTO Species VALUES(1, 'Dog', 'Dachshund');
INSERT INTO Species VALUES(2, 'Dog', 'Pug');
INSERT INTO Species VALUES(3, 'Dog', 'French bulldog');
INSERT INTO Species VALUES(4, 'Bird', 'Agapornis');
INSERT INTO Species VALUES(5, 'Rabbit', 'Rex');
INSERT INTO Species VALUES(6, 'Dog', 'Labrador');
INSERT INTO Species VALUES(7, 'Dog', 'Portuguese Water Dog');
INSERT INTO Species VALUES(8, 'Cat', 'Persa');
INSERT INTO Species VALUES(9, 'Bird', 'Parrot');


INSERT INTO Pet VALUES(0, 'Bobi', 'Bobi is a 2 year old Pug that loves everyone!', 2, 'M', 'Brown', '2013-05-23', 'Ilha do Sal', 'not adopted');
INSERT INTO Pet VALUES(1, 'Rex', 'Rex is a friendly and fashion Labrador!', 6, 'M', 'Brown', '2017-10-04', 'Ilha do Fogo', 'not adopted');
INSERT INTO Pet VALUES(2, 'Max', 'I am Max and I am very lazy...!', 3, 'M', 'Black', '2009-11-27', 'Boa Vista', 'not adopted');
INSERT INTO Pet VALUES(3, 'Venus', 'This is Venus and I just love to listening to music!', 6, 'F', 'White', '2015-09-07', 'Gaia', 'not adopted');
INSERT INTO Pet VALUES(4, 'Lara', 'My name is Lara and my favourite hobby is painting!', 0, 'F', 'Brown', '2020-01-10', 'Maia', 'adopted');
INSERT INTO Pet VALUES(5, 'Faial', 'I am Faial, my name was inspired on the Açores island and I love to eat!', 1, 'M', 'Black', '2012-02-02', 'Matosinhos', 'not adopted');
INSERT INTO Pet VALUES(6, 'Tiquinho', 'My name is Tiquinho, and I love to sing!', 4, 'M', 'Green-Orange', '2018-05-10', 'Porto', 'not adopted');
INSERT INTO Pet VALUES(7, 'Niki', 'I am Niki and I just want to have fun! On the 3rd photo, I am having breakfast with my friend Nucha!', 5, 'F', 'White-Brown', '2020-02-23', 'Matosinhos', 'not adopted');
INSERT INTO Pet VALUES(8, 'Wave', 'Hello, my name is Wave, and i love the beach!', 7, 'M', 'Black', '2016-08-07', 'Algarve', 'adopted');
INSERT INTO Pet VALUES(9, 'Leo', 'Leo is a very photogenic cat.', 8, 'M', 'White', '2019-07-29', 'Lisboa', 'not adopted');
INSERT INTO Pet VALUES(10, 'Perry', 'Perry is the most cutest parrot I have ever seen!', 9, 'M', 'Blue', '2019-07-29', 'Maia', 'not adopted');


INSERT INTO Photos VALUES(0, '../assets/images/user/diogoabnunes.jpg', NULL, 0);
INSERT INTO Photos VALUES(1, '../assets/images/user/marinuas.jpg', NULL, 1);
INSERT INTO Photos VALUES(2, '../assets/images/user/DiogoF17.jpg', NULL, 2);
INSERT INTO Photos VALUES(3, '../assets/images/user/MiNeves00.jpg', NULL, 3);

INSERT INTO Photos VALUES(4, '../assets/images/pets/bobi.jpeg', 0, NULL);
INSERT INTO Photos VALUES(5, '../assets/images/pets/rex.jpeg', 1, NULL);
INSERT INTO Photos VALUES(6, '../assets/images/pets/max.jpeg', 2, NULL);
INSERT INTO Photos VALUES(7, '../assets/images/pets/venus.jpeg', 3, NULL);
INSERT INTO Photos VALUES(8, '../assets/images/pets/lara.jpeg', 4, NULL);
INSERT INTO Photos VALUES(9, '../assets/images/pets/faial.jpeg', 5, NULL);
INSERT INTO Photos VALUES(10, '../assets/images/pets/tiquinho.jpeg', 6, NULL);
INSERT INTO Photos VALUES(11, '../assets/images/pets/niki.jpg', 7, NULL);

INSERT INTO Photos VALUES(12, '../assets/images/pets/lara2.png', 4, NULL);
INSERT INTO Photos VALUES(13, '../assets/images/pets/lara3.png', 4, NULL);
INSERT INTO Photos VALUES(15, '../assets/images/pets/bobi2.jpeg', 0, NULL);
INSERT INTO Photos VALUES(16, '../assets/images/pets/bobi3.jpeg', 0, NULL);
INSERT INTO Photos VALUES(17, '../assets/images/pets/sausage1.jpeg', 5, NULL);
INSERT INTO Photos VALUES(18, '../assets/images/pets/niki2.jpeg', 7, NULL);
INSERT INTO Photos VALUES(19, '../assets/images/pets/niki3.jpeg', 7, NULL);
INSERT INTO Photos VALUES(20, '../assets/images/pets/tiquinho2.jpeg', 6, NULL);
INSERT INTO Photos VALUES(21, '../assets/images/pets/tiquinho3.jpeg', 6, NULL);
INSERT INTO Photos VALUES(22, '../assets/images/pets/persa1.jpg', 9, NULL);
INSERT INTO Photos VALUES(23, '../assets/images/pets/persa2.jpg', 9, NULL);
INSERT INTO Photos VALUES(24, '../assets/images/pets/water.jpg', 8, NULL);
INSERT INTO Photos VALUES(25, '../assets/images/pets/water1.jpg', 8, NULL);
INSERT INTO Photos VALUES(26, '../assets/images/pets/parrot.png', 10, NULL);
INSERT INTO Photos VALUES(27, '../assets/images/pets/parrot2.jpg', 10, NULL);

INSERT INTO MyPets VALUES(1, 0);
INSERT INTO MyPets VALUES(1, 1);
INSERT INTO MyPets VALUES(1, 2);
INSERT INTO MyPets VALUES(2, 3);
INSERT INTO MyPets VALUES(3, 4);
INSERT INTO MyPets VALUES(3, 5);
INSERT INTO MyPets VALUES(0, 6);
INSERT INTO MyPets VALUES(0, 7);
INSERT INTO MyPets VALUES(3, 8);
INSERT INTO MyPets VALUES(2, 9);
INSERT INTO MyPets VALUES(0, 10);

INSERT INTO FavoritePets VALUES(0, 0);
INSERT INTO FavoritePets VALUES(1, 0);
INSERT INTO FavoritePets VALUES(1, 5);
INSERT INTO FavoritePets VALUES(3, 0);
INSERT INTO FavoritePets VALUES(3, 1);
INSERT INTO FavoritePets VALUES(3, 4);
INSERT INTO FavoritePets VALUES(3, 5);
INSERT INTO FavoritePets VALUES(2, 4);
INSERT INTO FavoritePets VALUES(2, 5);
INSERT INTO FavoritePets VALUES(2, 9);


INSERT INTO Adoption VALUES(0, 4);
INSERT INTO Adoption VALUES(1, 8);


INSERT INTO Propose VALUES(0, 'I would like to adopt this dog!', '2020-09-17', '19:53', 'processing', 2, 5);
INSERT INTO Propose VALUES(1, 'I would like to adopt this dog!', '2020-05-03', '7:30', 'processing', 1, 6);
INSERT INTO Propose VALUES(2, 'I would like to adopt Niki!', '2020-12-04', '18:30', 'processing', 1, 7);

INSERT INTO Comment VALUES(0, 'This dog is so big!', '2019-11-20', '21:30', 1, 5, NULL);
INSERT INTO Comment VALUES(1, "What's your conditions?", '2019-11-20', '22:07', 2, 5, 0);
INSERT INTO Comment VALUES(2, "What's your conditions?", '2019-11-20', '22:08', 3, 0, NULL);