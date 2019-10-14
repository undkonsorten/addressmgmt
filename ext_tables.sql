#
# Table structure for table 'tx_addressmgmt_domain_model_address'
#
CREATE TABLE tx_addressmgmt_domain_model_address (

	type varchar(100) DEFAULT '' NOT NULL,
	first_name varchar(100) DEFAULT '' NOT NULL,
	name varchar(100) DEFAULT '' NOT NULL,
	gender int(11) DEFAULT '0' NOT NULL,
	title varchar(40) DEFAULT '' NOT NULL,
	organization varchar(120) DEFAULT '' NOT NULL,
	department varchar(80) DEFAULT '' NOT NULL,
	street varchar(120) DEFAULT '' NOT NULL,
	street_number varchar(25) DEFAULT '' NOT NULL,
	address_supplement varchar(80) DEFAULT '' NOT NULL,
	city varchar(100) DEFAULT '' NOT NULL,
	zip varchar(10) DEFAULT '' NOT NULL,
	country varchar(80) DEFAULT '' NOT NULL,
	state varchar(80) DEFAULT '' NOT NULL,
	closest_city varchar(100) DEFAULT '' NOT NULL,
	email varchar(255) DEFAULT '' NOT NULL,
	phone varchar(60) DEFAULT '' NOT NULL,
	mobile varchar(60) DEFAULT '' NOT NULL,
	fax varchar(60) DEFAULT '' NOT NULL,
	www varchar(255) DEFAULT '' NOT NULL,
	description text NOT NULL,
    directions text NOT NULL,
    counterpart text NOT NULL,
	images int(11) unsigned DEFAULT '0',
	latitude varchar(255) DEFAULT '' NOT NULL,
	longitude varchar(255) DEFAULT '' NOT NULL,
    geojson longtext NOT NULL,
	fe_user int(11) unsigned DEFAULT '0' NOT NULL,
	social_identifiers int(11) unsigned DEFAULT '0' NOT NULL,
	link int(11) unsigned DEFAULT '0',
	map_zoom int(11) unsigned DEFAULT NULL,
	category int(11) unsigned DEFAULT '0' NOT NULL,
	relation int(11) unsigned DEFAULT '0',
	publish_state int(11) DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_addressmgmt_domain_model_socialidentifier'
#
CREATE TABLE tx_addressmgmt_domain_model_socialidentifier (

	identifier varchar(100) DEFAULT '' NOT NULL,
	url_override varchar(255) DEFAULT '' NOT NULL,
	provider int(11) unsigned DEFAULT '0' NOT NULL,
	address  int(11) unsigned DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_addressmgmt_domain_model_socialprovider'
#
CREATE TABLE tx_addressmgmt_domain_model_socialprovider (

	name varchar(80) DEFAULT '' NOT NULL,
	identifier_label varchar(80) DEFAULT '' NOT NULL,
	identifier_description varchar(80) DEFAULT '' NOT NULL,
	url_scheme varchar(255) DEFAULT '' NOT NULL,
	url_override_label varchar(255) DEFAULT '' NOT NULL,
	url_override_description varchar(255) DEFAULT '' NOT NULL,
	show_url_override tinyint(4) DEFAULT '0' NOT NULL,
	www varchar(120) DEFAULT '' NOT NULL,
	image int(11) DEFAULT '0' NOT NULL,

);

#
# Table structure for table 'tx_addressmgmt_domain_model_link'
#
CREATE TABLE tx_addressmgmt_domain_model_link (

	text varchar(255) DEFAULT '' NOT NULL,
	link varchar(255) DEFAULT '' NOT NULL,

);

#
# Table structure for table 'tx_eventmgmt_event_category_mm'
#
CREATE TABLE tx_addressmgmt_address_category_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for table 'tx_addressmgmt_domain_model_relation'
#
CREATE TABLE tx_addressmgmt_domain_model_relation (

	room int(11) unsigned DEFAULT '0',
	location int(11) unsigned DEFAULT '0',

);

#
# Table structure for table 'tx_addressmgmt_domain_model_room'
#
CREATE TABLE tx_addressmgmt_domain_model_room (

	name varchar(255) DEFAULT '' NOT NULL,
	capacity int(11) unsigned DEFAULT '0' NOT NULL,
	description text NOT NULL,

);
