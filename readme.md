# Sklik Api pro Nette Framework

Nastavení v **config.neon**
```neon
extensions:
    sklikApi: NAtrreid\SklikApi\DI\SklikApiExtension

sklikApi:
    retargetingId: 12345
    registrationId: 12345678
    conversionId: 12345678
```

Použití
```php
/** @var NAttreid\SklikApi\SklikApiFactory @inject */
public $sklikApiFactory;

protected function createComponentSklikApi() {
    return $this->sklikApiFactory->create();
}
```

v @layout.latte
```latte
<html>
<body>
    <!-- html kod -->
    {control sklikApi}
</body>
</html>
```

na konverzní stránce (nejčastěji 'ThankYou')
```html
<html>
<body>
    <!-- html kod -->
    {control sklikApi:conversion}
</body>
</html>
```

na stránce registrace zákazníka
```html
<html>
<body>
    <!-- html kod -->
    {control sklikApi:registration}
</body>
</html>
```