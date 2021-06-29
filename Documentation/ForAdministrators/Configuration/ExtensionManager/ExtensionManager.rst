.. include:: ../../../Includes.txt

.. _ExtensionManager:

=====================
Extension Manager
=====================

Some general settings of TYPO3 Address Management can be only configured in the Extension Manager / Extension Configuration.

Settings
========


Root category for addresses
"""""""""""""""""""""""""""

.. container:: table-row

  Property
    basic.feUserRelation
  Data type
    boolean
  Default
    (none)
  Description
    Enables the connection between addresses and Frontend Users. This is useful, if frontend users need to be able to edit their own profile in th frontend


Root category for addresses
"""""""""""""""""""""""""""

.. container:: table-row

  Property
    basic.rootCategory
  Data type
    int
  Default
    (none)
  Description
    If you add the *uid* of a TYPO3 SysCategory here, this category will be shown as the *only available root category* for the Address records. This helps to limit the available options (aka. sysCategores) for the editors and might imporove the backend usability
