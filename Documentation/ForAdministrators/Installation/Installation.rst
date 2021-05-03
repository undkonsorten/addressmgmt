.. include:: ../../Includes.txt

.. _Installation:

=====================
Installation
=====================

TYPO3 versions compatibility
============================

**TYPO3 7.6. LTS**: The ``master`` (Version 2.0.0.) branch is compatible with TYPO3 7.6. LTS.
**TYPO3 6.2. LTS**: The branch ``typo3-6.2`` (Version 1.0.0) is compatible with TYPO3 6.2. LTS.


Latest version from git
=======================

You can get the lastest version of TYPO3 Address Management (Ext: *addressmgmt*) from  `GitHub.com/undkonsorten/addressmgmt <https://github.com/undkonsorten/addressmgmt>`_ with the bash command

.. code-block:: bash

  https://github.com/undkonsorten/addressmgmt.git


Add/clone the repository into your ``typo3conf/ext`` folder and activate it in the TYPO3 Extension Manager.


Preparation: Include static TypoScript
======================================

The extension ships some TypoScript code which needs to be included.

#. Switch to the root page of your site.

#. Switch to the **Template module** and select *Info/Modify*.

#. Press the link **Edit the whole template record** and switch to the tab *Includes*.

#. Select **Address Management (addressmgmt)** at the field *Include static (from extensions):*
