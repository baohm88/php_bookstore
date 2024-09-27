<?php
$this->view('admin/header.php', $data);
$this->view($data['page'], $data);
$this->view('admin/footer.php', $data);
