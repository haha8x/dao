## Install
Create .env file from .env-example and update your configuration
```
composer install //to download vendor packages
php artisan migrate //to create database structure
php artisan cms:user:create //to create admin user
php artisan vendor:publish --tag=cms-public --force
php artisan cms:theme:assets:publish
php artisan storage:link
php artisan serve //Run the first test
php artisan cms:media:thumbnail:generate //Regenerate thumb
```
Open http://localhost:8000, you should see home page of Botble CMS

## Remove Header Botble licsence
```
platform\packages\theme\src\Theme.php
        $content->withHeaders([
            'Author'      => 'Sang Nguyen (sangnguyenplus@gmail.com)',
            'Author-Team' => 'https://botble.com',
            'CMS'         => 'Botble CMS',
            'CMS-Version' => get_cms_version(),
        ]);

        $content->withHeaders([
            'Author'      => 'Mr Haha',
            'Author-Team' => 'https://hahoang.com',
            'CMS'         => 'HaHa CMS',
            'CMS-Version' => '10.2019',
        ]);
```

## Plugin
```
php artisan cms:plugin:create <plugin name>
php artisan cms:plugin:activate <plugin name>
php artisan cms:plugin:deactivate <plugin name>
php artisan cms:plugin:remove demo

php artisan cms:plugin:make:crud demo demo-item

php artisan make:migration create_users_table
php artisan make:migration create_users_table --create=users
php artisan make:migration add_votes_to_users_table --table=users
php artisan make:migration add_collums_to_table --table=demo --path=platform/plugins/demo/database/migrations
php artisan migrate

cms:make:controller            Make a controller
cms:make:form                  Make a form
cms:make:model                 Make a model
cms:make:repository            Make a repository
cms:make:request               Make a request
cms:make:route                 Make a route
cms:make:table                 Make a table

php artisan list
```

## Add css to blade view
```php
@push('footer')
<link href="..." />
<script src="..."></script>
@endpush
```

## Add css script from controller
```php
\Assets::addStylesDirectly('...');
\Assets:: addScriptsDirectly('...');
```

## allow override plugin view in theme
```php
return Theme::scope('view-name-in-theme', [], 'plugins/your-plugin::view-name-in-plugin')->render();
```

## Working with botble plugin
https://www.youtube.com/watch?v=JAiKnnb9dH8&t=62s

## get current language code
```php
\Language::getCurrentLocaleCode();
```
## Make API Work
```
php artisan passport:install
```
https://laravel.com/docs/5.8/passport
You can research more about Laravel API.

To add new settings, you can see the example in platform/plugins/blog/src/Providers/HookServiceProvider.php.

You need to add filter BASE_FILTER_AFTER_SETTING_CONTENT
To write a new API, you need to write a controller, add a route and it done.

You can run command php artisan apidoc:generate and open your-domain/docs to see API docs.

You can run command “php artisan key:generate” to generate new app key.

## 3.5 Change
From version 3.5, you need to replace all  
core.table:: to core/table:: and trans(‘core.table… to trans(‘core/table  
core.base:: to core/base:: and trans(‘core.base to trans(‘core/base

To add your custom sitemap, you need to add listener for RenderingSiteMapEvent.  
Ex: platform/plugins/blog/src/Listeners/RenderingSiteMapListener.php  
Default sitemap: your-domain/sitemap.xml

```
php artisan cms:language:sync posts post
```

To override member theme, you can run command: 
```
php artisan vendor:publish --tag=cms-views --force
php artisan vendor:publish
```
and change it in /resources/views/vendor

## Move plugin management into /packages.
Now it's a optional feature, you can remove botble/plugin-management and run composer update to remove plugin feature.

## The document to change media sizes: https://docs.botble.com/cms/3.5/media

To see all image sizes, you can see the config in /platform/core/media/config/media.php

## Overide CMS config
```
php artisan vendor:publish --tag=cms-config
```
Then you can modify config file in /config/core folder.
To publish config of a module, you can add option "--provider"
```
php artisan vendor:publish --tag=cms-config --provider="Botble\Base\Providers\BaseServiceProvider"
```
Change file platform\core\base\src\Supports\Editor.php
```
->addScriptsDirectly('vendor/core/js/editor.js');
to
->addScriptsDirectly('ckeditor/editor.js');
```

## Upload from a path RV Media
```
$folder = \Botble\Media\Models\MediaFolder::create([
    'name' => 'Example',
    'slug' => 'example',
]);
$fileUpload = new \Illuminate\Http\UploadedFile(database_path('files/example.png'), 'example.png', 'image/png', null, true);
$image = \RvMedia::handleUpload($fileUpload, $folder->id);
```

## Browserslist: caniuse-lite is outdated
npm update caniuse-lite browserslist
npm i -g browserslist caniuse-lite


## Instagram
Hello,

The way the Instagram APIs work at the moment requires you to change Additional Settings.

1. Go to https://www.instagram.com/developer/ > Manage Clients > Register a New Client > Create a New Client (Add http://localhost/ in the Redirect URL) > Uncheck: Disable implicit OAuth (In Security Tab)

2. Go to this URL: https://api.instagram.com/oauth/authorize/?client_id=CLIENT-ID&redirect_uri=REDIRECT-URI&response_type=token and make sure that you replace the CLIENT-ID and REDIRECT-URI in the URL with their Actual Values. This will fetch you your Access Token.

3. Open the js/functions.js File and find the following code:
SEMICOLON.widget.instagramPhotos( '5834720953.1677ed0.a0a26ba4c90845f9a844d64c316bf77a', '8e000fefe3024b2ead6a50ff005bf036' );
then replace 5834720953.1677ed0.a0a26ba4c90845f9a844d64c316bf77a with the newly generated Access Token in the step above and replace 8e000fefe3024b2ead6a50ff005bf036 with the Client ID of your Newly Created Client.

4. Then you can simply add your User ID in the data-user Attribute and the data-type=”user” Attribute should always be User since Instagram has blocked Access for other types of Content.

This will definitely work fine. Hope this Helps!

Let us know if we can help you with anything else or if you find any further issues. Thanks. :)
