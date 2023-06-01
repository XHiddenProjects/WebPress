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
###### PHP extentions
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

### [updating versions](./docs#updating) {#updating}
1. Backup your data so nothing gets destroyed.
2. Delete the "old version" folder entirely.
3. Once done, register a new account for any changes.
4. Reload your data back onto the data and config folder (Backups can be done, using the backup plugin)

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

If you want to add your own, go to the _ROLES.json_

Enter this code
change `[obj]` to the name of type, also change true/false to allow or disallow that permission.
```json
		"[obj]":{
			"name": "[objname]",
			"description": "[objdesc]",
				"options":{
					"view":true,
					"write": true,
					"read": false,
					"delete": false,
					"ban": false,
					"warn": false,
					"post": false,
					"reply": false,
					"onComingMessages": false,
					"activePlugins": false,
					"activeThemes": false,
					"config": false,
					"changeRoles": false,
					"filemanager": false,
					"changeProfile": false
				}
			}
```

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
| afterPage | `core` | executes code after page load |
| init | `core` | executes before everything loads |
| profileCards_box | `forum` | displays in the "profile card" box |
| profileCards_btn | `forum` | displays in the "profile card" button group |
| beforeMsg | `forum` | displays before the message is loaded |
| afterMsg | `forum` | displays after the message is loaded |
| bottomReply | `forum` | displays in the bottom of the reply message |
| bottomTopic | `forum` | displays in the bottom of the topic message |

### [Bans](./docs#bans) {#bans}

Bans should be use very rearly, but you (the admin) will have all access to do so, you have 3 ways to ban users

###### __Bans:__
1. IP
2. Username
3. Hardware ID(Hard Ban)

It can be temporary by using (`m-d-Y H:i:s`) format or type (`-1`) for _unlimited_ time

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

### [File Uploding](./docs#file-uploading) {#file-uploading}
File uploading has it's limitations as well, you can upload anything, but some items can't be edited(ex. images, videos, etc).
The max upload size is whatever your server can handle. You can upload any file type some may be editable, some may not, try not to upload anything that may have injection software that allows access to accounts.
Users that upload items in the 'forum' are limited (view it in the `config` folder)

### [Forum searching](./docs#forum-searching) {#forum-searching}
The forum searching a avanced tool to find things easier, but it has to include a keywork to allow it to work
example, _(tags:fun)_, the syntax pattern is `{selector}:{value}`

Allowed selectors:
* tags
* forum
* topic
* status

### [Themes](./docs#themes) {#themes}
Themes is what makes the software look the way it looks, it is easy setup and configurable.

Here is how you set it up.
1. Copy the "Default" folder in the _theme folder_ (this is required, because most folders are required for this to work).
2. Go the `theme.conf.json` and change anything that needs to be changed.
3. Enjoy, start placing css/js codes into your folder and style your page.

### [Policies](./docs#policy) {#policy}


##### WebPress - Policy

Welcome to WebPress, a free open-source and self hosting CMS and Forum-Script. As a developer (myself) enjoys making software for anyone to use and have a fair use of the data, since this is classified as a _social media_ platform, I can tell you that social media has gone out of hand with abusive power and not appropriately moderating. So even tho this allows you to say what every you like, I am going to hop in to be a **_second-hand moderation_** Read more...

  

#### Allowed

*   Share your opions
*   Share your ideas/requests
*   Political/termology ideals
*   Sell Products or promote of your choice (make sure it's appropriate)
*   Upload/Post whatever you like (make sure it's appropriate)
*   Reply whatever you like

  

#### Disallowed

*   Selling illigal items: (18 U.S. Code § 1170)
*   Child abuse/pornography: Child Abuse: (34 U.S. Code § 20341) | Child Pornography: (18 U.S. Code § 2256)
*   Threats/Harmful comments: (6 U.S. Code § 1508)
*   Sharing others personal info, without consent: (18 U.S. Code § 798)
*   Identity theft: (Ohio Admin. Code 3354:1-20-09)

  

**IF ALL ANY OF THESE ARE VIOLATED** admin's can ban/remove account or _can be used agaist court with any information provide correctly. Example: images/videos/posts/replies and anything that can be shown_ that can be shown to federal authorities.

  

#### Administration

All these rules also refrence to you as well, not just your _Customers_. Your _Customers_ can report your account, and will be decided by [XHiddenProjects](#). Your punishement can be a _removal of account_. XHiddenProjects has 0 tolerance with anything **lack of child protection** or false banning **WITHOUT** and reasonable explaination.

  

#### Reporting Admins

On the side of your screen there is going to be a going to be a chat bar displayed on the side. Fill out the info, this will require of the followings:

1.  Username
2.  First and Last Name
3.  Date of ban(will be shown on the ban screen)
4.  Reson of ban(will be shown on the ban screen)
5.  Link to source of ban(provided by admin, make sure you request it.)

If you request the link to the source of ban, admins **ARE REQUIRED** to provide it, otherwise jugement would be cancelled and the ban is released, since adminstrator failed to prove evidence.  
**Note:** Do not tamper _with ANY_ evidence when in review, this is checkable and punishement can occur.

  

If you have any questions, ask them on the [discussions](https://github.com/XHiddenProjects1/WebPress/discussions/2) on github.

### Medias
Collaborate [Github](https://github.com/XHiddenProjects1/WebPress)