# mbarwick83-twitter-api

README
Latest Version on Packagist Software License Total Downloads

Laravel 5.4 wrapper/extension of the popular PHP library for the Twitter OAuth REST API. https://github.com/abraham/twitteroauth. This package has been modified and updates are not pulled directly from Abraham's package.

Installation
To install, run the following in your project directory

$ composer require mbarwick83/twitter-api
Then in config/app.php add the following to the providers array:

Mbarwick83\TwitterApi\TwitterApiServiceProvider::class
Also in config/app.php, add the Facade class to the aliases array, should you want to use it:

'TwitterApi'    => Mbarwick83\TwitterApi\Facades\TwitterApi::class
Configuration
To publish Shorty's configuration file, run the following vendor:publish command:

php artisan vendor:publish --provider="Mbarwick83\TwitterApi\TwitterApiServiceProvider"
This will create a twitter-api.php file in your config directory. Here you must enter your Twitter App Consumer Key, Consumer Secret, and Callback URL. Create your app at https://apps.twitter.com.

Usage
Be sure to include the namespace for the class wherever you plan to use this library and set construct

use Mbarwick83\TwitterApi\TwitterApi;

public function __construct(TwitterApi $twitter)
{
$this->twitter = $twitter;
}
#####Generate Authorize URL:

This generates a URL that points users to Twitter's authorization page where they can authorize your app. It lists permissions being granted and allow/deny buttons.

$url = $this->twitter->authorizeUrl();
return $url;
#####Get user's access tokens

At this point we will use the temporary request token to get the long lived access_token that authorized to act as the user.

// This is the callback route, which would likely be a controller method. But for example purposes, see below...
Route::get('oauth/twitter', function(Request $request) {

    // If the oauth_token is different from the one you sent them to Twitter with, abort authorization
    if (isset($request->oauth_token) && Session::get('oauth_token') !== $request->oauth_token) 
    {
        Session::forget('oauth_token');
        Session::forget('oauth_token_secret');
        abort(404);
    }

    $twitter = new TwitterApi(Session::get('oauth_token'), Session::get('oauth_token_secret'));
    $access_token = $twitter->accessToken($request->oauth_verifier);

    return $access_token;
});
This will return an object like the following. This is the important part where you save the credentials to your database of choice to make future calls.

{
"oauth_token": "24073951-WiFyIePIerPAhQuoZ8VUMq8I4df14jzMcYR7uE6rJ7",
"oauth_token_secret": "b1lSZ2cPk4DbTP934SCfn1BTVPljdvMEMqSy8asczIGFh",
"user_id": "24133471",
"screen_name": "MikeBarwick",
"x_auth_expires": "0"
}
Contributing
Please see CONTRIBUTING and CONDUCT for details.

License
The MIT License (MIT). Please see License File for more information.