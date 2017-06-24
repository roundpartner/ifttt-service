# IFTTT Maker

Integrates into IFTTT Maker to trigger events

## Usage

```php
$maker = new Maker($apiKey);
$maker->trigger('event_name', 'value1', 'value2', 'value3');
```

## Testing

```bash
phpunit
```

## Code Quality
```bash
./vendor/bin/phpcs --standard=psr2 ./src
./vendor/bin/phpcbf --standard=psr2 ./src
```
