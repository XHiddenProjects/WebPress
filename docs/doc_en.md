[Raw Documentation](../docs/doc_en.md)

# WebPress

A easy CMS that uses JSON database and used for all webpage including Domain and Localhosts

### [what is this?](./docs#what-is-this) {#what-is-this}

this is a easy CMS that allows you use User Infrence(UI) and allow easier search up using high qulity SEO information and simple building structures. This uses JSON files to make/create pages onto your webpage. Your pages are built by written codes, which then it is converted to JSON file.

***

### [Requirements](./docs#requirements) {#requirements}

###### System requirements
- PHP 7.4 or higher
- Webserver (Apache)
###### PHP extendtions
- PHP [GD](http://php.net/manual/en/book.mbstring.php) module for image processing.
- PHP [JSON](https://php.net/manual/en/book.json.php) module for JSON manipulation.
- PHP [mbstring](http://php.net/manual/en/book.mbstring.php) module for full UTF-8 support.

***

### [Basics](./docs#basics) {#basics}

The basics of these are simple once you access this url `http(s)://{your_domain}/` or `http(s)://{your_domain}/{folder}` there is 2 **HTACCESS** that will have 1 being you main(WebPress) page and the other will be *Your home page* for your website. which will be in it's own independent folder.

***

### [How to install?](./docs#how-to-install) {#how-to-install}

To install, just insert the *Un-ZIPED* the folder to your *HTDocs(Root folder)* to start running the software. Once your done go to `http(s)://{your_domain}/` or add `./{folder}/` to access the main WebPress Page **Recommended: htdocs**. After you are there start by configurate your after you create account _**(This will be default to Admin on the first register, after that you are going to be a member)**_.

***

### [Roles](./docs#roles) {#roles}

Roles are important, they are very customizable and has 3 main one, *admin, mod, and member* This will make users have different access. 

`admin`, have all control over how people can view and see what changes and notify. Can also have `mod` help edit pages and make thing better. Edit plugin and change themes, etc. Ban users by _name_ or _ip_.

`mod` can help `admin` out by accessing the editor(if allowed by `admin`) to make pages better. They can also report any suspicious activity and the `admin` will recive it.

`member` can only view and use page elements.

`guest` is a default account when you are not registered/login, you can only view and read data.

check out the [Jobs Document](#jobs) for what you can do with users status.

***

### [Error Pages](./docs#error-pages) {#error-pages}

You can make custom error pages in the [_dashboard.php/configs_](./configs) and make custom errors so your page can show something, instend of boring old error page.

List of error documents(editable)

1. 400 - Bad request
2. 401 - Auth required
3. 403 - Forbidden
4. 404 - Not Found
5. 500 - Internal Server Error

***

### [Jobs](./docs#jobs) {#jobs}

In the form of roles  of moderation. Here is a table that is defaulted to you

| Tag | Target | custom? |
| ---- | ------ | --------- |
| admin| first income | X |
| moderator | specified users | X |
| member | registered users | X |
| guest | unknown users | X |

You(`admin`) can remake jobs by going to `dashboard.php/roles?editJob={jobName}`  to edit what this custom job might be or `dashboard.php/roles?createJob={jobName}`

### [Editors](./docs#editors) {#editors}

The editors this project uses is __BBCode__, __Markdown__, and __WYSIWYG__

### [Public vs Private Key](./docs#public-vs-private-key) {#public-vs-private-key}

The public key is what you would use for configuration of any plugin that requires that key, 
The Private key is what is used for backup login, which from different location use it to access it.
The Public key allows you for plugins and themes for user info.

### [hooks](./docs#hooks) {#hooks}

With hooks you can intercept all kinds of WebPress events to inject your own code.

Here is a list of available hooks:

| hook | execute in | note |
| ---- | ---------- | ---- |
| Profile | `themes` | displays on profile page |
| edit_profile | `themes` | edit on profile editor |
| head | `themes` | executes in __head__ tag |
| nav | `themes` | displays in navbar |
| editor | `themes` | displays in the editor bar |
| footerJS | `themes` | Executes code in the footer(as __Javascript__) |
| footer | `themes` | Executes code in the footer |
| dblist | `core` | displays on dashboard's lists |
| beforePage | `core` | executes code before page load |

### [Bans and Warnings](./docs#bans-and-warnings) {#bans-and-warnings}

Bans and Warnings should be use very rearly, but you (the admin) will have all access to do so, you have 3 ways to ban users

###### __Bans:__
1. IP
2. Username
3. Hardware ID(Hard Ban)

It can be temporary by using (`m-d-YtH:i:s`) format or type (`-1`) for _unlimited_ time

###### __Warnings:__
This can be used for counts how many times the user has been warned, this just counts up until banned/removed

All this can be stored in there history

### [Toolkits](./docs#toolkits) {#toolkits}

Toolkits are very help full in a lot of cases, this can work for _plugins_ by doing the following

Insert in the `{plugin_name}.plg.php`:

```php
<?php
include_once(ROOT.'/libs/toolkit.lib.php');
# Use `toolkits` as TOOLKIT;
use WebPress\toolkits as TOOLKIT;
# load toolkit
$kit = new TOOLKIT();
# Functions(these are default selectors, leave pramaters null to just use default)
$kit->useColor($color='black');
$kit->useFontWeight($fontWeight='bold');
$kit->useFontStyle($fontStyle='italic');
$kit->useFontSize($fontStyle=25, $units='px');
$kit->setAllies($func, $parma=null);
# convert
$kit->__toBool($txt);
$kit->__toStr($txt);
$kit->__toInt($txt);
$kit->__toFloat($txt);
?>
```