## 基于laravel+element-plus个人博客

### 安装

### git安装
```shell
   git clone https://github.com/yinweiyi/blog.git
```

### 安装依赖
```shell
    cd blog
    composer install
```

### 配置权限
```shell
    sudo chmod -R 777 storage
```

### 配置配置文件
```shell
  cp .env.example .env
```

### 初始化数据库
```shell
    php artisan migrate --seed
```

### 软链接
```shell
   php artisan storage:link
```
