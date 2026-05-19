# Dcat Admin Demo

[![PHP](https://img.shields.io/badge/PHP-%3E%3D8.3-777BB4?logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)

> [PrintNow/dcat-admin](https://github.com/PrintNow/dcat-admin) 的在线演示项目。

> **WIP** — 本项目正在开发中，功能和文档可能随时变动。

## 环境要求

- PHP >= 8.3
- Composer
- Node.js & npm
- MySQL / PostgreSQL / SQLite

## 快速开始

```bash
# 1. 克隆仓库
git clone https://github.com/PrintNow/dcat-admin-demo.git
cd dcat-admin-demo

# 2. 安装依赖 & 初始化（自动复制 .env、生成 key、迁移数据库、构建前端）
composer run setup

# 3. 安装 dcat-admin
composer require printnow/dcat-admin

# 4. 发布资源 & 初始化 admin
php artisan admin:install

# 5. 启动开发服务器
composer run dev
```

访问 `http://localhost:8000/admin`，默认账号密码：

| 账号 | 密码 |
|------|------|
| admin | admin |

## 相关仓库

- **包源码**：[PrintNow/dcat-admin](https://github.com/PrintNow/dcat-admin)

## License

[MIT](LICENSE)
