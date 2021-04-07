INSERT INTO `zt_cron` (`m`, `h`, `dom`, `mon`, `dow`, `command`, `remark`, `type`, `buildin`, `status`, `lastTime`) VALUES ('30', '23', '*', '*', '*', 'moduleName=project&methodName=computeTaskEffort', '计算任务剩余工时', 'zentao', '1', 'normal', '0000-00-00 00:00:00');
UPDATE `zt_report` SET
`sql` = 'select t1.id,t1.name,1 as projects, round(t3.consumed,2) as consumed from TABLE_PRODUCT as t1 left join TABLE_PROJECTPRODUCT as t2 on t1.id=t2.product left join ztv_projectsummary as t3 on t2.project=t3.project left join TABLE_PROJECT as t4 on t2.project=t4.id where t1.deleted=\'0\' and t4.deleted=\'0\''
where `code` = 'product-invest';
