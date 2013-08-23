CUJSONPHPFile
=============

###将php文件的类，和函数名以及函数的注释导出成JSON

### Vendor

[PHP-Token-Reflection](https://github.com/Andrewsville/PHP-Token-Reflection)

[Sami](https://github.com/fabpot/Sami)

###php文件转成markdown语言文档

	php markdown.php -s test

###php文件转成json

	http://localhost/CUJSONPHPFile/command.php?path=test
	
Out put

```json

{
    "Account": {
        "index_get": false,
        "test": false
    },
    "Table": {
        "index_get": false,
        "list_get": "/**\n     * 根据数据库实例名字查找所有的数据库表名称\n     * \n     * @param string $database_name  数据库实例名\n     * \n     * \n     * @param string $database_name2 dumy\n     * \n     * @link http://www.baidu.com\n     * @return json\n\n{\n    \"statuses\": [\n        {\n            \"created_at\": \"Tue May 31 17:46:55 +0800 2011\",\n            \"id\": 11488058246,\n            \"text\": \"求关注。\",\n            \"source\": \"<a href=\"http://weibo.com\" rel=\"nofollow\">新浪微博</a>\",\n            \"favorited\": false,\n            \"truncated\": false,\n            \"in_reply_to_status_id\": \"\",\n            \"in_reply_to_user_id\": \"\",\n            \"in_reply_to_screen_name\": \"\",\n            \"geo\": null,\n            \"mid\": \"5612814510546515491\",\n            \"reposts_count\": 8,\n            \"comments_count\": 9,\n            \"annotations\": [],\n            \"user\": {\n                \"id\": 1404376560,\n                \"screen_name\": \"zaku\",\n                \"name\": \"zaku\",\n                \"province\": \"11\",\n                \"city\": \"5\",\n                \"location\": \"北京 朝阳区\",\n                \"description\": \"人生五十年，乃如梦如幻；有生斯有死，壮士复何憾。\",\n                \"url\": \"http://blog.sina.com.cn/zaku\",\n                \"profile_image_url\": \"http://tp1.sinaimg.cn/1404376560/50/0/1\",\n                \"domain\": \"zaku\",\n                \"gender\": \"m\",\n                \"followers_count\": 1204,\n                \"friends_count\": 447,\n                \"statuses_count\": 2908,\n                \"favourites_count\": 0,\n                \"created_at\": \"Fri Aug 28 00:00:00 +0800 2009\",\n                \"following\": false,\n                \"allow_all_act_msg\": false,\n                \"remark\": \"\",\n                \"geo_enabled\": true,\n                \"verified\": false,\n                \"allow_all_comment\": true,\n                \"avatar_large\": \"http://tp1.sinaimg.cn/1404376560/180/0/1\",\n                \"verified_reason\": \"\",\n                \"follow_me\": false,\n                \"online_status\": 0,\n                \"bi_followers_count\": 215\n            }\n        },\n        ...\n    ],\n    \"previous_cursor\": 0,                    // 暂未支持\n    \"next_cursor\": 11488013766,     // 暂未支持\n    \"total_number\": 81655\n}\n     \n     */"
    }
}

```
