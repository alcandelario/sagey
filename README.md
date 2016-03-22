# Sagey - WP starter plugin inspired by [Sage](https://roots.io/sage/)

Sagey is a WordPress starter plugin for projects with/without a front-end developement component and with/without a settings page. It includes an optional, slightly customized, namespaced version of [Cheezcap](https://github.com/alcandelario/cheezcap) to easily create a "Settings" page

## Why?

* If you'd like a plugin to load your theme's CSS/JS rather than put that logic directly in the theme.
* If you'd like to override a theme's CSS/JS/templates with your own, rather than modifying the theme directly
* If you'd like to create a settings page for a plugin or theme but don't want to modify the the theme directly 

## New Features

* [gulp](http://gulpjs.com/) build script with two new additions: do not minify assets unless running gulp --production. Wrap all minified JavaScript in an IIFE to protect variable scope. Run "gulp namespace" to change all namespaced .php files to whatever namespace is defined in /assets/manifest.json

* [Cheezcap](https://github.com/alcandelario/cheezcap) with support for two new option types, MultiSelect (saved as serialized string) and MediaItem (selects content from media library).

## Plugin installation

Bottom line is you want to get the files in this repo into your local development environment's wp-content/plugins folder

## Plugin setup

* Edit `./assets/manifest.json` to set the namespace, include vendor JS/CSS if necessary, and change gulp output paths.
* Edit `./constants.php` as needed. Some constants also have the current namespace in them, but that's not required - you can name them whatever you like
  * `LOAD_ASSETS` - whether or not to enqueue the CSS/JS 
  * `USE_ADMIN_MENU` - creates a link in the WP admin area for your plugin
  * `INIT_OPTIONS_PAGE` - creates a link to a cheezcap options page
  * `OPTIONS_AS_SUBMENU` - either creates the cheezcap options page as a top-level page, or a sub-page. Set to FALSE when your plugin only needs a settings page
* Run `gulp namespace` to automatically update the namespace everywhere used, so we don't collide with other instances of the Sagey plugin
* Run `gulp` to build the /dist folder
* Or just run `gulp watch` if working with CSS/JS files and upon change, the /dist folder will be built

## Default Plugin Features

Upon activation, the Sagey Starter Plugin will:
* Register a wp_enqueue_scripts/wp_enqueue_styles for the plugin, the assets for which are compiled by gulp and put in /dist
* Register hook for creating an admin menu item and page
* Register hook to create an admin submenu item and page for managing plugin settings 


### Available gulp commands

* `gulp` — Compile and optimize the files in your assets directory
* `gulp watch` — Compile assets when file changes are made (no minification of js)
* `gulp --production` — Compile assets for production (no source maps).
* `gulp namespace` - finds all .php files and changes the namespace where applicable
