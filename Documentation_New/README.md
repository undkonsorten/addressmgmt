## Installation

* General Information on TYPO3 an reST: https://wiki.typo3.org/ReST
* Install Sphinx, Python and TYPO3-Template on Linux: https://wiki.typo3.org/Rendering_reST_on_Linux
* Start SphinX Project with TYPO3 Template: https://wiki.typo3.org/New_reST_Project_with_Sphinx

## Configuration

Edit the `source/conf.py` file and add your project name. Especially the

```
# General information about the project.
project = u'ExtensionName'
copyright = u'2017, undkonsorten'

# The short X.Y version.
version = '2.0.0'
# The full version, including alpha/beta/rc tags.
release = '2.0.0.'
```
The TYPO3 rendering template `typo3sphinx` is already included in the `_templates/themes` folder and added to the configuration file `source/conf.py`.

```
# The theme to use for HTML and HTML Help pages.  See the documentation for
# a list of builtin themes.
html_theme = 'typo3sphinx'

# Add any paths that contain custom themes here, relative to this directory.
#html_theme_path = []
html_theme_path = ['_templates/themes/']
```

## Build HTML File
Start the build process with

```
> make html
```
