# 快递单号查询

## 安装

环境要求：laravel verstion > 5.0

1. 使用 [composer](https://getcomposer.org/)

  ```
  composer require widuu/laravel-express:@dev
  ```

## 配置

1. 注册 `ServiceProvider`:

  ```
  widuu\Express\ExpressServiceProvider::class,
  ```

2. （可选）添加到 `config/app.php` 中的 `aliases` 部分:

  ```php
  'Express' => widuu\Express\Express::class,
  ```

##使用

>这里我配置了alisa

```php
<?php

namespace App\Http\Controllers;

use Log;

class HomeController extends Controller
{

    /**
     * 使用DEMO
     *
     * @return string
     */

    public function demo(\Express $express)
    {
        // 如果配置中没有假如alisa,你可以如下的方法
        // $express = make('Express');

		// 返回快递公司名称，例如韵达
        $express->getCompanyName('快递单号');

        // 可以直接输入快递单号，第二个可选输入公司名称，第三个参数默认false 返回array的结果，true返回json 
        $express->search('快递单号','(可选)公司名称',false);

  		// 如果快递公司不全，可以使用如下的方法来更新静态类,所以 vendor/widuu/laravel-express/src 需要可写
  		$express->updateCompany();
    }
}
```
## License

APACHE-2.0
