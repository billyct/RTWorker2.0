<?php
$config = array(
        'register' => array(
            array(
                    'field' => 'username',
                    'label' => '用户名',
                    'rules' => 'required|max_length[12]|callback_user_check'
                 ),
            array(
                    'field' => 'password',
                    'label' => '密码',
                    'rules' => 'required|min_length[6]|max_length[16]'
                 ),
            array(
                    'field' => 'email',
                    'label' => '邮箱',
                    'rules' => 'required|valid_email|callback_user_check'
                 )
            ),
        'username' => array(
            array(
                    'field' => 'username',
                    'label' => '用户名',
                    'rules' => 'required|max_length[12]|callback_user_check'
                ),
            ),
        'password' => array(
                array(
                        'field' => 'password',
                        'label' => '密码',
                        'rules' => 'required|min_length[6]|max_length[16]'
                ),
            ),
        'email'    => array(
                array(
                        'field' => 'email',
                        'label' => '邮箱',
                        'rules' => 'required|valid_email|callback_user_check'
                ),
            ),
		'taskable' => array(
				array(
						'field' => 'content',
						'label' => '任务能力',
						'rules' => 'required'
				),			
			),
   );
               