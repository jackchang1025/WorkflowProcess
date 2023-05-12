## Workflow Process

### 安装
 - composer install 
 - npm install 
 - npm run dev

### 配置
#### Vagrant Homestead 中配置 Laravel 调度程序，需要在虚拟机中添加一个 Cron 任务，以便每分钟运行 schedule:run 命令
启动并登录到 Homestead 虚拟机

运行以下命令以启动并 SSH 进入你的 Homestead 虚拟机：

```bash
cd ~/Homestead
vagrant up
vagrant ssh
```

创建一个 Cron 任务

在 Homestead 虚拟机中，运行以下命令以打开 Cron 配置文件：

```bash
sudo crontab -e
```

选择你喜欢的文本编辑器（例如，选择 nano）。

添加 Cron 配置项

在 Cron 配置文件的末尾，添加以下内容：

```bash
* * * * * cd /path/to/your/project && php artisan schedule:run >> /dev/null 2>&1
```
将 /path/to/your/project 替换为你的 Laravel 项目在 Homestead 虚拟机中的绝对路径。例如，如果你的项目位于 /home/vagrant/code/myproject，则应将 /path/to/your/project 替换为 /home/vagrant/code/myproject。

保存更改并退出

保存更改并退出文本编辑器。例如，如果使用 nano，请按 Ctrl + X，然后按 Y，再按 Enter 以保存并退出。

现在，你已成功在 Vagrant Homestead 中配置了 Laravel 调度程序。Cron 任务将每分钟运行一次 schedule:run 命令。

### laravel-totem
#### 1 访问 Laravel Totem Web UI

首先，确保你已经安装并配置好了 Laravel Totem（见之前的回答），然后访问 Laravel Totem Web UI。默认情况下，访问以下 URL：
```
http://yourapp.local/totem
```
（如果你将路由前缀更改为其他值，请替换 totem。）

#### 2 创建新任务

在 Laravel Totem Web UI 中，点击右上角的 New Task 按钮。

填写任务详细信息 在创建任务的表单中，填写以下信息：

- Description：输入一个描述性的任务名称。
- Command：从下拉列表中选择要运行的 Artisan 命令。
- Parameters（可选）：输入命令所需的任何参数。
- Timezone：选择适当的时区。在这种情况下，你可以保留默认的服务器时区。

#### 3 设置执行时间

为了让任务每天在 11:23:00 开始运行，请执行以下操作：

Frequency：选择 daily。
At：在输入框中输入 11:23。
#### 4 保存任务

点击 Save 按钮以创建新任务。

现在，你已经在 Laravel Totem 中创建了一个任务，它将每天在 11:23:00 开始运行。你可以在 Totem Web UI 中查看和管理此任务。

### 扩展包
 - [laravel-admin]()
 - [bpmn-js]()
 - [processmaker/nayra]()
 - [barryvdh/laravel-ide-helper]()
 - [Laravel Horizon](https://learnku.com/docs/laravel/9.x/horizon/12268#591671)
 - [Laravel Totem](https://github.com/codestudiohq/laravel-totem)
 - [echarts](https://echarts.apache.org/zh/index.html)
 - [dcat/easy-excel]()
