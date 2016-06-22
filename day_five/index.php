<?php
    if(!empty($_POST)){
        //>>1 ��ȡ����Ĳ���
        $hickey = $_POST['hickey'];//�ӿ�����
        $method = $_POST['method'];//����ʽ
        $input = isset($_POST['input'])?$_POST['input']:null;//�������
        //>>2.����curl������Ӧ�ӿ�
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $hickey);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        switch($method){
            case  'get':
                curl_setopt($ch, CURLOPT_HEADER, 0);
                break;
            case 'post':
                //>>���������滻:
                if(is_null($input)){
                    echo "�����������ȷ";
                    exit;
                }
                $pattern = '/(\'|\"|)([a-zA-z.0-9]+)(\'|\"|)\s*:\s*(\'|\"|)([a-zA-z.0-9]+)(\'|\"|)/';
                $replacement  = '"$2":"$5"';
                $input =preg_replace($pattern,$replacement,$input);
                //>>����ת��Ϊ���������ʽ
                $jsonArray = json_decode($input,true);//ת��Ϊ����
                if(!$jsonArray){
                    echo "���������ʽ����ȷ";
                    exit;
                }
                $data = http_build_query($jsonArray);
                curl_setopt($ch,CURLOPT_POST,1);
                curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        }

        //>>3.��ȡ��������
        $res = curl_exec($ch);
        curl_close($ch);
    }

?>

<div style="width: 600px;margin: 100px auto">
    <h2 style="position:relative;left: 120px">�ӿڲ��Թ���</h2>
<form action="index.php" method="post">
     �ӿ�����:<input type="text" name="hickey" value="<?php echo isset($hickey)?$hickey:''; ?>" style="width: 300px;margin-bottom:15px"/></br>
     ����ʽ:<select name="method" style="width: 300px;margin-bottom:15px"  class="method">
        <option value="post" <?php echo isset($method) && ($method == 'post')?'selected':''; ?>>post</option>
        <option value="get" <?php echo isset($method) && ($method == 'get')?'selected':''; ?>>get</option>
    </select></br>
     <label style="position: relative;top: -100px">�������:</label><textarea name="input" style="width: 300px;height: 100px;margin-bottom:15px">
        <?php echo isset($input)?$input:''; ?>
    </textarea></br>
     <label style="position: relative;top: -100px">�������:</label><textarea name="output" readonly="readonly" style="width: 300px;height: 100px;margin-bottom:15px">
        <?php echo isset($res)?$res:''; ?>
    </textarea></br>
    <input type="submit" value="����" style="margin: 15px 150px"/>
</form>
</div>
