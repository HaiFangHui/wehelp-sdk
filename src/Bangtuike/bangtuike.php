<?php

require_once "base_bangtuike.php";

class Bangtuike extends BaseBangtuike
{

    const PRE_URL = '/api/tasks';

    public function __construct($config)
    {
        parent::__construct($config);
    }

    public function getTaskList($params)
    {
        return $this->__get_r(self::PRE_URL, $params);
    }

    public function getTask($id, $params)
    {
        return $this->__get_r(self::PRE_URL . '/' . $id, $params, $id);
    }

    public function getTaskShare($id, $params)
    {
        return $this->__post_r(self::PRE_URL . '/' . $id . '/shares', $params, $id);
    }

    public function getTaskShareCallback($id, $params)
    {
        return $this->__post_r(self::PRE_URL . '/' . $id . '/callbacks/shares', $params, $id);
    }

    public function getTaskStat($id, $params)
    {
        return $this->__get_r(self::PRE_URL . '/' . $id . '/stats', $params, $id);
    }

}
