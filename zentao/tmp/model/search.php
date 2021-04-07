<?php
global $app;
helper::cd($app->getBasePath());
helper::import('module\search\model.php');
helper::cd();
class extsearchModel extends searchModel 
{
public function getList($keywords, $pager, $type)
{
    return $this->loadExtension('search')->getList($keywords, $pager, $type);
}

/**
 * Save an index item.
 * 
 * @param  string    $objectType article|blog|page|product|thread|reply|
 * @param  int       $objectID 
 * @access public
 * @return void
 */
public function saveIndex($objectType, $object)
{
    return $this->loadExtension('search')->saveIndex($objectType, $object);
}

/**
 * Save dict info. 
 * 
 * @param  array    $words 
 * @access public
 * @return void
 */
public function saveDict($dict)
{
    return $this->loadExtension('search')->saveDict($dict);
}

public function buildIndexQuery($type, $testDeleted = true)
{
    return $this->loadExtension('search')->buildIndexQuery($type, $testDeleted);
}

/**
 * Build all search index.
 * 
 * @access public
 * @return bool
 */
public function buildAllIndex($type = '', $lastID = 0)
{
    return $this->loadExtension('search')->buildAllIndex($type, $lastID);
}

/**
 * Delete index of an object.
 * 
 * @param  string    $objectType 
 * @param  int       $objectID 
 * @access public
 * @return void
 */
public function deleteIndex($objectType, $objectID)
{
    return $this->loadExtension('search')->deleteIndex($objectType, $objectID);
}
    public function buildQuery()
    {
if($this->post->module == 'ldap') return $this->loadModel('ldap')->buildQuery();
        /* Init vars. */
        $where        = '';
        $groupItems   = $this->config->search->groupItems;
        $groupAndOr   = strtoupper($this->post->groupAndOr);
        $module       = $this->session->searchParams['module'];
        $searchParams = $module . 'searchParams';
        $fieldParams  = json_decode($_SESSION[$searchParams]['fieldParams']);
        $scoreNum     = 0;

        if($groupAndOr != 'AND' and $groupAndOr != 'OR') $groupAndOr = 'AND';

        for($i = 1; $i <= $groupItems * 2; $i ++)
        {
            /* The and or between two groups. */
            if($i == 1) $where .= '(( 1  ';
            if($i == $groupItems + 1) $where .= " ) $groupAndOr ( 1 ";

            /* Set var names. */
            $fieldName    = "field$i";
            $andOrName    = "andOr$i";
            $operatorName = "operator$i";
            $valueName    = "value$i";

            /* Fix bug #2704. */
            $field = $this->post->$fieldName;
            if(isset($fieldParams->$field) and $fieldParams->$field->control == 'input' and $this->post->$valueName === '0') $this->post->$valueName = 'ZERO';
            if($field == 'id' and $this->post->$valueName === '0') $this->post->$valueName = 'ZERO';

            /* Skip empty values. */
            if($this->post->$valueName == false) continue;
            if($this->post->$valueName == 'ZERO') $this->post->$valueName = 0;   // ZERO is special, stands to 0.
            if(isset($fieldParams->$field) and $fieldParams->$field->control == 'select' and $this->post->$valueName == 'null') $this->post->$valueName = '';   // Null is special, stands to empty if control is select. Fix bug #3279.

            $scoreNum += 1;

            /* Set and or. */
            $andOr = strtoupper($this->post->$andOrName);
            if($andOr != 'AND' and $andOr != 'OR') $andOr = 'AND';

            /* Set operator. */
            $value    = addcslashes(trim($this->post->$valueName), '%');
            $operator = $this->post->$operatorName;
            if(!isset($this->lang->search->operators[$operator])) $operator = '=';

            /* Set condition. */
            $condition = '';
            if($operator == "include")
            {
                $condition = ' LIKE ' . $this->dbh->quote("%$value%");
            }
            elseif($operator == "notinclude")
            {
                $condition = ' NOT LIKE ' . $this->dbh->quote("%$value%"); 
            }
            elseif($operator == 'belong')
            {
                if($this->post->$fieldName == 'module')
                {
                    $allModules = $this->loadModel('tree')->getAllChildId($value);
                    if($allModules) $condition = helper::dbIN($allModules);
                }
                elseif($this->post->$fieldName == 'dept')
                {
                    $allDepts = $this->loadModel('dept')->getAllChildId($value);
                    $condition = helper::dbIN($allDepts);
                }
                else
                {
                    $condition = ' = ' . $this->dbh->quote($value) . ' ';
                }
            }
            else
            {
                if($operator == 'between' and !isset($this->config->search->dynamic[$value])) $operator = '=';
                $condition = $operator . ' ' . $this->dbh->quote($value) . ' ';
            }

            /* Processing query criteria. */
            if($operator == '=' and preg_match('/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/', $value))
            {
                $condition  = '`' . $this->post->$fieldName . "` >= '$value' AND `" . $this->post->$fieldName . "` <= '$value 23:59:59'";
                $where     .= " $andOr ($condition)";
            }
            elseif($operator == '<=' and preg_match('/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/', $value))
            {
                $where .= " $andOr " . '`' . $this->post->$fieldName . "` <= '$value 23:59:59'";
            }
            elseif($condition)
            {
                $where .= " $andOr " . '`' . $this->post->$fieldName . '` ' . $condition;
            }
        }

        $where .=" ))";
        $where  = $this->replaceDynamic($where);

        /* Save to session. */
        $querySessionName = $this->post->module . 'Query';
        $formSessionName  = $this->post->module . 'Form';
        $this->session->set($querySessionName, $where);
        $this->session->set($formSessionName,  $_POST);
        if($scoreNum > 2 && !dao::isError()) $this->loadModel('score')->create('search', 'saveQueryAdvanced');
    }

//**//
}