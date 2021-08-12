.. include:: ../../Includes.txt

.. _Map:

=========================
Map
=========================

Features
========

TYPO3 Addressmanagement can display addresses on a map. Therefore it provides fields for

* *Latitute* and *Lontitude* for Pins/Markers and
* *GeoJson* for Shapes/Polygones

on the map.

.. important::

   In order to use the map as described here you need an OpenStreetMap acccount. But it's also possbile to use other tile servers.


OpenStreetMap
=============

We decided to use for our map `OpenStreetMap <https://www.openstreetmap.org/>`_ . The map is created with  `Leaflet.js <http://leafletjs.com/>`_. As a tile server we are using `Mapbox <https://www.mapbox.com/>`_.


Using Mapbox
=========================

In Order to use `Mapbox <https://www.mapbox.com/>`_ you need to create an Mapbox account and add the credentials via TypoScript settings.
