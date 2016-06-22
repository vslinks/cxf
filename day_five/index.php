<?php
    if(!empty($_POST)){
        //>>1 获取传入的参数
        $hickey = $_POST['hickey'];//接口名称
        $method = $_POST['method'];//请求方式
        $input = isset($_POST['input'])?$_POST['input']:null;//输入参数
        //>>2.调用curl请求相应接口
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $hickey);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        switch($method){
            case  'get':
                curl_setopt($ch, CURLOPT_HEADER, 0);
                break;
            case 'post':
                //>>进行正则替换:
                if(is_null($input)){
                    echo "传入参数不正确";
                    exit;
                }
                $pattern = '/(\'|\"|)([a-zA-z.0-9]+)(\'|\"|)\s*:\s*(\'|\"|)([a-zA-z.0-9]+)(\'|\"|)/';
                $replacement  = '"$2":"$5"';
                $input =preg_replace($pattern,$replacement,$input);
                //>>数组转换为请求参数形式
                $jsonArray = json_decode($input,true);//转换为数组
                if(!$jsonArray){
                    echo "传入参数格式不正确";
                    exit;
                }
                $data = http_build_query($jsonArray);
                curl_setopt($ch,CURLOPT_POST,1);
                curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        }

        //>>3.获取返回数据
        $res = curl_exec($ch);
        curl_close($ch);
    }

?>

<div style="width: 600px;margin: 100px auto">
    <h2 style="position:relative;left: 120px">接口测试工具</h2>
<form action="index.php" method="post">
     接口名称:<input type="text" name="hickey" value="<?php echo isset($hickey)?$hickey:''; ?>" style="width: 300px;margin-bottom:15px"/></br>
     请求方式:<select name="method" style="width: 300px;margin-bottom:15px"  class="method">
        <option value="post" <?php echo isset($method) && ($method == 'post')?'selected':''; ?>>post</option>
        <option value="get" <?php echo isset($method) && ($method == 'get')?'selected':''; ?>>get</option>
    </select></br>
     <label style="position: relative;top: -100px">输入参数:</label><textarea name="input" style="width: 300px;height: 100px;margin-bottom:15px">
        <?php echo isset($input)?$input:''; ?>
    </textarea></br>
     <label style="position: relative;top: -100px">输出参数:</label><textarea name="output" readonly="readonly" style="width: 300px;height: 100px;margin-bottom:15px">
        <?php echo isset($res)?$res:''; ?>
    </textarea></br>
    <input type="submit" value="请求" style="margin: 15px 150px"/>
</form>
</div>
