# Documentation

Read this [blog post](https://tombroucke.be/blog/set-woocommerce-product-variation-thumbnail-by-attribute/).

# How to install

## From this repository
Go to the releases section of the repository and download the most recent release.

Then, from your WordPress administration panel, go to Plugins > Add New and click the Upload Plugin button at the top of the page.

## Bedrock
Add this repository to your composer.json's repositories. 

```
{
   "type": "vcs",
   "url": "git@github.com:tombroucke/otomaties-woocommerce-variation-general-thumbnail.git"
}
 ```
 
 Then run `composer require tombroucke/otomaties-woocommerce-variation-general-thumbnail`
 
 
# Caveats
- The product needs to be saved before these thumbnail fields are displayed in the admin. So you need to add your attributes & terms, save your product. The page gets refreshed and will display the thumbnail fields.
