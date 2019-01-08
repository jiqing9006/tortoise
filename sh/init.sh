#!/bin/bash
# 初始化小程序后台
# 增加灵活性 支持密码设置
password=$1
if test -z "$password"
then
    password="123456"
fi #ifend

if [ ! -d "sh" ];
then
    cd ..
fi

# 进入APP目录下
cd App

# 清理runtime文件夹
if [ ! -d  "Runtime" ];then
    echo $password|sudo -S mkdir Runtime
    echo $password|sudo -S chmod -R 777 Runtime
else
    echo $password|sudo -S rm -rf Runtime/*
fi


# 创建public下的site_upload文件夹
cd ../Public
if [ ! -d "site_upload" ];
then
    echo $password|sudo -S mkdir site_upload
    echo $password|sudo -S chmod -R 777 site_upload
else
    echo $password|sudo -S chmod -R 777 site_upload
fi


echo "操作成功"
exit
