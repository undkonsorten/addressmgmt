.. include:: ../Includes.txt

.. _Installation:

============
Installation
============

TYPO3 versions compatibility
============================

@todo compatibility list really needed?

**TYPO3 10.4 LTS**: The version 5 is compatible with TYPO3 10.4 LTS.

**TYPO3 9.5 LTS**: The version 4.1.0 is compatible with TYPO3 9.5 LTS.

**TYPO3 8.7 LTS**: The branch ``develop-8.7`` (Version 3.1.1.) is compatible with TYPO3 8.7 LTS.

**TYPO3 7.6 LTS**: The branch ``master-7.6`` (Version 2.1.0.) is compatible with TYPO3 7.6 LTS.

**TYPO3 6.2 LTS**: The branch ``typo3-6.2`` (Version 1.0.0) is compatible with TYPO3 6.2 LTS.


@todo Add addressmgmt to TER

@todo Add addressmgmt to packagist.org


Latest version from git
=======================

You can get the lastest version of TYPO3 Address Management (Ext: *addressmgmt*) from  `GitHub.com/undkonsorten/addressmgmt <https://github.com/undkonsorten/addressmgmt>`_ with the bash command

.. code-block:: bash

  git clone https://github.com/undkonsorten/addressmgmt.git


Add/clone the repository into your ``typo3conf/ext`` folder and activate it in the TYPO3 Extension Manager.


Preparation: Include static TypoScript
======================================

The extension ships some TypoScript code which needs to be included.

#. Switch to the root page of your site.
#. Switch to the **Template module** and select *Info/Modify*.
#. Press the link **Edit the whole template record** and switch to the tab *Includes*.
#. Select **Address Management (addressmgmt)** at the field *Include static (from extensions):*

.. image:: ../Images/Installation/includeTs.png
   :class: with-shadow
   :scale: 70

Include TypoScript in site_package
**********************************

Another way is to include the addressmgmt TypoScript in a :ref:`TYPO3 site_package <t3sitepackage:start>`.
They are several kind of ways to include the TypoScript from extensions. Use your preferred way.
