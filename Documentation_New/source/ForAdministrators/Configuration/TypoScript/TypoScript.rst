.. include:: ../../../Includes.txt

.. _TypoScript:


=====================
TypoScript
=====================

This page is divided into the following sections which are all configurable by using TypoScript:


.. contents::
  :local:
  :depth: 3


Constants
=========

Address Management provides many settings through the *TYPO3 Constant Editor*.

.. important:: TYPO3 Constant Editor

  We strongly recommend to use the Constant Editor for project specific settings.

  Here you can find a tutorial about the `TYPO3 Constant Editor <https://docs.typo3.org/typo3cms/TyposcriptSyntaxReference/TypoScriptTemplates/TheConstantEditor/Index.html>`_.

The Constant Editor provides the following constants:


Map
---

.. _tsConstants_map_markerClusters:

Marker Clusters
""""""""""""""""""""

.. container:: table-row

  Property
    MarkerClusters
  Variable Name
    plugin.tx_addressmgmt.settings.useMarkerClusters
  Data type
    bolean
  Description
    If you use marker clusters, pins/addresses on the map that will be to close together on a map will be combined to circle with the number of pins.  `Example here <http://leafletjs.com/2012/08/20/guest-post-markerclusterer-0-1-released.html#map>`_

    :typoscript:`plugin.tx_addressmgmt.settings.useMarkerClusters =` 1

----------


.. _tsConstants_map_latitude:

Latitude
""""""""""""""""""""

.. container:: table-row

  Property
    Latitude
  Variable Name
    plugin.tx_addressmgmt.settings.mapConfiguration.latitude
  Data type
    int
  Description
    Defines the latitude center of your map (if no pins are shown)

    :typoscript:`plugin.tx_addressmgmt.settings.mapConfiguration.latitude =` 14.000

----------

.. _tsConstants_map_longitude:

Longitude
""""""""""""""""""""

.. container:: table-row

  Property
    Latitude
  Variable Name
    plugin.tx_addressmgmt.settings.mapConfiguration.longitude
  Data type
    int
  Description
    Defines the longitude center of your map (if no pins are shown)

    :typoscript:`plugin.tx_addressmgmt.settings.mapConfiguration.longitude =` 30.000



Setup
=====
