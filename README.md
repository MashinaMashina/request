# request

- request class - PHP надстройка над CURL, упрощающая жизнь разработчику

Самый простой пример:

```php
use MashinaMashina\Request\Request;

$request = new Request('https://github.com');
$request->send();

echo $request->response;
```

Методы:
- request::_\_construct($url) - устанавливает URL запроса
- request::set($key, $value) - Устанавливает параметр CURL. [Описание параметров](http://php.net/manual/ru/function.curl-setopt.php)
- request::session($directory) - Устанавливает папку для хранения временных файлов сессии.
- request::post($data = array()) - устанавливает передаваемые данные и тип запроса в POST
- request::payload($data) - устанавливает тип запроса POST, данные кодирует в JSON [Можно чуть-чуть почитать тут](https://stackoverflow.com/questions/23118249/whats-the-difference-between-request-payload-vs-form-data-as-seen-in-chrome)
- request::send() - отправляет запрос. Возвращает содержимое страницы запроса
- request::error() - проверяет наличие ошибок. Если их нет возвращает False, иначе описание ошибки
- request::get_charset() - возвращает кодировку.
  Метод пытается определить кодировку:
    1. В заголовках
    2. В теле страницы
    3. С момощью mb_detect_encoding()
- request::dump() - возвращает полное описание запроса

Примеры:
```php
use MashinaMashina\Request\Request;

$request = new Request('http://google.com');
$request->session('google');
$request->send();

if( $request->error())
{
  echo $request->dump();
  die();
}
```

```php
$data = array(
  'login' => 'Vasya',
  'passwd' => '12345'
);

$request = new Request('http://example.com');
$request->post($data);
$request->send();

echo $request->response;
```

```php
$data = array(
  'auth' => array(
    'login' => 'Vasya',
    'passwd' => '12345'
  ),
  'order' => array(
    'id' => 1
  )
);

$request = new Request('http://example.com');
$request->payload($data);
$request->send();

echo $request->response;
```

# Установка:
```
composer require mashinamashina/request
```

