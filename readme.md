# Sklik Api pro Nette Framework

Nastavení v **config.neon**
```neon
extensions:
    sklikApi: NAttreid\SklikApi\DI\SklikApiExtension

sklikApi:
    retargetingId: 12345
    registrationId: 12345678
    conversionId: 12345678
```

Použití
```php
/** @var NAttreid\SklikApi\ISklikApiFactory @inject */
public $sklikApiFactory;

protected function createComponentSklikApi() {
    return $this->sklikApiFactory->create();
}

public function renderDefault() {
    $this['sklikApi']->conversion(500); // konverze
    $this['sklikApi']->registration(); // registrace
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