<?php  $post = request()->except('_token'); ?>
尊敬的用户：{{$post['user_name']}}，欢迎注册！！