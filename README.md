# Element Cache Buster plugin for Craft CMS 3.x

Bust the Craft CMS cache when an entry is updated/deleted, a structure is moved or a project config is updated or applied regardless of how you access the data (Element API/GraphQL/other).

Have you ever wanted to use cache on the Element API, but noticed that the cache is never cleared? We have!

This plugin exists for the sole purpose of solving that ultra simple and specific use case.

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require everyday/craft-element-cache-buster

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Element Cache Buster.

## Element Cache Buster Overview

Whenever you update a an entry, move a structure or apply the project config the Craft CMS cache will be flushed.

This plugin was originally intended to be used for just clearing the Element API cache, but it's not possible to fetch all current Element API cached keys using the available methods on Yii's cache service. That's why it just clears the cache for everything.

## Configuring Element Cache Buster

It's simple! You can either enable or disable the plugin in the settings.

Brought to you by [Everyday AS](https://everyday.no)
