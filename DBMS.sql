CREATE OR REPLACE TABLE account (
    id 			SERIAL,
    email   VARCHAR(100) UNIQUE,
    password VARCHAR(100),
    role    VARCHAR (20),
    PRIMARY KEY (id)
);


CREATE OR REPLACE TABLE category (
    id 			SERIAL,
    name 		VARCHAR(100) UNIQUE,
    PRIMARY KEY (id)
);
CREATE OR REPLACE TABLE brand (
    id          SERIAL,
    name VARCHAR(100),
    description TEXT,
    image TEXT,
    PRIMARY KEY (id)
);

CREATE OR REPLACE TABLE product (
    id 			SERIAL,
    name 		VARCHAR(100),
    description TEXT,
    price 		VARCHAR(100),
    category_id INT,
    brand_id 	INT,
    image 		text,
    PRIMARY KEY (id)
);




INSERT INTO category (name) VALUES ('Disc');
INSERT INTO category (name) VALUES ('Poster');
INSERT INTO brand (name, image) VALUES ('Nanahira', 'public/image/artist/nanahira.png');
INSERT INTO brand (name, image) VALUES ("YUC'e", "public/image/artist/YUCe.jpg");
INSERT INTO brand (name, image) VALUES ('irucaice', 'public/image/artist/irucaice.jpg');
INSERT INTO brand (name, image) VALUES ('Nor / Aice room', 'public/image/artist/nor.jpg');

