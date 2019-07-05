# Known Recaptcha3 Bot blocking support

This plugin adds Recaptcha3 bot blocking support to certain public pages - register, logged out comments, and login.

It works by extending the ```forms/input/captcha``` template, and is extensible to add your own protected views and bot thresholds (by default everything has a threshold of 0.5)

## Installation

* Download the latest version of Known. I recommend that you either use the [GitHub](https://github.com/idno/known) version or the [Unofficial packages](https://www.marcus-povey.co.uk/known) available from my website.
* Create an **Recaptcha3** directory in your ```IdnoPlugins``` directory, and copy these files into it.
* Activate it from the Admin panel.

or

* ``` composer require mapkyca/known-recaptcha3 ```

## Configuration

Once you've installed and activated the plugin, go [here](https://g.co/recaptcha/v3) to get your recaptcha3 tokens, and configure these in your admin page.

You can set custom threshold values in your ```config.ini```, but at time of writing there's no UI for these.



## See

* Author: [Marcus Povey](https://www.marcus-povey.co.uk)
