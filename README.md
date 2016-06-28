# Clarifai

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]


## Install

Via Composer

``` bash
$ composer require threeel/Clarifai
```

## Usage

``` php
$clarifai = new Threeel\Clarifai\Clarifai();
$url = "http://image.com.url.jpg";
$tags = $clarifai->tags($url);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email lefteris.k@3elalliance.com instead of using the issue tracker.

## Credits

- [Lefteris Kameris][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/threeel/Clarifai.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/threeel/Clarifai/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/threeel/Clarifai.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/threeel/Clarifai.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/threeel/Clarifai.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/threeel/Clarifai
[link-travis]: https://travis-ci.org/threeel/Clarifai
[link-scrutinizer]: https://scrutinizer-ci.com/g/threeel/Clarifai/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/threeel/Clarifai
[link-downloads]: https://packagist.org/packages/threeel/Clarifai
[link-author]: https://github.com/threeel
[link-contributors]: ../../contributors