INSERT INTO Product (name, description, price, category_id, brand_id, image) 
VALUES ('Mukunaru shoka ni shukufuku o (A blessing for the innocent bookshelf)',
'Mukunaru shoka ni shukufuku o (A blessing for the innocent bookshelf)
Once upon a time, there was a girl.
The girl was a special being called <span style="font-weight:bold;color:blue">an angel.</span>
Her mission was to one day save the lives of everyone in the world.
Deep inside the forest, in a facility that stood quietly, a hideaway-like room.
Today, the girl is reading many books and learning about the world in order to become <span style="font-weight:bold;color:blue">a fine angel.</span>
This is the story of this girls daily life.
Or a record. Or a monologue.',
3000, 1, 1, 'public/image/product/nanahira0.png');
INSERT INTO Product (name, description, price, category_id, brand_id, image) 
VALUES ('SHIBUYA DIMENSIONS',
'<span style="font-weight:bold;color:blue">

[SHIBUYA DIMENSIONS]</span>
2025.04.27 Physical Release
M3春-2025 [T-37b]

Artwork & illustration: dong_hang

Link
Twitter：  / yuce_e   
Instagram：  / y_yuce_e',
2000, 1, 2, 'public/image/product/yuce0.png');
INSERT INTO Product (name, description, price, category_id, brand_id, image) 
VALUES ('IceQuarium Combo',
'2 posters',
6000, 2, 3, 'public/image/product/irucaice0.jpg');
INSERT INTO Product (name, description, price, category_id, brand_id, image) 
VALUES ('bevel',
'Illustration: Makihitsuji

All Original music by Nor (Aice room)

Released April 27, 2025

1. Twisty Twisty
2. Midnight Anthem
3. Hyper Lover
4. Haiiro Philosophy
5. PAPAPA
6. Movie
7. Spring Forever
8. Spell
＋GG LOVE (Feat. nyankobrq)',
2000, 1, 4, 'public/image/product/nor0.jpg');
INSERT INTO Product (name, description, price, category_id, brand_id, image) 
VALUES ('ANGEL GELATO',
'This is <span style="font-weight:bold;color:blue">irucaice''s</span> first vocal album, which brings together all the cute female vocal songs he has provided so far.

A lineup of sparkling, happy, and simply cute songs packed with girlish charm!

Including the gorgeous title song featuring Nanahira x Suzushiro x Choco, maimai Deluxe (© SEGA) "Rainbow Rush Story"

Full version and Capchii Remix, Denonbu (Denonbu & Bandai Namco Entertainment Inc.)

Contains 14 gorgeous songs, including "Cinderella Magic Stage / Kayano Futaba (CV: Horikoshi Sena)"!',
3000, 1, 3, 'public/image/product/irucaice1.jpg');
INSERT INTO Product (name, description, price, category_id, brand_id, image) 
VALUES ('iceQuarium -Lemon-',
'2021.10.23-24 (Sat. & Sun.)
Magical Mirai 2021 in OSAKA
Creators Market "B2"
2021.10.31 (Sun.)
2021 Autumn M3
2nd Exhibition Hall 2F Co-03
2021.11.5-7 (Fri., Sat. & Sun.)
Magical Mirai 2021 in TOKYO
Creators Market "B1"
Event 2,000 yen',
2000, 1, 3, 'public/image/product/irucaice2.jpg');
INSERT INTO Product (name, description, price, category_id, brand_id, image) 
VALUES ('CHERRY CUBE',
'
Spring M3
2016/4/24

Space: E-20b "YUC''e"
Cover illustration: Yumemi Sucha
Layout design: Ryuta
Consignment sales available.

I think spring is a season when the heart is confused and lost.
This album is packed with all sorts of lost and wishful thoughts.

<span style="font-weight:bold;color:#cb73a5">"If all you can do is get by, I dont want to become an adult."</span>

2nd album. 9 songs in total.
1. Accel.
2. Bye-bye
3. Hello Say Hello
4. Sleeping Beauty
5. SOS
6. Renge Sou
7. Shredder
8. Spring Trip
9. Cuore (instrumental)',
1500, 1, 2, 'public/image/product/yuce1.avif');
INSERT INTO Product (name, description, price, category_id, brand_id, image) 
VALUES ('COSMOSOUP',
'
Comic Market 88
2015/8/16 3rd day
Space: West Ru-42b "YUC''e"

Jacket illustration: Kamakirimai
The first CD is filled with songs inspired by <span style="font-weight:bold;color:blue">space.</span>

8 songs in total.
1. Nice to meet you
2. Arke s Sorrow
3. Cosmos
4. Sweet Trap
5. You and me
6. Whimsical Dinner
7. Good night
8. Beyond those clouds',
1500, 1, 2, 'public/image/product/yuce2.avif');
INSERT INTO Product (name, description, price, category_id, brand_id, image) 
VALUES ('Toy Frappe',
'
Comic Market 90
2016/8/14

Space: West r-22a "YUC''e"
Cover illustration: Kizaki Shin
Layout design: Ryut

A CD focused on summer with Future Bass! Intro+outro+5 songs!!
Enjoy this frappe in the hot summer!!
1. START
2. The Last Hero in This World
3. Summer Lover!!
4. Midsummer Dramatic
5. Sugar Marionette
6. Lulalala
7. CLEAR
',
1500, 1, 2, 'public/image/product/yuce3.avif');
INSERT INTO Product (name, description, price, category_id, brand_id, image) 
VALUES ('Future Cαndy',
'
M3 2016 Autumn
2016/10/30

Space: E-15a "YUC''e"
Cover illustration: Kizaki Shin
Layout design: Ryuta

<span style="font-weight:bold;color:blue">Future Cαndy</span>, which has been a big hit in the Future Bass genre and has received a lot of support!!
The usual YUC''e worldview has also been mixed in, making this a unique CD!!
Experience the diverse Future Bass☆

1. Intro
2. Future Cαndy
3. Tick Tock
4. POISON
5. Ghost Town
6. Cinderella Syndrome
',
1500, 1, 2, 'public/image/product/yuce4.avif');
INSERT INTO Product (name, description, price, category_id, brand_id, image) 
VALUES ('macaron moon',
'
M3 2017 Spring
2017/4/30

Space: F-20a "YUC''e consignment"
Cover illustration: Kizaki Shin
Layout design: Ryuta

JAZZ CLUB MUSIC!! Incorporating Future Bass sounds and brass band sounds, music that will make you shake your body, with romantic lyrics!! Let''s enjoy a wonderful time♪

1. Opening Theme
2. macaron moon
3. Night Club Junkie
4. Cappuccino
5. Datte
6. Ending Theme
',
1500, 1, 2, 'public/image/product/yuce5.avif');
INSERT INTO Product (name, description, price, category_id, brand_id, image) 
VALUES ('Future Cαke',
'
<span style="font-weight:bold;color:#cb73a5">Future Cαke</span>
2017/10/18
Label: Miraicha Records
Jacket illustration: Kizaki Shin
Layout design: Ryuta

YUC''e''s first distributed album! The song <span style="font-weight:bold;color:blue">Future Cαke</span>, written specifically for this album, topped the Spotify viral chart for 11 consecutive days.
The album itself also topped the iTunes electronic chart! Also includes new songs "Wataame Parade" and "Gemini Tale."
In addition, this fun CD is packed with tracks that will make you want to dance, centered around songs that have been provided to compilation albums up until now. Enjoy!

1. Future Cαke
2. Cotton Candy Parade
3. Night Club Junkie
4. POISON
5. Tick Tock
6. intro-duck-tion!!
7. MUDPIE
8. Sengoku HOP
9. Gemini Tale
10. PUMP
11. Future Cαndy
',
3000, 1, 2, 'public/image/product/yuce6.avif');



CREATE OR REPLACE TABLE stores (
    id SERIAL,
    name VARCHAR(255),
    address VARCHAR(255)
);

INSERT INTO stores (name, address) VALUES
('Main Store', '643 Dien Bien Phu, Ward 1, District 3, Ho Chi Minh City');
-- ('District 7', '1058 Nguyen Van Linh, Tan Phong Ward, District 7, HCMC'),
-- ('Thu Duc', '216 Vo Van Ngan, Binh Tho Ward, Thu Duc City, HCMC'),
-- ('Branch 1', '2 Hai Trieu, Ben Nghe Ward, District 1, HCMC'),
-- ('Branch 2', '720A Dien Bien Phu, Ward 22, Binh Thanh District, HCMC');



INSERT INTO account (email, password, role) VALUES ('chi@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'admin');
-- chi@gmail.com Password: 1234