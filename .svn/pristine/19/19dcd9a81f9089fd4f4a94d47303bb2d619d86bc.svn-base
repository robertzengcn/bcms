<?php

/**
 * CX标签库解析类
 */
class Cx extends TagLib {

    // 标签定义
    protected $tags   =  array(
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'php'       =>  array(),
        'if'        =>  array('attr'=>'c','level'=>2),
        'elseif'    =>  array('attr'=>'c','close'=>0),
        'else'      =>  array('attr'=>'','close'=>0),
        'foreach'   =>  array('attr'=>'name,item,key','level'=>3),
        'compare'   =>  array('attr'=>'name,value,type','level'=>3,'alias'=>'eq,neq,gt,lt,egt,elt'),
        'assign'    =>  array('attr'=>'name,value','close'=>0),
        'for'       =>  array('attr'=>'start,end,name,comparison,step', 'level'=>3),
        );
		

    /**
     * php标签解析
     * @access public
     * @param array $tag 标签属性
     * @param string $content  标签内容
     * @return string
     */
    public function _php($tag,$content) {
        $parseStr = '<?php '.$content.' ?>';
        return $parseStr;
    }



    /**
     * foreach标签解析 循环输出数据集
     * @access public
     * @param array $tag 标签属性
     * @param string $content  标签内容
     * @return string|void
     */
    public function _foreach($tag,$content) {
        $name       =   $tag['name'];
        $item       =   $tag['item'];
        $key        =   !empty($tag['key'])?$tag['key']:'key';
        $name       =   $this->autoBuildVar($name);
        $parseStr   =   '<?php if(is_array('.$name.')): foreach('.$name.' as $'.$key.'=>$'.$item.'): ?>';
        $parseStr  .=   $this->tpl->parse($content);
        $parseStr  .=   '<?php endforeach; endif; ?>';

        if(!empty($parseStr)) {
            return $parseStr;
        }
        return ;
    }

    /**
     * if标签解析
     * 格式：
     * {if c=" $a eq 1" }
	 * {elseif c="$a eq 2" /}
     * {else /}
	 * {/if}
     * 表达式支持 eq neq gt egt lt elt == > >= < <= or and || &&
     * @access public
     * @param array $tag 标签属性
     * @param string $content  标签内容
     * @return string
     */
    public function _if($tag,$content) {
        $condition  =   $this->parseCondition($tag['c']);
        $parseStr   =   '<?php if('.$condition.'): ?>'.$content.'<?php endif; ?>';
        return $parseStr;
    }

    /**
     * else标签解析
     * 格式：见if标签
     * @access public
     * @param array $tag 标签属性
     * @param string $content  标签内容
     * @return string
     */
    public function _elseif($tag,$content) {
        $condition  =   $this->parseCondition($tag['c']);
        $parseStr   =   '<?php elseif('.$condition.'): ?>';
        return $parseStr;
    }

    /**
     * else标签解析
     * @access public
     * @param array $tag 标签属性
     * @return string
     */
    public function _else($tag) {
        $parseStr = '<?php else: ?>';
        return $parseStr;
    }


    /**
     * compare标签解析
     * 用于值的比较 支持 eq neq gt lt egt elt heq nheq 默认是eq
     * 格式： <compare name="" type="eq" value="" >content</compare>
     * @access public
     * @param array $tag 标签属性
     * @param string $content  标签内容
     * @return string
     */
    public function _compare($tag,$content,$type='eq') {
        $name       =   $tag['name'];
        $value      =   $tag['value'];
        $type       =   isset($tag['type'])?$tag['type']:$type;
        $type       =   $this->parseCondition(' '.$type.' ');
        $varArray   =   explode('|',$name);
        $name       =   array_shift($varArray);
        $name       =   $this->autoBuildVar($name);
        if(count($varArray)>0)
            $name = $this->tpl->parseVarFunction($name,$varArray);
        if('$' == substr($value,0,1)) {
            $value  =  $this->autoBuildVar(substr($value,1));
        }else {
            $value  =   '"'.$value.'"';
        }
        $parseStr   =   '<?php if(('.$name.') '.$type.' '.$value.'): ?>'.$content.'<?php endif; ?>';
        return $parseStr;
    }

    public function _eq($tag,$content) {
        return $this->_compare($tag,$content,'eq');
    }

    public function _neq($tag,$content) {
        return $this->_compare($tag,$content,'neq');
    }

    public function _gt($tag,$content) {
        return $this->_compare($tag,$content,'gt');
    }

    public function _lt($tag,$content) {
        return $this->_compare($tag,$content,'lt');
    }

    public function _egt($tag,$content) {
        return $this->_compare($tag,$content,'egt');
    }

    public function _elt($tag,$content) {
        return $this->_compare($tag,$content,'elt');
    }



    /**
     * assign标签解析
     * 在模板中给某个变量赋值 支持变量赋值
     * 格式： <assign name="" value="" />
     * @access public
     * @param array $tag 标签属性
     * @param string $content  标签内容
     * @return string
     */
    public function _assign($tag,$content) {
        $name       =   $this->autoBuildVar($tag['name']);
        if('$'==substr($tag['value'],0,1)) {
            $value  =   $this->autoBuildVar(substr($tag['value'],1));
        }else{
            $value  =   '\''.$tag['value']. '\'';
        }
        $parseStr   =   '<?php '.$name.' = '.$value.'; ?>';
        return $parseStr;
    }


    
    /**
     * for标签解析
     * 格式： <for start="" end="" comparison="" step="" name="" />
     * @access public
     * @param array $tag 标签属性
     * @param string $content  标签内容
     * @return string
     */
    public function _for($tag, $content){
        //设置默认值
        $start 		= 0;
        $end   		= 0;
        $step 		= 1;
        $comparison = 'lt';
        $name		= 'i';
        $rand       = rand(); //添加随机数，防止嵌套变量冲突
        //获取属性
        foreach ($tag as $key => $value){
            $value = trim($value);
            if(':'==substr($value,0,1))
                $value = substr($value,1);
            elseif('$'==substr($value,0,1))
                $value = $this->autoBuildVar(substr($value,1));
            switch ($key){
                case 'start':   
                    $start      = $value; break;
                case 'end' :    
                    $end        = $value; break;
                case 'step':    
                    $step       = $value; break;
                case 'comparison':
                    $comparison = $value; break;
                case 'name':
                    $name       = $value; break;
            }
        }
        
        $parseStr   = '<?php $__FOR_START_'.$rand.'__='.$start.';$__FOR_END_'.$rand.'__='.$end.';';
        $parseStr  .= 'for($'.$name.'=$__FOR_START_'.$rand.'__;'.$this->parseCondition('$'.$name.' '.$comparison.' $__FOR_END_'.$rand.'__').';$'.$name.'+='.$step.'){ ?>';
        $parseStr  .= $content;
        $parseStr  .= '<?php } ?>';
        return $parseStr;
    }

}
