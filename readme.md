# PSDGator Boilerplate for WP themes

SET UP
=====
The setup has been simplified. No need to install grunt seperately etc. All you need to run in your theme folder is:
```
npm i
```

**Make sure that you're not using ruby sass.**
```
sass --version
```


If output looks like:
`Ruby Sass 3.7.4`
**It means it's using Ruby which has been EoL since 2019.**

```
gem uninstall sass
```

If output looks like:
`1.63.6 compiled with dart2js 3.0.5`
**It means you're now using the correct dart2js sass**


```
grunt
```

*Update node.js if you haven't in a while.*

If you haven't already you should install composer and php sniffer and beautifier.
After you have composer installed. you should run this command.
```
composer require "squizlabs/php_codesniffer=*"
```
This lets you format the php document and fix minor warnings such as indentation etc.
```
F1 > PHPCBF: Fix this file
```

Plugins
=====
The boilerplate is now using TGM Plugin Activation to install and activate the most common plugins we use in most projects.
```
ACF PRO
CF7
SVG SUPPORT
YOAST SEO
```
**IMPORTANT:**
After installing ACF PRO. Make sure you use the license key and update the plugin to the latest version.
This is important for the custom acf blocks to work.
