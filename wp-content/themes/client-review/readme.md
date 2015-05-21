# Sandpit
> Wordpress Theme Development Kit

A framework for rapid Wordpress development using the Bower front end package manager, Gulp build tool and ACF for custom fields

## Breakdown

By default, on install this theme will -

- set a few friendly defaults
- remove a whole lot of default cruft
- change the default behaviour of several Wordpress features
- prompt for the installation of ACF Pro

The framework is fairly opinionated, while it won't force you to do anything directly, it will often have an example of how best to approach a problem.

The SASS stack includes

- Bourbon (Mixin Library)
- Bourbon Neat (Grid System)

## Dependencies

- Nodejs/npm (`brew install node`)
- Gulp + Bower (`npm install gulp bower -g`)
- Ruby/gem + SASS (`brew install ruby && gem install sass`)

## Getting Started

Make sure you have all your dependencies installed

Clone or checkout this repo into your themes directory and run `npm install && bower install` to install all the dependencies

## Build Process

You can run the default (`watch` based) task with `gulp`. This task will add debug information to SASS for testing + leave all coded expanded.

For production use `gulp production` which will minify, strip comments and uglify all code to decrease server requests.
