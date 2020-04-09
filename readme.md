# minimalism-service-geolocator

**minimalism-service-geolocator** is a service for [minimalism](https://github.com/carlonicora/minimalism) to retrieve
physical location from an IP address.

## Getting Started

To use this library, you need to have an application using minimalism. This library does not work outside this scope.

### Prerequisite

You should have read the [minimalism documentation](https://github.com/carlonicora/minimalism/readme.md) and understand
the concepts of services in the framework.

minimalism-service-geolocator uses data coming from the free version of IP2LOCATION.

### Installing

Require this package, with [Composer](https://getcomposer.org/), in the root directory of your project.

```
$ composer require carlonicora/minimalism-service-geolocator
```

or simply add the requirement in `composer.json`

```json
{
    "require": {
        "carlonicora/minimalism-service-geolocator": "~1.0"
    }
}
```

## Deployment

This service does not require any parameter.

## Build With

* [minimalism](https://github.com/carlonicora/minimalism) - minimal modular PHP MVC framework
* [ip2location-php](https://github.com/ip2location/ip2location-php)

## Versioning

This project use [Semantiv Versioning](https://semver.org/) for its tags.

## Authors

* **Carlo Nicora** - Initial version - [GitHub](https://github.com/carlonicora) |
[phlow](https://phlow.com/@carlo)

# License

This project is licensed under the [MIT license](https://opensource.org/licenses/MIT) - see the
[LICENSE.md](LICENSE.md) file for details 

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)