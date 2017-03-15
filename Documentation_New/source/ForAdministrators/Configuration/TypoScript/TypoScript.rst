.. include:: ../../../Includes.txt

.. _TypoScript:


=====================
TypoScript
=====================

This page is divided into the following sections which are all configurable by using TypoScript:

.. only:: html

   .. contents::
        :local:
        :depth: 1


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
         If you use marker clusters, pins/addresses on the map that will be to close together on a map will be combined to circle with the number of pins.
         `Example here <http://leafletjs.com/2012/08/20/guest-post-markerclusterer-0-1-released.html#map>`_

         :typoscript:`plugin.tx_addressmgmt.settings.useMarkerClusters =` 1




Setup
=====
