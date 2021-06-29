.. include:: ../../../Includes.txt

.. _TsConfig:

=====================
TsConfig
=====================

Via TsConfig (`Configuration/TsConfig/TemplateLayouts.ts`) Address Management provides 3 different layouts for the Address List View:

#. Map only
#. Map with list
#. List only

.. code-block:: bash

   tx_addressmgmt.templateLayouts {
      map = LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt.templateLayout.map
      map-list = LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt.templateLayout.map-list
      list = LLL:EXT:addressmgmt/Resources/Private/Language/locallang_db.xlf:tx_addressmgmt.templateLayout.list
   }

The template be chosen in the Plugin in the dropdown *Template layout*  @settings.templateLayout@.
