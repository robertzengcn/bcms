<?php

class SysCloudService extends BaseService {

    /**
     * 同步
     */
    public $introduce;

    public $contact;

    public $environment;

    public $honor;

    public $device;

    public function synchro() {
        $this->getData($_REQUEST['data']);
        $result = $this->allOperation();
        if (count($result)) {
            return $this->success($result);
        } else {
            return $this->success(1);
        }
    }

    /**
     * 添加到简介表中...
     */
    public function addToIntroduce() {
        $introduceS = new IntroduceService();
        $introduce = $introduceS->get()->data;
        $data = $this->introduce;
        if ($data['pic'] != '' || $data['introduce'] != '') {
			if ($data['pic'] != $introduce->pic) {
				@unlink ( UPLOAD . $introduce->pic );
				$data ['pic'] = str_replace ( '/images', 'http://imgcms.qqyy.com', $data ['pic'] );
				$data ['pic'] = $this->getPic ( $data ['pic'], 'hospital' );
				$introduce->pic = $data ['pic'];
			}
			unset ( $introduce->src );
			if($data['introduce'] != '' && $data['introduce'] != $introduce->content){
				$introduce->content = $data ['introduce'];
			}
			$result = $introduceS->update ( $introduce );
			if (! $result->statu) {
				throw new ValidatorException ( 148 );
			}
		}
    }

    /**
     * 添加到联系表中...
     *
     * @throws ValidatorException
     */
    public function addToContact() {
        $contactS = new ContactService();
        $title = array();
        foreach ($this->contact as $key => $value) {
            $result = $contactS->query(array(
                'name' => $key
            ));
            $data = $result->data;
            //print_r($data);exit;
            if (count($data) >= 1) {
                $array = $result->data;
                $contact = $array[0];
                if (isset($contact->val) && $contact->val != '') {
                    $contact->val = $value;
                    $contact->obj = 'contact';
                    $title[] = $contact;
                }else{
                	$contact->val = $value;
                	$contactS->update($contact);
                }
            } else {
                $contact = new Contact();
                $contact->name = $key;
                $contact->val = $value;
                $contact->flag = '';
                $contact->is_retain = 0;
                $re = $contactS->save($contact);
                if (! $re->statu) {
                    throw new ValidatorException(148);
                }
            }
        }
        return $title;
    }

    /**
     * 所有的操作
     *
     * @return Ambiguous
     */
    public function allOperation() {
    	set_time_limit(0);
    	$this->addToIntroduce();
        $contact = $this->addToContact();
        $title = array();
        $deviceS = new DeviceService();
        $environmentS = new EnvironmentService();
        $honorS = new HonorService();
        $device = $this->getQuery($this->device, $deviceS, 'device');
        $environment = $this->getQuery($this->environment, $environmentS, 'environment');
        $honor = $this->getQuery($this->honor, $honorS, 'honor');
        // 进行添加
        if (count($this->device) >= 1) {
            $this->add($this->device, $deviceS, 'Device');
        }
        if (count($this->environment) >= 1) {
            $this->add($this->environment, $environmentS, 'Environment');
        }
        if (count($this->honor) >= 1) {
            $this->add($this->honor, $honorS, 'honor');
        }
        $title = $this->integration($contact, $title);
        $title = $this->integration($device, $title);
        $title = $this->integration($environment, $title);
        $title = $this->integration($honor, $title);

        return $title;
    }

    /**
     * 修改数据..
     *
     * @return Ambiguous
     */
    public function update() {
    	//print_r($_REQUEST);exit;
        $name = ucfirst($_REQUEST['data']['obj']);
        unset($_REQUEST['data']['obj']);
        $className = $name . 'Service';
        $service = new $className();
        $entity = new $name();
        foreach ($_REQUEST['data'] as $key => $value) {
        	/*if ($key == 'pic'){
        		$value = str_replace('images.qqyy.com', 'imgcms.qqyy.com', $value);
        	}*/
            if (! $entity->$key) {
                $entity->$key = $value;
            }
        }
        $result = $service->update($entity);
        return $result;
    }

    /**
     * 整合数据..
     */
    public function integration($data, $array) {
        foreach ($data as $value) {
            $array[] = $value;
        }
        return $array;
    }

