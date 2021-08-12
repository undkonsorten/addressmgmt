.. include:: ../../../Includes.txt

.. _ExtensionManager:

=====================
Extension Manager
=====================

Some general settings of TYPO3 Address Management can be only configured in the Extension Manager.

If you need to configure those, switch to the module "Extension Manager", select the extension "**addressmgmt**" and press on the configure-cog-icon!


Settings
========

**Relation to fe_users**
*basic.feUserRelation (boolean)*:

You can active a relation between addresses (*tx_addressmgmt_domain_model_address*) and TYPO3 FE-Users.

Such a relation is for example needed when FE users should be able to create/edit/see their own addresses.

**Root category for addresses**
*basic.rootCategory*

If you add the *uid* of a TYPO3 SysCategory here, this category will be shown as the *only available root category* for the Address records. This helps to limit the available options (aka. sysCategores) for the editors and might imporove the backend usability.
