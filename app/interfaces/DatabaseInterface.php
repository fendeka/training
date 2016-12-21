<?php

namespace inter_face;

interface DatabaseInterface
{
    public function connect();
    public function executeQuery($sql, $params = array());
    public function disconnect();
}