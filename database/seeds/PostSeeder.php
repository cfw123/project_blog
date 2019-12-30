<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [];
        for($i=0;$i<50;$i++){
            $tmp = [];
            $tmp['title']=str_random(20);
            $tmp['content']='<p><img src="/ueditor/php/upload/image/20191210/1575978249581914.jpg" title="1575978249581914.jpg" alt="1482237063319149.jpg"/>PHP作为服务器端的脚本语言，其跨平台性以及丰富的函数库成为网站开发的主流语言，而作为网站必不可少的数据库，轻量、开源、性能优良、简单易用的<a target="_blank" href="https://baike.baidu.com/item/MySQL/471251" style="color: rgb(19, 110, 194); text-decoration-line: none;">MySQL</a>得到各个中小型企业的青睐。所以，PHP访问数据库技术就成为网站开发的一项基本且重要的工作。基于不同的环境、不同的工具，可以使用不同的MySQL数据库的访问方法。</p><p>1. 面向对象的方法</p><p>1.1 mysqli</p><p>通过<a target="_blank" href="https://baike.baidu.com/item/MySQLi/1286552" style="color: rgb(19, 110, 194); text-decoration-line: none;">MySQLi</a>构造方法实例化一个MySQL连接对象，相当于建立了一个连接，后续代码完全使用面向对象的方法，使用该对象的成员函数操作MySQL数据库。</p><p>1.2 PDO连接MySQL数据库</p><p><a target="_blank" href="https://baike.baidu.com/item/PDO/9496399" style="color: rgb(19, 110, 194); text-decoration-line: none;">PDO</a>是基于数据库抽象层的一种访问方法，基于不同的数据库的驱动运行不同的链接库进行数据库访问。同样适用面向对象的方法，创建PDO对象进行连接。</p><p>1.3 ADODB连接MySQL数据库</p><p><a target="_blank" href="https://baike.baidu.com/item/ADODB/6528570" style="color: rgb(19, 110, 194); text-decoration-line: none;">ADODB</a>同样是数据库抽象类。ADODB的数据库提供了共通的应用程序和所有支持的数据库连接，ADODB提供了很 比较实用的方法，使它超越了一个抽象层的功能。</p><p>2. 面向过程的方法</p><p>面向过程的方法是PHP连接数据库最基本的方法，使用较为简单。其灵活性较差，在大型项目的开发中一般较少使用。 该设计提供了一个面向过程的接口，并且是针对MySQL4.1.3或更早版本设计的 。 因此 ，虽然也可 以与MySQL4.1.3或更新的数据库<a target="_blank" href="https://baike.baidu.com/item/%E6%9C%8D%E5%8A%A1%E7%AB%AF/6492316" style="color: rgb(19, 110, 194); text-decoration-line: none;">服务端</a>进行交互，但并不支持后期MySQL服务端提供的一些特性。由于比较古老，安全性差，所以现在被后来的MySQLi取代。</p><p><br/></p>';
            $tmp['user_id']=1;
            $tmp['cate_id']=rand(1,6);
            $tmp['img']='/Upload/2019-12-10/1575977706475678.jpg';
            $tmp['created_at']=date('Y-m-d H:i:s');
            $tmp['updated_at']=date('Y-m-d H:i:s');
            $arr[]=$tmp;

        }
        DB::table('posts')->insert($arr);
    }
}
