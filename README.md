# 下载并安装microsoft-authenticator应用

[下载并安装microsoft-authenticator应用](https://support.microsoft.com/zh-cn/account-billing/%E4%B8%8B%E8%BD%BD%E5%B9%B6%E5%AE%89%E8%A3%85microsoft-authenticator%E5%BA%94%E7%94%A8-351498fc-850a-45da-b7b6-27e523b8702a)

# 安装

在composer.json中添加

~~~
"thefunpower/two-factor": "dev-main" 
~~~

## 使用

1.初始化
~~~
$factor = new \TwoFactor();
$factor->label = "验证器名称";
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
$factor->label  = "验证器名称";
$factor->secret = '秘钥';
echo  'verify: ' . $factor->verify('437388');
exit;
~~~

## 演示

~~~
$factor = new \TwoFactor();
$factor->label = "验证器名称";
$factor->init();
$text = $factor->text();
echo "<img src='/sys/qr?data=" . urlencode($text) . "' />"; 
$factor->secret = '秘钥';
echo  'verify: ' . $factor->verify('437388');
~~~

### 开源协议 

[Apache License 2.0](LICENSE)