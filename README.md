How to install

add to repositories in ocmposer.json

    "drupal-redirects": {
        "type": "vcs",
        "url": "git@github.com:IN10/drupal-redirects"
    }
    
in your project run 

`composer require IN10/drupal-redirects`


endpoint will be at 

`/api/redirects/getRedirect`

Query parameters:

`source` (required) without preceding `/`

`language` (optional)

Response:

    {
        "language": "en",
        "source": "/the-source-path",
        "url": "/the-redirect-path",
        "statusCode": "301"
    }
