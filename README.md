# Redux Options Framework v1.0.0 #

Wordpress options framework which uses the [WordPress Settings API](http://codex.wordpress.org/Settings_API "WordPress Settings API"), Custom Error/Validation Handling, Custom Field/Validation Types, and import/export functionality.

## Donate to the Framework ##

I develop Redux (and my other projects) because I enjoy them, and almost exclusively release them to the community as open source projects. If you can, please donate to help support the ongoing development of Redux Framework!

[![Donate to the framework](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif "Donate to the framework")](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=QQJDSRRZVKRGU)

## Simple Usage ##

Download Redux [here](https://github.com/ghost1227/Redux-Framework/archive/stable.zip) and unzip it in your theme. Rename the Redux directory to `admin/`.

```bash
$ cd my-theme
$ unzip ~/Downloads/Redux-Framework-master.zip -d admin
```

Alternatively clone the repository using git:

```bash
$ cd my-theme
$ git clone git://github.com/ghost1227/Redux-Framework/ admin
```

Or use:

```bash
$ cd my-theme
$ git submodule add git://github.com/ghost1227/Redux-Framework/ admin
```

Next, copy `admin/options.php` to the base of your theme directory, so it won't get overwritten when you update Redux.

Include the `options.php` file for use in your theme by adding this to your `functions.php`:

```php
get_template_part('theme', 'settings');
```

Finally change the settings as needed in `options.php`. The file is heavily documented, the rest of the [documention][docs] is a work in progress.

[docs]: http://plovs.github.com/Redux-Framework-Docs/index.html

## Features ##

* Uses the [WordPress Settings API](http://codex.wordpress.org/Settings_API "WordPress Settings API")
* Multiple built in field types
* Multple layout field types
* Fields can be over-ridden with a callback function, for custom field types
* Easily extendable by creating Field Classes
* Built in Validation Classes
* Easily extendable by creating Validation Classes
* Custom Validation error handling, including error counts for each section, and custom styling for error fields
* Custom Validation warning handling, including warning counts for each section, and custom styling for warning fields
* Multiple Hook Points for customisation
* Import / Export Functionality - including cross site importing of settings
* Easily add page help through the class
* Much more

## Are you using Redux? ##

Send me an email at ghost1227@reduxframework.com so I can add you to our user spotlight!

## Changelog ##

### Development Branch ###

* Fixed SSL error which occurred occasionally with Google Webfonts 
* Moved glyphicons to img/icons

### Version 1.0.0 (December 5, 2012) ###

* Based on NHP Theme Options Framework v1.0.6
* Cleaned up codebase
* Changed option group name to allow multiple instances
* Changed checkbox name attribute to id
* Added rows attribute to textareas
* Removed extra linebreak in upload field
* Set default menu position to null to avoid conflicts
* Added sample content for dashboard credit line
* Minor style changes
* Changed name of upload button
* Refactored Google Webfonts function
* Replaced ```stylesheet_override``` with ```admin_stylesheet```
* Made text domain a constant
* Removed PHP closing tags to prevent issues with newlines
* Added option to define custom start tab
