# 云端黑名单系统
本系统最初设计为Ivory BDS Launcher的云端黑名单系统，用于为所有使用IBL的腐竹提供危险玩家信息。

IBL使用需要保留getversion.php和getblack.php

其在启动时和备份时将自动请求getversion.php获取最后修改时间，若与本地记录不一致则会通过getblack拉取所有云黑数据。

我们倡导大家共享所有熊孩子信息，若您不希望共享，我们也提供查询模式（自行删除get*.php和index.php）

用户界面：`index.php`（建议搭建完毕后删除）

管理员界面：`admin.php`

初始管理员用户名和密码均为admin

查熊孩：`query.php?username=<熊孩子用户名>`

存在记录返回值：`<熊孩子用户名>,<封禁等级>,<封禁原因>`

不存在返回值：`Not Found!`

## 熊孩等级规范：
```
1级 - 品行不端者：品行不端（如嘴臭、散步谣言）但没有破坏性（不开挂不炸服）的玩家。
2级 - 有破坏倾向：利用职务之便炸服的管理员，扬言报复任何服务器的玩家。无法确认其是否使用外挂或确认其不使用外挂。
3级 - 危险玩家：使用外挂的恶意玩家，或炸服超过3个以上，造谣诽谤抹黑造成严重后果的，侵犯他人隐私权的，使用网络工具攻击他人服务器的。

```


## 在Debian 10上安装：
```
sudo su
cd /var/www/
git clone https://github.com/VoryWork/CloudBlackList.git
apt install nginx php7.2-common php7.2-fpm php7.2-cli php7.2-json
cd CloudBlackList
php init.php
chown www-data:www-data /var/www/CloudBlackList/ -R
# 如果无法编辑熊孩子请检查文件夹是否可读写，多半是chown设置不正确
```
nginx配置文件：
```
server {
    listen 80;
    listen [::]:80;
    server_name qiangda.example.com;
    root /var/www/CloudBlackList;
    index index.html;
    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php7.2-fpm.sock;
    }
    location ~ ^/(?:\.db){
        deny all;
    }
}