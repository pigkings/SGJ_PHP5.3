<?php
// +----------------------------------------------------------------------
// | OpenCMF [ Simple Efficient Excellent ]
// +----------------------------------------------------------------------
// | Copyright (c) 2014  All rights reserved.
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------
/**
 * 发送邮件列表里的邮件
 */
if (D('Admin/Addon')->where('name="Email" and status="1"')->count()) {
    $sql = 'SELECT COUNT(*) FROM information_schema.tables WHERE table_schema = "' . C('DB_NAME') . '" AND table_name = "' . C('DB_PREFIX') . 'addon_email";';
    $exist = M('')->query($sql);
    if ($exist[0]['COUNT(*)'] === '1') {
        $email_object = D('Addons://Email/Email');
        $info = $email_object->where(array('status' => 1, 'is_sent' => 0))->order('id asc')->find();
        do {
            $result = false;
            $result = $email_object->send($info);
            if ($result) {
                $email_object->where(array('id' => $info['id']))->setField('is_sent', 1);
            } else {
                $email_object->where(array('id' => $info['id']))->setField('status', 0);
            }
            $info = $email_object->where(array('status' => 1, 'is_sent' => 0))->order('id asc')->find();
        } while ($info);
    }
}
