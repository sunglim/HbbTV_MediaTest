CREATE TABLE media_dash_ts
(
	id int auto_increment primary key,
	media_type int not null,
	media_url varchar(200),
	description varchar(200),
	listing_order int
)

CREATE TABLE media_dash_mp4
(
	id int auto_increment primary key,
	media_type int not null,
	media_url varchar(200),
	description varchar(200),
	listing_order int
)
