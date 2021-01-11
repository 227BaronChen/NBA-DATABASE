# NBA-DATABASE
本NBA-DATABASE数据库分为两个系统：球员数据查询系统和球队数据查询系统（通过首页进行选择）
# Database-project
## NBA DATABASE

#### 配置方法

1. 可以通过 Player.php 和 Team.php 修改SQL数据库的账号和密码；
2. 在 MySQL 中输入`source create_table.sql`即可创建 Database 和 Table；

3. 将所有文件放置在apache网页资料文件夹（apache安装目录下htdocs文件夹）中；
4. 启动apache，在浏览器通过localhost访问。

#### 框架搭建

* MySQL-8.0.22-winx64(https://dev.mysql.com/downloads/mysql/)
* Apache 2.4(https://www.apachelounge.com/download/)
* PHP8(https://windows.php.net/download)
* HTML

配置全过程可参考(https://blog.csdn.net/weixin_42596724/article/details/111322138)

#### 项目设计

##### MySQL部分

Database：Team_Project

Table: Player_Statistics（只有这一个）

表中篮球术语：

* Player：球员姓名
* Pos：场上位置
* Age：年龄
* Tm：所在球队
* G：当赛季参与比赛场次
* GS：当赛季首发出场次数
* MP：场均上场时间
* FG：命中数
* FGA：出手次数
* FG%：命中率
* 3P：三分球命中次数
* 3PA：三分球出手次数
* 3P%：三分球命中率
* 2P：2分球命中数
* 2PA：2分球出手数
* 2P%：2分球命中率
* eFG%：有效命中率
* FT：场均发球命中数
* FTA：场均罚球次数
* FT%：罚球命中率
* ORB：进攻篮板
* DRB：防守篮板
* TRB：总篮板
* AST：助攻
* STL：抢断
* BLK：盖帽
* TOV：失误
* PF：个人犯规
* PTS：场均得分
* year：年份

此表虽囊括大量数据，但有唯一候选码（Player，Year），经分析该表符合BCNF，故对其进行简单的数据清洗后，未再进行优化设计。

##### 网页设计部分

本在线数据库分为两个系统：球员数据查询系统和球队数据查询系统（通过首页进行选择）

网页通过HTML进行了简单的装饰

* 球员数据查询系统（Player.php)
  * 通过输入球员姓名、球队、数据类型（基础、进攻、防守、高阶）以及年份进行查询
  * 当数据类型选择为“基础”时，绘制该球员生涯的得分、抢断、助攻、篮板数据的变化趋势
* 球队数据查询系统 (Team.php)
  * 输入球队名称简写、数据类型、年份范围进行查询
  * 结果为各年该队所有球员某项数据类型的总和
* 两个系统和首页之间通过按钮进行切换
