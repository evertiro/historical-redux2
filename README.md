# Redux Options Framework v1.0.1 #

Wordpress options framework which uses the [WordPress Settings API](http://codex.wordpress.org/Settings_API "WordPress Settings API"), Custom Error/Validation Handling, Custom Field/Validation Types, and import/export functionality.

## Want to see a feature added to the 2.0.0 stable release? ##

Let me know now! Better yet, add it yourself and send a pull request! The 2.0.0 stable release will be out as soon as I convert everything to Font Awesome!

## Donate to the Framework ##

I develop Redux (and my other projects) because I enjoy them, and almost exclusively release them to the community as open source projects. If you can, please donate to help support the ongoing development of Redux Framework!

[![Donate to the framework](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif "Donate to the framework")](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=QQJDSRRZVKRGU)

## Simple Usage ##

1) Download Redux [here](https://github.com/ghost1227/Redux-Framework/archive/stable.zip) 

Or..

```bash
$ cd my-theme
$ unzip ~/Downloads/Redux-Framework-master.zip -d admin
```

Or.. Alternatively clone the repository using git:

```bash
$ cd my-theme
$ git clone git://github.com/ghost1227/Redux-Framework/ admin
```

Or use:

```bash
$ cd my-theme
$ git submodule add git://github.com/ghost1227/Redux-Framework/ admin
```

2) Unzip it, and upload the `options/` directory and the `options.php` file to your theme folder.

3) Rename `options.php` to `redux-options.php`

4) Copy `options/defaults.php` to the base of your theme directory, so it won't be overwritten when you update Redux.

5) Include the `defaults.php` file for use in your theme by adding this to your `functions.php`:

```php
get_template_part('redux', 'options');
```

Finally change the settings as needed in `defaults.php`. The file is heavily documented, the rest of the [documention][docs] is a work in progress.

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
* Added optional flag for wpautop on editors
* Added password field type
* Added checkbox_hide_all option
* Added WP3.5 media chooser
* Added Google webfonts previews
* Updated to WP3.5 color picker

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
