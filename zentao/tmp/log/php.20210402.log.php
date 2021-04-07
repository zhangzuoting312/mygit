<?php
 die();
?>

14:22:34 Uncaught Error: Call to undefined method language::projectCommon() in module\task\lang\zh-cn.php:58
Stack trace:
#0 framework\base\router.class.php(2109): include()
#1 framework\router.class.php(176): baseRouter->loadLang('task', '')
#2 framework\base\model.class.php(148): router->loadLang('task', '')
#3 framework\base\control.class.php(314): baseModel->__construct('')
#4 framework\control.class.php(111): baseControl->loadModel('task')
#5 framework\base\control.class.php(208): control->loadModel('task', '')
#6 framework\control.class.php(34): baseControl->__construct('', '', '')
#7 module\task\control.php(22): control->__construct('', '')
#8 framework\base\router.cl in module\task\lang\zh-cn.php on line 58 when visiting /ZenTaoPMS/zentaopms/www/index.php?m=task&amp;f=edit&amp;taskID=10

14:26:07 Uncaught Error: Call to undefined function é() in module\task\lang\zh-cn.php:58
Stack trace:
#0 framework\base\router.class.php(2109): include()
#1 framework\router.class.php(176): baseRouter->loadLang('task', '')
#2 framework\base\model.class.php(148): router->loadLang('task', '')
#3 framework\base\control.class.php(314): baseModel->__construct('')
#4 framework\control.class.php(111): baseControl->loadModel('task')
#5 framework\base\control.class.php(208): control->loadModel('task', '')
#6 framework\control.class.php(34): baseControl->__construct('', '', '')
#7 module\task\control.php(22): control->__construct('', '')
#8 framework\base\router.class.php(1658): task- in module\task\lang\zh-cn.php on line 58 when visiting /ZenTaoPMS/zentaopms/www/index.php?m=task&amp;f=edit&amp;taskID=10
