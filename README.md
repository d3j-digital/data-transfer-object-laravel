
# Data Transfer Object for Laravel

This is an extension to the [d3j-digital/data-transfer-object](https://github.com/d3j-digital/data-transfer-object) package that adds support for Eloquent models and collections.


## Authors

- Dom McLaughlin [@deeejmc](https://www.github.com/deeejmc)


## Installation

We recommend installing this library via Composer.

```bash
composer require d3j-digital/data-transfer-object-laravel
```

Or, if you'd prefer, you can clone this repository into your project.


## Usage

We recommend reading the documentation in the [d3j-digital/data-transfer-object](https://github.com/d3j-digital/data-transfer-object) package first.

In this example, we'll be querying a User model and converting it to our UserDto class.

#### Defining a DTO class for the model

We first need to assign a DTO class to our User model. If you haven't already created a DTO class, please follow the instructions in the link above.

```php
<?php

namespace App\Models;

use App\Dto\UserDto;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    public function toDto(): UserDto
    {
        $properties = $this->toArray();

        return new UserDto($properties);
    }
}
```

There is a custom `toDto` function which must return a DataTransferObject class instance. 

We're pulling the properties out of the model as an array and passing them to the UserDto class.

If you have any properties you wish to map, you can do so by passing an array as a second argument.

```php
<?php

public function toDto(): UserDto
{
    $properties = $this->toArray();

    $map = [

        // map the 'display_name' property in the dto
        // class to the 'name' attribute in the model
        'display_name' => 'name',
    ];

    return new UserDto($properties, $map);
}
```

### Rendering each collection record as a DTO

There is a custom `toDto` macro set up for collections that will loop through each record and convert it to the DTO set up in the model.

```php
<?php

$query = \App\Models\User::get()->toDto();
```

### Rendering a model instance as a DTO

In order to convert a model instance to a DTO, you can simply call `toDto` on the model.

```php
<?php

$user = \App\Models\User::first()->toDto();
```

## Contributing

Contributions are always welcome!

Please submit your PR and we will review it as soon as possible.


## License

[MIT](https://choosealicense.com/licenses/mit/)