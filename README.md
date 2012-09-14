flickr-mosaic-php
=================

A PHP implementation of creating mosaics from pics downloaded from my Flickr
account (http://www.flickr.com/photos/meetrajesh/). See examples
[here](http://www.flickr.com/photos/krazydad/sets/874417/)

## Motivation

Motivated by my co-worker Eric Fung who is working on a [Ruby
implementation](https://github.com/efung/flickr-hacks-ruby) of Bumgardner
(a.k.a krazydad) and his work (viewable
[here](http://www.flickr.com/photos/krazydad/collections/72157622192771853/)). Eric
emailed Bumgardner asking how he could create his own mosaics, and he told
him that he had used the scripts that could be found in his book called
[Flickr Hacks](http://shop.oreilly.com/product/9780596102456.do) by Paul
Bausch and Jim Bumgardner. The (mostly Perl) examples are downloadable from
O'Reilly [here](http://examples.oreilly.com/9780596102456/).

## Goal

I want to build my own mosaics as well, so I'm porting all these scripts to
PHP to help me interact with the Flickr API, to download thumbnails of photos
I've uploaded there, and to generate mosaics of my own pictures.

## Requirements

PHP 5.3 or above

## How To

The scripts here are written in PHP since it is my language of comfort.

Steps to run these scripts

* Clone this repo:
git clone git://github.com/meetrajesh/flickr-mosaic-php.git

* Edit api_key.php and insert your flickr api key. You can get your own
app key from
[here](http://www.flickr.com/services/apps/create/noncommercial/?).

* Execute mosaic.php from the command line: php -f mosaic.php