    /**
     * 添加到数据表
     *
     * @param unknown_type $data
     * @param unknown_type $service
     * @param unknown_type $obj
     * @throws ValidatorException
     */
    public function add($data, $service, $obj) {
        foreach ($data as $value) {
            $entity = new $obj();
            $entity->subject = $value['title'];
            foreach ($value as $k => $v) {
                if (! isset($entity->$k)) {
                    if ($k == 'pic') {
                    	$v = str_replace('images.qqyy.com', 'imgcms.qqyy.com', $v);
                    	//var_dump($v);exit;
                    	$v = $this->getPic($v, strtolower($obj));
                    }
                    $entity->$k = $v;
                }
            }
            $re = $service->save($entity);
            if (! $re->statu) {
                throw new ValidatorException(148);
            }
        }
    }

    /**
     * 查询出已存在的数据
     *
     * @param unknown_type $data
     * @param unknown_type $service
     * @return Ambigous <multitype:, string>
     */
    public function getQuery($data, $service, $obj) {
        $array = $data;
        $arr = array();
        foreach ($array as $key => $value) {
            $result = $service->query(array(
                'subject' => $value['title']
            ));
            $data = $result->data;
            if (count($data) >= 1) {
                $data = $data[0];
                $data->obj = $obj;
                foreach ($value as $k => $v) {
                    if ($k == 'pic') {
                    	$v = str_replace('images.qqyy.com', 'imgcms.qqyy.com', $v);
                        $v = $this->getPic($v, strtolower($obj));
                    }
                    $data->$k = $v;
                }
                $arr[] = $data;
                unset($array[$key]);
            }
        }
        $this->$obj = $array;
        return $arr;
    }

    /**
     * 根据接口获取数据 .
     * ..
     */
    public function getData($array) {
        $this->contact = $this->curlData('http://yyk.qqyy.com/interface/contact.aspx?username=' . $array['user'] . '&pwd=' . $array['pwd']);
        $this->environment = $this->curlData('http://yyk.qqyy.com/interface/enviroment.aspx?username=' . $array['user'] . '&pwd=' . $array['pwd']);
        $this->honor = $this->curlData('http://yyk.qqyy.com/interface/honor.aspx?username=' . $array['user'] . '&pwd=' . $array['pwd']);
        $this->device = $this->curlData('http://yyk.qqyy.com/interface/device.aspx?username=' . $array['user'] . '&pwd=' . $array['pwd']);
        $this->introduce = $this->specialData('http://yyk.qqyy.com/interface/introduce.aspx?username=' . $array['user'] . '&pwd=' . $array['pwd']);
    }

    /**
     * 特殊数据处理...
     */
    public function specialData($url) {
        $lines = file($url);
        $content = '';
        foreach ($lines as $line) {
            $content .= trim($line);
        }
        $content = str_replace(array(
            '="',
            '">'
        ), array(
            "='",
            "'>"
        ), $content);
        $data = json_decode($content, true);
        return $data;
    }

    /**
     * 利用 curl获取远程数据
     *
     * @param unknown_type $url
     * @return mixed
     */
    public function curlData($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Expect: '
        ));
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $data = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($data, true);
        return $data;
    }

    /**
     * 获取图片名称
     *
     * @param unknown_type $string
     */
    public function getPic($string, $home) {	
        $picname = substr($string, strrpos($string, '/') + 1);
        //copy($string, '../upload/'.$home . '/' . $picname);
        $this->getImage($string,'../upload/'.$home . '/' . $picname,1);
        return $home . '/' . $picname;
    }
    
	/**
	 * 获取图片到本地...
	 */
	public function getImage($url,$filename='',$type=0){
    	if($url==''){return false;}
    	if($filename==''){
        	$ext=strrchr($url,'.');
        	if($ext!='.gif' && $ext!='.jpg'){return false;}
        	$filename=time().$ext;
    	}
    	//文件保存路径 
    	if($type){
  			$ch=curl_init();
  			$timeout=5;
  			curl_setopt($ch,CURLOPT_URL,$url);
  			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  			curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
  			$img=curl_exec($ch);
  			curl_close($ch);
    	}else{
     		ob_start(); 
     		readfile($url);
     		$img=ob_get_contents(); 
     		ob_end_clean(); 
    	}
    	$size=strlen($img);
    	//文件大小 
    	$fp2=@fopen($filename,'a');
    	fwrite($fp2,$img);
    	fclose($fp2);
    	return $filename;
	}
}
