<?php
$config->installed       = true;
$config->debug           = false;
$config->requestType     = 'GET';
$config->timezone        = 'Asia/Shanghai';
$config->db->host        = 'localhost';
$config->db->port        = '3306';
$config->db->name        = 'zentao';
$config->db->user        = 'root';
$config->db->encoding    = 'UTF8';
$config->db->password    = '123456';
$config->db->prefix      = 'zt_';
$config->webRoot         = getWebRoot();
$config->default->lang   = 'zh-cn';
$config->customSession = true;