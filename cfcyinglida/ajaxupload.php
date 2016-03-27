<?php
/**
 * Ajax 上传类库
 * @date 2013/4/17
 * @author jinliang.zhang <zjl_bm@163.com>
 */
class AjaxUpload {
    private $form_name;  //文件form名称
    private $ext_arr;    //允许上传的文件后缀
    private $upload_dir; //上传目录
    private $file_size;  //文件大小
    private $name_f; //文件名称
    
    public function __construct($form_name, $file_size, $name_f) {
        //初始化属性
        $this->form_name = $form_name;
        $this->ext_arr = array(
            '.jpg',
            '.png',
            '.gif',
            '.jpeg'
        );
        $this->upload_dir = dirname(__FILE__).'/qzyzh/';
        $this->name_f = $name_f;
        $this->file_size = $file_size;
        $this->upload();
    }

    public function __set($key, $val) {
        $this->$key = $val;
    }

    /**
     * Ajax 无刷新上传图片（jpg|gif|png）
     * @param bool $return_arr 是否返回数组，前提是上传成功
     * @return (array)? || output
     */
    public function upload($return_arr=false) {
        if (!is_dir($this->upload_dir)) mkdir($this->upload_dir, 0777); //上传目录不存在则创建
        $file = $_FILES[$this->form_name];
        if ($file['error']==1 || $file['size']>($this->file_size*1024)) exit('1'); //上传失败，图片不能大于 $this->file_size k！
        switch ($file['error']) {
            case 3:
                exit('3'); //图片只有部分文件被上传，请重新上传！
                break;
            case 4:
                exit('4'); //没有任何文件被上传！
                break;
        }
        $ext = $this->getExt($file['name']);
        if (!in_array($ext, $this->ext_arr)) exit('5'); //非图片类型，请上传jpg|png|gif图片！
        $fname = $this->name_f . $ext; //图片名称
        $filename = $this->upload_dir . '/' . $fname;
        if (!move_uploaded_file($file['tmp_name'], $filename)) { //执行上传
            exit('upload error!'); //上传失败，错误未知
        } else {
            $arr = array('ok'=>1, 'filename'=> '/qzyzh/'.$fname, 'size'=>$file['size']);
            if ($return_arr) return $arr;
            else {
                exit(json_encode(array('ok'=>$arr['ok'], 'filename'=>$arr['filename'])));
            }
        }
    }

    /**
     * 获取文件后缀名
     * @param string $file_name 文件名称
     * @return string
     */
    private function getExt($file_name) {
        $ext = strtolower(strrchr($file_name, "."));
        return $ext;
    }
}
if($_POST) {
    $form_name = $_GET['form_name'];
    $name_f = $_GET['name_f']; //文件名字
    $file_size = intval($_GET['file_size']);
    $upload = new AjaxUpload($form_name, $file_size, $name_f);
}
?>
