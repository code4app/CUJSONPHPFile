<?php

require 'FormatComments.php';

use CUFormatComments\CUFormatComments;

$options = getopt("s:d");
if (!is_array($options))
{
  die("There was a problem reading in the option\n");
}

$path = $options['s'];
if (empty($path))
{
  die('-s source path must be set');
}

$json = shell_exec('php ' . 'php_to_json.php ' . $path);
$jsonValue = json_decode($json, TRUE);
if (!empty($jsonValue['error']))
{
    die('parse source:' . $path . ' failed');
}

function jsonToReadable($json){
    $tc = 0;        //tab count
    $r = '';        //result
    $q = false;     //quotes
    $t = "\t";      //tab
    $nl = "\n";     //new line

    for($i=0;$i<strlen($json);$i++){
        $c = $json[$i];
        if($c=='"' && $json[$i-1]!='\\') $q = !$q;
        if($q){
            $r .= $c;
            continue;
        }
        switch($c){
            case '{':
            case '[':
                $r .= $c . $nl . str_repeat($t, ++$tc);
                break;
            case '}':
            case ']':
                $r .= $nl . str_repeat($t, --$tc) . $c;
                break;
            case ',':
                $r .= $c;
                if($json[$i+1]!='{' && $json[$i+1]!='[') $r .= $nl . str_repeat($t, $tc);
                break;
            case ':':
                $r .= $c . ' ';
                break;
            default:
                $r .= $c;
        }
    }
    return $r;
}

function generateMarkDown($jsonValue)
{
    $markDown = "";
    foreach ($jsonValue as $className => $methods)
    {
        $markDown .= "## $className 接口\n";
        echo "Class $className:\n";

        foreach ($methods as $methodName => $comment)
        {
            $httpMethod = strpos($methodName, "_get");
            $docMethodName = strstr($methodName, "_get", TRUE);
            if ($httpMethod === FALSE)
            {
                $httpMethod = strpos($methodName, "_post");
                $docMethodName = strstr($methodName, "_post", TRUE);
                if ($httpMethod === FALSE)
                {
                    //not get or post method we don't need dump it
                    continue;
                }
                else
                {
                    $httpMethod = "POST";
                }
            }
            else
            {
                $httpMethod = "GET";
            }

            echo "  httpMethod : $httpMethod function: $docMethodName\n";
            $markDown .= "### $docMethodName\n";
            
            if ($comment === FALSE)
            {
                echo '      empty comment'."\n";
                $markDown .= "暂无文档描述\n\n";

                $markDown .= "#### HTTP请求方式:\n";
                $markDown .= "$httpMethod\n\n";
            }
            else
            {
                $formatComments = new CUFormatComments($comment);
                $result = $formatComments->formatComment();

                echo "      method comments: ".$result['des'];
                $markDown .= $result['des'];

                $markDown .= "#### HTTP请求方式:\n";
                $markDown .= "$httpMethod\n\n";

                $markDown .= "#### URL:\n\n";
                $link = $result['link'];
                $markDown .= "[$link]($link)\n\n";

                $markDown .= "#### 请求参数:\n";

/*
                $markDown .= '<table class="table table-bordered table-striped table-condensed">';
                $markDown .= '<tr>';
                $markDown .= '<td>参数</td>';
                $markDown .= '<td>说明</td>';
                $markDown .= '</tr>';
                */

                foreach ($result['params'] as $param)
                {
                    /*
                    $markDown .= '<tr>';
                    echo "      param name :".$param['name'];
                    $markDown .= '<td>'.$param['name'].'</td>';
                    echo "      param des :".$param['des']."\n";
                    $markDown .= '<td>'.$param['des'].'</td>'."\n\n";
                    $markDown .= '</tr>';*/

                    $markDown .= "* ".$param['name'].' '.$param['des']. "\n\n";
                }

                //$markDown .= '</table>';

                $markDown .= "#### 返回结果:\n\n";
                $markDown .= '```json'."\n\n";

                $json = jsonToReadable($result['return']);
                $markDown .= $json;

                $markDown .= "\n\n".'```';
                
                echo "\n";
                $markDown.= "\n";
            }
        }
    }
    
    file_put_contents('document.md', $markDown);
}

generateMarkDown($jsonValue);
