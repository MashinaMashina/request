# request

Самый простой пример:

```php
$request = new request('https://github.com');
$request->send();

echo $request->response;
```

Методы:
- request::_\_construct($url) - устанавливает URL запроса
- request::set($key, $value) - Устанавливает параметр CURL. [Описание параметров](http://php.net/manual/ru/function.curl-setopt.php)
- request::session($name = false) - Устанавливает имя сессии (Путь сохранения cookie, а не имя PHPSESSID).
  ! Надо настроить путь: заменить DATA в строке $this->dir = DATA.'/'.$this->name;
- request::post($data = array()) - устанавливает передаваемые данные и тип запроса в POST
- request::payload($data) - устанавливает тип запроса POST, данные кодирует в JSON [Можно чуть-чуть почитать тут](https://stackoverflow.com/questions/23118249/whats-the-difference-between-request-payload-vs-form-data-as-seen-in-chrome)
- request::send() - отправляет запрос. Возвращает содержимое страницы запроса
- request::error() - проверяет наличие ошибок. Если их нет возвращает False, иначе описание ошибки
- request::get_charset() - возвращает кодировку.
  Медот пытается определить кодировку:
    * В заголовках
    * теле страницы
    * С момощью mb_detect_encoding()
- request::dump() - возвращает полное описание запроса

Примеры:
```php
$request = new request('http://google.com');
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

$request = new request('http://example.com');
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

$request = new request('http://example.com');
$request->payload($data);
$request->send();

echo $request->response;
```
