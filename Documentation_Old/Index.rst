..  Editor configuration
	...................................................
	* utf-8 with BOM as encoding
	* tab indent with 4 characters for code snippet.
	* optional: soft carriage return preferred.

.. Includes roles, substitutions, ...
.. include:: _IncludedDirectives.rst

=====================
Address Management
=====================

:Extension name: Address Management
:Extension key: addressmgmt
:Version: 2.0
:Description: manuals covering TYPO3 extension "Address Management"
:Language: en
:Author: Eike Starkmann, Thomas Alboth, Felix Althaus @ `undkonsorten - TYPO3 Agentur Berlin<http://www.undkonsorten.com>`_
:Creation: 2013-09-17
:Generation: 00:06
:Licence: Open Content License available from `www.opencontent.org/opl.shtml <http://www.opencontent.org/opl.shtml>`_

The content of this document is related to TYPO3, a GNU/GPL CMS/Framework available from `www.typo3.org
<http://www.typo3.org/>`_

**Table of Contents**

.. toctree::
	:maxdepth: 2

	ProjectInformation
	UserManual
	AdministratorManual
	TyposcriptReference
	DeveloperCorner
	RestructuredtextHelp

.. STILL TO ADD IN THIS DOCUMENT
	@todo: add section about how screenshots can be automated. Pointer to PhantomJS could be added.
	@todo: explain how documentation can be rendered locally and remotely.
	@todo: explain what files should be versionned and what not (_build, Makefile, conf.py, ...)

.. include:: ../Readme.rst

What does it do?
=================


What does it do?
----------------

The TYPO3-Extension **Address Management (EXT: addressmgmt)** was created to **replace tt_address**.
It is used to display persons, organisations or locations als lists or on a map.

**Features of TYPO3 Address Management**

* address database and backend masks for
  * Persons (E.g.: *John Doe*)
  * Organisations (E.g: *TYPO3 Association*)
  * Locations (E.g.: *Deutscher Bundestag* or an are like a *National Park*)

* list view (by SysFolder and/or SysSategories) and template switcher
* map view (based on `Leaflet.js<http://leafletjs.com/>`_, `OpenStreetMap<https://www.openstreetmap.org/>`_ and `Mapbox<https://www.mapbox.com/>`_)
* customizable filters based on SysCategories
* frontend edit/create for FE users (with geoPosition connector)
* detail view

It's build with love and

* is based on extbase & fluid
* it's easy to use and understand
* working with TYPO3 core elements (like *sys categories* and *fe users*)
* it's tested and impoved on mulitple live websites
* has a documentation


asdfaf
******

In this chapter should be given a brief overview of the extension. What does it do? What problem does it solve? Who is interested in this? Basically, this section includes everything addressmgmt need to know to decide whether they should go on with this extension.

.. figure:: Images/IntroductionPackage.png
		:width: 500px
		:alt: Introduction Package

		Introduction Package just after installation (caption of the image)

		How the Frontend of the Introduction Package looks like just after installation (legend of the image)
