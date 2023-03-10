# Structure base de données

## Table MUSHROOM
### CREATE

```sql
CREATE table IF NOT EXISTS public.mushroom (
	id SERIAL primary key ,
	name varchar(50) unique not null,
	edible BOOLEAN not null default true,
	poisonous BOOLEAN not null default false,
	img varchar(255) not null,
	description text not null,
	toxicity varchar(20) not null
);
```

### INSERT
```sql
INSERT INTO public.mushroom(name,edible,poisonous,img,description,toxicity) VALUES ('Amanite tue-mouches','false','true','https://www.chasseursdechampignons.com/blog/wp-content/uploads/2022/06/Des-amanites-tue-mouche-Amanita-muscaria-en-groupe.jpg','Amanita muscaria, commonly known as the fly agaric or fly amanita, is a basidiomycete of the genus Amanita. It is also a muscimol mushroom. Native throughout the temperate and boreal regions of the Northern Hemisphere. Although poisonous, death due to poisoning from A. muscaria ingestion is quite rare. Parboiling twice with water draining weakens its toxicity and breaks down the mushroom''s psychoactive substances.','Lethal');
INSERT INTO public.mushroom(name,edible,poisonous,img,description,toxicity) VALUES ('Amanite phalloïde','false','true','https://upload.wikimedia.org/wikipedia/commons/9/99/Amanita_phalloides_1.JPG','Amanite phalloïde is a poisonous mushroom that is found in Europe, North America, and Asia. It is one of the most toxic mushrooms in the world, and is responsible for many deaths. It is also known as the death cap, destroying angel, devil''s mushroom, or inedible amanita.','Lethal');
INSERT INTO public.mushroom(name,edible,poisonous,img,description,toxicity) VALUES ('Amanite vireuse','false','true','https://upload.wikimedia.org/wikipedia/commons/8/81/Destroying_Angel_02.jpg','Amanite vireuse, commonly known in Europe as the destroying angel or the European destroying angel amanita (Amanita virosa), is a poisonous mushroom that is found in Europe, North America, and Asia. It is one of the most toxic mushrooms in the world, and is responsible for many deaths.','Lethal');
INSERT INTO public.mushroom(name,edible,poisonous,img,description,toxicity) VALUES ('Cêpe de Bordeaux','true','false','https://upload.wikimedia.org/wikipedia/commons/3/34/Boletus_edulis_IT.jpg','Boletus edulis is a basidiomycete fungus, the type species of the genus Boletus. It is commonly known as the cep, porcini, or penny bun. It is native to Europe and North America, and is widely cultivated in temperate regions. It is a large, edible mushroom with a distinctive, pleasant smell and a mild, nutty taste. It is a common ingredient in European cuisine, and is often served as a main course in restaurants. It is also used in traditional Chinese medicine.','None');
INSERT INTO public.mushroom(name,edible,poisonous,img,description,toxicity) VALUES ('Champignon de Paris','true','false','https://upload.wikimedia.org/wikipedia/commons/0/01/ChampignonMushroom.jpg','Champignon de Paris (Agaricus bisporus) is an edible basidiomycete mushroom native to grasslands in Europe and North America. It has two color states while immature – white and brown – both of which have various names, with additional names for the mature state.','None');
INSERT INTO public.mushroom(name,edible,poisonous,img,description,toxicity) VALUES ('Champignon hallucinogène','false','true','https://upload.wikimedia.org/wikipedia/commons/6/6b/Psilocybe_semilanceata.jpg','Psilocybe semilanceata, commonly known as the liberty cap, is a species of fungus which produces the psychoactive mushroom psilocybin.','Hallucinogenic');
INSERT INTO public.mushroom(name,edible,poisonous,img,description,toxicity) VALUES ('Truffe','true','false','https://upload.wikimedia.org/wikipedia/commons/2/26/Truffe_nature.JPG','Tuber melanosporum is a species of edible mushroom in the genus Tuber. It is native to Europe, where it is found in the wild in deciduous and mixed forests. It is also cultivated in many countries, and is one of the most widely cultivated species of truffle. It is one of the most expensive mushrooms in the world, and is considered a delicacy in many countries.','None');
INSERT INTO public.mushroom(name,edible,poisonous,img,description,toxicity) VALUES ('Trompette de la mort','true','false','https://upload.wikimedia.org/wikipedia/commons/6/62/0_Craterellus_cornucopioides_-_Trompette_de_la_mort_%281%29.JPG','Craterellus cornucopioides , or horn of plenty, is an edible mushroom. It is also known as the black chanterelle, black trumpet, trompette de la mort, and trompette de la mort noire. It is native to Europe and North America, and is widely cultivated in temperate regions. It is a large, edible mushroom with a distinctive, pleasant smell and a mild, nutty taste. It is a common ingredient in European cuisine, and is often served as a main course in restaurants.','None');
INSERT INTO public.mushroom(name,edible,poisonous,img,description,toxicity) VALUES ('Girollle','true','false','https://upload.wikimedia.org/wikipedia/commons/8/86/Cantharellus_cibarius1.jpg','Gyromitra esculenta is an ascomycete fungus from the genus Gyromitra, widely distributed across Europe and North America. It normally fruits in sandy soils under coniferous trees in spring and early summer.','None');
INSERT INTO public.mushroom(name,edible,poisonous,img,description,toxicity) VALUES ('Pleurote','true','false','https://upload.wikimedia.org/wikipedia/commons/9/94/Oyster_mushoom_fells.jpg','Pleurote (Pleurotus ostreatus) is a mushroom that is found in Europe, North America, and Asia. It is one of the most toxic mushrooms in the world, and is responsible for many deaths. It is also known as the death cap, destroying angel, devil''s mushroom, or inedible amanita.','None');
INSERT INTO public.mushroom(name,edible,poisonous,img,description,toxicity) VALUES ('Langue de boeuf','true','false','https://upload.wikimedia.org/wikipedia/commons/3/3f/2008-08-08_Fistulina_hepatica_crop.jpg','Fistulina hepatica is an unusual bracket fungus classified in the Agaricales, that is commonly seen in Britain, but can be found in other parts of the world. It is a saprobic fungus that grows on dead wood, and is often found on the trunks of trees.','None');
```


## Table CLIENT
### CREATE
```sql
CREATE table IF NOT EXISTS public.client (
	id SERIAL primary key ,
	lastname varchar(20) not null,
	firstname varchar(20) not null,
	zipcode varchar(10) not null,
	tel varchar(10) not null,
	email varchar(50) not null,
	gender varchar(10) not null,
	login varchar(30) unique not null,
	"password" varchar(30) not null
	
);
```

### INSERT
```sql
INSERT INTO client
(lastname, firstname, zipcode, tel, email, gender, login, password)
VALUES('test', 'test', 'test', 'test', 'test', 'test', 'test', 'test');
```