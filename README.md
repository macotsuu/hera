# Hera
Hera is an implementation of the CQRS pattern, based on a service bus that maps a Query/Command to an appropriate handler
## Requirements
- [PHP](https://www.php.net/) 8.0+

## Example of code
```php
<?php
  class Query implements \Hera\Query\QueryInterface {
    public function __construct(
      public int $id
    ) {}
  }
  
  class Handler implements \Hera\Query\QueryHandlerInterface {
    public function dispatch(\Hera\Query\QueryInterface $query): mixed {
      return $query->id;
    }
  }
  
  $serviceBus = new \Hera\Bus\Bus();
  $serviceBus->register(Query::class, Handler::class);
  $serviceBus->handle(new Query(33));
?>
```
## Authors

- **Dominik Szamburski** - *Initial commit* -
  [macotsuu](https://github.com/macotsuu)

See also the list of
[contributors](https://github.com/macotsuu/hera/graphs/contributors)
who participated in this project.

## License

This project is licensed under the [MIT](LICENSE.md) see the [LICENSE](LICENSE.md) file for
details