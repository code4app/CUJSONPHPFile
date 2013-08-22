CUJSONPHPFile
=============

###将php文件的类，和函数名以及函数的注释导出成JSON

### Vendor

[PHP-Token-Reflection](https://github.com/Andrewsville/PHP-Token-Reflection)

### example

	http://localhost/CUJSONPHPFile/command.php?path=test
	
Out put

	{
    "HTTPClient": {
        "get": "/**\n\t * GET wrappwer for oAuthRequest.\n\t *\n\t * @return mixed\n\t */",
        "post": "/**\n\t * POST wreapper for oAuthRequest.\n\t *\n\t * @return mixed\n\t */",
        "delete": "/**\n\t * DELTE wrapper for oAuthReqeust.\n\t *\n\t * @return mixed\n\t */",
        "oAuthRequest": "/**\n\t * Format and sign an OAuth / API request\n\t *\n\t * @return string\n\t * @ignore\n\t */",
        "http": "/**\n\t * Make an HTTP request\n\t *\n\t * @return string API results\n\t * @ignore\n\t */",
        "getHeader": "/**\n\t * Get the header info to store.\n\t *\n\t * @return int\n\t * @ignore\n\t */",
        "build_http_query_multi": "/**\n\t * @ignore\n\t */"
    }
	}