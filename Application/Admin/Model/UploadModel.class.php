<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
namespace Admin\Model;
use Think\Model;
use Think\Upload;
/**
 * 上传模型

 */
class UploadModel extends Model {
    /**
     * 数据库表名

     */
    protected $tableName = 'admin_upload';

    /**
     * 自动验证规则

     */
    protected $_validate = array (
        array('name', 'require', '文件名不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('path', 'require', '文件不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('size', 'require', '文件大小不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('md5', 'require', '文件Md5编码不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
        array('sha1', 'require', '文件Sha1编码不能为空', self::EXISTS_VALIDATE, 'regex', self::MODEL_BOTH),
    );

    /**
     * 自动完成规则

     */
    protected $_auto = array (
        array('uid', 'is_login', self::MODEL_INSERT, 'function'),
        array('create_time', 'time', self::MODEL_INSERT, 'function'),
        array('update_time', 'time', self::MODEL_BOTH, 'function'),
        array('status', '1', self::MODEL_INSERT),
    );

    /**
     * 查找后置操作

     */
    protected function _after_find(&$result, $options) {
        //获取上传文件的地址
        if ($result['url']) {
            $result['real_path'] = $result['url'];
        } else {
            if (C('STATIC_DOMAIN')) {
                $result['real_path'] = C('STATIC_DOMAIN').$result['path'];
            } else {
                $result['real_path'] = C('HOME_PAGE').$result['path'];
            }
        }
        if (in_array($result['ext'], array('jpg', 'jpeg', 'png', 'gif', 'bmp') )) {
            $result['show'] = '<img class="picture" src="'.$result['real_path'].'">';
        } else {
            $result['show'] = '<img class="picture" src="'.C('TMPL_PARSE_STRING.__HOME_IMG__').'/file/'.$result['ext'].'.png">';
        }
    }

    /**
     * 查找后置操作

     */
    protected function _after_select(&$result, $options) {
        foreach($result as &$record){
            $this->_after_find($record, $options);
        }
    }

    /**
     * curl模拟上传文件

     */
    public function curlUploadFile($url, $filename, $formname = 'file') {
        // 上传token
        $upload_token = \Org\Util\String::randString(32,1);
        S('upload_token', $upload_token, array('prefix' => ENV_PRE.'Home_', 'expire' => 300));

        // curl
        if (version_compare(phpversion(),'5.5.0') >= 0 && class_exists('CURLFile')) {
            $post_data = array(
                $formname => new \CURLFile(realpath($filename)),
            );
        } else {
            $post_data = array(
                $formname => '@'.realpath($filename),
            );
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('uploadtoken: '. $upload_token ));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * 裁剪图片

     */
    public function crop($data = null) {
        $image = new \Think\Image();
        $image->open($data['src']);
        $type = $image->type();
        if ($image) {
            $file = './Runtime/Temp/crop'.\Org\Util\String::randString(12,1).'.'.$type;
            $url  = U(MODULE_MARK."/Upload/upload", null, true, true);

            // 图片缩放计算
            $sw = $sh = 1;
            if ($data['vw']) {
                $sw = $image->width()/$data['vw'];
            }
            if ($data['vh']) {
                $sh = $image->height()/$data['vh'];
            }

            // 裁剪并保存
            $image->crop($data['w']*$sw, $data['h']*$sh, $data['x']*$sh, $data['y']*$sh)->save($file);
            $result = $this->curlUploadFile($url, $file);
            return json_decode($result, true);
        }
    }

    /**
     * 上传文件

     */
    public function upload($files) {
        // 获取文件信息
        $_FILES = $files ? $files : $_FILES;

        // 返回标准数据
        $return = array('error' => 0, 'success' => 1, 'status' => 1);
        $dir = I('request.dir') ? I('request.dir') : 'image';   // 上传类型image、flash、media、file
        if (!in_array($dir, array('image', 'flash', 'media', 'file'))) {
            $return['error']   = 1;
            $return['success'] = 0;
            $return['status']  = 0;
            $return['message'] = '缺少上传参数！';
            return $return;
        }

        // 上传文件钩子，用于七牛云、又拍云等第三方文件上传的扩展
        hook('UploadFile', $dir);

        // 根据上传文件类型改变上传大小限制
        $upload_config = C('UPLOAD_CONFIG');
        if ($_GET['temp'] === 'true') {
            $upload_config['rootPath'] = './Runtime/';
        }
        $upload_driver = C('UPLOAD_DRIVER');
        if (!$upload_driver) {
            $return['error']   = 1;
            $return['success'] = 0;
            $return['status']  = 0;
            $return['message'] = '无效的文件上传驱动';
            return $return;
        }

        if ($dir == 'image') {
            if (C('UPLOAD_IMAGE_SIZE')) {
                $upload_config['maxSize'] = C('UPLOAD_IMAGE_SIZE')*1024*1024;  // 图片的上传大小限制
            }
        } else {
            if (C('UPLOAD_FILE_SIZE')) {
                $upload_config['maxSize'] = C('UPLOAD_FILE_SIZE')*1024*1024;  // 普通文件上传大小限制
            }
        }

        // 上传配置
        $ext_arr = array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb', 'mp4'),
            'file'  => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'wps', 'txt', 'zip', 'rar', 'gz', 'bz2', '7z', 'ipa', 'apk', 'dmg', 'iso'),
        );

        // 计算文件散列以查看是否已有相同文件上传过
        $reay_file = array_shift($_FILES);
        $con['md5']  = md5_file($reay_file['tmp_name']);
        $con['sha1'] = sha1_file($reay_file['tmp_name']);
        $con['size'] = $reay_file['size'];
        $upload = $this->where($con)->find();
        if ($upload) {  // 发现相同文件直接返回
            $return['id']   = $upload['id'];
            $return['name'] = $upload['name'];
            $return['url']  = $upload['real_path'];
            $return['path'] = '.' . $upload['path'];
        } else {
            // 上传文件
            $upload_config['removeTrash'] = array($this, 'removeTrash');
            $upload = new Upload($upload_config, $upload_driver, C("UPLOAD_{$upload_driver}_CONFIG"));  // 实例化上传类
            $upload->exts = $ext_arr[$dir] ? $ext_arr[$dir] : $ext_arr['image'];    // 设置附件上传允许的类型，注意此处$dir为空时漏洞
            $info = $upload->uploadOne($reay_file);  // 上传文件
            if (!$info) {
                $return['error']    = 1;
                $return['success']  = 0;
                $return['status']  = 0;
                $return['message']  = '上传出错'.$upload->getError();
            } else {
                // 获取上传数据
                if ($_GET['temp'] === 'true') {
                    $upload_data['name']  = $info["name"];
                    $upload_data['path']  = '/Runtime/' . $info['savepath'] . $info['savename'];
                    $upload_data['url']   = $info["url"] ? : '';

                    // 返回数据
                    if ($upload_data["url"]) {
                        $return['url'] = $upload_data['url'];
                    } else {
                        $return['url'] = __ROOT__ . $upload_data['path'];
                    }
                    $return['path'] = '.' . $upload_data['path'];
                    $return['name'] = $upload_data['name'];
                } else {
                    $upload_data['type']  = $info["type"];
                    $upload_data['name']  = $info["name"];
                    $upload_data['path']  = '/Uploads/' . $info['savepath'] . $info['savename'];
                    $upload_data['url']   = $info["url"] ? : '';
                    $upload_data['ext']   = $info["ext"];
                    $upload_data['size']  = $info["size"];
                    $upload_data['md5']   = $info['md5'];
                    $upload_data['sha1']  = $info['sha1'];
                    $upload_data['location']  = $upload_driver;

                    // 返回数据
                    $result = $this->create($upload_data);
                    $result = $this->add($result);
                    if ($result) {
                        if ($info["url"]) {
                            $return['url'] = $upload_data['url'];
                        } else {
                            $return['url'] = __ROOT__ . $upload_data['path'];
                        }
                        $return['path'] = '.' . $upload_data['path'];
                        $return['name'] = $upload_data['name'];
                        $return['id'] = $result;
                    } else {
                        $return['error']   = 1;
                        $return['success'] = 0;
                        $return['status']  = 0;
                        $return['message'] = '上传出错'.$this->error;
                    }
                }
                
            }
        }
        return $return;
    }

    /**
     * 下载指定文件
     * @param  number  $root 文件存储根目录
     * @param  integer $id   文件ID
     * @param  string  $args 回调函数参数
     * @return boolean false-下载失败，否则输出下载文件
     */
    public function download($id, $callback = null, $args = null) {
        // 获取下载文件信息
        $file = $this->find($id);
        if (!$file) {
            $this->error = '不存在该文件！';
            return false;
        }
        // 下载文件
        switch ($file['location']) {
            case 'Local':  // 下载本地文件
                return $this->downLocalFile($file, $callback, $args);
            default:
                $this->error = '不支持的文件存储类型！';
                return false;
        }
    }

    /**
     * 下载本地文件
     * @param  array    $file     文件信息数组
     * @param  callable $callback 下载回调函数
     * @param  string   $args     回调函数参数
     * @return boolean            下载失败返回false
     */
    private function downLocalFile($file, $callback = null, $args = null) {
        $fiel_path = '.'.$file['path'];
        if (file_exists($fiel_path)) {
            // 调用回调函数
            is_callable($callback) && call_user_func($callback, $args);

            // 新增下载数
            $this->where(array('id' => $file['id']))->setInc('download');

            // 执行下载
            header("Content-Description: File Transfer");
            header('Content-type: ' . $file['type']);
            header('Content-Length:' . $file['size']);
            if (preg_match('/MSIE/', $_SERVER['HTTP_USER_AGENT'])) {  // for IE
                header('Content-Disposition: attachment; filename="' . rawurlencode($file['name']) . '"');
            } else {
                header('Content-Disposition: attachment; filename="' . $file['name'] . '"');
            }
            readfile($fiel_path);
            exit;
        } else {
            $this->error = '文件已被删除！';
            return false;
        }
    }

    /**
     * KindEditor编辑器文件管理

     */
    public function fileManager($only_image = false) {
        // 根目录路径，可以指定绝对路径，比如 /var/www/attached/
        $root_path = './Uploads/';

        // 根目录URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
        $root_url = __ROOT__ . '/Uploads';

        // 图片扩展名
        $ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');

        if ($dir_name !== '') {
            $root_path .= $dir_name . "/";
            $root_url .= $dir_name . "/";
            if (!file_exists($root_path)) {
                mkdir($root_path);
            }
        }

        // 根据path参数，设置各路径和URL
        if (empty($_GET['path'])) {
            $current_path = realpath($root_path) . '/';
            $current_url = $root_url;
            $current_dir_path = '';
            $moveup_dir_path = '';
        } else {
            $current_path = realpath($root_path) . '/' . $_GET['path'];
            $current_url = $root_url . $_GET['path'];
            $current_dir_path = $_GET['path'];
            $moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
        }

        // 排序形式，name or size or type
        $order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);

        // 不允许使用..移动到上一级目录
        if (preg_match('/\.\./', $current_path)) {
            echo 'Access is not allowed.';
            exit;
        }
        // 最后一个字符不是/
        if (!preg_match('/\/$/', $current_path)) {
            echo 'Parameter is not valid.';
            exit;
        }
        // 目录不存在或不是目录
        if (!file_exists($current_path) || !is_dir($current_path)) {
            echo 'Directory does not exist.';
            exit;
        }

        // 遍历目录取得文件信息
        $file_list = array();
        if ($handle = opendir($current_path)) {
            $i = 0;
            while (false !== ($filename = readdir($handle))) {
                if ($filename{0} == '.') continue;
                $file = $current_path . $filename;
                if (is_dir($file)) {
                    $file_list[$i]['is_dir'] = true; //是否文件夹
                    $file_list[$i]['has_file'] = (count(scandir($file)) > 2);  // 文件夹是否包含文件
                    $file_list[$i]['filesize'] = 0;      // 文件大小
                    $file_list[$i]['is_photo'] = false;  // 是否图片
                    $file_list[$i]['filetype'] = '';     // 文件类别，用扩展名判断
                } else {
                    $file_list[$i]['is_dir'] = false;
                    $file_list[$i]['has_file'] = false;
                    $file_list[$i]['filesize'] = filesize($file);
                    $file_list[$i]['dir_path'] = '';
                    $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
                    $file_list[$i]['filetype'] = $file_ext;
                }
                if ($only_image === true
                    && $file_list[$i]['is_dir'] === false
                    && $file_list[$i]['is_photo'] === false) {
                    unset($file_list[$i]);
                } else {
                    $file_list[$i]['filename'] = $filename;  // 文件名，包含扩展名
                    $file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file));  // 文件最后修改时间
                    $i++;
                }
            }
            closedir($handle);
        }

        usort($file_list, 'cmp_func');

        $result = array();

        // 相对于根目录的上一级目录
        $result['moveup_dir_path'] = $moveup_dir_path;

        // 相对于根目录的当前目录
        $result['current_dir_path'] = $current_dir_path;

        // 当前目录的URL
        $result['current_url'] = $current_url;

        // 文件数
        $result['total_count'] = count($file_list);

        // 文件列表数组
        $result['file_list'] = $file_list;

        // 返回JSON数据
        return json_encode($result);
    }
}
