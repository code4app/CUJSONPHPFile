<?php

namespace CUFormatComments;

require_once 'libs/Sami/Parser/DocBlockParser.php';
require_once 'libs/Sami/Parser/Node/DocBlockNode.php';

use Sami\Parser\DocBlockParser;
use Sami\Parser\Node\DocBlockNode;

class CUFormatComments
{

    public function __construct($comments)
    {
        $dbp = new DocBlockParser();
        $this->doc = $dbp->parse($comments);
    }

    function formatComment()
    {
        $params = $this->getParam();
        $des = $this->getDescription();
        $return = $this->getReturn();
        $link = $this->getLink();
        
        return array(
            'params'    => $params, 
            'des'       => $des,
            'link'       => $link,
            'return'    => $return,
            );
    }

    public function getParam()
    {
        $params = $this->doc->getTag('param');

        $result = array();
        foreach ($params as $item)
        {
            $object['type'] = $item[0];
            $object['name'] = $item[1];
            $object['des'] = $item[2];

            $result[] = $object;
        }

        return $result;
    }

    public function getDescription()
    {
        return $this->doc->getDesc();
    }

    public function getReturn()
    {
        $res = $this->doc->getTag('return');
        if (count($res) != 1)
        {
            return "";
        }

        return $res[0][1];
    }

    public function getLink()
    {
        $res = $this->doc->getTag('link');

        return $res[0];  
    }

    private $doc;

}