<?php
$lang->file->onlySupportXLSX = 'Only xlsx format import is supported. Please convert xlsx format and import again.';

$lang->excel->fileField = 'File';

$lang->excel->title   = new stdclass();
$lang->excel->title->testcase  = 'Tình huống';
$lang->excel->title->bug       = 'Bug';
$lang->excel->title->task      = 'Nhiệm vụ';
$lang->excel->title->story     = 'Câu chuyện';
$lang->excel->title->caselib   = 'Thư viện';
$lang->excel->title->sysValue  = 'Hệ thống';
$lang->excel->title->tree      = 'Cây';

$lang->excel->error      = 'Giá trị bạn nhập này không có trong sổ xuống';
$lang->excel->errorTitle = 'Lỗi đầu vào';

$lang->excel->help     = new stdclass();
$lang->excel->help->testcase = "Sử dụng + '.' để đánh dấu các bước tình huống trong một dòng mới. Sử dụng + '.' cho kỳ vọng tương ứng với từng bước. Tiêu đề là Loại là bắt buộc. Nếu để trống, dữ liệu trong cùng một hàng sẽ bị bỏ qua. ";
$lang->excel->help->bug      = "Tiêu đề là bắt buộc. Nếu để trống, dữ liệu trong cùng một hàng sẽ bị bỏ qua.";
$lang->excel->help->task     = "Tiêu đề và Loại là bắt buộc. Nếu để trống, dữ liệu trong cùng một hàng sẽ bị bỏ qua. Sử dụng '>'  trước tiêu đề này để đánh dấu nhiệm vụ con.";
$lang->excel->help->multiple = 'Nếu bạn thêm nhiệm vụ nhiều người dùng, vui lòng thêm nó trong cột "Dự tính.(giờ)" trong định dạng "Tên người dùng : Dự tính.(giờ)", và mỗi người dùng sẽ ở trong một dòng. Tên người dùng được liệt kê trong cột "F" của bảng tính "hệ thống".';
$lang->excel->help->taskTip  = 'A task cannot be a child task which is a multi-user task.';
$lang->excel->help->story    = "Tiêu đề là bắt buộc. Nếu để trống, dữ liệu trong cùng một hàng sẽ bị bỏ qua.";
