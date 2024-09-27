<?php
$this->view('client/header.php', $data);
$this->view($data['page'], $data);
$this->view('client/footer.php', $data);
