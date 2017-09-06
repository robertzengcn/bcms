#!/bin/bash

self_exec="$0"

usage ()
{
    echo ""
    echo "sudo $self_exec 根目录，如："
    echo "sudo $self_exec /alidata/www/default/boyicms/"
    echo "" 
    echo "" 
    exit 1
}  

if [ $# -ne 1 ] ;then
     echo "缺少参数，请指定站点根目录!"
     usage
fi

#目录为apache权限
chown -R www:www $1

#开启目录及文件读写权限
chmod -R 777 $1/hcc
chmod 777 $1/controller
chmod -R 777 $1/controller/mobile

chmod 777 $1/kernel
chmod -R 777 $1/kernel/dao
chmod -R 777 $1/kernel/entity
chmod -R 777 $1/kernel/exception
chmod -R 777 $1/kernel/test

chmod -R 777 $1/mobile

chmod 777 $1/interface
chmod -R 777 $1/plugin
chmod -R 777 $1/upload

chmod -R 777 $1/tagobj

chmod 777 $1/template_c
chmod 777 $1/tpl
chmod 777 $1/tpl/related
chmod 777 $1/tpl/config.json

chmod 777 $1/topic
chmod -R 777 $1/topic/1
chmod 777 $1/dynapage
chmod 777 $1/lib
chmod 777 $1/log

echo ""
echo "init Success!"
echo ""
exit
