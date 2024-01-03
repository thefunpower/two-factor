# 安装

在composer.json中添加
~~~
"thefunpower/two-factor": "dev-main" 
~~~

## 使用

1.初始化
~~~
$factor = new \TwoFactor();
$factor->label = "xda.com";
$factor->init();
~~~

2.取得内容
~~~ 
$text = $factor->text();
~~~

3.自行生成二维码
~~~
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

$title = $this->input['title'];
$data = $this->input['data'];
$res = Builder::create()
    ->writer(new PngWriter())
    ->writerOptions([])
    ->data($data)
    ->encoding(new Encoding('UTF-8'))
    ->size(300);
if($title) {
    $res = $res->labelText($title)->labelFont(new NotoSans(20))
    ->labelAlignment(LabelAlignment::Center)
    ->validateResult(false);
}
$res = $res->build();
header('Content-Type: ' . $res->getMimeType());
echo $res->getString();

~~~

## 验证

~~~ 
$factor = new \TwoFactor();
$factor->label  = "xda.com";
$factor->secret = 'Q5G7JQBWOA4EM6UO';
echo  'verify: ' . $factor->verify('437388');
exit;
~~~

### 开源协议 

[Apache License 2.0](LICENSE)