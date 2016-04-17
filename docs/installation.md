---
currentSection: overview
currentItem: installation
pageflow_prev_url: license.html
pageflow_prev_text: License
pageflow_next_url: changelog.html
pageflow_next_text: Changelog
---

# Installation

## Via Composer

_PHP: The Missing Bits_ is available via Packagist:

    composer require ganbarodigital/php-the-missing-bits

## From Github

The source code for _PHP: The Missing Bits_ is available from [Github](https://github.com):

    git clone https://github.com/ganbarodigital/php-the-missing-bits.git

We follow the Gitflow branching model:

Branch | Purpose
-------|--------
`master` | latest tagged release
`develop` | completed features and fixes waiting for final testing and release
`feature/XXX` | work in progress, to be merged into `develop` when completed
`release/XXX` | a release that is undergoing final testing, to be merged into `master` and `develop` when completed
`hotfix/XXX` | emergency bug fixes in progress, to be merged into `master` and released when completed
