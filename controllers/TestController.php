<?php
namespace controllers;

class TestController 
{
    public function testConfig()
    {
        $re = config('redis');
        $db = config('db');

        echo '<pre>';
        var_dump($re);

        var_dump($db);
    }

    public function register()
    {
        // 注册成功

        // 发邮件
        $redis = \libs\Redis::getInstance();

        // 消息队列的信息
        $data = [
            'email' => 'qzyb_sw@126.com',
            'title' => '标题',
            'content' => '内容',
        ];

        // 数组转成 JSON
        $data = json_encode($data);

        $redis->lpush('email', $data);

        echo '注册成功！';
    }

    // 发邮件
    public function mail()
    {
        // 设置 socket 永不超时
        ini_set('default_socket_timeout', -1);

        echo "邮件程序已启动....等待中...";

        $redis = \libs\Redis::getInstance();

        // 循环监听一个列表
        while(true)
        {
            // 从队列中取数据，设置为永久不超时
            $data = $redis->brpop('email', 0);

            echo '开始发邮件';
            // 处理数据
            var_dump($data);
            echo "发完邮件，继续等待\r\n";
        }
    }

    public function testMail1()
    {
        $mail = new \libs\Mail;
        $mail->send('测试meila类', '测试mail类', ['qzyb_sw@126.com', '孙威']);
    }

    public function testMail()
    {
        // 设置邮件服务器账号
        $transport = (new \Swift_SmtpTransport('smtp.126.com', 25))  // 邮件服务器IP地址和端口号
        ->setUsername('qzyb_sw@126.com')       // 发邮件账号
        ->setPassword('sun021028wei');      // 授权码

        // 创建发邮件对象
        $mailer = new \Swift_Mailer($transport);

        // 创建邮件消息
        $message = new \Swift_Message();

        $message->setSubject('测试标题')   // 标题
                ->setFrom(['qzyb_sw@126.com' => '全栈1班'])   // 发件人
                ->setTo(['qzyb_sw@126.com', 'qzyb_sw@126.com' => '孙威'])   // 收件人
                ->setBody('Hello <a href="http://localhost:9999">点击激活</a> World ~', 'text/html');     // 邮件内容及邮件内容类型

        // 发送邮件
        $ret = $mailer->send($message);

        var_dump( $ret );
    }
}
