<!DOCTYPE html>
<html lang="zh_CN">
<head>
	<meta charset="UTF-8">
	<title>投票活动</title>
</head>
<body>
	<table class="table">
        <tr>
            <th>ID</th>
            <th>活动名称</th>
            <th>时间</th>
        </tr>
        <{foreach $data as $r}>
        <tr>
            <td><{$r.id}></td>
            <td><a href="<{url route="vote/list/<{$r.id}>"}>"><{$r.name}></a></td>
            <td><{$r.add_time}></td>
        </tr>
        <{/foreach}>
    </table>
</body>
</html>